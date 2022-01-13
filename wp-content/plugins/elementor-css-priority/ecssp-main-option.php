<?php
if ( ! defined( 'ABSPATH' ) ) exit;
add_settings_section("ecsspmain", __('','ecssp'), null, "ecssp-main");
add_settings_field("ecssp_headerpage_id", __('Select Elementor Templates','ecssp'), "eccsp_template_render", "ecssp-main", "ecsspmain");
register_setting("ecsspmain", "ecssp_headerpage_id");
function eccsp_template_render(){
	$page_arr = eccsp_get_all_template_ids();
	?><select id="ecssp_headerpage_id" name="ecssp_headerpage_id[]" multiple="multiple">
	<?php
	if( $page_arr ){
		foreach( $page_arr as $page_id => $pagename ){
			?><option value="<?php echo $page_id; ?>" <?php selected( in_array( $page_id, get_option( 'ecssp_headerpage_id' ) ),1 ); ?> ><?php echo $pagename; ?></option><?php
		}
	}
	?></select><?php
}