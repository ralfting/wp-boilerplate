<?php

require_once get_template_directory() . '/dependencies/plugins.php';

function remove_menu_pages()
{

    global $user_ID;

    if (get_current_user_id() == 2) {
        remove_menu_page('edit-comments.php');
        remove_menu_page('plugins.php');
        remove_menu_page('customize.php?return=%2Fwp-admin%2Fadmin.php%3Fpage%3Dfeatures');
        remove_menu_page('theme-editor.php');
        remove_menu_page('options-general.php');
        remove_menu_page('edit.php?post_type=acf-field-group');

        // remove_menu_page('themes.php');
        remove_menu_page('users.php');
        remove_menu_page('tools.php');
    }
}

if (function_exists('acf_add_options_page')) {
    $features = array(
        'page_title' => 'Destaques',
        'menu_slug' => 'features',
        'position' => 8,
    );

    acf_add_options_page($features);

    $banneers = array(

        'page_title' => 'Banners',

        'menu_slug' => 'banners',

        'position' => 8,

    );

    acf_add_options_page($banneers);
}

/**
 * @param $postType
 * @param $key
 * @param $value
 * @param $limit
 */
function get_posts_by_custom_field($postType, $key, $value, $limit = -1)
{
    $args = array(
        'numberposts' => $limit,
        'post_type' => $postType,
        'meta_key' => $key,
        'meta_value' => $value,
    );

    return new WP_Query($args);
}

function remove_dashboard_widgets()
{

    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('icl_dashboard_widget', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_action('welcome_panel', 'wp_welcome_panel');
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

/**
 * @param  $post_id
 * @return mixed
 */
function get_theme_excerpt($post_id)
{
    global $post;
    $save_post = $post;
    $post = get_post($post_id);
    $output = get_the_excerpt();
    $post = $save_post;
    return $output;
}

/**
 *    Add menu support for the theme
 *
 */
function moviment_theme_setup()
{
    register_nav_menu('primary', 'Menu Principal');

    add_theme_support('post-thumbnails');
}

add_action('init', 'moviment_theme_setup');

/**
 * Get all plugins and install dynamically
 * @return array
 */
function get_all_plugins_and_install()
{
    $plugins = array();

    foreach (scandir(get_template_directory() . "/plugins/") as $file) {
        if ($file != ".DS_Store" && $file != ".." && $file != ".") {
            $names = ucwords(str_replace('-', ' ', substr($file, 0, -4)));
            $sources = get_template_directory_uri() . "/plugins/" . $file;
            $slugs = str_replace('.zip', '', $file);
            $plugins[] = array(
                'name' => $names,
                'slug' => $slugs,
                'source' => $sources,
                'required' => true,
                'force_activation' => true,
                'force_deactivation' => false,
                'version' => '',
            );
        }
    }

    return $plugins;
}

/**
 *     Get taxonomy of an custom post type
 *     ex: get_taxonomy_post_type('categoria');
 *
 */
function get_taxonomy_post_type($taxonomie, $level = 0)
{
    $show_count = 0;
    $pad_counts = 0;
    $hierarchical = 1;
    $taxonomy = $taxonomie;
    $title = '';

    $args = array(
        'show_count' => $show_count,
        'pad_counts' => $pad_counts,
        'hierarchical' => $hierarchical,
        'taxonomy' => $taxonomy,
        'title_li' => $title,
        'parent' => $level,
    );

    return get_categories($args);
}

/**
 * @param  $type
 * @param  $taxonomy
 * @param  $id
 * @return mixed
 */
function get_posts_of_taxonomy($type, $taxonomy, $id)
{
    $args = array('post_type' => $type, 'order' => 'ASC', 'orderby' => 'date', 'posts_per_page' => '-1',
        'tax_query' => array(array('taxonomy' => $taxonomy, 'field' => 'id', 'terms' => $id)));

    $query = new WP_Query($args);

    $post_type = $query->get_posts();

    return $post_type;
}

/**
 * Get all posts of an custom post type
 * @return array
 */
function get_custom_post_type($type, $limit, $order = 'DESC', $orderby = 'date', $notIn = null)
{

    if (is_null($notIn)) {
        $args = array('post_type' => $type, 'order' => $order, 'orderby' => $orderby, 'posts_per_page' => $limit);
    } else {
        $args = array('post_type' => $type, 'order' => $order, 'orderby' => $orderby, 'posts_per_page' => $limit, 'post__not_in' => $notIn);
    }

    $query = new WP_Query($args);

    $post_type = $query->get_posts();

    return $post_type;
}

/**
 * Add custom image sizes (width, height, crop)
 * @return void
 */
add_image_size('gallery-thumbnail', 400, 400, true);

add_image_size('gallery-width', 400);

add_image_size('gallery-height', 9999, 400);

remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

add_action('admin_init', 'remove_menu_pages');

function insert_news($email)
{
    wp_insert_post(['post_title' => $email, 'post_type' => 'mailist', 'post_status' => 'publish']);
}
