<?php
/*
 * Template name: contact
 */

  require_once './config.php';
  require_once 'utils/session.php';

  session_start();

  get_header();

  $session_token = Session::generate_token('token_form_contact');

  get_header();

?>

  <div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-title">Leer antes de completar!</div>
      </div>

      <ul class="list-group">
        <li class="list-group-item">
          <strong>Si querés suscribirte</strong>, hacé click <a href="<?php echo get_permalink(get_page_by_path('subscribe')); ?>">acá</a>.
        </li>
        <li class="list-group-item">
          <strong>Si querés comprar una revista (actual o atrasada)</strong>, hacé click <a href="<?php echo get_permalink(get_page_by_path('issues')); ?>">acá</a>.
        </li>
      </ul>
    </div>
  </div>

  <div class="col-md-7"
    ng-controller="ContactController"
    ng-init="init('<?php echo $session_token; ?>', '<?php echo Config::$RECAPTCHA_PUBLIC; ?>');">

    <ng-include src="model.formTemplate"></ng-include>

  </div>

<?php get_footer(); ?>
