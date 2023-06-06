<?php
/**
 * WP Bootstrap Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package memorial_health
 */


 

if (!function_exists('wp_bootstrap_starter_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function wp_bootstrap_starter_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on WP Bootstrap Starter, use a find and replace
         * to change 'wp-bootstrap-starter' to the name of your theme in all the template files.
        */
        load_theme_textdomain('memorial_health', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
        */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'top-header-menu' => esc_html__('Top Header Menu', 'wp-bootstrap-starter') ,
            'primary-header' => esc_html__('Primary Menu', 'wp-bootstrap-starter') ,
            'primary-footer' => esc_html__('Primary Footer Menu', 'wp-bootstrap-starter')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
        */
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('wp_bootstrap_starter_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        function wp_boostrap_starter_add_editor_styles()
        {
            add_editor_style('custom-editor-style.css');
        }
        add_action('admin_init', 'wp_boostrap_starter_add_editor_styles');

        /*Add Image size*/
        add_image_size('location-contact-box', 222, 222, false);
    }
endif;
add_action('after_setup_theme', 'wp_bootstrap_starter_setup');

/**
 * Add Welcome message to dashboard
 */
function wp_bootstrap_starter_reminder()
{
    $theme_page_url = 'https://afterimagedesigns.com/wp-bootstrap-starter/?dashboard=1';

    if (!get_option('triggered_welcomet')) {
        $message = sprintf(__('Welcome to WP Bootstrap Starter Theme! Before diving in to your new theme, please visit the <a style="color: #fff; font-weight: bold;" href="%1$s" target="_blank">theme\'s</a> page for access to dozens of tips and in-depth tutorials.', 'wp-bootstrap-starter'), esc_url($theme_page_url));

        printf('<div class="notice is-dismissible" style="background-color: #6C2EB9; color: #fff; border-left: none;">
                        <p>%1$s</p>
                    </div>', $message);
        add_option('triggered_welcomet', '1', '', 'yes');
    }
}
add_action('admin_notices', 'wp_bootstrap_starter_reminder');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_bootstrap_starter_content_width()
{
    $GLOBALS['content_width'] = apply_filters('wp_bootstrap_starter_content_width', 1170);
}
add_action('after_setup_theme', 'wp_bootstrap_starter_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_bootstrap_starter_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'wp-bootstrap-starter') ,
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'wp-bootstrap-starter') ,
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1', 'wp-bootstrap-starter') ,
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here.', 'wp-bootstrap-starter') ,
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'wp-bootstrap-starter') ,
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here.', 'wp-bootstrap-starter') ,
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 3', 'wp-bootstrap-starter') ,
        'id' => 'footer-3',
        'description' => esc_html__('Add widgets here.', 'wp-bootstrap-starter') ,
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'wp_bootstrap_starter_widgets_init');

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init()
{

    // Check function exists.
    if (function_exists('acf_add_options_sub_page')) {
        // Add sub page.
        $child = acf_add_options_sub_page(array(
            'page_title' => __('Business Information') ,
            'menu_title' => __('Business Info') ,
            'parent_slug' => "options-general.php",
        ));
    }
}

//Theme Options
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => true
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));

    // acf_add_options_sub_page(array(
    //  'page_title'    => 'Theme Footer Settings',
    //  'menu_title'    => 'Footer',
    //  'parent_slug'   => 'theme-general-settings',
    // ));

}

/**
 * Enqueue scripts and styles.
 */
function wp_bootstrap_starter_scripts()
{
    // load bootstrap css
    if (get_theme_mod('cdn_assets_setting') === 'yes') {
        wp_enqueue_style('wp-bootstrap-starter-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css');
        wp_enqueue_style('wp-bootstrap-starter-fontawesome-cdn', 'https://use.fontawesome.com/releases/v5.10.2/css/all.css');
    } else {
        wp_enqueue_style('wp-bootstrap-starter-bootstrap-css', get_template_directory_uri() . '/inc/assets/css/bootstrap.min.css');
        wp_enqueue_style('wp-bootstrap-starter-fontawesome-cdn', get_template_directory_uri() . '/inc/assets/css/fontawesome.min.css');
    }
    // load bootstrap css
    // load AItheme styles
    // load WP Bootstrap Starter styles
    wp_enqueue_style('wp-bootstrap-starter-style', get_stylesheet_uri());
    if (get_theme_mod('theme_option_setting') && get_theme_mod('theme_option_setting') !== 'default') {
        wp_enqueue_style('wp-bootstrap-starter-' . get_theme_mod('theme_option_setting'), get_template_directory_uri() . '/inc/assets/css/presets/theme-option/' . get_theme_mod('theme_option_setting') . '.css', false, '');
    }
    if (get_theme_mod('preset_style_setting') === 'poppins-lora') {
        wp_enqueue_style('wp-bootstrap-starter-poppins-lora-font', 'https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Poppins:300,400,500,600,700');
    }
    if (get_theme_mod('preset_style_setting') === 'montserrat-merriweather') {
        wp_enqueue_style('wp-bootstrap-starter-montserrat-merriweather-font', 'https://fonts.googleapis.com/css?family=Merriweather:300,400,400i,700,900|Montserrat:300,400,400i,500,700,800');
    }
    if (get_theme_mod('preset_style_setting') === 'poppins-poppins') {
        wp_enqueue_style('wp-bootstrap-starter-poppins-font', 'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700');
    }
    if (get_theme_mod('preset_style_setting') === 'roboto-roboto') {
        wp_enqueue_style('wp-bootstrap-starter-roboto-font', 'https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i');
    }
    if (get_theme_mod('preset_style_setting') === 'arbutusslab-opensans') {
        wp_enqueue_style('wp-bootstrap-starter-arbutusslab-opensans-font', 'https://fonts.googleapis.com/css?family=Arbutus+Slab|Open+Sans:300,300i,400,400i,600,600i,700,800');
    }
    if (get_theme_mod('preset_style_setting') === 'oswald-muli') {
        wp_enqueue_style('wp-bootstrap-starter-oswald-muli-font', 'https://fonts.googleapis.com/css?family=Muli:300,400,600,700,800|Oswald:300,400,500,600,700');
    }
    if (get_theme_mod('preset_style_setting') === 'montserrat-opensans') {
        wp_enqueue_style('wp-bootstrap-starter-montserrat-opensans-font', 'https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:300,300i,400,400i,600,600i,700,800');
    }
    if (get_theme_mod('preset_style_setting') === 'robotoslab-roboto') {
        wp_enqueue_style('wp-bootstrap-starter-robotoslab-roboto', 'https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700|Roboto:300,300i,400,400i,500,700,700i');
    }
    if (get_theme_mod('preset_style_setting') && get_theme_mod('preset_style_setting') !== 'default') {
        wp_enqueue_style('wp-bootstrap-starter-' . get_theme_mod('preset_style_setting'), get_template_directory_uri() . '/inc/assets/css/presets/typography/' . get_theme_mod('preset_style_setting') . '.css', false, '');
    }
    //Color Scheme
    /*if(get_theme_mod( 'preset_color_scheme_setting' ) && get_theme_mod( 'preset_color_scheme_setting' ) !== 'default') {
        wp_enqueue_style( 'wp-bootstrap-starter-'.get_theme_mod( 'preset_color_scheme_setting' ), get_template_directory_uri() . '/inc/assets/css/presets/color-scheme/'.get_theme_mod( 'preset_color_scheme_setting' ).'.css', false, '' );
    }else {
        wp_enqueue_style( 'wp-bootstrap-starter-default', get_template_directory_uri() . '/inc/assets/css/presets/color-scheme/blue.css', false, '' );
    }*/

    // Internet Explorer HTML5 support
    wp_enqueue_script('html5hiv', get_template_directory_uri() . '/inc/assets/js/html5.js', array(), '3.7.0', false);
    wp_script_add_data('html5hiv', 'conditional', 'lt IE 9');

    // load bootstrap js
    if (get_theme_mod('cdn_assets_setting') === 'yes') {
        wp_enqueue_script('wp-bootstrap-starter-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1/dist/umd/popper.min.js', array(), '', true);
        wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', 'https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js', array(), '', true);
    } else {
        wp_enqueue_script('wp-bootstrap-starter-popper', get_template_directory_uri() . '/inc/assets/js/popper.min.js', array(), '', true);
        wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', get_template_directory_uri() . '/inc/assets/js/bootstrap.min.js', array(), '', true);
    }
    wp_enqueue_script('wp-bootstrap-starter-themejs', get_template_directory_uri() . '/inc/assets/js/theme-script.min.js', array(), '', true);

    wp_enqueue_script('wp-bootstrap-starter-skip-link-focus-fix', get_template_directory_uri() . '/inc/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    wp_enqueue_script('slick-slider', get_template_directory_uri() . '/inc/assets/js/slick.min.js', array(), '', true);
    wp_enqueue_style('slick-slider-theme', get_template_directory_uri() . '/inc/assets/css/slick-theme.css');
    wp_enqueue_script('main', get_template_directory_uri() . '/inc/assets/js/main.js', array(), rand(0,99999), true);

    wp_localize_script( 'main', 'script_ajax', array('ajaxurl' => admin_url( 'admin-ajax.php' ),'ct_ajax'=>wp_create_nonce('nGC6ruJD0O'),'noposts' => 'No more posts found', 'loadmore' => 'View More','processing' => 'Loading...','theme_path' => get_template_directory_uri(), ));
}
add_action('wp_enqueue_scripts', 'wp_bootstrap_starter_scripts');

/**
 * Add Preload for CDN scripts and stylesheet
 */




function wp_bootstrap_starter_preload($hints, $relation_type)
{
    if ('preconnect' === $relation_type && get_theme_mod('cdn_assets_setting') === 'yes') {
        $hints[] = ['href' => 'https://cdn.jsdelivr.net/', 'crossorigin' => 'anonymous', ];
        $hints[] = ['href' => 'https://use.fontawesome.com/', 'crossorigin' => 'anonymous', ];
    }
    return $hints;
}

add_filter('wp_resource_hints', 'wp_bootstrap_starter_preload', 10, 2);

function wp_bootstrap_starter_password_form()
{
    global $post;
    $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
    $o = '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
    <div class="d-block mb-3">' . __("To view this protected post, enter the password below:", "wp-bootstrap-starter") . '</div>
    <div class="form-group form-inline"><label for="' . $label . '" class="mr-2">' . __("Password:", "wp-bootstrap-starter") . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="form-control mr-2" /> <input type="submit" name="Submit" value="' . esc_attr__("Submit", "wp-bootstrap-starter") . '" class="btn btn-primary"/></div>
    </form>';
    return $o;
}
add_filter('the_password_form', 'wp_bootstrap_starter_password_form');

function hospital_urgent_shortcode()
{
    echo get_template_part('/template-parts/hospital-urgent');
}

function doctor_ratings_shortcode()
{
    echo get_template_part('/template-parts/doctor-ratings');
}

add_shortcode('doctor-ratings', 'doctor_ratings_shortcode');

function posts_cron_shortcode()
{
    echo get_template_part('/template-parts/posts-chron');
}

add_shortcode('health-wellness-chronological', 'health_wellness_shortcode');

function health_wellness_shortcode()
{
    echo get_template_part('/template-parts/health-wellness-chron');
}

add_shortcode('newsroom-chronological', 'posts_cron_shortcode');

function dr_search_shortcode()
{
    echo get_template_part('/template-parts/doctor-search');
}

add_shortcode('dr-search', 'dr_search_shortcode');

function class_events_search_shortcode()
{
    echo get_template_part('/template-parts/class-events-search');
}

add_shortcode('class-events-search', 'class_events_search_shortcode');

function services_search_shortcode()
{
    echo get_template_part('/template-parts/services-search');
}

add_shortcode('services-search', 'services_search_shortcode');

function locations_search_shortcode()
{
    echo get_template_part('/template-parts/locations-search');
}

add_shortcode('locations-search', 'locations_search_shortcode');

/**
 * Add Custom Post Types
 */
add_action('init', 'create_doctors');
function create_doctors()
{
    register_post_type('Doctors', array(
        'labels' => array(
            'name' => __('Doctors') ,
            'singular_name' => __('Doctor')
        ) ,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-id',
        'show_in_rest' => true,
        'rewrite' => array(
        'with_front' => false
        )
    ));
}

add_action('admin_menu', 'add_custom_links_into_doctors_menu');
function add_custom_links_into_doctors_menu()
{
    global $submenu;
    $submenu['edit.php?post_type=doctors'][] = array('Specialties', 'manage_options', 'edit-tags.php?taxonomy=specialties');
    $submenu['edit.php?post_type=doctors'][] = array('Conditions', 'manage_options', 'edit-tags.php?taxonomy=conditions');
}

add_action('init', 'create_services');
function create_services()
{
    register_post_type('services', array(
        'labels' => array(
            'name' => __('Services') ,
            'singular_name' => __('Service')
        ) ,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-tag',
        'has_archive' => false,
        'supports' => array(
            'title'
        ) ,
        'show_in_rest' => true,
        'rewrite' => array(
        'with_front' => false
        )

    ));
}

add_action('init', 'create_locations');
function create_locations()
{
    register_post_type('Locations', array(
        'labels' => array(
            'name' => __('Location') ,
            'singular_name' => __('Location')
        ) ,
        'public' => true,
        'menu_icon' => 'dashicons-building',
        'has_archive' => false,
        'show_in_rest' => true,
        'rewrite' => array(
        'with_front' => false
        )
    ));
}


add_action('init', 'create_health_wellness');
function create_health_wellness()
{
    register_post_type('health_wellness', array(
        'labels' => array(
            'name' => __('Health & Wellness') ,
            'singular_name' => __('Health & Wellness')
        ) ,
        'public' => true,
        'menu_icon' => 'dashicons-admin-post',
        'has_archive' => false,
        'show_in_rest' => true,
        'menu_position' => 4,
        'rewrite' => array(
        'with_front' => false
        )
    ));
}
add_post_type_support( 'health_wellness', 'thumbnail' );

add_action('init', 'create_classes_events');
function create_classes_events()
{
    register_post_type('classes_events', array(
        'labels' => array(
            'name' => __('Classes & Events') ,
            'singular_name' => __('class / Event')
        ) ,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-list-view',
        'has_archive' => false,
        'show_in_rest' => true,
        'rewrite' => array(
        'with_front' => false
        )
    ));
}


add_action( 'init', 'create_specialties_taxonomy', 0 );

function create_specialties_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Specialties', 'taxonomy general name' ),
    'singular_name' => _x( 'Specialty', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Specialties' ),
    'popular_items' => __( 'Popular Specialties' ),
    'all_items' => __( 'All Specialties' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Specialty' ),
    'update_item' => __( 'Update Specialty' ),
    'add_new_item' => __( 'Add New Specialty' ),
    'new_item_name' => __( 'New Specialty Name' ),
    'separate_items_with_commas' => __( 'Separate specialties with commas' ),
    'add_or_remove_items' => __( 'Add or remove specialties' ),
    'choose_from_most_used' => __( 'Choose from the most used specialties' ),
    'menu_name' => __( 'Specialties' ),
  );

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('specialties', 'Doctors', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'specialty' ),
  ));
}


add_action( 'init', 'create_categories_taxonomy', 0 );

function create_categories_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Categories' ),
    'popular_items' => __( 'Popular Categories' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Category' ),
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
    'separate_items_with_commas' => __( 'Separate Categories with commas' ),
    'add_or_remove_items' => __( 'Add or remove Categories' ),
    'choose_from_most_used' => __( 'Choose from the most used Categories' ),
    'menu_name' => __( 'Categories' ),
  );

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('categories', 'health_wellness', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'category' ),
  ));
}


add_action( 'init', 'create_classes_type_taxonomy', 0 );

function create_classes_type_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Genres', 'taxonomy general name' ),
    'singular_name' => _x( 'Class Genre', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Class Genres' ),
    'popular_items' => __( 'Popular Class Genres' ),
    'all_items' => __( 'All Genres' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Genre' ),
    'update_item' => __( 'Update Genre' ),
    'add_new_item' => __( 'Add New Genre' ),
    'new_item_name' => __( 'New Genre Name' ),
    'separate_items_with_commas' => __( 'Separate genres with commas' ),
    'add_or_remove_items' => __( 'Add or remove genres' ),
    'choose_from_most_used' => __( 'Choose from the most used genres' ),
    'menu_name' => __( 'Genres' ),
  );

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('Genres', 'classes_events', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'genres' ),
  ));
}


add_action( 'init', 'create_conditions_taxonomy', 0 );

function create_conditions_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Conditions', 'taxonomy general name' ),
    'singular_name' => _x( 'Condition', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Conditions' ),
    'popular_items' => __( 'Popular Conditions' ),
    'all_items' => __( 'All Conditions' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Condition' ),
    'update_item' => __( 'Update Condition' ),
    'add_new_item' => __( 'Add New Condition' ),
    'new_item_name' => __( 'New Condition Name' ),
    'separate_items_with_commas' => __( 'Separate conditions with commas' ),
    'add_or_remove_items' => __( 'Add or remove conditions' ),
    'choose_from_most_used' => __( 'Choose from the most used conditions' ),
    'menu_name' => __( 'Conditions' ),
  );

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('conditions', 'Doctors', array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'specialty' ),
  ));
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load plugin compatibility file.
 */
require get_template_directory() . '/inc/plugin-compatibility/plugin-compatibility.php';

/**
 * Load custom WordPress nav walker.
 */
if (!class_exists('wp_bootstrap_navwalker')) {
    require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
}

//rmeove default wisy
function remove_editor()
{
    //remove_post_type_support('page', 'editor');
    remove_post_type_support('post', 'editor');
    remove_post_type_support('services', 'editor');
    remove_post_type_support('doctors', 'editor');
    remove_post_type_support('locations', 'editor');
    remove_post_type_support('classes_events', 'editor');
    remove_post_type_support('health_wellness', 'editor');
}
add_action('admin_init', 'remove_editor');

add_rewrite_rule('^locations/page/([0-9]+)', 'index.php?pagename=locations&paged=$matches[1]', 'top');
add_rewrite_rule('^services/page/([0-9]+)', 'index.php?pagename=services&paged=$matches[1]', 'top');



function flatten(array $array)
{
    $return = array();
    array_walk_recursive($array, function ($a) use (&$return) {
        $return[] = $a;
    });
    return $return;
}

function clean($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function getToken()
{
    $curl = curl_init();
    $apiID = "761681521472221";
    $apiSecret = "620ec320-86df-4c27-a190-622693eb68cd";
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.binaryfountain.com/api/service/v1/token/create",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "appId=" . $apiID . "&appSecret=" . $apiSecret,
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded"
        )
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $json = json_decode($response);
    curl_close($curl);

    if ($err) {
        return $err;
    } else {
        return $json->accessToken;
    }
}

function getRatingsByNpi($npi_code)
{
    $token = getToken();
    $curl = curl_init();
    $npiKey = $npi_code;
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.binaryfountain.com/api/service/bsr/comments",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "personId=" . $npiKey . "&perPage=1000",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "accesstoken: $token"
        )
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $json = json_decode($response, true);

    curl_close($curl);

    if ($err) {
        return $err;
    } else {
        return $json;
    }
}

function services_main_search($request)
{

    $results = array();

    $pageresults = array();


    if ($request["term"]) {
        $search_term = strtolower($request["term"]);


        $generalsearch = get_posts(array(
            'post_type' => array('services'),
            'order' => 'ASC',
            'posts_per_page' => - 1,
        ));

        foreach ($generalsearch as $p) {

            $terms = get_field("search_term", $p->ID);
     
            $term_names = [];
            if ($terms) {
                foreach ($terms as $term) {
                    array_push($term_names, strtolower($term->name));
                }
                if(preg_grep("/$search_term/", $term_names) || stripos($p->name, $search_term) !== false) {
                    $results[] = $p;
                }
            }
        
            if ($search_term == strtolower($p->name)) {
                array_push($results, $p);
            }
        }


    }

    $pagesServiceListing = get_posts(array(
            'post_type' => array('page'),
            'order' => 'ASC',
            'posts_per_page' => - 1,
            's' => $search_term,
            'meta_query' => array(
                'relation' => 'AND',
                  array(
                      'key' => 'list_as_a_service',
                      'value' => 1,
                      'compare' => '='
                  ),
              )
        ));

    foreach ($pagesServiceListing as $p) {

        $pageresults[] = $p;

    }



    $return = array();

    foreach ($results as $post_id) {

        array_push($return, array(
            'taxonomy_terms' => get_field("search_term", $post_id),
            'service' => get_field("name", $post_id),
            'permalink' => get_the_permalink($post_id),

        ));
    }

    foreach ($pageresults as $post_id) {

        array_push($return, array(
            'taxonomy_terms' => '',
            'service' => get_the_title($post_id),
            'permalink' => get_the_permalink($post_id),

        ));
    }

    $final_services = array_unique($return, SORT_REGULAR);



    return $final_services;
}

add_action('rest_api_init', 'services_main_search_route');

function services_main_search_route()
{
    register_rest_route('memorial', 'v2/services/main-search/', ['methods' => "GET", 'callback' => 'services_main_search', 'args' => ['term', 'type', 'location'], ]);
}

//Doctors Main search


function doctor_text_match($post_id, $search_term)
{

    $p = get_post($post_id);

    $terms = array();
    $terms[] = strtolower($p->post_title);

    // check services

    $services = get_field("related_services", $post_id);

    if ($services) {

        foreach ($services as $term) {

            $terms[] = strtolower($term->post_title);

        }
    }

    // check specialties

    $specialties = get_field("specialties", $post_id);

    if ($specialties) {

        foreach ($specialties as $term) {

            $terms[] = strtolower($term->name);

        }
    }

    // check conditions

    $conditions = get_field("conditions", $post_id);

    if ($conditions) {

        foreach ($conditions as $term) {

            $terms[] = strtolower($term->name);

        }
    }

    foreach ($terms as $term) {

        if (strpos($term, strtolower($search_term)) > -1) {

            return true;

        }
    }

    return false;
}

function doctors_main_search($request)
{

    $results = array();
    $accepting_new_patients = "";
    $accepts_telehealth = "";


    if ($request["accepting_new_patients"] === "true") {
        $accepting_new_patients = array('yes');
    }else{
        $accepting_new_patients = array('yes', 'no');
    }

    if ($request["accepting_telehealth"] === "true") {
        $accepts_telehealth = array('yes');
    }else{
        $accepts_telehealth = array('yes', 'no');
    }



    if ($request["generalterm"]) {

        $generalsearch = get_posts(array(
            'post_type' => array('doctors'),
            'order' => 'ASC',
            'posts_per_page' => - 1,
            'meta_query' => array(
                'relation' => 'AND',
                  array(
                      'key' => 'accepting_telehealth_appointment',
                      'value' => $accepts_telehealth,
                      'compare' => 'IN'
                  ),
                  array(
                    'key' => 'accepting_new_patients',
                    'value' => $accepting_new_patients,
                    'compare' => 'IN'
                ),
            )
        ));

        $results = array();

        foreach ($generalsearch as $p) {

            if (doctor_text_match($p->ID, $request["generalterm"])) {

                array_push($results, $p->ID);

            }
        }
    }else{

        $generalsearch = get_posts(array(
            'post_type' => array('doctors'),
            'order' => 'ASC',
            'posts_per_page' => - 1,
            'meta_query' => array(
                'relation' => 'AND',
                  array(
                      'key' => 'accepting_telehealth_appointment',
                      'value' => $accepts_telehealth,
                      'compare' => 'IN'
                  ),
                  array(
                    'key' => 'accepting_new_patients',
                    'value' => $accepting_new_patients,
                    'compare' => 'IN'
                ),
            )
        ));

        $results = array();

        foreach ($generalsearch as $p) {

            array_push($results, $p->ID);
        }
    }

    if ($request["locationterm"]) {

        if (count($results)) {

            $generalsearch = get_posts(array(
                'post_type' => array('doctors'),
                'order' => 'ASC',
                'posts_per_page' => - 1,
                'post__in' => $results,
            ));

        } else {

            $generalsearch = get_posts(array(
                'post_type' => array('doctors'),
                'order' => 'ASC',
                'posts_per_page' => - 1,
            ));

        }

        $results = array();

        // check locations

        foreach ($generalsearch as $p) {

            $post_id = $p->ID;

            $locations = get_field("related_locations", $post_id);

            if ($locations) {

                foreach ($locations as $location) {

                    $location_name = strtolower(get_field("location_name", $location->ID));

                    if (strpos($location_name, strtolower($request["locationterm"])) > -1) {

                        array_push($results, $post_id);

                    }

                    $contact_information_street_address = strtolower(get_field("contact_information_street_address", $location->ID));

                    if (strpos($contact_information_street_address, strtolower($request["locationterm"])) > -1) {

                        array_push($results, $post_id);

                    }
                }
            }
        }
    }

    $fresults = array_unique(flatten($results));

    $return = array();

    foreach ($fresults as $post_id) {

          array_push($return, array(

              'name' => get_the_title($post_id) ,
              'service' => get_field("related_services", $post_id) ,
              'phone_number' => get_field("main_phone_number", $post_id),
              'profile_image' => get_field("profile_image", $post_id),
              'accepting_new_patients' => get_field("accepting_new_patients", $post_id),
              'accepting_telehealth_appointment' => get_field("accepting_telehealth_appointment", $post_id),
              'profile_link' => get_permalink($post_id),

          ));
    }

    return $return;
}

add_action('rest_api_init', 'doctors_main_search_route');

function doctors_main_search_route()
{
    register_rest_route('memorial', 'v2/doctors/main-search/', ['methods' => "GET", 'callback' => 'doctors_main_search', 'args' => ['generalterm', 'type', 'secondaryterm', 'isdualsearch', 'criteria_type'], ]);
}


// LOCATIONS SEARCH
function locations_main_search($request)
{

    $results = array();

    if ($request["generalterm"]) {

        // search locations and filter post title by generalterm

        $generalsearch = get_posts(array(
            'post_type' => array('services', 'locations'),
            'order' => 'ASC',
            'posts_per_page' => - 1,
            's' => $request["generalterm"],
        ));

        foreach ($generalsearch as $p) {

            $args = null;

            if ($p->post_type == "services") {

                $args = array(
                    'post_type' => 'locations',
                    'order' => 'ASC',
                    'posts_per_page' => - 1,
                    'meta_query' => array(
                        array(
                            'key' => 'related_services',
                            'value' => $p->ID,
                            'compare' => 'LIKE',
                        )
                    )
                );

                $locations = new WP_Query($args);

                while ($locations->have_posts()):

                    $locations->the_post();

                    array_push($results, get_the_ID());

                endwhile;

            } elseif ($p->post_type == "locations") {

                array_push($results, $p->ID);

            }
        }

        // for each location, search and filter all Doctor posts based on related_locations

        $locationsearch = get_posts(array(
            'post_type' => array('locations'),
            'order' => 'ASC',
            'posts_per_page' => - 1,
        ));

        foreach ($locationsearch as $p) {

            $args = array(
                'post_type' => 'doctors',
                'order' => 'ASC',
                'posts_per_page' => - 1,
                'meta_query' => array(
                    array(
                        'key' => 'related_locations',
                        'value' => $p->ID,
                        'compare' => 'LIKE',
                    )
                )
            );

            $doctors = new WP_Query($args);

            while ($doctors->have_posts()):

                $doctors->the_post();

                if (doctor_text_match(get_the_ID(), $request["generalterm"])) {

                    array_push($results, $p->ID);

                }

            endwhile;

        }

        // for each doctor, search and filter all Location posts based on doctors_staff

        $doctorsearch = get_posts(array(
            'post_type' => array('doctors'),
            'order' => 'ASC',
            'posts_per_page' => - 1,
        ));

        foreach ($doctorsearch as $p) {

            if (doctor_text_match($p->ID, $request["generalterm"])) {

                $args = array(
                    'post_type' => 'locations',
                    'order' => 'ASC',
                    'posts_per_page' => - 1,
                    'meta_query' => array(
                        array(
                            'key' => 'doctors_staff',
                            'value' => $p->ID,
                            'compare' => 'LIKE',
                        )
                ));

                $locations = new WP_Query($args);

                while ($locations->have_posts()):

                    $locations->the_post();

                    array_push($results, get_the_ID());

                endwhile;

            }
        }
    }

    // filter all potential results by location field

    if ($request["locationterm"]) {

      $args = array(
          'post_type' => 'locations',
          'order' => 'ASC',
          'posts_per_page' => - 1,
          'post__in' => $results,
          'meta_query' => array(
              'relation' => 'OR',
              array(
                  'key' => 'location_name',
                  'value' => $request["locationterm"],
                  'compare' => 'LIKE',
              ),
              array(
                  'key' => 'contact_information_street_address',
                  'value' => $request["locationterm"],
                  'compare' => 'LIKE',
              ),
          )
      );

      $results = array();

      $locations = new WP_Query($args);

      while ($locations->have_posts()):

          $locations->the_post();

          array_push($results, get_the_ID());

      endwhile;

    }

    $fresults = array_unique(flatten($results));

    $return = array();

    foreach ($fresults as $post_id) {

          $imageset = get_field("image", $post_id);
          if (@getimagesize($imageset)) {
              $imagePath = $imageset;
          } else {
              $imagePath = get_template_directory_uri().'/inc/assets/images/MemorialHospital-default.jpg';
          }

          array_push($return, array(

              'Name' => get_field("location_name", $post_id),
              'contact_information' => get_field("contact_information", $post_id),
              'image' => $imagePath,
              'logo' => get_field("logo", $post_id),
              'url' => get_permalink($post_id),
              'hide_from_locations_and_search' => get_field("hide_from_locations_and_search", $post_id),

          ));
    }

    return $return;
}

add_action('rest_api_init', 'locations_main_search_route');

function locations_main_search_route()
{
    register_rest_route('memorial', 'v2/locations/main-search/', ['methods' => "GET", 'callback' => 'locations_main_search', 'args' => ['generalterm', 'type', 'locationterm', 'secondaryterm', 'isdualsearch', 'criteria_type'], ]);
}

function location_search_ahead($request)
{
    $locationsargs = array(
        'posts_per_page' => - 1,
        'post_type' => 'locations',
        'order' => 'ASC'
    );

    $all_locations = array();
    $locations = new WP_Query($locationsargs);
    $street_address = array();
    $location_name = array();
    $namesOnly = array();

    while ($locations->have_posts()):

        $locations->the_post();

        $location_name[] = get_field("location_name");

        if (have_rows('contact_information')):

            while ( have_rows('contact_information') ) : the_row();
                $street_address[] = get_sub_field('street_address');
                // Do something...
            endwhile;

        else :
            // no rows found
        endif;

        $mereged_locations = array_merge($location_name,$street_address);

        foreach($mereged_locations as $key => $value){
            $namesOnly[]  = $value;
        }

        // array_push($all_locations, array(
        //     'value' => $namesOnly,
        //     'class' => 'location',
        //     //'query_data' => [$_GET,$_REQUEST,$request]
        // ));

        array_push($all_locations, array(
            'value' => get_field('location_name') .' | '.get_field('contact_information_street_address'),
            'class' => 'location',
            //'query_data' => [$_GET,$_REQUEST,$request]
        ));

    endwhile;

    return json_encode($all_locations);
}

add_action('rest_api_init', 'location_search_ahead_route');

function location_search_ahead_route()
{
    register_rest_route('memorial', 'v2/location-search-ahead/', array(
        'methods' => 'GET',
        'callback' => 'location_search_ahead',
        'args' => ['generalterm', 'type', 'secondaryterm', 'isdualsearch', 'locationterm']
    ));
}

function general_search_ahead()
{
    $doctorargs = array(
        'posts_per_page' => -1,
        'post_type' => 'doctors',
        'orderby' => 'last_name',
        'order' => 'ASC'
    );

    $doctor_names = array();
    $doctors = new WP_Query($doctorargs);

    while ($doctors->have_posts()):
        $doctors->the_post();

        $value = get_field("first_name") . " " . get_field("last_name");

        $dr_title = get_the_title();
        // check specialties
        $specialties = get_field("specialties");
        if ($specialties) {
            foreach ($specialties as $term) {
                $value .= " " . strtolower($term->name);
            }
        }
        // check conditions
        $conditions = get_field("conditions");
        if ($conditions) {
            foreach ($conditions as $term) {
                $value .= " " . strtolower($term->name);
            }
        }
        array_push($doctor_names, array(
            'value' => $dr_title,
            'label' => $value,
            'class' => 'doctor'
        ));
    endwhile;

    $serviceargs = array(
        'posts_per_page' => - 1,
        'post_type' => 'services',
        'order' => 'ASC'
    );
    $service_names = array();
    $services = new WP_Query($serviceargs);

    while ($services->have_posts()):
        $services->the_post();
        array_push($doctor_names, array(
            'value' => html_entity_decode(get_the_title()) ,
            'class' => 'service'
        ));
    endwhile;

    $terms = get_terms([
        'taxonomy' => "specialties",
        'hide_empty' => false,
    ]);

    foreach ($terms as $term) {
        array_push($doctor_names, array(
            'value' => html_entity_decode($term->name),
            'class' => 'specialty'
        ));
    }

    $terms = get_terms([
        'taxonomy' => "conditions",
        'hide_empty' => false,
    ]);

    foreach ($terms as $term) {
        array_push($doctor_names, array(
            'value' => html_entity_decode($term->name),
            'class' => 'condition'
        ));
    }

    $unique = array();

    foreach ($doctor_names as $result) {

      $key = trim(strtolower($result["value"]));

      $unique[$key] = $result;

    }

    $return = array();

    foreach ($unique as $result) {

      $return[] = $result;

    }

    return json_encode($return);
}

add_action('rest_api_init', 'general_search_ahead_route');

function general_search_ahead_route()
{
    register_rest_route('memorial', 'v2/general-search-ahead/', array(
        'methods' => 'GET',
        'callback' => 'general_search_ahead',
    ));
}



function services_search_ahead()
{

    $results = array();
    $pagesServiceListing = array();

    $tags = get_tags(array(
      'taxonomy' => 'post_tag',
      'orderby' => 'name',
      'hide_empty' => false // for development
    ));

    $services = get_posts(array(
        'post_type' => array('services'),
        'order' => 'ASC',
        'posts_per_page' => - 1,
    ));

    $pagesServiceListing = get_posts(array(
            'post_type' => array('page'),
            'order' => 'ASC',
            'posts_per_page' => - 1,
            's' => $search_term,
            'meta_query' => array(
                'relation' => 'AND',
                  array(
                      'key' => 'list_as_a_service',
                      'value' => 1,
                      'compare' => '='
                  ),
              )
        ));


    $return = array();

    foreach ($pagesServiceListing as $p) {

        $pageresults[] = $p;

    }

    foreach ($pageresults as $post_id) {

        array_push($return, array(
            'value' => get_the_title($post_id),
            'label' => get_the_title($post_id),
            'class' => 'service term',

        ));
    }

    foreach ($tags as $term) {
        array_push($return, array(
                'value' => $term->name,
                'label' => $term->name,
                'class' => 'service term'
        ));
    }


    foreach ($services as $service) {
        array_push($return, array(
                'value' => $service->name,
                'label' => $service->name,
                'class' => 'service term'
        ));
    }

    return json_encode($return);

}

add_action('rest_api_init', 'services_search_ahead_route');

function services_search_ahead_route()
{
    register_rest_route('memorial', 'v2/services-search-ahead/', array(
        'methods' => 'GET',
        'callback' => 'services_search_ahead',
    ));
}




function locations_search_ahead()
{

    $results = array();

    $locations = get_posts(array(
        'post_type' => array('locations'),
        'order' => 'ASC',
        'posts_per_page' => - 1,
    ));

    $services = get_posts(array(
        'post_type' => array('services'),
        'order' => 'ASC',
        'posts_per_page' => - 1,
    ));


    $return = array();


    foreach ($locations as $location) {
        array_push($return, array(
                'value' => get_field( 'location_name', $location->ID),
                'label' => get_field( 'location_name', $location->ID),
                'class' => 'location term'
        ));
    }

    foreach ($services as $service) {
        array_push($return, array(
                'value' => get_the_title($service->ID),
                'label' => get_the_title($service->ID),
                'class' => 'service term'
        ));
    }

    return json_encode($return);

}

add_action('rest_api_init', 'locations_search_ahead_route');

function locations_search_ahead_route()
{
    register_rest_route('memorial', 'v2/locations-search-ahead/', array(
        'methods' => 'GET',
        'callback' => 'locations_search_ahead',
    ));
}



function class_calendar_search($request)
{
    $date_one = $request["date_one"];
    $date_two = $request["date_two"];

    $classargs = array(
        'post_type' => 'classes_events',
        'order' => 'ASC',
        'posts_per_page' => - 1,
        'meta_query' => array(
            array(
                'key' => 'date',
                'value' => array($date_one, $date_two),
                'compare' => 'BETWEEN',
                'type' => 'DATE'
            )
        ),
    );

    $class_results = array();
    $classes_final = new WP_Query($classargs);

    while ($classes_final->have_posts()):
    // $contact_information = get_field("contact_information", get_field("related_location"));
    $classes_final->the_post();
    $post_id = get_the_ID();

    if( have_rows('class_times') ):
        // Loop through rows.
        $count = count(get_field('class_times'));

        if ($count != null && $count > 1) {
            $classes_batch = "Multiple Classes";
        }else{
            while( have_rows('class_times') ) : the_row();
            $start_time = get_sub_field('start_time');
            if (preg_match('/pm/i', $start_time) == 0) {
                $classes_batch = "Afternoon Class";
            }else{
                $classes_batch = "Morning Class";
            }
            endwhile;
        }
    // No value.
    else :
        // Do something...
    endif;

    // Returns ID
    $relatedLocationId = get_field('related_location',$post_id);
    $relatedLocatoinName = get_the_title($relatedLocationId);
    array_push($class_results, array(
        'name' => get_field("name"),
        'date' => get_field("date") ,
        'class_times' => get_field("class_times"),
      //'related_location' => $contact_information,
        'image' => get_field("image"),
        'ceid' => $post_id,
        'classpermalink' => get_the_permalink($post_id),
        'related_location' => $relatedLocatoinName,
        'classes_batch' => $classes_batch
    ));
    endwhile;

    return $class_results;
}


add_action('rest_api_init', 'class_calendar_search_route');

function class_calendar_search_route()
{
    register_rest_route('memorial', 'v2/classes/calendar/', ['methods' => "GET", 'callback' => 'class_calendar_search', 'args' => ['date_one'],['date_two'] ]);
}

function class_general_search($request)
{
    $search_term = $request["open_search_term"];
    $class_name = $request["class_name"];
    $class_type = $request["class_type"];
    $classes_results = array();
    $today = date('Ymd');


    if ($search_term) {
    $class_args = array(
        'post_type' => 'classes_events',
        'order' => 'ASC',
        'posts_per_page' => - 1,
        's' => $search_term,
        'meta_query' => array(
            array(
            'key' => 'date',
            'value' => $today,
            'compare' => '>='
            )
         ) ,
        );

        $class_open_search_results = new WP_Query($class_args);
    }

    

   if ($class_name) {
    $class_name_args = array(
        'post_type' => 'classes_events',
        'order' => 'ASC',
        'posts_per_page' => - 1,
        'meta_query' => array(
            array(
                'key' => 'name',
                'value' => $class_name,
                'compare' => '=',
                'order' => 'ASC'
            ) ,
            array(
            'key' => 'date',
            'value' => $today,
            'compare' => '>='
            )
         ) ,
        );
        $class_name_search_results = new WP_Query($class_name_args);
    }
    


   if ($class_type) {
    $class_type_args = array(
        'post_type' => 'classes_events',
        'order' => 'ASC',
        'posts_per_page' => - 1,
        'meta_query' => array(
          array(
            'key' => 'genres',
            'value' => $class_type,
            'compare' => 'LIKE'
          ),
          array(
            'key' => 'date',
            'value' => $today,
            'compare' => '>='
         )
        ),
      );

        $class_type_search_results = new WP_Query($class_type_args);
    }


    if ($search_term) {
        while ($class_open_search_results->have_posts()):
            $class_open_search_results->the_post();
            $related_locations = get_field('related_location', get_the_ID());
            $locations = get_field('related_location', get_the_ID());
            $contact_information = get_field( 'contact_information', $locations);
            if( have_rows('class_times', get_the_ID()) ):
                while( have_rows('class_times') ) : the_row();
                     $start_time = get_sub_field('start_time');
                endwhile;
            endif;
        array_push($classes_results, array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'name' => get_field('name', get_the_ID()),
                'description' => get_field('description', get_the_ID()),
                'cost' => get_field('cost', get_the_ID()),
                'date' => get_field('date', get_the_ID()),
                'permalink' => get_the_permalink(),
                'image' => get_field('image', get_the_ID()),
                'contact_information' => $contact_information,
                'time' => $start_time
            ));
        endwhile;
    }


   if ($class_name) {
    while ($class_name_search_results->have_posts()):
        $class_name_search_results->the_post();
        $locations = get_field('related_location', get_the_ID());
        $contact_information = get_field( 'contact_information', $locations);
        if( have_rows('class_times', get_the_ID()) ):
            while( have_rows('class_times') ) : the_row();
                 $start_time = get_sub_field('start_time');
            endwhile;
        endif;
    array_push($classes_results, array(
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'name' => get_field('name', get_the_ID()),
            'description' => get_field('description', get_the_ID()),
            'cost' => get_field('cost', get_the_ID()),
            'date' => get_field('date', get_the_ID()),
            'permalink' => get_the_permalink(),
            'image' => get_field('image', get_the_ID()),
            'contact_information' => $contact_information,
            'time' => $start_time
        ));
    endwhile;
    }


    if ($class_type) {
    while ($class_type_search_results->have_posts()):
        $class_type_search_results->the_post();
        $locations = get_field('related_location', get_the_ID());
        $contact_information = get_field( 'contact_information', $locations);
        if( have_rows('class_times', get_the_ID()) ):
            while( have_rows('class_times') ) : the_row();
                $start_time = get_sub_field('start_time');
            endwhile;
        endif;
    array_push($classes_results, array(
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'name' => get_field('name', get_the_ID()),
            'description' => get_field('description', get_the_ID()),
            'cost' => get_field('cost', get_the_ID()),
            'date' => get_field('date', get_the_ID()),
            'permalink' => get_the_permalink(),
            'image' => get_field('image', get_the_ID()),
            'contact_information' => $contact_information,
            'time' => $start_time
        ));
    endwhile;
    }

    $smashed = array_unique($classes_results, SORT_REGULAR);
    $renumbered = array_merge($smashed, array());


    return $renumbered;

}

add_action('rest_api_init', 'class_general_search_route');

function class_general_search_route()
{
    register_rest_route('memorial', 'v2/classes/general/', ['methods' => "GET", 'callback' => 'class_general_search', 'args' => ['type_filter'], ]);
}



function doctor_alpha_search($request)
{
    $split_term = explode("-", $request["term"]);
    $args = array(
        'post_type' => 'doctors',
        'orderby' => 'last_name',
        'order' => 'ASC',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'last_name',
                'value' => array(
                    $split_term[0],
                    $split_term[1]
                ) ,
                'compare' => 'BETWEEN',
                'order' => 'ASC'
            ) ,
        ) ,
    );

    $doctor_results = array();
    $doctors = new WP_Query($args);

    while ($doctors->have_posts()):
        $doctors->the_post();
        $postid = get_the_ID();

        $services = get_field("related_services",$postid);
        $servicearray = array();
        foreach ($services as $key => $serviceval) {
            $serviceid = $serviceval->ID;
            $serviceTitle = $serviceval->post_title;
            $serviceLink = get_the_permalink($serviceid);

            $servicearray[] = array(
                'serviceid' => $serviceid,
                'serviceTitle' => $serviceTitle,
                'serviceLink' => $serviceLink
            );
        }

        array_push($doctor_results, array(
            'name' => get_the_title(),
            'service' => get_field("related_services") ,
            'phone_number' => get_field("main_phone_number"),
            'profile_image' => get_field("profile_image"),
            'accepting_new_patients' => get_field("accepting_new_patients"),
            'profile_permalink' => get_the_permalink($postid),
            'site_url_web' => site_url(),
            'services_data' => $servicearray,
        ));
    endwhile;

    return $doctor_results;
}

add_action('rest_api_init', 'doctors_alpha_route');

function doctors_alpha_route()
{
    register_rest_route('memorial', 'v2/doctors/alpha/', ['methods' => "GET", 'callback' => 'doctor_alpha_search', 'args' => ['term'], ]);
}

function service_alpha_search($request)
{
    $split_term = explode("-", $request["term"]);
    $all_services = array();
    $args = array(
        'post_type' => array('services', 'page'),
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC',
        'posts_per_page' => - 1,
                // 's' => array(
                //     $split_term[0],
                //     $split_term[1]
                // ),
        'meta_query' => array(
           'relation' => 'OR',
            array(
                'key' => 'name',
                'value' => array(
                    $split_term[0],
                    $split_term[1]
                ) ,
                'compare' => 'BETWEEN',
                'order' => 'ASC'
            ) ,
            array(
              'key' => 'list_as_a_service',
              'value' => 1,
              'compare' => '='
           )
        ) ,
    );
    $services = new WP_Query($args);

    // $pageargs = array(
    //     'post_type' => 'page',
    //     'post_status' => 'publish',
    //     'orderby' => 'title',
    //     'order' => 'ASC',
    //     'posts_per_page' => - 1,
    //     's' => array(
    //                 $split_term[0],
    //                 $split_term[1]
    //             ),
    //     'meta_query' => array(
      
    //               array(
    //                   'key' => 'list_as_a_service',
    //                   'value' => 1,
    //                   'compare' => '='
    //             ),

    //     )
    // );
    // $pageservices = new WP_Query($pageargs);

    while ($services->have_posts()): $services->the_post();
        $post_type = get_post_type();
    if($post_type == 'services'):
    array_push($all_services, array(
            'taxonomy_terms' => get_field("search_term") ,
            'service' => get_field("name") ,
            'permalink' => get_the_permalink()
        ));
    else:

     if($split_term[0] == 'a') {
        $title = get_the_title();
        $starts_with = $title[0];
        if(in_array($starts_with, ['A','B','C','D','E'])):
            array_push($all_services, array(
            'taxonomy_terms' => '',
            'service' => get_the_title() ,
            'permalink' => get_the_permalink()
            ));

        endif;    
     }


      if($split_term[0] == 'f') {
        $title = get_the_title();
        $starts_with = $title[0];
        if(in_array($starts_with, ['F','G','H','I','J'])):
            array_push($all_services, array(
            'taxonomy_terms' => '',
            'service' => get_the_title() ,
            'permalink' => get_the_permalink()
            ));

        endif;    
     }


      if($split_term[0] == 'k') {
        $title = get_the_title();
        $starts_with = $title[0];
        if(in_array($starts_with, ['K','L','M','N','O'])):
            array_push($all_services, array(
            'taxonomy_terms' => '',
            'service' => get_the_title() ,
            'permalink' => get_the_permalink()
            ));

        endif;    
     }
     

      if($split_term[0] == 'p') {
        $title = get_the_title();
        $starts_with = $title[0];
        if(in_array($starts_with, ['P','Q','R','S','T'])):
            array_push($all_services, array(
            'taxonomy_terms' => '',
            'service' => get_the_title() ,
            'permalink' => get_the_permalink()
            ));

        endif;    
     }

      if($split_term[0] == 'u') {
        $title = get_the_title();
        $starts_with = $title[0];
        if(in_array($starts_with, ['U','V','X','Y','Z'])):
            array_push($all_services, array(
            'taxonomy_terms' => '',
            'service' => get_the_title() ,
            'permalink' => get_the_permalink()
            ));

        endif;    
     } 

    endif;
    endwhile;

    // while ($pageservices->have_posts()):
    //     $pageservices->the_post();
    // array_push($all_services, array(
    //         'taxonomy_terms' => '',
    //         'service' => get_the_title() ,
    //         'permalink' => get_the_permalink()
    //     ));
    // endwhile;

    return $all_services;
}

add_action('rest_api_init', 'services_alpha_search');


// function change_wp_search_size($query)
// {
//     if ($query->is_search) { // Make sure it is a search page
//         $query->query_vars['posts_per_page'] = 3;
//     } // Change 10 to the number of posts you would like to show

//     return $query; // Return our modified query variables
// }
//add_filter('pre_get_posts', 'change_wp_search_size');

add_filter('query_vars', 'mhealth_custom_queryvar');
function mhealth_custom_queryvar($public_query_vars) {
    $public_query_vars[] = 'mh_query_var';
    return $public_query_vars;
}

function services_alpha_search()
{
    register_rest_route('memorial', 'v2/services/alpha/', ['methods' => "GET", 'callback' => 'service_alpha_search', 'args' => ['term'], ]);
}

function alternate_classes($request)
{
    $class_name = $request["term"];
    $class_id = $request["id"];
    $alt_classes = array();

    $args = array(
        'post_type' => 'classes_events',
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC',
        'post__not_in' => array(
            $class_id
        ),
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'name',
                'value' => $class_name,
                'compare' => '=',
                'order' => 'ASC'
            ) ,
        ) ,
    );
    $classes = new WP_Query($args);

    while ($classes->have_posts()):
        $start_times = array();
    $classes->the_post();
    if (have_rows('class_times')):

            $count = count(get_field('class_times'));

    while (have_rows('class_times')):
                the_row();
    $start_time = get_sub_field('start_time');

    array_push($start_times, $start_time);

    if ($count != null && $count > 1) {
        $class_type = "Multiple Classes";
    } else {
        if (preg_match('/pm/i', $start_time) == 0) {
            $class_type = "Morning Class";
        } else {
            $class_type = "Evening Class";
        }
    }

    endwhile; else:
            // Do something...

        endif;

    array_push($alt_classes, array(
            'date' => get_field("date") ,
            'class_type' => $class_type,
            'permalink' => get_the_permalink() ,
            'times' => $start_times
        ));
    endwhile;

    return $alt_classes;
}

add_action('rest_api_init', 'altnerates_classes');

function altnerates_classes()
{
    register_rest_route('memorial', 'v2/alternate-classes/', ['methods' => "GET", 'callback' => 'alternate_classes', 'args' => ['term', 'id'], ]);
}

//disable gutenburg
add_filter('use_block_editor_for_post_type', '__return_false');

// Function to change "posts" to "news" in the admin side menu
function change_post_menu_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'NewsRoom';
    $submenu['edit.php'][5][0] = 'News Articles';
    $submenu['edit.php'][10][0] = 'Add News Article';
    $submenu['edit.php'][16][0] = 'Tags';
    echo '';
}
add_action('admin_menu', 'change_post_menu_label');
// Function to change post object labels to "news"
function change_post_object_label()
{
    global $wp_post_types;
    $labels = & $wp_post_types['post']->labels;
    $labels->name = 'News Articles';
    $labels->singular_name = 'News Article';
    $labels->add_new = 'Add News Article';
    $labels->add_new_item = 'Add News Article';
    $labels->edit_item = 'Edit News Article';
    $labels->new_item = 'News Article';
    $labels->view_item = 'View News Article';
    $labels->search_items = 'Search News Articles';
    $labels->not_found = 'No News Articles found';
    $labels->not_found_in_trash = 'No News Articles found in Trash';
}
add_action('init', 'change_post_object_label');

// Method 1: Filter.
function my_acf_google_map_api($api)
{
    $api['key'] = 'AIzaSyA7b8UmzXyFb4258MYEpjdnfYsNT5zCSfk';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Method 2: Setting.
function my_acf_init()
{
    acf_update_setting('google_api_key', 'xxx');
}
add_action('acf/init', 'my_acf_init');

function create_ACF_meta_in_REST()
{
    $postypes_to_exclude = ['acf-field-group', 'acf-field'];
    $extra_postypes_to_include = ["page"];
    $post_types = array_diff(get_post_types(["_builtin" => false], 'names'), $postypes_to_exclude);

    array_push($post_types, $extra_postypes_to_include);

    foreach ($post_types as $post_type) {
        register_rest_field($post_type, 'ACF', ['get_callback' => 'expose_ACF_fields', 'schema' => null, ]);
    }
}


/**
 * Login theme branding.
 */
function rt_login_css()
{
    wp_enqueue_style('wp-bootstrap-starter-bootstrap-css', get_template_directory_uri() . '/inc/assets/css/login.css');
}
add_action('login_head', 'rt_login_css');



function expose_ACF_fields($object)
{
    $ID = $object['id'];
    return get_fields($ID);
}

add_action('rest_api_init', 'create_ACF_meta_in_REST');

function my_own_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'my_own_mime_types');
//breadcrumbs
// Breadcrumbs
function custom_breadcrumbs()
{

    // Settings
    $separator = '&#47;';
    $breadcrums_id = 'breadcrumbs';
    $breadcrums_class = 'breadcrumbs';
    $home_title = 'Home';

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy = 'product_cat';

    // Get the query & post information
    global $post, $wp_query;

    // Do not display on the homepage
    if (!is_front_page()) {

        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';

        if (is_archive() && !is_tax() && !is_category() && !is_tag()) {
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
        } elseif (is_archive() && is_tax() && !is_category() && !is_tag()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);

                if($post_type == 'doctors'){
                    $post_type_archive = site_url('find-a-doctor');
                }
                else if($post_type == 'services'){
                    $post_type_archive = site_url('services');
                }
                else if($post_type == 'locations'){
                    $post_type_archive = site_url('locations');
                }
                else if($post_type == 'classes_events'){
                    $post_type_archive = site_url('health-wellness/classes-events');
                }
                else{
                    $post_type_archive = get_post_type_archive_link($post_type);
                }

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object
                    ->labels->name . '">' . $post_type_object
                    ->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
            }

            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
        } elseif (is_single()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                if($post_type == 'doctors'){
                    $post_type_archive = site_url('find-a-doctor');
                }
                else if($post_type == 'services'){
                    $post_type_archive = site_url('services');
                }
                else if($post_type == 'locations'){
                    $post_type_archive = site_url('locations');
                }
                else if($post_type == 'classes_events'){
                    $post_type_archive = site_url('health-wellness/classes-events');
                }
                else{
                    $post_type_archive = get_post_type_archive_link($post_type);
                }

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object
                    ->labels->name . '">' . $post_type_object
                    ->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
            }

            $cat_display = '';
            $cat_display .= '<li class="item-cat">Newsroom</li>';
            $cat_display .= '<li class="separator"> News' . $separator . ' </li>';

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                $cat_id = $taxonomy_terms[0]->term_id;
                $cat_nicename = $taxonomy_terms[0]->slug;
                $cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name = $taxonomy_terms[0]->name;
            }

            // Check if the post is in a category
            if (!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

            // Else if post is in a custom taxonomy
            } elseif (!empty($cat_id)) {
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
            }elseif ($post_type == 'post') {
                echo '<li class="item-cat item-custom-post-type-doctors"><a class="bread-cat bread-custom-post-type-doctors" href="/news-room" title="Doctors">News Room</a></li><li class="separator"> / </li><li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
            } else {
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
            }
        } elseif (is_category()) {

            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
        } elseif (is_page()) {

            // Standard page
            if ($post->post_parent) {

                // If child page, get parents
                $anc = get_post_ancestors($post->ID);

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                if (!isset($parents)) {
                    $parents = null;
                }
                foreach ($anc as $ancestor) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
            }
        } elseif (is_tag()) {

            // Tag page
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args = 'include=' . $term_id;
            $terms = get_terms($taxonomy, $args);
            $get_term_id = $terms[0]->term_id;
            $get_term_slug = $terms[0]->slug;
            $get_term_name = $terms[0]->name;

            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
        } elseif (is_day()) {

            // Day archive
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
        } elseif (is_month()) {

            // Month Archive
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
        } elseif (is_year()) {

            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
        } elseif (is_author()) {

            // Auhor archive
            // Get the author information
            global $author;
            $userdata = get_userdata($author);

            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
        } elseif (get_query_var('paged')) {

            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">' . __('Page') . ' ' . get_query_var('paged') . '</strong></li>';
        } elseif (is_search()) {

            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
        } elseif (is_404()) {

            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }

        echo '</ul>';
    }
}

/*Doctors Sort by surname*/
add_filter( 'manage_edit-doctors_sortable_columns', 'mh_sortable_doc_surname_columns' );
add_filter( 'manage_doctors_posts_columns', 'mh_sortable_doc_surname_columns' );
function mh_sortable_doc_surname_columns( $columns ) {
    $columns['doctor_lastname_sortorder'] = 'Doctor Last Name';
    return $columns;
}

function doctors_custom_column_values( $column, $post_id ) {
    switch ( $column ) {
        case 'doctor_lastname_sortorder'     :
            echo get_post_meta( $post_id , 'last_name' , true );
        break;
        default:
            break;
    }
}
add_action( 'manage_doctors_posts_custom_column' , 'doctors_custom_column_values', 10, 2 );


// admin login change code
// function mhealth_wp_admin_block(){
//     if ( !is_user_logged_in() && '/mhealthadmin'!==$_SERVER['REQUEST_URI'] && is_admin() ){
//         wp_redirect( home_url() );
//         exit;
//     }
// }
// add_action( 'init', 'mhealth_wp_admin_block' );

// function mhealth_wp_admin_block_1(){
//     if('/mhealthadmin'===$_SERVER['REQUEST_URI'] ){
//         setcookie( 'valid_admin_slug', 1, 0, "/");
//     }

//     if( '/mhealthadmin'!==$_SERVER['REQUEST_URI'] && !is_user_logged_in() && empty($_COOKIE['valid_admin_slug']) ){
//         wp_redirect( home_url() );
//         exit;
//     }
// }
// add_action( 'login_init', 'mhealth_wp_admin_block_1' );


//Pagination
function memorial_health_cstm_pagination($pages = '', $range = 10)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}




function order_search_by_posttype( $orderby, $wp_query ){

    global $wpdb;

    if( ! $wp_query->is_admin && $wp_query->is_search ) {

        $orderby =
            "
            CASE WHEN {$wpdb->prefix}posts.post_type = 'services' THEN '1'
                 WHEN {$wpdb->prefix}posts.post_type = 'locations' THEN '2'
                 WHEN {$wpdb->prefix}posts.post_type = 'doctors' THEN '3'
                 WHEN {$wpdb->prefix}posts.post_type = 'pages' THEN '4'
                 WHEN {$wpdb->prefix}posts.post_type = 'classes_events' THEN '5'
            ELSE {$wpdb->prefix}posts.post_type END ASC, 
            {$wpdb->prefix}posts.post_title ASC";

    }

    return $orderby;
}

add_filter( 'posts_orderby', 'order_search_by_posttype', 10, 2 );

//Custom
function custom_dsnew_pagination($pages = '', $range = 4)
    {
        $showitems = ($range * 2)+1;
        global $paged;
        if(empty($paged)) $paged = 1;

        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }

        }


        if(1 != $pages)
        {

            echo "<nav>";

            //if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";

            //if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";


            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages && (!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems) )
                {

                    if($i == $paged){
                        $class= "current";
                        $aria_current = 'aria-current="page"';
                    }
                    else{
                        $class= "";
                        $aria_current = '';
                    }

                    if($paged === $i && $i == 1){
                        echo '<span class="page-numbers '.$class.'" '.$aria_current.'>'.$i.'</span>';
                        echo '<span class="page-numbers dots">…</span>';
                        echo '<a class="next page-numbers custom_next_to" onclick="scroll_to_pagetop(event,this);" href="'.get_pagenum_link($i+1).'">Next <i class="fas fa-angle-right"></i></a>';
                        echo '<a class="next page-numbers cstm-last-link" onclick="scroll_to_pagetop(event,this);" href="'.get_pagenum_link($pages).'">Last <i class="fas fa-angle-right"></i></a>';
                    }
                    elseif($paged === $i && $i !== 1 && $i < $pages){
                        echo '<a class="prev page-numbers custom_prev_to" onclick="scroll_to_pagetop(event,this);" href="'.get_pagenum_link($i-1).'"><i class="fas fa-angle-left"></i> Prev</a>';
                        echo '<span class="page-numbers dots">…</span>';
                        echo '<span '.$aria_current.' class="page-numbers '.$class.'">'.$i.'</span>';
                        echo '<span class="page-numbers dots">…</span>';
                        echo '<a class="next page-numbers custom_next_to" onclick="scroll_to_pagetop(event,this);" href="'.get_pagenum_link($i+1).'">Next <i class="fas fa-angle-right"></i></a>';
                        echo '<a class="next page-numbers cstm-last-link" onclick="scroll_to_pagetop(event,this);" href="'.get_pagenum_link($pages).'">Last <i class="fas fa-angle-right"></i></a>';
                    }
                    elseif($paged == $i && $i == $pages){
                        echo '<a class="prev page-numbers custom_prev_to" onclick="scroll_to_pagetop(event,this);" href="'.get_pagenum_link($pages-1).'"><i class="fas fa-angle-left"></i> Prev</a>';
                        echo '<a class="page-numbers" onclick="scroll_to_pagetop(event,this);" href="'.get_pagenum_link(1).'">1</a>';
                        echo '<span class="page-numbers dots">…</span>';
                        echo '<a class="next page-numbers cstm-last-link '.$class.'" onclick="scroll_to_pagetop(event,this);" href="'.get_pagenum_link($pages).'">Last <i class="fas fa-angle-right"></i></a>';
                    }
                }


            }

            //if ($paged < $pages && $showitems < $pages) echo "<li class='page-item'><a class='page-link' href=\"".get_pagenum_link($paged + 1)."\">i class='flaticon flaticon-back'></i></a></li>";

            //if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo " <li class='page-item'><a class='page-link' href='".get_pagenum_link($pages)."'><i class='flaticon flaticon-arrow'></i></a></li>";

            echo "</nav>";
        }
  }