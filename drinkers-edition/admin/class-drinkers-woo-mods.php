<?php


class Drinkers_Edition_Woo_Mods {

	/** 
	 * Register new order status redeemed
	**/
	function register_deal_redeemed_order_status() {
	    register_post_status( 'wc-deal-redeemed', array(
	        'label'                     => 'Deal Redeemed',
	        'public'                    => true,
	        'exclude_from_search'       => false,
	        'show_in_admin_all_list'    => true,
	        'show_in_admin_status_list' => true,
	        'label_count'               => _n_noop( 'Deals Redeemed <span class="count">(%s)</span>', 'Deals Redeemed <span class="count">(%s)</span>' )
	    ) );
	}


	function add_deal_redeemed_to_order_statuses( $order_statuses ) {

	    $new_order_statuses = array();
	
	    // add new order status after processing
	    foreach ( $order_statuses as $key => $status ) {
	
	        $new_order_statuses[ $key ] = $status;
	
	        if ( 'wc-processing' === $key ) {
	            $new_order_statuses['wc-deal-redeemed'] = 'Deal Redeemed';
	        }
	    }
	
	    return $new_order_statuses;
	}


}