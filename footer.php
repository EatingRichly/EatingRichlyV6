<?php
/**
* The template for displaying the footer
* EATING RICHLY
* 2018-07-11 09:34:06
*
* @package kale
*/
?>

<?php
if (is_front_page() && !is_paged()) {
    $kale_frontpage_order = kale_get_option('kale_frontpage_order');
    if (! empty($kale_frontpage_order) && is_array($kale_frontpage_order)) {
        if (in_array('kale_frontpage_order_feed', $kale_frontpage_order)) {
            $key = array_search('kale_frontpage_order_feed', $kale_frontpage_order);
            $after_feed = array_slice($kale_frontpage_order, $key);
            foreach ($after_feed as $section) {
                switch ($section) {
                case 'kale_frontpage_order_banner':             get_template_part('parts/frontpage', 'banner');  break;
                case 'kale_frontpage_order_featured_posts':     get_template_part('parts/frontpage', 'featured');  break;
                case 'kale_frontpage_order_large':              get_template_part('parts/frontpage', 'large');  break;
                case 'kale_frontpage_order_vertical':           get_template_part('parts/frontpage', 'vertical');  break;
            }
            }
        }
    }
}
?>
  <?php get_sidebar('footer'); ?>

  <!-- Footer -->
  <div class="footer">

    <?php if (is_active_sidebar('footer-row-3-center')) {
    ?>
    <div class="footer-row-3-center"><?php dynamic_sidebar('footer-row-3-center'); ?>
    <?php
} ?>

    <?php $kale_footer_copyright = kale_get_option('kale_footer_copyright'); ?>
    <?php if ($kale_footer_copyright) {
        ?>
    <div class="footer-copyright"><?php echo wp_kses_post($kale_footer_copyright); ?></div>
    <?php
    } ?>
<?php /*
    <div class="footer-copyright">
        <ul class="credit">
            <li><?php _e('Built using ', 'kale'); ?><a href="https://www.lyrathemes.com/kale-pro"><?php _e('Kale Pro', 'kale'); ?></a> <?php _e('by', 'kale'); ?> <a href="https://www.lyrathemes.com">LyraThemes</a>.</li>
        </ul>
    </div>
*/ ?>

  </div>
  <!-- /Footer -->

  </div><!-- /Container -->
</div><!-- /Main Wrapper -->

<?php wp_footer(); ?>
</body>
</html>
