<?php get_header(); ?>


	<?php
	  if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} else {
			$paged = 1;
		}

		if ($paged == 1) :
	?>

	<?php endif; ?>

<!--
			<div align="center">-------------------------------------------------</div>
			<div align="center">
				<a href="http://goo.gl/C7B7V2"> BAJAR: Esto No Es Un Programa de Radio 40 </a>
			</div>
			<div align="center">-------------------------------------------------
				<div align="center">
					<a href="http://www.mediafire.com/download/usvfyaiu298fdg9/EstoNoEsUnProgramaDeRadio39.rar">
						BAJAR: Esto No Es Un Programa de Radio 39
					</a>
				</div>
			</div>
			<div align="center">-------------------------------------------------</div>
		</div>

		<a href="http://goo.gl/yi1eGP"> BAJAR: Esto No Es Un Programa de Radio 38 </a>

		<div align="center">
			<div align="center">-------------------------------------------------</div>
			<div id="libro-dave">
				<a href="http://www.jedbangers.com.ar/web/esto-no-es-un-programa-de-radio/">
					<i></i>mg	src="http://www.jedbangers.com.ar/web/wp-content/uploads/2013/11/CASSETTE.jpg"
								width="291" height="100" border="0" />
				</a>
			</div>
		</div>
-->

	<?php if ( have_posts() ) : ?>

	<div class="posts multicolumns row">
	  <?php while ( have_posts() ) : the_post(); ?>

		  <div class="post col-md-4">
		    <div class="thumbnail">
		    	<?php
		    	if (has_post_thumbnail()){
						$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
						echo '<a href="' . get_the_permalink() . '">';
		    			echo '<cropped-image src="' . $url . '" height="125px" valign="top"></cropped-image>';
		    		echo '</a>';
		    	}
		    	?>
		      <div class="caption">
		        <?php echo get_the_date('j \d\e F \d\e Y'); ?>
		        <a href="<?php the_permalink(); ?>">
		        	<h3><?php the_title_limited(); ?></h3>
		       	</a>
		        <p><?php the_excerpt(); ?></p>
	        	<a href="<?php the_permalink();?>" class="btn btn-danger" role="button">Continuar leyendo</a>
		      </div>
		    </div>
		  </div>
		<?php endwhile; ?>
	</div>

  <?php else: ?>

	<div class="row">
  	<div class="container-fluid">
  		<div class="page-header">
    		<h3><?php _e('Sorry, no posts matched your criteria.'); ?></h3>
    	</div>
  	</div>
	</div>

  <?php endif; ?>

	<div class="row">
		<div class="col-md-12 centered">
			<?php pager(); ?>
		</div>
	</div>

<?php get_footer(); ?>