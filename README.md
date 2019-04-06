# EatingRichlyV6
Eating Richly V6 (Kale) Child Theme

**Upstream Changelog**

- http://demo.lyrathemes.com/kale-pro/wp-content/themes/kale-pro/changelog.txt

**Issues**

- https://wordpress.org/support/topic/ab-1-6-0-add-the-newsletter-block-broke-my-theme/
>Hi Eric,

>I investigated this issue and to fix it you need to open wp-content/themes/kale-pro/inc/mailchimp-functions.php file and replace this line:

>`include $file;`

>with this:

>```
>if ( ! class_exists( '\DrewM\MailChimp\MailChimp' ) ) {
>	include $file;
>}
>```

>Let me know it that helps.
