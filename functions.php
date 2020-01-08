<?php
// Proper Child Theme
// https://gist.github.com/lyrathemes/7f5c791b7351b7cadd7ab9faaba0b204
add_action('wp_enqueue_scripts', 'kale_child_enqueue_styles');
function kale_child_enqueue_styles()
{
  wp_dequeue_style('font-awesome');
  wp_deregister_style('font-awesome');

  wp_dequeue_style('owl-carousel');
  wp_deregister_style('owl-carousel');

  $parent_style = 'kale-style';
  $deps = array(
    'bootstrap',
    'bootstrap-select' /* , 'font-awesome', 'owl-carousel' */
  );
  wp_enqueue_style(
    $parent_style,
    get_template_directory_uri() . '/style.css',
    $deps
  );

  wp_enqueue_style(
    'kale-style-child',
    get_stylesheet_directory_uri() . '/style.css',
    array($parent_style),
    wp_get_theme()->get('Version')
  );
}

function kale_get_option($key)
{
  global $kale_defaults;

  $parent_theme = get_template_directory();
  $parent_theme_slug = basename($parent_theme);
  $parent_theme_mods = get_option("theme_mods_{$parent_theme_slug}");

  $value = '';
  $child_value = get_theme_mod($key);
  if (!empty($child_value)) {
    $value = $child_value;
  } elseif (!empty($parent_theme_mods) && isset($parent_theme_mods[$key])) {
    $value = $parent_theme_mods[$key];
  } elseif (
    is_array($kale_defaults) &&
    array_key_exists($key, $kale_defaults)
  ) {
    $value = get_theme_mod($key, $kale_defaults[$key]);
  }
  return $value;
}

//Change thumbnail to 2:3
function kale_child_setup()
{
  set_post_thumbnail_size(400, 600, true);
  add_image_size('kale-thumbnail', 400, 600, true);
  add_image_size('kale-vertical', 400, 600, true);
}
add_action('after_setup_theme', 'kale_child_setup', 15);

// Disable lazy load on amp pages
function bjll_compat_amp()
{
  if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
    add_filter('bjll/enabled', '__return_false');
  }
}
add_action('bjll/compat', 'bjll_compat_amp');

// Alert on Staging Site
// http://stackoverflow.com/questions/6522023/php-if-domain
$host = $_SERVER['HTTP_HOST'];
if ($host != 'eatingrichly.com') {
  function staging_admin_error_notice()
  {
    $class = "error";
    $message = "You are on the staging site.";
    echo "<div class=\"$class\"> <h1>$message</h1></div>";
  }
  add_action('admin_notices', 'staging_admin_error_notice');
}

// Set max srcset image width
function remove_max_srcset_image_width($max_width)
{
  $max_width = 1200;
  return $max_width;
}
add_filter('max_srcset_image_width', 'remove_max_srcset_image_width');

// Dequeue the Parent Theme scripts.
function eating_richly_WI_dequeue_script()
{
  wp_dequeue_script('owl-carousel'); // remove kale scripts
  wp_dequeue_script('font-awesome'); // remove kale scripts
  wp_dequeue_script('kirki-fontawesome-font'); // remove kale scripts
  wp_dequeue_script('devicepx'); // Remove jetpack js
  wp_dequeue_script('kale-js'); // Remove Kale-js 2020-01-07 16:41:39
  wp_dequeue_script('kale-pinterest'); // Remove Kale Pinterest Share 2020-01-07 16:41:41
}

add_action('wp_print_scripts', 'eating_richly_WI_dequeue_script', 100);

// empty function to override owl-carousel insert from parent functions
function kale_slider()
{
  // This function is intentionally left blank.
}
add_action('wp_enqueue_scripts', 'kale_slider', 15);

// Google native lazy load do not load JS
add_filter('native_lazyload_fallback_script_enabled', '__return_false');

// Removing Jetpack CSS
// 2019-12-30 11:17:35
// https://css-tricks.com/snippets/wordpress/removing-jetpack-css/
add_filter( 'jetpack_sharing_counts', '__return_false', 99 );
add_filter( 'jetpack_implode_frontend_css', '__return_false', 99 );
