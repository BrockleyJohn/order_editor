<?php
/*
  $Id$

  add edit orders to admin / orders.php
	
	author: John Ferguson @BrockleyJohn john@sewebsites.net

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2018 osCommerce

  Released under the GNU General Public License
*/

  class hook_admin_orders_edit_order {
		
		function load_language() {
		  global $language;
      include_once(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/hooks/admin/' . basename(__FILE__));
		}

    function execute($hook) {
      global $oInfo;
	//		$this->load_language();
			$output = '';

			switch ($hook) {

				case 'orderTab' :
					$buttonscript = tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('edit_orders.php', 'oID=' . $_GET['oID']), null, array('newwindow' => true));
					$buttonbits = explode('<script type="text/javascript">',$buttonscript);
					$button = $buttonbits[0];
					$script = substr($buttonbits[1],0,0 - strlen('</script>'));
					$output = <<<EOD
<script>
  $('h1.pageHeading + div').prepend('$button');
  $script
</script>
EOD;
                break;

		  	case 'orderList' :
          if (isset($oInfo) && is_object($oInfo) && defined('ORDER_EDITOR_LIST_DIRECT_TO_EDITOR') && ORDER_EDITOR_LIST_DIRECT_TO_EDITOR == 'true') {
            $link = tep_href_link('edit_orders.php', 'oID=' . $oInfo->orders_id);
            $output = <<<EOD
<script>
$(function() {
	$('.infoBoxContent:first a:first').attr('href','$link');
});
</script>
EOD;
					}
          break;
      }

      return $output;
    }

  } 
