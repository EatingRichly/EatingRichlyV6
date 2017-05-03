<?php
/**
 * Horizontan ad
 *
 * @package kale
 */
?>
<?php 
$kale_enable_ads = kale_get_option('kale_enable_ads'); 
$kale_ads = kale_get_option('kale_ads'); 
if($kale_enable_ads) {
    if(array_key_exists($kale_ad, $kale_ads)) { 
    if($kale_ads[$kale_ad]) {
        $kale_ad_image_details = wp_get_attachment_image_src($kale_ads[$kale_ad]['kale_ad_image'], 'full');
    ?>
    <!-- Horizontal Ad -->
    <div class="ad">
        <a href="<?php echo esc_url($kale_ads[$kale_ad]['kale_ad_url']); ?>" target="_blank">
            <img src="<?php echo esc_url($kale_ad_image_details[0]) ?>" class="img-responsive" />
        </a>
    </div>
    <!-- /Horizontal Ad -->
    <?php $kale_ad++; } }
} ?>