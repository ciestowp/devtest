<?php
/**
 * Industrial Lite: Block Patterns
 *
 * @package Industrial Lite
 * @since   1.0.0
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'industrial-lite',
		array( 'label' => __( 'Industrial Lite', 'industrial-lite' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	register_block_pattern(
		'industrial-lite/banner-section',
		array(
			'title'      => __( 'Banner Section', 'industrial-lite' ),
			'categories' => array( 'industrial-lite' ),
			'content'    => "<!-- wp:cover {\"url\":\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png\",\"id\":5864,\"dimRatio\":10,\"align\":\"full\",\"className\":\"banner-section\"} -->\n<div class=\"wp-block-cover alignfull has-background-dim-10 has-background-dim banner-section\" style=\"background-image:url(" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/banner.png)\"><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"verticalAlignment\":\"center\",\"align\":\"full\"} -->\n<div class=\"wp-block-columns alignfull are-vertically-aligned-center\"><!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"50%\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:50%\"><!-- wp:heading {\"textAlign\":\"left\",\"level\":1,\"style\":{\"color\":{\"text\":\"#002e5b\"}}} -->\n<h1 class=\"has-text-align-left has-text-color\" style=\"color:#002e5b\">We are World-Class Designers and Industrial Engineer</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#002e5b\"}}} -->\n<p class=\"has-text-color\" style=\"color:#002e5b\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"background\":\"#f7c02e\",\"text\":\"#002e5b\"}},\"className\":\"btn\"} -->\n<div class=\"wp-block-button btn\"><a class=\"wp-block-button__link has-text-color has-background no-border-radius\" style=\"background-color:#f7c02e;color:#002e5b\">READ MORE</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"verticalAlignment\":\"center\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\"></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);

	register_block_pattern(
		'industrial-lite/services-section',
		array(
			'title'      => __( 'Services Section', 'industrial-lite' ),
			'categories' => array( 'industrial-lite' ),
			'content'    => "<!-- wp:cover {\"overlayColor\":\"white\",\"align\":\"wide\",\"className\":\"article-outer-box\"} -->\n<div class=\"wp-block-cover alignwide has-white-background-color has-background-dim article-outer-box\"><div class=\"wp-block-cover__inner-container\"><!-- wp:heading {\"textAlign\":\"left\",\"style\":{\"color\":{\"text\":\"#002e5b\"}}} -->\n<h2 class=\"has-text-align-left has-text-color\" style=\"color:#002e5b\">SERVICES WE PROVIDE</h2>\n<!-- /wp:heading -->\n\n<!-- wp:columns {\"align\":\"wide\",\"className\":\"article-container\"} -->\n<div class=\"wp-block-columns alignwide article-container\"><!-- wp:column {\"className\":\"article-section\"} -->\n<div class=\"wp-block-column article-section\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"color\":{\"text\":\"#002e5b\"}}} -->\n<h3 class=\"has-text-align-center has-text-color\" style=\"color:#002e5b\">SERVICES TITLE 1</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#738297\"}}} -->\n<p class=\"has-text-align-center has-text-color\" style=\"color:#738297\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard. </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:image {\"id\":5877,\"sizeSlug\":\"large\",\"linkDestination\":\"media\",\"className\":\"img-services\"} -->\n<figure class=\"wp-block-image size-large img-services\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/services1.png\" alt=\"\" class=\"wp-image-5877\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"article-section\"} -->\n<div class=\"wp-block-column article-section\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"color\":{\"text\":\"#002e5b\"}}} -->\n<h3 class=\"has-text-align-center has-text-color\" style=\"color:#002e5b\">SERVICES TITLE 2</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#738297\"}}} -->\n<p class=\"has-text-align-center has-text-color\" style=\"color:#738297\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:image {\"id\":5881,\"sizeSlug\":\"large\",\"linkDestination\":\"media\",\"className\":\"img-services\"} -->\n<figure class=\"wp-block-image size-large img-services\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/services1.png\" alt=\"\" class=\"wp-image-5881\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"article-section\"} -->\n<div class=\"wp-block-column article-section\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"color\":{\"text\":\"#002e5b\"}}} -->\n<h3 class=\"has-text-align-center has-text-color\" style=\"color:#002e5b\">SERVICES TITLE 3</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#738297\"}}} -->\n<p class=\"has-text-align-center has-text-color\" style=\"color:#738297\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:image {\"id\":5882,\"sizeSlug\":\"large\",\"linkDestination\":\"media\",\"className\":\"img-services\"} -->\n<figure class=\"wp-block-image size-large img-services\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/services1.png\" alt=\"\" class=\"wp-image-5882\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"placeholder\":\"Write title\",\"fontSize\":\"large\"} -->\n<p class=\"has-text-align-center has-large-font-size\"></p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:cover -->",
		)
	);
}