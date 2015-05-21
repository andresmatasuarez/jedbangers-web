<!DOCTYPE html>
<html lang="en" ng-app="jeds" style="margin-top: 0 !important;">
  <head>
    <meta charset="utf-8">
    <title>JEDBANGERS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url') . '/genericons/genericons.css';?>">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300">
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url') . '/bower_components/blueimp-gallery/css/blueimp-gallery.min.css';?>">
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url') . '/bower_components/blueimp-bootstrap-image-gallery/css/bootstrap-image-gallery.min.css';?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->

	  <script src="//www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>

    <?php

    	$tpl = get_bloginfo('template_url');
    	$lib = $tpl . '/bower_components';
    	$js = $tpl . '/js';
    	$filters = $js . '/filters';
    	$services = $js . '/services';
    	$directives = $js . '/directives';
    	$controllers = $js . '/controllers';

    	// Lib
	    wp_register_script('lodash',                  $lib . '/lodash/dist/lodash.min.js');
	    wp_register_script('moment',                  $lib . '/moment/min/moment.min.js');
	    wp_register_script('moment/es',               $lib . '/moment/locale/es.js');
	    wp_register_script('angular',                 $lib . '/angular/angular.min.js');
	    wp_register_script('angular-i18n',            $lib . '/angular-i18n/angular-locale_es-ar.js');
	    wp_register_script('angular-sanitize',        $lib . '/angular-sanitize/angular-sanitize.min.js');
	    wp_register_script('angular-animate',         $lib . '/angular-animate/angular-animate.min.js');
	    wp_register_script('restangular',             $lib . '/restangular/dist/restangular.min.js');
	    wp_register_script('angular-recaptcha',       $lib . '/angular-recaptcha/release/angular-recaptcha.min.js');
	    wp_register_script('ui-bootstrap',            $lib . '/angular-bootstrap/ui-bootstrap.min.js');
	    wp_register_script('ui-bootstrap-tpls',       $lib . '/angular-bootstrap/ui-bootstrap-tpls.min.js');
	    wp_register_script('blueimp-gallery',         $lib . '/blueimp-gallery/js/jquery.blueimp-gallery.min.js');
	    wp_register_script('bootstrap-image-gallery', $lib . '/blueimp-bootstrap-image-gallery/js/bootstrap-image-gallery.min.js');

	    // Angular app
		  wp_register_script('app',                      $tpl . '/app.js');
		  wp_register_script('values',                   $js . '/values.js');
		  wp_register_script('APIService',               $services . '/service_api.js');
	    wp_register_script('dropdownOnHoverDirective', $directives . '/directive_dropdown_on_hover.js');
	    wp_register_script('croppedImageDirective',    $directives . '/directive_cropped_image.js');
	    wp_register_script('disableNgAnimateDirective',$directives . '/directive_disable_ng_animate.js');
	    wp_register_script('UTCFilter',                $filters . '/filter_utc.js');
	    wp_register_script('AutolinkFilter',           $filters . '/filter_autolink.js');
	    wp_register_script('jedsIdFilter',             $filters . '/filter_jedsid.js');
	    wp_register_script('sectionLabel',             $filters . '/filter_section_label.js');
	    wp_register_script('integerToRoman',           $filters . '/filter_integer_to_roman.js');
	    wp_register_script('SellingPointsController',  $controllers . '/controller_selling_points.js');
	    wp_register_script('LabelController',          $controllers . '/controller_label.js');
	    wp_register_script('RecordController',         $controllers . '/controller_record.js');
	    wp_register_script('BooksController',          $controllers . '/controller_books.js');
	    wp_register_script('BookController',           $controllers . '/controller_book.js');
	    wp_register_script('ContactController',        $controllers . '/controller_contact.js');
	    wp_register_script('SubscribeController',      $controllers . '/controller_subscribe.js');
	    wp_register_script('IssuesController',         $controllers . '/controller_issues.js');
	    wp_register_script('SidebarController',        $controllers . '/controller_sidebar.js');

		  wp_enqueue_script('lodash');
		  wp_enqueue_script('moment');
		  wp_enqueue_script('moment/es');
    	wp_enqueue_script('jquery');
		  wp_enqueue_script('angular');
		  wp_enqueue_script('angular-i18n');
		  wp_enqueue_script('angular-animate');
		  wp_enqueue_script('angular-sanitize');
		  wp_enqueue_script('restangular');
		  wp_enqueue_script('angular-recaptcha');
		  wp_enqueue_script('ui-bootstrap');
		  wp_enqueue_script('ui-bootstrap-tpls');
    	wp_enqueue_script('blueimp-gallery');
    	wp_enqueue_script('bootstrap-image-gallery');
    	wp_enqueue_script('fancybox');

    	wp_enqueue_script('app');
		  wp_enqueue_script('values');
	    wp_enqueue_script('APIService');
	    wp_enqueue_script('dropdownOnHoverDirective');
	    wp_enqueue_script('croppedImageDirective');
	    wp_enqueue_script('disableNgAnimateDirective');
	    wp_enqueue_script('fancyboxDirective');
	    wp_enqueue_script('UTCFilter');
	    wp_enqueue_script('AutolinkFilter');
	    wp_enqueue_script('jedsIdFilter');
	    wp_enqueue_script('sectionLabel');
	    wp_enqueue_script('integerToRoman');
	    wp_enqueue_script('SellingPointsController');
	    wp_enqueue_script('LabelController');
	    wp_enqueue_script('RecordController');
	    wp_enqueue_script('BooksController');
	    wp_enqueue_script('BookController');
	    wp_enqueue_script('ContactController');
	    wp_enqueue_script('SubscribeController');
	    wp_enqueue_script('IssuesController');
	    wp_enqueue_script('SidebarController');

		  // we need to create a JavaScript variable to store our API endpoint...
		  // this is the API address of the JSON API plugin
		  //wp_localize_script('app', 'API', array(
		  //	'url' => get_bloginfo('wpurl') . '/wp-json/')
		  //);

		  // ... and useful information such as the theme directory and website url
		  wp_localize_script('app', 'App', array(
		  	'template_url' => $tpl
		  ));

	    wp_head();
    ?>

  </head>

  <body <?php body_class();?>>

		<!-- Tweet button -->
	  <script>
	    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
	  </script>

	  <!-- FB button -->
	  <script>
	  	var fbAppId = '<?php echo FB_APP_ID; ?>';
	    window.fbAsyncInit = function(){
	      FB.init({
	        appId      : fbAppId,
	        xfbml      : true,
	        version    : 'v2.2'
	      });
	    };

	    (function(d, s, id){
	       var js, fjs = d.getElementsByTagName(s)[0];
	       if (d.getElementById(id)) {return;}
	       js = d.createElement(s); js.id = id;
	       js.src = "//connect.facebook.net/en_US/sdk.js";
	       fjs.parentNode.insertBefore(js, fjs);
	     }(document, 'script', 'facebook-jssdk'));
	  </script>
  	<div id="fb-root"></div>


	<div class="container">

		<div class="row">

			<div class="sidebar-column col-md-3">
				<div class="container-fluid">
					<div class="centered logo">
						<a class="link logo-img" href="<?php echo esc_url( home_url( '/' ) ); ?>"></a>
						<div class="social centered">
							<a class="fa-stack fa-lg" target="_blank" href="http://www.facebook.com/pages/Revista-JEDBANGERS/112633800288">
							  <i class="fa fa-circle fa-stack-2x"></i>
							  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
							</a>
							<a class="fa-stack fa-lg" target="_blank" href="http://twitter.com/jedbangers">
							  <i class="fa fa-circle fa-stack-2x"></i>
							  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
							</a>
							<a class="fa-stack fa-lg" target="_blank" href="http://www.youtube.com/user/jedbangers">
							  <i class="fa fa-circle fa-stack-2x"></i>
							  <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
							</a>
							<a class="fa-stack fa-lg" target="_blank" href="<?php echo get_bloginfo('rss2_url'); ?>">
							  <i class="fa fa-circle fa-stack-2x"></i>
							  <i class="fa fa-rss fa-stack-1x fa-inverse"></i>
							</a>
							<a class="fa-stack fa-lg" target="_blank" href="http://jedbangers.com.ar/forito2/">
							  <i class="fa fa-circle fa-stack-2x"></i>
							  <i class="fa fa-stack-1x fa-inverse"
							  		style="font-family: Oswald; font-size: 0.6em; font-weight: normal; text-transform: uppercase;">foro</i>
							</a>
						</div>
					</div>
				</div>

<!--
				<div class="container-fluid">
		    	<form class="centered newsletter" role="newsletter">
						<div class="input-group add-on">
							<input type="text" class="input-sm form-control" placeholder="Dejanos tu email y enterate de todo!"/>
							<div class="input-group-btn">
								<button class="input-sm btn btn-default" class="form-control">
									<i class="genericon genericon-subscribed"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
 -->
				<div class="row">
				  <div class="sidebar" ng-controller="SidebarController">

				    <div class="thumbnail current-number">
				      <h3>Ya salió!</h3>
				      <h4 class="jedbangers">Jedbangers #{{ current.number }}</h4>
				      <a href="" ng-click="openIssueModal(current.number)">
				    		<img class="cover" data-ng-src="{{ _.first(_.flatten([ current.cover ])) }}"/>
				    	</a>
				    	<!-- <p class="more-info">
			        	<a href="" ng-click="openIssueModal(current.number)" class="btn btn-danger" role="button">+ info</a>
			       	</p> -->
				    </div>

				    <div class="thumbnail issues hidden-xs">
			    		<a href="<?php echo get_permalink(get_page_by_path('issues')); ?>">
			    			<img src="http://jedbangers.com.ar/imagenes/atrasados.png" border="0">
			    		</a>
				   	</div>

				    <div class="thumbnail hidden-xs">
			    		<a href="http://www.jedbangers.com.ar/web/v8-antologia-preventa/">
			    			<img src="http://www.jedbangers.com.ar/web/wp-content/uploads/2014/04/frente-m2.png"
			    			height="395" border="0"/>
			    		</a>
				   	</div>

				    <div class="thumbnail hidden-xs">
			    		<a href="http://www.jedbangers.com.ar/web/iommi/">
			    			<img src="http://www.jedbangers.com.ar/web/wp-content/uploads/2011/05/3dcaja1.jpg"
			    			height="390" border="0">
			    		</a>
				   	</div>

				    <div class="thumbnail hidden-xs">
			    		<a href="http://www.jedbangers.com.ar/web/metallica-the-club-dayz/">
			    			<img src="http://www.jedbangers.com.ar/web/wp-content/uploads/2012/09/metallica-tcd-sidebar.jpg"
			    			height="390" border="0">
			    		</a>
				   	</div>

				    <div class="thumbnail hidden-xs">
			    		<a href="http://www.jedbangers.com.ar/web/mustaine-la-autobiografia/">
			    			<img src="http://jedbangers.com.ar/imagenes/publicidad-libro.jpg"
			    			height="340" border="0">
			    		</a>
				   	</div>

				    <div class="thumbnail hidden-xs">
			    		<a href="" style="display: block; background: url('http://jedbangers.com.ar/imagenes/back-libro.jpg');">
			    			<img src="http://jedbangers.com.ar/imagenes/libro.png" border="0">
			    		</a>
				   	</div>

				    <div class="thumbnail hidden-xs">
			    		<a href="http://www.jedbangers.com.ar/web/vista-chino-peace-combos/">
			    			<img src="http://www.jedbangers.com.ar/web/wp-content/uploads/2013/10/widget.jpg" border="0">
			    		</a>
				   	</div>

					</div>
				</div>
			</div>

		  <div class="col-md-9">

			  <nav role="navigation" class="navbar navbar-default navbar-inverse navbar-static-top" style="margin-top: 10px; border-radius: 5px;">
			  	<div class="container-fluid">
		        <div>
		          <ul class="nav navbar-nav">
		            <?php //wp_list_pages(array('title_li' => '', 'exclude' => 4)); ?>
				        <li dropdown-on-hover class="top-level dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Revista <span class="caret"></span></a>
				          <ul class="dropdown-menu" role="menu">
				            <li><a href="<?php echo get_permalink(get_page_by_path('issues')); ?>">Números</a></li>
				            <li class="divider"></li>
				            <li><a href="<?php echo get_permalink(get_page_by_path('subscribe')); ?>">Suscribite</a></li>
				            <li class="divider"></li>
				            <li><a href="<?php echo get_permalink(get_page_by_path('selling-points')); ?>">Puntos de venta</a></li>
				          </ul>
				        </li>
		            <li dropdown-on-hover class="top-level dropdown"><a href="<?php echo get_permalink(get_page_by_path('books')); ?>">Libros</a></li>
				        <li dropdown-on-hover class="top-level dropdown"><a href="<?php echo get_permalink(get_page_by_path('label')); ?>">Sello</a></li>
				        <li dropdown-on-hover class="top-level dropdown"><a href="http://www.jedbangers.com.ar/tienda/index.php" target="_blank"><i class="cart-icon fa fa-shopping-cart"></i> Tienda online</a></li>
                <!--
                <li class="top-level online-store">
                	<a href="http://www.jedbangers.com.ar/tienda/index.php" target="_blank">
                		<i class="cart-icon fa fa-shopping-cart fa-2x"></i>
                		<div class="jedbangers"><div>Tienda</div><div>online</div></div>
                	</a>
                </li>
                -->
				        <li dropdown-on-hover class="top-level dropdown"><a href="#">Publicite</a></li>
				        <li dropdown-on-hover class="top-level dropdown"><a href="<?php echo get_permalink(get_page_by_path('contact')); ?>">Contacto</a></li>
		          </ul>
		          <!-- <ul class="nav navbar-nav navbar-right">
		          	<form class="search navbar-form" role="search">
									<div class="input-group">
										<div class="input-group-btn">
											<input type="text" class="input-sm form-control" placeholder="Buscá en el sitio"/>
											<button class="btn btn-default input-sm" class="form-control">
												<i class="glyphicon glyphicon-search"></i>
											</button>
										</div>
									</div>
								</form>
		          </ul> -->
		        </div>
				  </div>
			  </nav>

			  <?php if (is_front_page()) : ?>

			  		<!-- Diplay posts carousel -->
			  		<div class="row slider-container hidden-xs">

							<div class="col-md-8">
								<carousel interval="3000" disable-ng-animate>
									<?php
										$recent_posts = wp_get_recent_posts(array(
											'numberposts' => 3,
											'post_type' => 'post'
										));

										$first = true;
										foreach($recent_posts as $recent){
											echo '<slide ' . ($first ? 'active="active"' : '') . '>';
												echo '<img style="width: 100%;" src="' . wp_get_attachment_url( get_post_thumbnail_id($recent['ID'])) . '"></img>';
												echo '<div class="carousel-caption">';
													echo '<a href="' . get_permalink($recent['ID']) . '">';
														echo '<h3 class="title">' . $recent['post_title'] . '</h3>';
													echo '</a>';
													echo '<p>' . $recent['post_excerpt'] . '</p>';
												echo '</div>';
											echo '</slide>';
											$first = false;
										}
				        	?>
						    </carousel>
						  </div>

							<div class="col-md-4">
								<div class="centered">
									<object	id="playerList37971" width="206" height="182"
													type="application/x-shockwave-flash"
													data="http://www.ivoox.com/playeriVoox_em_37971_1.html">
										<param name="movie" value="http://www.ivoox.com/playeriVoox_em_37971_1.html"></param>
										<param name="allowFullScreen" value="true"></param>
										<param name="wmode" value="transparent"></param>
										<param name="AllowScriptAccess" value="always"></param>
										<embed	src="http://www.ivoox.com/playeriVoox_em_37971_1.html"
														type="application/x-shockwave-flash"
														allowfullscreen="true" wmode="transparent" allowscriptaccess="always"
														width="206" height="182">
										</embed>
									</object>
								</div>

								<div class="centered">
									<a href="http://www.jedbangers.com.ar/web/esto-no-es-un-programa-de-radio/">
										<img	src="http://www.jedbangers.com.ar/web/wp-content/uploads/2013/11/CASSETTE.jpg"
													width="100%" height="100px" border="0" />
									</a>
								</div>
							</div>

					  </div>

				<!-- Checks if any page is being displayed -->
				<?php elseif(is_page()) : ?>

						<!-- Display page title -->
						<div class="page-title container-fluid">
							<div class="row">
								<div class="panel jedbangers-page-header oswald">
									<h2><span class="glyphicon glyphicon-fire"></span> <?php echo the_title();?></h2>
									<!-- <div class="panel-heading header"> -->
										<!-- <h2><span class="glyphicon glyphicon-fire"></span> <?php echo the_title();?></h2> -->
									<!-- </div> -->
								</div>
							</div>
						</div>

			  <?php endif; ?>
