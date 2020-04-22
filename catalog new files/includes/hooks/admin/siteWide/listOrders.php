<?php
/*
  $Id$

  add edit orders to admin / orders.php
	
	author: John Ferguson @BrockleyJohn oscommerce@sewebsites.net

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2019 SE Websites

  Released under the MITc License
  without warranty express or implied
*/

class hook_admin_siteWide_listOrders {

  function listen_injectSiteEnd() {
    global $PHP_SELF, $oInfo;
    
    if (basename($PHP_SELF) == 'orders.php' && defined('ORDER_EDITOR_LIST_DIRECT_TO_EDITOR') && ORDER_EDITOR_LIST_DIRECT_TO_EDITOR == 'true') {
      if (isset($oInfo) && is_object($oInfo)) {
        $link = tep_href_link('edit_orders.php', 'oID=' . $oInfo->orders_id);
        return <<<EOD
<!-- order list hook -->
<script>
$(function() {
$('.infoBoxContent:first a:first').attr('href','$link');
});
</script>
EOD;
      }
      
    }
    
  }

}
