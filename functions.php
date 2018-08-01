<?php
// Add scripts and stylesheets
function bootking_scripts() {

    wp_register_style ( 'blog', get_template_directory_uri() . '/css/blog.css' );
    wp_enqueue_style( 'blog');
    wp_register_style ( 'BootstrapCSS', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
    wp_enqueue_style( 'BootstrapCSS');

    wp_register_script( 'jQuery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', null, null, true );
    wp_enqueue_script('jQuery');
    wp_register_script( 'BootstrapJS', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', null, null, true );
    wp_enqueue_script('BootstrapJS');

}

add_action( 'wp_enqueue_scripts', 'bootking_scripts' );


// Add Google Fonts
function bootking_google_fonts() {
    wp_register_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700');
    wp_enqueue_style( 'OpenSans');
}

add_action('wp_print_styles', 'bootking_google_fonts');


// WordPress Titles
add_theme_support( 'title-tag' );


// Custom Settings
function custom_settings_add_menu() {
    add_menu_page( 'Theme Einstellungen', 'Theme Einstellungen', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );
}
add_action( 'admin_menu', 'custom_settings_add_menu' );

// Create Custom Global Settings
function custom_settings_page() { ?>
  <div class="wrap">
    <h1>Custom Settings</h1>
    <form method="post" action="options.php">
       <?php
           settings_fields( 'section' );
           do_settings_sections( 'theme-options' );      
           submit_button(); 
       ?>          
    </form>
  </div>
<?php }

// Twitter
function setting_twitter() { ?>
  <input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }

function custom_settings_page_setup() {
  add_settings_section( 'section', 'Alle Einstellungen', null, 'theme-options' );
  add_settings_field( 'twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section' );

  register_setting('section', 'twitter');
}
add_action( 'admin_init', 'custom_settings_page_setup' );