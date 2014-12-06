<?php

  function jeds_custom_excerpt_length($length){
    return 20;
  }

  function jeds_home_posts_per_page($query){
    // If attempting to display an admin section page
    // or query is not main, return.
    if (is_admin() || !$query->is_main_query())
      return;

    // Change posts_per_page only in home page.
    if ( is_home() ) {
      $query->set('posts_per_page', 10);
      return;
    }
  }

  if ( function_exists( 'add_theme_support' ) ){
    add_theme_support( 'post-thumbnails' );
  }

  add_filter('excerpt_length', 'jeds_custom_excerpt_length', 999);
  add_action('pre_get_posts', 'jeds_home_posts_per_page', 1);

  function pager($query = null) {

    global $wp_query;
    $query = $query ? $query : $wp_query;
    $big = 999999999;

    if ( get_query_var('paged') ) {
      $paged = get_query_var('paged');
    } else {
      $paged = 1;
    }

    $paginate = paginate_links(array(
      'base' => get_pagenum_link(1) . '%_%',
      'format' => '?paged=%#%',
      'type' => 'array',
      'total' => $query->max_num_pages,
      'current' => $paged,
      'prev_text' => __('&laquo;'),
      'next_text' => __('&raquo;'),
    ));

    if ($query->max_num_pages > 1){
      echo '<ul class="pagination">';
      foreach ( $paginate as $index => $page ) {
        echo '<li' . ($paged == $index ? ' class="active"' : '') . '>' . $page . '</li>';
      }
      echo '</ul>';
    }
  }

  // src: http://www.doc4design.com/articles/wordpress-5ways-shorten-titles/
  function the_title_limited($length = 35, $replacer = '...') {
    $string = the_title('','',FALSE);
    if(strlen($string) > $length){
      $string = (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
    }
    echo $string;
  }

  function breadcrumbs() {
    global $post;
    echo '<ol class="breadcrumb">';
    if (!is_home()) {
      echo '<li><a href="';
      echo get_option('home');
      echo '">';
      echo 'Home';
      echo '</a></li>';
      if (is_category() || is_single()) {
        echo '<li>';
        the_category(' </li><li> ');
        if (is_single()) {
          echo '</li><li>';
          the_title();
          echo '</li>';
        }
      } elseif (is_page()) {
        if($post->post_parent){
          $anc = get_post_ancestors( $post->ID );
          $title = get_the_title();
          foreach ( $anc as $ancestor ) {
            $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> ';
          }
          echo $output;
          echo '<strong title="'.$title.'"> '.$title.'</strong>';
        } else {
          echo '<li><strong> '.get_the_title().'</strong></li>';
        }
      }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ol>';
  }


  function disqus_embed($disqus_shortname) {
    global $post;
    wp_enqueue_script('disqus_embed','http://'.$disqus_shortname.'.disqus.com/embed.js');
    echo '<div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = "'.$disqus_shortname.'";
        var disqus_title = "'.$post->post_title.'";
        var disqus_url = "'.get_permalink($post->ID).'";
        var disqus_identifier = "'.$disqus_shortname.'-'.$post->ID.'";
    </script>';
  }




  // MAGAZINE META
  function add_magazine_meta( $post ) {
    add_meta_box(
        'jeds_issue_number',
        'Magazine Number (only for posts with "Magazine" category)',
        'jeds_render_issue_number', 'post', 'normal', 'default'
    );
    add_meta_box(
        'jeds_issue_month',
        'Magazine Month (only for posts with "Magazine" category)',
        'jeds_render_issue_month', 'post', 'normal', 'default'
    );
    add_meta_box(
        'jeds_issue_year',
        'Magazine Year (only for posts with "Magazine" category)',
        'jeds_render_issue_year', 'post', 'normal', 'default'
    );
  }
  add_action('add_meta_boxes_post', 'add_magazine_meta');

  function jeds_render_issue_number($post) {
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'jeds_issue_number_meta_box', 'jeds_issue_number_meta_box_nonce' );

    // Use get_post_meta() to retrieve an existing value
    // from the database and use the value for the form.
    $value = get_post_meta( $post->ID, 'jeds_issue_number', true );

    echo '<label for="jeds_issue_number">Magazine issue number (#)</label> ';
    echo '<input type="text" id="jeds_issue_number" name="jeds_issue_number" value="' . esc_attr( $value ) . '" size="25" />';
  }

  function jeds_render_issue_month($post) {
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'jeds_issue_month_meta_box', 'jeds_issue_month_meta_box_nonce' );

    // Use get_post_meta() to retrieve an existing value
    // from the database and use the value for the form.
    $value = get_post_meta( $post->ID, 'jeds_issue_month', true );

    echo '<label for="jeds_issue_month">Magazine issue month (MMMM)</label> ';
    echo '<input type="text" id="jeds_issue_month" name="jeds_issue_month" value="' . esc_attr( $value ) . '" size="25" />';
  }

  function jeds_render_issue_year($post) {
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'jeds_issue_year_meta_box', 'jeds_issue_year_meta_box_nonce' );

    // Use get_post_meta() to retrieve an existing value
    // from the database and use the value for the form.
    $value = get_post_meta( $post->ID, 'jeds_issue_year', true );

    echo '<label for="jeds_issue_year">Magazine issue year (yyyy)</label> ';
    echo '<input type="text" id="jeds_issue_year" name="jeds_issue_year" value="' . esc_attr( $value ) . '" size="25" />';
  }

  function jeds_save_magazine_meta($post_id) {
    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( !isset($_POST['jeds_issue_number_meta_box_nonce']) ||
         !isset($_POST['jeds_issue_month_meta_box_nonce']) ||
         !isset($_POST['jeds_issue_year_meta_box_nonce']) ){
      return;
    }

    // Verify that the nonce is valid.
    if ( !wp_verify_nonce( $_POST['jeds_issue_number_meta_box_nonce'], 'jeds_issue_number_meta_box' ) ||
         !wp_verify_nonce( $_POST['jeds_issue_month_meta_box_nonce'], 'jeds_issue_month_meta_box' ) ||
         !wp_verify_nonce( $_POST['jeds_issue_year_meta_box_nonce'], 'jeds_issue_year_meta_box' )){
      return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
      return;
    }

    // Check the user's permissions.
    if (isset( $_POST['post_type']) && 'page' == $_POST['post_type'] ) {
      if (!current_user_can('edit_page', $post_id)){
        return;
      }
    } else {
      if (!current_user_can('edit_post', $post_id)) {
        return;
      }
    }

    /* OK, it's safe for us to save the data now. */
    if ( !isset($_POST['jeds_issue_number']) ) {
      update_post_meta($post_id, 'jeds_issue_number', sanitize_text_field($_POST['jeds_issue_number']));
    }

    if ( !isset($_POST['jeds_issue_month']) ) {
      update_post_meta($post_id, 'jeds_issue_month', sanitize_text_field($_POST['jeds_issue_month']));
    }

    if ( !isset($_POST['jeds_issue_number']) ) {
      update_post_meta($post_id, 'jeds_issue_year', sanitize_text_field($_POST['jeds_issue_year']));
    }
  }

  add_action( 'save_post', 'jeds_save_magazine_meta' );

?>