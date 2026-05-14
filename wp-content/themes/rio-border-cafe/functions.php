<?php
//* Load genesis init file
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Montauk Soundview' );
define( 'CHILD_THEME_URL', 'http://example.com' );
define( 'CHILD_THEME_VERSION', '1.0.5' );

define('DEFINE', 'val');


//* Add HTML5 markup structure
add_theme_support( 'html5' );

// Unregister secondary navigation menu
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );

// Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'bofilltech_manage_scripts_styles', 100 );

/**
 * Manage all scripts and styles
 */
function bofilltech_manage_scripts_styles() {

    wp_deregister_script('jquery');
    wp_enqueue_script('lozad', 'https://cdn.jsdelivr.net/npm/lozad', array(), null, true);
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' );
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'montauk-soundview' );
    wp_dequeue_style( 'classic-theme-styles' );


    if( is_page('contact') ){
        wp_enqueue_script('jquery-cdn', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    }

    if( ! is_page('contact') ){
        wp_dequeue_style( 'contact-form-7' );
        wp_deregister_script('swv');
        wp_deregister_script('contact-form-7');
        wp_deregister_script('contact-form-7-js-extra');
    }

    if( is_page_template('template-homepage.php') || is_page_template('template-gallery.php') ){
        wp_enqueue_script('splide', get_stylesheet_directory_uri().'/js/splide.min.js', array(), null, true);
        wp_enqueue_style( 'image-utils', get_stylesheet_directory_uri().'/css/image-utils.min.css', array(), 1.0, 'all' );
        wp_deregister_script('mc4wp-forms-api');
    }


}


// register image size
add_action( 'after_setup_theme', 'bofilltech_theme_setup' );
function bofilltech_theme_setup() {
    add_image_size( 'lazy-thumb', 20, 20, false ); // 100 pixels wide (and unlimited height)
    add_image_size( 'lazy-thumb-square', 20, 20, true );
    add_image_size( 'full-gallery', 1600);
    add_image_size( 'rooms-showcase', 450, 300, true);
    add_image_size( 'amenities-showcase', 900, 600, true);
    add_image_size( 'menu-showcase', 300, 260, true);
    add_image_size( 'gallery-square', 400, 400, true);
    add_image_size( 'festivities-showcase', 700, 300, true);
    add_image_size( 'full-screen', 1900, 1200, false );
}

// add custom widgets
function bofilltech_widgets_init() {

    register_sidebar( array(
        'name'          => 'Footer 1',
        'id'            => 'footer_one',
        'before_widget' => '<div class="widget-col">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => 'Footer 2',
        'id'            => 'footer_two',
        'before_widget' => '<div class="widget-col">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => 'Footer 3',
        'id'            => 'footer_three',
        'before_widget' => '<div class="widget-col">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => 'Footer 4',
        'id'            => 'footer_four',
        'before_widget' => '<div class="widget-col">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );

}
add_action( 'widgets_init', 'bofilltech_widgets_init' );


//Page Slug Body Class
function bofilltech_add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}

add_filter( 'body_class', 'bofilltech_add_slug_body_class' );


// Custom Footer
function bofilltech_footer_markup(){?>

    <div class="footer-sections">

        <div class="widget-wrapper">
            <div class="all-widgets">
                <div class="widget-column">
                    <?php dynamic_sidebar( 'footer_one' ); ?>
                </div>
                <div class="widget-column">
                    <?php dynamic_sidebar( 'footer_two' ); ?>
                </div>
                <div class="widget-column">
                    <?php dynamic_sidebar( 'footer_three' ); ?>
                </div>
                <div class="widget-column">
                    <?php dynamic_sidebar( 'footer_four' ); ?>
                </div>
            </div>
        </div>

        <?php
        $creds_text = wp_kses_post( genesis_get_option( 'footer_text' ) );
        $output  = '<div class="footer-credentials"><p>' . genesis_strip_p_tags( $creds_text ) . '</p></div>';
        echo do_shortcode($output);
        ?>

    </div>

<?php }


add_filter('genesis_footer','bofilltech_footer_markup');

// Remove Sidebar
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

// Register a custom image size for hero images on single posts.
//remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


/**
 * @param $url
 * @return string
 */
function bofilltech_encode_image_base64( $url ) {
    $context = stream_context_create( array(
        'http' => array( 'header' => "Authorization: Basic " . base64_encode( "flywheel:flywheel" ) )
    ) );

    $base64 = base64_encode( file_get_contents( $url, false, $context ) );
    return 'data: ' . wp_check_filetype( $url )['type'] . ';base64,' . $base64;
}

/**
 *
 */
add_filter( 'genesis_attr_site-header', 'add_id_attr_to_header' );
function add_id_attr_to_header( $attributes ) {
    $attributes['id'] = 'header';
    return $attributes;
}

/**
 *
 */
add_action('wp_footer', 'add_lozad_script', 100);
function add_lozad_script(){ ?>

    <script>

        function toggleNav() {
            const element = document.getElementById("nav-holder")
            element.classList.toggle("display-active");
        }

        lozad('.defer-img', {
            load: function(el) {
                el.src = el.dataset.src;
                el.onload = function() {
                    el.classList.add('fadeIn');
                }
            }
        }).observe();

        window.addEventListener("scroll", function(event){
            const scroll = this.scrollY;
            if(scroll > 100) {
                this.document.getElementById("header").classList.add("sticky-active");
            } else {
                this.document.getElementById("header").classList.remove("sticky-active");
            }
        });
    </script>
    <script>
        const loadScriptsTimer = setTimeout(loadScripts, 3000);
        const userInteractionEvents = ["mouseover","keydown","touchmove","touchstart"];
        userInteractionEvents.forEach(function (event) {
            window.addEventListener(event, triggerScriptLoader, {
                passive: true
            });
        });
        function triggerScriptLoader() {
            loadScripts();
            clearTimeout(loadScriptsTimer);
            userInteractionEvents.forEach(function (event) {
                window.removeEventListener(event, triggerScriptLoader, {
                    passive: true
                });
            });
        }
        function loadScripts() {
            document.querySelectorAll("script[data-type='lazy']").forEach(function (elem) {
                elem.setAttribute("src", elem.getAttribute("data-src"));
            });
            document.querySelectorAll("iframe[data-type='lazy']").forEach(function (elem) {
                elem.setAttribute("src", elem.getAttribute("data-src"));
            });
        }
    </script>
    <?php
}


/**
 * @param $tag
 * @param $handle
 * @return array|mixed|string|string[]
 */
add_filter('script_loader_tag', 'bofilltech_lazyload_script_tag', 10, 2);
function bofilltech_lazyload_script_tag($tag, $handle) {
    # add script handles to the array below
    $scripts_to_defer = array( 'mc4wp-forms-api', 'wpia');
    foreach($scripts_to_defer as $defer_script) {
        if ($defer_script === $handle) {
            return str_replace(' src', ' data-type="lazy" data-src', $tag);
        }
    }
    return $tag;
}


/**
 * @param $html
 * @param $handle
 * @param $href
 * @param $media
 * @return mixed|string
 */
add_filter( 'style_loader_tag', 'bofilltech_defer_css_rel_preload', 10, 4 );
function bofilltech_defer_css_rel_preload( $html, $handle, $href, $media ) {
    $styles_to_defer = array( 'image-utils', 'datepicker-styles', 'wpia-overview-calendar', 'aos');
    foreach($styles_to_defer as $defer_style) {
        if ($defer_style === $handle) {
            $html =  '<link rel="preload" href="' . $href . '" as="style" id="' . $handle . '" media="' . $media . '" onload="this.onload=null;this.rel=\'stylesheet\'">'.'<noscript>'.$html.'</noscript>';
        }
    }
    return $html;
}



/**
 * Disable the emoji's
 */

add_action( 'init', 'bofilltech_remove_wp_stuff' );

function bofilltech_remove_wp_stuff() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
    remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
    remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
    remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
    remove_action( 'wp_head', 'index_rel_link' ); // index link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
    remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
    remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
    remove_action( 'wp_head', 'rest_output_link_wp_head' );
    remove_action( 'wp_head', 'rest_output_link_header' );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
}


/**
 * Return Optimized Image
 * @param $image
 * @param $image_size
 */
function get_optimized_bg_image( $image, $image_size ){
    if( !empty( $image ) ): ?>
        <div class="image-wrapper">
            <img data-placeholder-image src="<?php echo bofilltech_encode_image_base64($image['sizes']['lazy-thumb']) ?>" aria-hidden="true" alt="" height="300" width="100%">
            <img data-main-image decoding="async" class="defer-img" height="400" width="100%" src="<?php echo bofilltech_encode_image_base64($image['sizes']['lazy-thumb']) ?>"
                 data-src="<?php echo esc_url($image['sizes'][$image_size]); ?>"  alt="<?php echo esc_attr($image['alt']); ?>">
        </div>
    <?php endif; ?>
    <?php
}



/**
 * Minify CSS
 * @param $input
 * @return array|mixed|string|string[]|null
 */

function minify_css($input) {
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
            '#(?<=[\s:,\-])0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
        ),
        array(
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2'
        ),
        $input);
}

/**
 * Inline the CSS
 */
function inline_global_styles(){
    $context = stream_context_create( array(
        'http' => array( 'header' => "Authorization: Basic " . base64_encode( "flywheel:flywheel" ) )
    ) );
    echo '<style data-identity="global-styles">'. minify_css(file_get_contents( get_stylesheet_directory_uri() . '/css/global-styles.css?version=' . time(), false, $context )). '</style>'."\n";
}

add_action('wp_head', 'inline_global_styles', 2);


/**
 * Add btn Shortcode
 */

function bofilltech_register_btn1_shortcode( $atts ) {
    if( ! isset($atts['target'])){
        $atts['target'] = "self";
    }
    $target = $atts['target'] === "blank" ? '_blank' : '_self';
    return sprintf('<a class="btn-style-one" href="%s" target="%s">%s</a>', $atts['url'], $target, $atts['text']);
}
add_shortcode( 'btn-style-one', 'bofilltech_register_btn1_shortcode' );


/**
 * Add btn Shortcode
 */

function bofilltech_register_btn2_shortcode( $atts ) {
    if( ! isset($atts['target'])){
        $atts['target'] = "self";
    }
    $target = $atts['target'] === "blank" ? '_blank' : '_self';
    return sprintf('<a class="btn-style-two" href="%s" target="%s">%s</a>', $atts['url'], $target, $atts['text']);
}
add_shortcode( 'btn-style-two', 'bofilltech_register_btn2_shortcode' );

/**
 * Add btn Shortcode
 */

function wporg_shortcode( $atts = array(), $content = null ) {
    $render_content = do_shortcode($content);
    return sprintf('<div class="hero-cta-col">%s</div>', $render_content );
}

add_shortcode( 'hero-cta', 'wporg_shortcode' );

/**
 * Add btn Shortcode
 */

function intro_shortcode( $atts = array(), $content = null ) {
    $render_content = do_shortcode($content);
    return sprintf('<div class="menu-intro"><p>%s</p></div>', $render_content );
}

add_shortcode( 'menu-intro', 'intro_shortcode' );


function menu_image_shortcode( $atts = array(), $content = null ) {
    $render_content = do_shortcode($content);
    return sprintf('<div class="menu-image">%s</div>', $render_content );
}

add_shortcode( 'menu-image', 'menu_image_shortcode' );

/**
 * Add menu Shortcode
 */


function menu_column_shortcode( $atts = array(), $content = null ) {
    $render_content = do_shortcode($content);
    return sprintf('<div class="menu-column">%s</div>', $render_content );
}

add_shortcode( 'menu-column', 'menu_column_shortcode' );


/**
 * Add hero Shortcode
 */

function bofilltech_hero_image_shortcode( $atts = array(), $content = null ) {
    return sprintf('<div class="hero-image-col">%s</div>', $content );
}

add_shortcode( 'hero-image', 'bofilltech_hero_image_shortcode' );

/*
 * Add theme options
 * */

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

}

/**
 * Remove Jquery Migrate
 * @param $scripts
 */
function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            // Check whether the script has any dependencies
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );


/**
 *
 */
function slugify($text, string $divider = '-'){

    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, $divider);
    $text = preg_replace('~-+~', $divider, $text);
    $text = strtolower($text);
    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}

/**
 * @param $image_file
 * @return string
 */
function get_local_image($image_file){
    return get_stylesheet_directory_uri().'/images/'.$image_file;
}


// Register a custom image size for hero images on single posts.

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_action( 'genesis_entry_header', 'bofilltech_page_header_background' );

function bofilltech_page_header_background() {

    // if we are not on a page, abort.
    if ( ! is_page() ) {
        return;
    }

    // set $image to URL of featured image. If featured image is not present, set a fallback image, hero-image.jpg in child theme's images folder.
    if ( has_post_thumbnail() ) { $image = genesis_get_image( 'format=url&size=full-screen' );}
    ?>

    <div class="entry-header-bg <?php if ( has_post_thumbnail() ) { echo 'has-image'; }?>">
        <?php if ( has_post_thumbnail() ) { ?> <img loading="lazy" src="<?php echo $image; ?>" alt="<?php echo get_the_title(); ?>"> <?php } ?>
        <?php genesis_do_post_title(); ?>
    </div>

    <?php


}

