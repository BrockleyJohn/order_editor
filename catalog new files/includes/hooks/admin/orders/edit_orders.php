<?php
/*
  add edit orders to admin / orders.php
	
	author: John Ferguson @BrockleyJohn phoenix@sewebsites.net

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  class hook_admin_orders_edit_orders {

    function listen_orderTab() {
      if ( !class_exists('hook_admin_orders_edit_order') ) {
        include(DIR_FS_CATALOG . 'includes/modules/hooks/admin/orders_edit_order.php');
      }

      $hook = new hook_admin_orders_edit_order();

      return $hook->execute('orderTab');
    }

    function listen_orderList() {
      if ( !class_exists('hook_admin_orders_edit_order') ) {
        include(DIR_FS_CATALOG . 'includes/modules/hooks/admin/orders_edit_order.php');
      }

      $hook = new hook_admin_orders_edit_order();

      return $hook->execute('orderList');
    }
  }
?>
