// Enable translation
function load_theme_textdomain( 'my_custom_theme', get_template_directory() . '/languages' );

// Add custom field to posts
function my_custom_theme_add_custom_field() {
  add_post_meta( get_the_ID(), 'my_custom_field', 'Custom Field Value', true );
}
add_action( 'init', 'my_custom_theme_add_custom_field' );