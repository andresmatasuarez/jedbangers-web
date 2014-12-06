  <?php

  require_once '../../../../config.php';
  require_once '../../../../vendor/autoload.php';
  require_once '../utils/response.php';
  require_once '../utils/session.php';
  require_once 'form.php';

  Response::allow_method('POST');

  session_start();

  if (!isset($_POST['token']) || !Session::verify_token('token_form_contact', $_POST['token'])){
    Response::json(401, 'La sesión es inválida o este formulario ya fue enviado.');
  }

  unset($_POST['token']);

  if (!isset($_POST['recaptcha']) || !isset($_POST['recaptcha']['challenge']) || !isset($_POST['recaptcha']['response'])){
    Response::json(400, 'Captcha requerido!');
  }

  // Validate captcha
  $captcha = new Captcha\Captcha();
  $captcha->setPublicKey(Config::$RECAPTCHA_PUBLIC);
  $captcha->setPrivateKey(Config::$RECAPTCHA_SECRET);
  $response = $captcha->check($_POST['recaptcha']['challenge'], $_POST['recaptcha']['response']);
  if (!$response->isValid()){
    Response::json(401, 'Captcha inválido!');
  }

  unset($_POST['recaptcha']);

  // Form creation
  $MAX_LENGTH_NAME    = 30;
  $MAX_LENGTH_SUBJECT = 70;
  $MAX_LENGTH_MESSAGE = 250;
  $REASONS = array(
    'enquiry'   => 'Consultas',
    'complaint' => 'Reclamos',
    'difussion' => 'Bandas/Difusión',
    'other'     => 'Otros'
  );

  $form = new Form(array(
    'full_name' => array(
      'label'     => 'Nombre/s',
      'type'      => 'string',
      'required'  => true,
      'maxlength' => $MAX_LENGTH_NAME
    ),
    'email' => array(
      'label'    => 'Correo electrónico',
      'type'     => 'email',
      'required' => true
    ),
    'reason' => array(
      'label'     => 'Motivo',
      'type'      => 'string',
      'required'  => true,
      'select'    => $REASONS
    ),
    'subject' => array(
      'label'     => 'Asunto',
      'type'      => 'string',
      'required'  => true,
      'maxlength' => $MAX_LENGTH_SUBJECT
    ),
    'message' => array(
      'label'     => 'Mensaje',
      'type'      => 'string',
      'required'  => true,
      'maxlength' => $MAX_LENGTH_MESSAGE
    )
  ));

  $errors = $form->validate_whitelist();

  if (!empty($errors)){
    Response::json(400, $errors);
  }

  $errors = $form->validate_required();

  if (!empty($errors)){
    Response::json(400, $errors);
  }

  $form->fill_values();

  $errors = $form->validate_format();

  if (!empty($errors)){
    Response::json(400, $errors);
  }

  // Get form values
  $full_name = $form->value('full_name');
  $email     = $form->value('email');
  $reason    = $form->value('reason');
  $subject   = $form->value('subject');
  $message   = $form->value('message');

  // Message template
  $message_body = file_get_contents('../templates/_email_contact.html');
  $message_body = str_replace(array(
    '{{ full_name }}', '{{ email }}', '{{ reason }}', '{{ subject }}', '{{ message }}'
  ), array(
    $full_name, $email, $REASONS[$reason], $subject, $message
  ), $message_body);

  // Mail build
  $mailer = new SendGrid(Config::$SENDGRID_USERNAME, Config::$SENDGRID_PASSWORD, Config::$SENDGRID_OPTIONS);
  $message = new SendGrid\Email();
  $message->addTo(Config::$CONTACT_FORM_TO);
  $message->setReplyTo($email);
  $message->setFrom($email);
  $message->setFromName('Contacto Jedbangers');
  $message->setSubject('Contacto | ' . $full_name);
  $message->setHtml($message_body);

  $response = $mailer->send($message);
  if(strcmp($response->message, 'success') !== 0) {
    Response::json(500, 'El mensaje no pudo ser enviado. Error: ' . $response->errors[0]);
  }

  unset($_SESSION['token_form_contact']);

  Response::json(200, 'Gracias! El mensaje fue enviado. Te responderemos a la brevedad.');

?>
