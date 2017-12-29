<?php
// Proper Child Theme
// https://gist.github.com/lyrathemes/7f5c791b7351b7cadd7ab9faaba0b204
add_action( 'wp_enqueue_scripts', 'kale_child_enqueue_styles' );
function kale_child_enqueue_styles() {

  $parent_style = 'kale-style';
  $deps = array('bootstrap', 'bootstrap-select', 'font-awesome', 'owl-carousel');
  wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' , $deps);

  wp_enqueue_style( 'kale-style-child', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get('Version') );
}

function kale_get_option($key){
  global $kale_defaults;

  $parent_theme = get_template_directory();
  $parent_theme_slug = basename($parent_theme);
  $parent_theme_mods = get_option( "theme_mods_{$parent_theme_slug}");

  $value = '';
  $child_value = get_theme_mod($key);
  if(!empty($child_value)){
    $value = $child_value;
  }
  else if (!empty($parent_theme_mods) && isset($parent_theme_mods[$key])) {
    $value = $parent_theme_mods[$key];
  } else if (array_key_exists($key, $kale_defaults))
          $value = get_theme_mod($key, $kale_defaults[$key]);
  return $value;
}

//Change thumbnail to 2:3
function kale_child_setup() {
  set_post_thumbnail_size( 400, 600, true );
  add_image_size( 'kale-thumbnail', 400, 600, true );
  add_image_size( 'kale-vertical', 400, 600, true );
}
add_action( 'after_setup_theme', 'kale_child_setup', 15 );

// Disable lazy load on amp pages
function bjll_compat_amp() {
  if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
      add_filter( 'bjll/enabled', '__return_false' );
  }
}
add_action( 'bjll/compat', 'bjll_compat_amp' );

// Alert on Staging Site
/*http://stackoverflow.com/questions/6522023/php-if-domain*/
$host = $_SERVER['HTTP_HOST'];
if ($host === 'eatingrichly-staging.lcdoxnf7-liquidwebsites.com') {
    function staging_admin_error_notice() {
        $class = "error";
        $message = "You are on the staging site.";
            echo"<div class=\"$class\"> <h1>$message</h1></div>";
    }
    add_action( 'admin_notices', 'staging_admin_error_notice' );
}
