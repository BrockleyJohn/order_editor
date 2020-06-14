<?php
/*
  v2.0 April 2020 (COVID-19 lockdown) - rewrite as extension to catalog class
  @BrockleyJohn oscommerce@sewebsites.net
  
  *** You don't need to update this file in line with the catalog version
  *** unless you change the constructor

  $Id: order_total.php,v 1.0 200/05/13 00:04:53 djmonkey1 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
  
  order_total.php is a clone of the original order_total.php class file from the catalog side
  if you have modified the file catalog/includes/classes/order_total.php in any way
  you will have to modify this file as well in order for your order total modules to behave the same via Order Editor
  
*/

if (! class_exists('order_total')) {
  // no class so no autoloader, include category class from old location
  require_once(DIR_FS_CATALOG . 'includes/classes/order_total.php');
}

  class edit_order_total extends order_total {

// override class constructor for different location
    function __construct() {
      global $language;

      if (defined('MODULE_ORDER_TOTAL_INSTALLED') && tep_not_null(MODULE_ORDER_TOTAL_INSTALLED)) {
        $this->modules = explode(';', MODULE_ORDER_TOTAL_INSTALLED);

        foreach($this->modules as $value) {
          include(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/order_total/' . $value);
          include(DIR_FS_CATALOG_MODULES . 'order_total/' . $value);
		  
          $class = substr($value, 0, strrpos($value, '.'));
          $GLOBALS[$class] = new $class;
        }
      }
    }

  }
