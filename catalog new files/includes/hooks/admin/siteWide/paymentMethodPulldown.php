<?php
/*
  $Id$

  add edit orders to admin / orders.php
  
  pseudo hook doesn't hook anything!
	
	author: John Ferguson @BrockleyJohn oscommerce@sewebsites.net

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2019 SE Websites

  Released under the MIT License
  without warranty express or implied
*/

class hook_admin_siteWide_paymentMethodPulldown {

  function listen_injectSiteStart() {
    // don't need to do anything here
  }
    
}

if (! function_exists('tep_cfg_pull_down_payment_methods')) {
  // Get list of all payment modules available
  function tep_cfg_pull_down_payment_methods() {
    global $language;
    $enabled_payment = array();
    $module_directory = DIR_FS_CATALOG_MODULES . 'payment/';
    $file_extension = '.php';

    if ($dir = @dir($module_directory)) {
      while ($file = $dir->read()) {
        if (!is_dir( $module_directory . $file)) {
          if (substr($file, strrpos($file, '.')) == $file_extension) {
            $directory_array[] = $file;
          }
        }
      }
      sort($directory_array);
      $dir->close();
    }

    // For each available payment module, check if enabled
    for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
      $file = $directory_array[$i];

      include(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/payment/' . $file);
      include($module_directory . $file);

      $class = substr($file, 0, strrpos($file, '.'));
      if (tep_class_exists($class)) {
        $module = new $class;
        if ($module->check() > 0) {
          // If module enabled create array of titles
          $enabled_payment[] = array('id' => $module->title, 'text' => $module->title);

        }
      }
    }

    $enabled_payment[] = array('id' => 'Other', 'text' => 'Other');     

    //draw the dropdown menu for payment methods and default to the order value
    return tep_draw_pull_down_menu('configuration_value', $enabled_payment, '', ''); 
  }

}
