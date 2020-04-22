<?php
/*
  Order Editor Addon for osC 2.3.4BS
	version 1.2.6 2019-09-29
	- table constants removed
	v1.2.5 Revisions to make lighter touch
	
	headers tags module saves shipping in session during checkout
	writes to order after payment
	
	Author: John Ferguson @BrockleyJohn john@sewebsites.net

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/

  class ht_record_order_shipping_module {
    var $code;
    var $group = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function __construct() {
      $this->code = get_class($this);
			$this->title = MODULE_HEADER_TAGS_ORDER_SHIPPING_TITLE;
      $this->description = MODULE_HEADER_TAGS_ORDER_SHIPPING_DESCRIPTION;

      if ( defined('MODULE_HEADER_TAGS_ORDER_SHIPPING_STATUS') ) {
        $this->sort_order = MODULE_HEADER_TAGS_ORDER_SHIPPING_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_ORDER_SHIPPING_STATUS == 'True');
      }
    }

    function execute() {
      global $PHP_SELF, $oscTemplate, $customer_id, $order_id, $shipping, $shipping_module;

      if ( tep_session_is_registered('customer_id') ) {
				switch ( basename($PHP_SELF) ) {
					case 'checkout_confirmation.php' :		
						if (!tep_session_is_registered('shipping_module')) tep_session_register('shipping_module');
						$shipping_module = $shipping['id'];
						break;
					case 'checkout_success.php' :		
						if ( tep_session_is_registered('shipping_module') ) {
							tep_session_unregister('shipping_module');
							$sql_data_array = array('shipping_module' => tep_db_input($shipping_module));
							tep_db_perform('orders',$sql_data_array,'update',"orders_id = '" . (int)$order_id . "'");
						}
				} // end switch page 
			} // endif customer_id registered
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_HEADER_TAGS_ORDER_SHIPPING_STATUS');
    }

    function install() {
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Order Shipping Module', 'MODULE_HEADER_TAGS_ORDER_SHIPPING_STATUS', 'True', 'Do you want to record shipping method against orders?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_ORDER_SHIPPING_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
			$db_query = tep_db_query('show columns from orders like "shipping_module"');
			if (!tep_db_num_rows($db_query)) {
			  tep_db_query('alter table orders add column shipping_module varchar(11) null default null');
			}
    }

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_HEADER_TAGS_ORDER_SHIPPING_STATUS', 'MODULE_HEADER_TAGS_ORDER_SHIPPING_SORT_ORDER');
    }
  }
	
?>
