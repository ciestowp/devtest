  <?php


/* Enqueue Styles */

define('STYLESHEET_DIR', get_bloginfo('stylesheet_directory'));

/* Enqueue Styles */

add_action( 'wp_enqueue_scripts', 'whf_enqueue_stylesheets', 999 );
function whf_enqueue_stylesheets() {
  $base = get_stylesheet_directory_uri();
  wp_enqueue_script ( 'jquery-script', 'https://code.jquery.com/jquery-3.6.0.min.js');
  wp_enqueue_script ( 'custom-script', get_stylesheet_directory_uri() . '/js/custom.js' );

  wp_enqueue_style('main-styles', get_stylesheet_directory_uri() . '/style.css');
}

function ajax_form_scripts() {
	$translation_array = array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    );
    wp_localize_script( 'main', 'cpm_object', $translation_array );
}

add_action( 'wp_ajax_set_form', 'set_form' ); 
add_action( 'wp_enqueue_scripts', 'ajax_form_scripts' );
add_action( 'wp_ajax_nopriv_set_form', 'set_form');
function set_form(){
  print_r($_POST);
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$admin =get_option('admin_email');
	if(wp_mail($email, $name, $message)  &&  wp_mail($admin, $name, $message) )
       {
           echo "mail sent";
   } else {
          echo "mail not sent";
   }

	die();
  $new_post = array(
    'post_title'    => $name,
    'post_content'  => $message,
    'post_status'   => 'draft',           // Choose: publish, preview, future, draft, etc.
    'post_type' => 'ajaxform'  //'post',page' or use a custom post type if you want to
 );

}


// Add product gallery to shop page
add_action('woocommerce_shop_loop_item_title','wps_add_extra_product_thumbs', 5);
function wps_add_extra_product_thumbs() {
  if ( is_shop() ) {
    global $product;
    $attachment_ids = $product->get_gallery_attachment_ids();
    echo '<div class="product-thumbs">';
    foreach( array_slice( $attachment_ids, 0,3 ) as $attachment_id ) {
      $thumbnail_url = wp_get_attachment_image_src( $attachment_id, 'thumbnail' )[0];
      echo '<img class="thumb" src="' . $thumbnail_url . '" width="50">';
    }
    echo '</div>';
  }
}