<?php
/*
	Plugin Name: Elementor Css Priority
	Plugin URI: https://ciestosolutions.com/
	description: Select header page for elementor css priority change
	Version: 0.2.1
	Author: ciestosolutions
	Author URI: https://ciestosolutions.com/
	Text Domain: ecssp
*/
//Define Plugin pathinfo
define( 'ECSSP_PATH', plugin_dir_url( __FILE__ ) );
define( 'ECSSP_ABS_PATH', plugin_dir_path( __FILE__ ) );
define( 'ECSSP_VER', '0.1' );
add_action("admin_menu", "wpecssp_menu_cb");
function wpecssp_menu_cb(){
	$menu = add_menu_page( __('Elem. Css Priority','ecssp'), __('Elem. Css Priority','ecssp'), 'manage_options', 'e-cssp', 'wp_ecssp_cb', 'dashicons-editor-ul' );
	function wp_ecssp_cb(){
		?>
		<div class="wrap">
			<h1><?php _e( 'Elementor Css Priority', 'ecssp' ); ?></h1>
			<form action='options.php' method='post'>
				<?php
				settings_fields("ecsspmain");
				do_settings_sections("ecssp-main");
				submit_button();
				?>
			</form>
		</div>
		<?php
	}	
}
//select2 library including
add_action('admin_enqueue_scripts', 'select2_lib_incluing',10,1);
function select2_lib_incluing( $hook_suffix ){
	if( $hook_suffix == 'toplevel_page_e-cssp' ){
		wp_enqueue_style( 'select2-css', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css');
		wp_enqueue_script( 'select2-js', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js');
	}
}
add_action('admin_init','wpecssp_main_option_page_cb');
function wpecssp_main_option_page_cb(){
	include ECSSP_ABS_PATH.'ecssp-main-option.php';
}
if( !function_exists('eccsp_get_all_template_ids') ){
	function eccsp_get_all_template_ids(){
		$page_list = array();
		$page_ids = array();
		$templ_args = array(
			'post_type'			=>	'elementor_library',
			'posts_per_page'	=>	-1,
			'fields'			=>	'ids',
			'post_status'		=>	'publish',
		);
		$elem_templates = new WP_Query( $templ_args );
		if( !empty($elem_templates->posts) ){
			$page_ids = $elem_templates->posts;
		}
		if( !empty( $page_ids ) ){
			foreach($page_ids as $page){
				$page_list[$page] = get_the_title( $page);
			}
		}
		return $page_list;
	}
}
add_action( 'wp_enqueue_scripts', 'ecssp_elementor_css_in_head' );
function ecssp_elementor_css_in_head(){
	$tmpl_elementor_id = get_option( 'ecssp_headerpage_id' );
	if( is_array( $tmpl_elementor_id ) && !empty( $tmpl_elementor_id ) ){
		if(class_exists('\Elementor\Plugin')){
			$elementor =  \Elementor\Plugin::instance();
			$elementor->frontend->enqueue_styles();
		}
		if(class_exists('\ElementorPro\Plugin')){
			$elementor =  \ElementorPro\Plugin::instance();
			$elementor->enqueue_styles();
		}
		foreach( $tmpl_elementor_id as $tmplElemId ){
			if(class_exists('\Elementor\Core\Files\CSS\Post')){
				$css_file = new \Elementor\Core\Files\CSS\Post( $tmplElemId );
				$css_file->enqueue();
			}
		}
	}
}
add_action('admin_footer-toplevel_page_e-cssp','select2_selection_initialization_script');
function select2_selection_initialization_script(){
	?>
	<script>
	jQuery(document).ready(function($){
		if( jQuery('#ecssp_headerpage_id').length > 0 ){			
			jQuery('#ecssp_headerpage_id').select2();
		}
	});
	</script>
	<?php
}
add_action('admin_head','select2_selection_style');
function select2_selection_style(){
	?><style>.toplevel_page_e-cssp .select2-container{ width:50% !important; }</style><?php
}
//disable elementor updates
add_filter( 'site_transient_update_plugins', 'ecssp_filter_plugin_updates_specific_mod',15 );
function ecssp_filter_plugin_updates_specific_mod( $value ){
	if( isset( $value->response['elementor/elementor.php'] ) ){		
		unset( $value->response['elementor/elementor.php'] );
	}
	if( isset( $value->response['elementor-pro/elementor-pro.php'] ) ){		
		unset( $value->response['elementor-pro/elementor-pro.php'] );
	}
    return $value;
}
//hide all notice
add_action('admin_print_scripts', 'ecssp_remove_admin_notices'); // Remove Notice
function ecssp_remove_admin_notices(){
    global $wp_filter;
    if (is_user_admin()) {
        if (isset($wp_filter['user_admin_notices'])) {
            unset($wp_filter['user_admin_notices']);
        }
    } elseif (isset($wp_filter['admin_notices'])) {
        unset($wp_filter['admin_notices']);
    }
    if (isset($wp_filter['all_admin_notices'])) {
        unset($wp_filter['all_admin_notices']);
    }
}