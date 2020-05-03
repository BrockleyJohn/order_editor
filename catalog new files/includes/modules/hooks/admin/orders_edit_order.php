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
                
                  $params = (defined('ORDER_EDITOR_EDIT_NEW_TAB') && ORDER_EDITOR_EDIT_NEW_TAB == 'false' ? null : array('newwindow' => true));
                  if (tep_get_version() >= '1.0.5.5') {
                    $button = tep_draw_bootstrap_button(IMAGE_EDIT, 'fas fa-cogs', tep_href_link('edit_orders.php', tep_get_all_get_params(['oID', 'action']) . 'oID=' . (int)$_GET['oID']), null, $params, 'btn-warning mr-2');
                    $script = '';
                  } else {
					$buttonscript = tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('edit_orders.php', 'oID=' . (int)$_GET['oID']), null, $params);
					$buttonbits = explode('<script type="text/javascript">',$buttonscript);
					$button = $buttonbits[0];
					$script = substr($buttonbits[1],0,0 - strlen('</script>'));
                  }
                
                  if (tep_get_version() >= '1.0.5.9') { 
                    
				  $output = <<<EOD
<script>
  $('#contentText .row:first .col.text-right').prepend('$button');
  $script
</script>
EOD;
                    
                  } else {
                    
				  $output = <<<EOD
<script>
  $('h1.pageHeading + div').prepend('$button');
  $script
</script>
EOD;
                  }
                break;

		  	case 'orderList' :
          if (isset($oInfo) && is_object($oInfo) && defined('ORDER_EDITOR_LIST_DIRECT_TO_EDITOR') && ORDER_EDITOR_LIST_DIRECT_TO_EDITOR == 'true') {
            $link = tep_href_link('edit_orders.php', 'oID=' . (int)$oInfo->orders_id);
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
