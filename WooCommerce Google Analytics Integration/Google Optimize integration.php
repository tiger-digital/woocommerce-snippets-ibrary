<?php
/**
 * WooCommerce Google Analytics Integration: Google Optimize integration
 *
 * Requires https://woocommerce.com/products/woocommerce-google-analytics/
 *
 * Replace GTM-XXXXXXX with your Optimize container ID
 */

//Google Optimize
add_filter('woocommerce_ga_snippet_require','td_wgai_add_go');
function td_wgai_add_go($ga_snippet_require){
    $ga_snippet_require .= "" . WC_Google_Analytics_JS::tracker_var() . "( 'require', 'GTM-XXXXXXX');";

    return $ga_snippet_require;
}

//Anti-flicker
//"999998" - because the Anti-flicker should be placed
//before Google Optimize script
add_action( 'wp_head', 'td_wgai_add_anti_flicker', 999998 );
function td_wgai_add_anti_flicker(){
    ?>

    <!-- Anti-flicker snippet (recommended)  -->
    <style>.async-hide { opacity: 0 !important} </style>
    <script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
            h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
            (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
        })(window,document.documentElement,'async-hide','dataLayer',4000,
            {'GTM-XXXXXXX':true});</script>

    <?php
}