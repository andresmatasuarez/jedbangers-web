<?php get_header(); ?>



	<div class="row">
		<?php breadcrumbs(); ?>
	</div>

	<hr/>

	<div class="post-single container-fluid">

		<div class="row">
			<div class="col-md-9">

				<div class="title">
					<div class="date-ribbon traditional">
				    <p>
				      <span class="day"><?php echo get_the_date('j'); ?></span>
				      <span class="month"><?php echo get_the_date('M'); ?></span>
				      <span class="year"><?php echo get_the_date('Y'); ?></span>
				    </p>
					</div>
					<!-- <div class="date"><?php echo get_the_date('j \d\e F \d\e Y'); ?></div> -->
					<h1><?php the_title();?></h1>

					<div class="social-bar">
						<a
							href="http://twitter.com/share"
							class="twitter-share-button"
							data-via="jedbangers"
							data-count="horizontal">Tweet</a>

						<div
							class="fb-like post-fb-like"
							data-href="<?php echo get_permalink(); ?>"
							data-layout="standard"
							data-action="like"
							data-show-faces="false"
							data-share="true"></div>

					</div>

				</div>

				<div class="content">
				<?php
		    	//if (has_post_thumbnail()){
					//	$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));
		    	//	echo '<img src="' . $url . '" width="100%" />';
		    	//}
					echo $post->post_content;

				?>
				</div>

				<div class="social-bar-bottom">
					<div
						class="fb-like post-fb-like"
						style="display: table-cell; vertical-align: middle;"
						data-href="<?php echo get_permalink(); ?>"
						data-layout="box_count"
						data-action="like"
						data-show-faces="false"
						data-share="true"></div>

					<a
						href="http://twitter.com/share"
						class="twitter-share-button"
						style="display: table-cell; vertical-align: middle;"
						data-via="jedbangers"
						data-count="vertical">Tweet</a>

				</div>

			</div>

			<div class="col-md-3" style="background: rgba(255,0,0,0.5);;">
				<h1>ESPACIO LIBRE DE ACA PARA ABAJO</h1>
				<!--
				<?php
					//for use in the loop, list 5 post titles related to first tag on current post
					$categories = wp_get_post_categories($post->ID);
					if ($categories) {
						echo 'Related Posts';
						$args = array(
							'category__in' => $categories,
							'post__not_in' => array($post->ID),
							'posts_per_page'=>5
						);

						$related = new WP_Query($args);
						if( $related->have_posts() ) {
							while ($related->have_posts()) : $related->the_post();
								$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
				?>

					<div class="thumbnail" style="<?php echo 'background: url(' . $url . '); background-size: cover;';?>">
			      <p><?php echo get_the_date(get_option( 'date_format' )); ?></p>
			      <div class="caption">
			        <a href="<?php the_permalink(); ?>">
			        	<h4><?php the_title_limited(); ?></h4>
			       	</a>
			      </div>
			    </div>

				<?php
							endwhile;
						}

						wp_reset_query();
					}
				?>
				-->
			</div>
		</div>

		<div class="row comments">
			<?php disqus_embed('revistajedbangers'); ?>
		</div>

	</div>

<?php get_footer(); ?>
