<?php

define("WP_ROOT", __DIR__);
define("DS", DIRECTORY_SEPARATOR);
require(dirname(__FILE__) . '/wp-load.php');

$args = array(
  'post_type' => 'shop_order',
 'posts_per_page' => '-1'
);
$query = new WC_Order_Query( $args );
$orders = $query->get_orders();

foreach($orders as $order)
{
	$parentOrderid = $order->ID;
	$ordercdate = $order->get_date_created();
	$order4mintimestart = date( 'Y-m-d H:i:s', strtotime( $ordercdate ) + 240 );
	
	$order4mintimeend = date( 'Y-m-d H:i:s', strtotime( $ordercdate ) + 300 );
	$orderctimestart = strtotime($order4mintimestart);
	$orderctimeend = strtotime($order4mintimeend);

	$nowtime = current_time( 'mysql' );
	//echo "<br>";
	$fnowtime = strtotime($nowtime);
	if($fnowtime >= $orderctimestart && $fnowtime <= $orderctimeend){
		$original_order = new WC_Order($parentOrderid);
		//1 Create Order
		$order_data =  array(
			'post_type'     => 'shop_order',
			'post_title'    => sprintf( __( 'Auto-Ship Order &ndash; %s', 'woocommerce' ), strftime( _x( '%b %d, %Y @ %I:%M %p', 'Order date parsed by strftime', 'woocommerce' ) ) ),
			'post_status'   => 'publish',
			'ping_status'   => 'closed',
			'post_excerpt'  => 'Auto-Ship Order based on original order ' . $original_order_id,
			'post_password' => uniqid( 'order_' )   // Protects the post just in case
		);

		$order_id = wp_insert_post( $order_data, true );

		if ( is_wp_error( $order_id ) ){
			$msg = "Unable to create order:" . $order_id->get_error_message();;
			throw new Exception( $msg );
		} else {

			$order = new WC_Order($order_id);
			update_post_meta($order_id, 'parent_id', $parentOrderid);
			
			$userid = get_post_meta( $parentOrderid, '_customer_user', true );
			If($userid)
			{
				update_post_meta( $order_id, '_customer_user', $userid);
			}
			
			//2 Update Order Header

			update_post_meta( $order_id, '_order_shipping',         get_post_meta($original_order_id, '_order_shipping', true) );
			update_post_meta( $order_id, '_order_discount',         get_post_meta($original_order_id, '_order_discount', true) );
			update_post_meta( $order_id, '_cart_discount',          get_post_meta($original_order_id, '_cart_discount', true) );
			update_post_meta( $order_id, '_order_tax',              get_post_meta($original_order_id, '_order_tax', true) );
			update_post_meta( $order_id, '_order_shipping_tax',     get_post_meta($original_order_id, '_order_shipping_tax', true) );
			update_post_meta( $order_id, '_order_total',            get_post_meta($original_order_id, '_order_total', true) );

			update_post_meta( $order_id, '_order_key',              'wc_' . apply_filters('woocommerce_generate_order_key', uniqid('order_') ) );
			update_post_meta( $order_id, '_customer_user',          get_post_meta($original_order_id, '_customer_user', true) );
			update_post_meta( $order_id, '_order_currency',         get_post_meta($original_order_id, '_order_currency', true) );
			update_post_meta( $order_id, '_prices_include_tax',     get_post_meta($original_order_id, '_prices_include_tax', true) );
			update_post_meta( $order_id, '_customer_ip_address',    get_post_meta($original_order_id, '_customer_ip_address', true) );
			update_post_meta( $order_id, '_customer_user_agent',    get_post_meta($original_order_id, '_customer_user_agent', true) );

		   

			//3 Add Billing Fields

			update_post_meta( $order_id, '_billing_city',           get_post_meta($original_order_id, '_billing_city', true));
			update_post_meta( $order_id, '_billing_state',          get_post_meta($original_order_id, '_billing_state', true));
			update_post_meta( $order_id, '_billing_postcode',       get_post_meta($original_order_id, '_billing_postcode', true));
			update_post_meta( $order_id, '_billing_email',          get_post_meta($original_order_id, '_billing_email', true));
			update_post_meta( $order_id, '_billing_phone',          get_post_meta($original_order_id, '_billing_phone', true));
			update_post_meta( $order_id, '_billing_address_1',      get_post_meta($original_order_id, '_billing_address_1', true));
			update_post_meta( $order_id, '_billing_address_2',      get_post_meta($original_order_id, '_billing_address_2', true));
			update_post_meta( $order_id, '_billing_country',        get_post_meta($original_order_id, '_billing_country', true));
			update_post_meta( $order_id, '_billing_first_name',     get_post_meta($original_order_id, '_billing_first_name', true));
			update_post_meta( $order_id, '_billing_last_name',      get_post_meta($original_order_id, '_billing_last_name', true));
			update_post_meta( $order_id, '_billing_company',        get_post_meta($original_order_id, '_billing_company', true));

			
				

			update_post_meta( $order_id, '_shipping_country',       get_post_meta($original_order_id, '_shipping_country', true));
			update_post_meta( $order_id, '_shipping_first_name',    get_post_meta($original_order_id, '_shipping_first_name', true));
			update_post_meta( $order_id, '_shipping_last_name',     get_post_meta($original_order_id, '_shipping_last_name', true));
			update_post_meta( $order_id, '_shipping_company',       get_post_meta($original_order_id, '_shipping_company', true));
			update_post_meta( $order_id, '_shipping_address_1',     get_post_meta($original_order_id, '_shipping_address_1', true));
			update_post_meta( $order_id, '_shipping_address_2',     get_post_meta($original_order_id, '_shipping_address_2', true));
			update_post_meta( $order_id, '_shipping_city',          get_post_meta($original_order_id, '_shipping_city', true));
			update_post_meta( $order_id, '_shipping_state',         get_post_meta($original_order_id, '_shipping_state', true));
			update_post_meta( $order_id, '_shipping_postcode',      get_post_meta($original_order_id, '_shipping_postcode', true));


		   

			foreach($original_order->get_items() as $originalOrderItem){

				$itemName = $originalOrderItem['name'];
				$qty = $originalOrderItem['qty'];
				$lineTotal = $originalOrderItem['line_total'];
				$lineTax = $originalOrderItem['line_tax'];
				$productID = $originalOrderItem['product_id'];

				$item_id = wc_add_order_item( $order_id, array(
					'order_item_name'       => $itemName,
					'order_item_type'       => 'line_item'
				) );

				wc_add_order_item_meta( $item_id, '_qty', $qty );
				//wc_add_order_item_meta( $item_id, '_tax_class', $_product->get_tax_class() );
				wc_add_order_item_meta( $item_id, '_product_id', $productID );
				//wc_add_order_item_meta( $item_id, '_variation_id', $values['variation_id'] );
				wc_add_order_item_meta( $item_id, '_line_subtotal', wc_format_decimal( $lineTotal ) );
				wc_add_order_item_meta( $item_id, '_line_total', wc_format_decimal( $lineTotal ) );
				wc_add_order_item_meta( $item_id, '_line_tax', wc_format_decimal( '0' ) );
				wc_add_order_item_meta( $item_id, '_line_subtotal_tax', wc_format_decimal( '0' ) );

			}

		   

			//6 Copy shipping items and shipping item meta from original order
			$original_order_shipping_items = $original_order->get_items('shipping');
		   
			foreach ( $original_order_shipping_items as $original_order_shipping_item ) {

				$item_id = wc_add_order_item( $order_id, array(
					'order_item_name'       => $original_order_shipping_item['name'],
					'order_item_type'       => 'shipping'
				) );

				if ( $item_id ) {
					wc_add_order_item_meta( $item_id, 'method_id', $original_order_shipping_item['method_id'] );
					wc_add_order_item_meta( $item_id, 'cost', wc_format_decimal( $original_order_shipping_item['cost'] ) );
				}

			}

		   

			// Store coupons
			$original_order_coupons = $original_order->get_items('coupon');
			foreach ( $original_order_coupons as $original_order_coupon ) {
				$item_id = wc_add_order_item( $order_id, array(
					'order_item_name'       => $original_order_coupon['name'],
					'order_item_type'       => 'coupon'
				) );
				// Add line item meta
				if ( $item_id ) {
					wc_add_order_item_meta( $item_id, 'discount_amount', $original_order_coupon['discount_amount'] );
				}
			}

		   

			//Payment Info
			update_post_meta( $order_id, '_payment_method',         get_post_meta($original_order_id, '_payment_method', true) );
			update_post_meta( $order_id, '_payment_method_title',   get_post_meta($original_order_id, '_payment_method_title', true) );
			update_post_meta( $order->id, 'Transaction ID',         get_post_meta($original_order_id, 'Transaction ID', true) );
			$order->payment_complete();

		 

			//6 Set Order Status to processing to trigger initial emails to end user and vendor
			$updateNote = "This Auto-Ship order was created by SAP Commerce Engine, per PayPal payment installment.";
			$order->update_status('processing');
			$order->add_order_note($updateNote);

		   
		}
	}
}


    

   

    







?>