<?php
/*
 * Template name: subscribe
 */

  require_once './config.php';
  require_once 'utils/session.php';

  session_start();

  get_header();

  $session_token = Session::generate_token('token_form_subscription');

?>

  <div class="container-fluid"
    ng-controller="SubscribeController"
    ng-init="init('<?php echo $session_token; ?>', '<?php echo Config::$RECAPTCHA_PUBLIC; ?>');">

        <div class="float-left">
          <img src="<?php echo get_bloginfo('template_url');?>/img/covers3.png" >
        </div>

        <div class="col-md-8">
          <h3 class="section no-margin-top">Detalles</h3>
          <div>
            La suscripción por <strong>$192</strong> incluye:
            <ul>
              <li>Los próximos 6 números de la revista <span class="jedbangers">Jedbangers</span> en tu domicilio.</li>
              <li ng-if="!_.isEmpty(model.giftMagazines)">
                Una revista de regalo:
                <strong>
                  <span ng-repeat="m in model.giftMagazines">
                    #{{ m.number + ($index < model.giftMagazines.length - 2 ? ',' : ($index === model.giftMagazines.length - 1 ? '.' : ' o')) }}
                  </span>
                </strong>
              </li>
              <li>El derecho a participar en los sorteos que son sólo para suscriptos.</li>
              <li>Participás de sorteos de entradas para shows internacionales</li>
              <li>Participás de sorteos de Meet and Greet para cuando vienen bandas internacionales</li>
            </ul>
          </div>

          <h3 class="section">Términos y condiciones</h3>
          <div>
            <ul>
              <li>
                Asegurate de leer las
                <a href="" ng-click="openModal(model.faqTemplate, { contactFormTemplate: model.contactTemplate, reason_enquiry: model.reason_enquiry })"><strong>PREGUNTAS FRECUENTES</strong></a>
                antes de suscribirte.
              </li>
              <li>
                Si tenés alguna duda, no dudes en
                <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>">consultarnos</a>.
              </li>
            <ul>
          </div>

          <h3 class="section">Suscribite</h3>
          <div>
            <p>
              Dejanos tus datos para inpiciar el trámite de suscripción. Te responderemos a la brevedad.
            </p>
            <ng-include src="model.formTemplate"></ng-include>
          </div>

        </div>

  </div>

<?php get_footer(); ?>
