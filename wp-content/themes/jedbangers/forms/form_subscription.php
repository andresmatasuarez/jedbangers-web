  <?php

  require_once '../../../../config.php';
  require_once '../../../../vendor/autoload.php';
  require_once '../utils/response.php';
  require_once '../utils/session.php';
  require_once 'form.php';

  Response::allow_method('POST');

  session_start();

  if (!isset($_POST['token']) || !Session::verify_token('token_form_subscription', $_POST['token'])){
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
  $MAX_LENGTH_FIRST_NAME = 30;
  $MAX_LENGTH_LAST_NAME  = 30;
  $MAX_LENGTH_PROVINCE   = 50;
  $MAX_LENGTH_CITY       = 50;
  $MAX_LENGTH_ADDRESS    = 70;
  $MAX_LENGTH_NOTES      = 250;
  $MIN_ZIP_CODE          = 1000;
  $MAX_ZIP_CODE          = 9999;
  $GIFT_MAGAZINES        = array(16, 17, 18, 19, 21);

  $form = new Form(array(
    'first_name' => array(
      'label'     => 'Nombre/s',
      'type'      => 'string',
      'required'  => true,
      'maxlength' => $MAX_LENGTH_FIRST_NAME
    ),
    'last_name' => array(
      'label'     => 'Apellido/s',
      'type'      => 'string',
      'required'  => true,
      'maxlength' => $MAX_LENGTH_LAST_NAME
    ),
    'email' => array(
      'label'    => 'Correo electrónico',
      'type'     => 'email',
      'required' => true
    ),
    'province' => array(
      'label'     => 'Provincia',
      'type'      => 'string',
      'required'  => true,
      'maxlength' => $MAX_LENGTH_PROVINCE
    ),
    'city' => array(
      'label'     => 'Ciudad',
      'type'      => 'string',
      'required'  => true,
      'maxlength' => $MAX_LENGTH_CITY
    ),
    'address' => array(
      'label'     => 'Dirección',
      'type'      => 'string',
      'required'  => true,
      'maxlength' => $MAX_LENGTH_ADDRESS
    ),
    'zip_code' => array(
      'label'    => 'Código postal',
      'type'     => 'number',
      'required' => true,
      'minvalue' => $MIN_ZIP_CODE,
      'maxvalue' => $MAX_ZIP_CODE
    ),
    'gift_magazine' => array(
      'label'    => 'Revista de regalo',
      'type'     => 'number',
      'required' => false,
      'select'   => $GIFT_MAGAZINES
    ),
    'notes' => array(
      'label'     => 'Notas',
      'type'      => 'string',
      'required'  => false,
      'maxlength' => $MAX_LENGTH_NOTES
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
  $first_name    = $form->value('first_name');
  $last_name     = $form->value('last_name');
  $email         = $form->value('email');
  $province      = $form->value('province');
  $city          = $form->value('city');
  $address       = $form->value('address');
  $zip_code      = $form->value('zip_code');
  $gift_magazine = $form->value('gift_magazine');
  $notes         = $form->value('notes');

  // Message template
  $message_body = file_get_contents('../templates/_email_subscription.html');
  $message_body = str_replace(array(
    '{{ first_name }}', '{{ last_name }}',     '{{ email }}',
    '{{ province }}',   '{{ city }}',          '{{ address }}',
    '{{ zip_code }}',   '{{ gift_magazine }}', '{{ notes }}'
  ), array(
    $first_name, $last_name,      $email,
    $province,   $city,           $address,
    $zip_code,   $gift_magazine,  $notes
  ), $message_body);


  // Mail build
  $mailer = new SendGrid(Config::$SENDGRID_USERNAME, Config::$SENDGRID_PASSWORD, Config::$SENDGRID_OPTIONS);
  $message = new SendGrid\Email();
  $message->addTo(Config::$SUBCRIPTION_FORM_TO);
  $message->setReplyTo($email);
  $message->setFrom($email);
  $message->setFromName('Subscripciones Jedbangers');
  $message->setSubject('Nuevo suscriptor | ' . $first_name . ' ' . $last_name);
  $message->setHtml($message_body);

  $response = $mailer->send($message);
  if(strcmp($response->message, 'success') !== 0) {
    Response::json(500, 'El mensaje no pudo ser enviado. Error: ' . $response->errors[0]);
  }

  unset($_SESSION['token_form_subscription']);

  Response::json(200, 'Gracias! El mensaje fue enviado. Te responderemos a la brevedad.');

?>
