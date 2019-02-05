<?php
/**
 * Enqueue scripts and styles
 */
function books_catalog__enqueue_scripts() {
    // all styles
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), '05022019' );
    wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/style.css', array(), '05022019' );
    // all scripts
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '05022019', true );
    wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '05022019', true );
}
add_action( 'wp_enqueue_scripts', 'books_catalog__enqueue_scripts' );

/**
 * Register book post type
 */
function book_post_type() {

    $labels = array(
        'name'                  => _x( 'Книги', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Книга', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Книги', 'text_domain' ),
        'name_admin_bar'        => __( 'Книга', 'text_domain' ),
        'all_items'             => __( 'Все книги', 'text_domain' ),
        'add_new_item'          => __( 'Добавить книгу', 'text_domain' ),
        'add_new'               => __( 'Добавить книгу', 'text_domain' ),
        'new_item'              => __( 'Новая книга', 'text_domain' ),
        'edit_item'             => __( 'Редактировать', 'text_domain' ),
        'items_list'            => __( 'Список книг', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Книга', 'text_domain' ),
        'description'           => __( 'Книга', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor' ),
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-book'
    );
    register_post_type( 'book', $args );

}
add_action( 'init', 'book_post_type', 0 );

/**
 * Add book with AJAX form
 */
function add_book_ajax(){

    $book = array(
        'post_type'     => 'book',
        'post_title'    => $_POST['book_title'],
        'post_content'  => $_POST['book_description'],
        'post_status'   => 'draft',
    );

    // Insert the book into the database
    $post_id = wp_insert_post( $book );
    if( !is_wp_error($post_id) ){
        echo '<div class="text-center">Книга успешно добавлена и будет опубликована после проверки модератором</div>';
    } else {
        echo $post_id->get_error_message();
    }
    die();
}

add_action('wp_ajax_nopriv_add_book_ajax', 'add_book_ajax' );
add_action('wp_ajax_add_book_ajax', 'add_book_ajax' );