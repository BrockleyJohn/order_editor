<?php
/*
  $Id: cart.php v5.0 07/19/2007 djmonkey1 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  class manualCart {
    var $contents, $total, $weight;

    function __construct() {
      $this->reset();
	}
	
    function restore_contents($orders_id) {
      $this->reset();

      $products_query = tep_db_query("select products_id, products_quantity, orders_products_id from orders_products where orders_id = '" . (int)$orders_id . "'");
      while ($products = tep_db_fetch_array($products_query)) {
        $prod_array = array('qty' => $products['products_quantity']);

        $subindex = 0;
        $att_array = [];
        $attributes_query = tep_db_query("select products_options, products_options_values, options_values_price, price_prefix from orders_products_attributes where orders_id = '" . (int)$orders_id . "' and orders_products_id = '" . (int)$products['orders_products_id'] . "'");
        if (tep_db_num_rows($attributes_query)) {
          while ($attributes = tep_db_fetch_array($attributes_query)) {
            $option_id = sew_get_products_options_id($attributes['products_options']);
            $value_id = sew_get_products_options_values_id($option_id,$attributes['products_options_values'],0,$products['products_id']);
            $att_array[$option_id] = $value_id;

            $subindex++;
          }
          $prod_array['attributes'] = $att_array;
        }
        $prod_id = tep_get_uprid($products['products_id'], $att_array);
        if (! array_key_exists($prod_id, $this->contents)) {
          $this->contents[$prod_id] = $prod_array;
        } else {
          $this->contents[$prod_id]['qty'] += $prod_array['qty'];
        }
/*        $index++;
      }
    }


        $attributes_query = tep_db_query("select orders_products_attributes_id, products_options, products_options_values from orders_products_attributes where orders_id = '" . (int)$orders_id . "' and orders_products_id = '" . $products['products_id'] . "'");
        while ($attributes = tep_db_fetch_array($attributes_query)) {
          $this->contents[$products['products_id']]['attributes'][$attributes['orders_products_attributes_id']] = $attributes['orders_products_attributes_id'];
        }
*/
      }
    }

    function reset() {
      $this->contents = array();
      $this->total = 0;
    }

    function count_contents() {  // get total number of items in cart 
        $total_items = 0;
        if (is_array($this->contents)) {
            foreach(array_keys($this->contents) as $products_id) {
                $total_items += $this->get_quantity($products_id);
            }
        }
        return $total_items;
    }

    function get_quantity($products_id) {
      if ($this->contents[$products_id]) {
        return $this->contents[$products_id]['qty'];
      } else {
        return 0;
      }
    }

    function in_cart($products_id) {
      if ($this->contents[$products_id]) {
        return true;
      } else {
        return false;
      }
    }

    function remove_all() {
      $this->reset();
    }

    function get_product_id_list() {
      $product_id_list = '';
      if (is_array($this->contents))
      {
        foreach(array_keys($this->contents) as $products_id) {
          $product_id_list .= ', ' . $products_id;
        }
      }
      return substr($product_id_list, 2);
    }

    function calculate() {
      $this->total = 0;
      $this->weight = 0;
      if (!is_array($this->contents)) return 0;

      foreach(array_keys($this->contents) as $products_id) {
        $qty = $this->contents[$products_id]['qty'];

// products price
        $product_query = tep_db_query("select products_id, products_price, products_tax_class_id, products_weight from products where products_id='" . (int)($products_id) . "'");
        if ($product = tep_db_fetch_array($product_query)) {
          $prid = $product['products_id'];
          $products_tax = tep_get_tax_rate($product['products_tax_class_id']);
          $products_price = $product['products_price'];
          $products_weight = $product['products_weight'];

          $specials_query = tep_db_query("select specials_new_products_price from specials where products_id = '" . $prid . "' and status = '1'");
          if (tep_db_num_rows ($specials_query)) {
            $specials = tep_db_fetch_array($specials_query);
            $products_price = $specials['specials_new_products_price'];
          }

          $this->total += tep_add_tax($products_price, $products_tax) * $qty;
          $this->weight += ($qty * $products_weight);
        }

// attributes price
        if (isset($this->contents[$products_id]['attributes'])) {
		  foreach ($this->contents[$products_id]['attributes'] as $option => $value) {
            $attribute_price_query = tep_db_query("select options_values_price, price_prefix from products_attributes where products_id = '" . (int)$prid . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
            $attribute_price = tep_db_fetch_array($attribute_price_query);
            if ($attribute_price['price_prefix'] == '+') {
              $this->total += $qty * tep_add_tax($attribute_price['options_values_price'], $products_tax);
            } else {
              $this->total -= $qty * tep_add_tax($attribute_price['options_values_price'], $products_tax);
            }
          }
        }
      }
    }

    function attributes_price($products_id) {
      if ($this->contents[$products_id]['attributes']) {
        foreach(array_keys($this->contents) as $products_id) {
          $attribute_price_query = tep_db_query("select options_values_price, price_prefix from products_attributes where products_id = '" . $products_id . "' and options_id = '" . $option . "' and options_values_id = '" . $value . "'");
          $attribute_price = tep_db_fetch_array($attribute_price_query);
          if ($attribute_price['price_prefix'] == '+') {
            $attributes_price += $attribute_price['options_values_price'];
          } else {
            $attributes_price -= $attribute_price['options_values_price'];
          }
        }
      }

      return $attributes_price;
    }

    function get_products() {
      global $languages_id;

      if (!is_array($this->contents)) return 0;
      $products_array = array();
      foreach(array_keys($this->contents) as $products_id) {
        $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_model, p.products_price, p.products_weight, p.products_tax_class_id from products p, products_description pd where p.products_id='" . tep_get_prid($products_id) . "' and pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "'");
        if ($products = tep_db_fetch_array($products_query)) {
          $prid = $products['products_id'];
          $products_price = $products['products_price'];

          $specials_query = tep_db_query("select specials_new_products_price from specials where products_id = '" . $prid . "' and status = '1'");
          if (tep_db_num_rows($specials_query)) {
            $specials = tep_db_fetch_array($specials_query);
            $products_price = $specials['specials_new_products_price'];
          }

          $products_array[] = array('id' => $products_id,
                                    'name' => $products['products_name'],
                                    'model' => $products['products_model'],
                                    'price' => $products_price,
                                    'quantity' => $this->contents[$products_id]['qty'],
                                    'weight' => $products['products_weight'],
                                    'final_price' => ($products_price + $this->attributes_price($products_id)),
                                    'tax_class_id' => $products['products_tax_class_id'],
                                    'attributes' => $this->contents[$products_id]['attributes']);
        }
      }
      return $products_array;
    }

    function get_content_type() {
      $this->content_type = false;

      if ( (DOWNLOAD_ENABLED == 'true') && ($this->count_contents() > 0) ) {
        foreach(array_keys($this->contents) as $products_id) {
          if (isset($this->contents[$products_id]['attributes'])) {
            foreach($this->contents[$products_id]['attributes'] as $option => $value) {
              $virtual_check_query = tep_db_query("select count(*) as total from products_attributes pa, products_attributes_download pad where pa.products_id = '" . (int)$products_id . "' and pa.options_values_id = '" . (int)$value . "' and pa.products_attributes_id = pad.products_attributes_id");
              $virtual_check = tep_db_fetch_array($virtual_check_query);

              if ($virtual_check['total'] > 0) {
                switch ($this->content_type) {
                  case 'physical':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'virtual';
                    break;
                }
              } else {
                switch ($this->content_type) {
                  case 'virtual':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'physical';
                    break;
                }
              }
            }
          } else {
            switch ($this->content_type) {
              case 'virtual':
                $this->content_type = 'mixed';

                return $this->content_type;
                break;
              default:
                $this->content_type = 'physical';
                break;
            }
          }
        }
      } else {
        $this->content_type = 'physical';
      }

      return $this->content_type;
    }

    function show_total() {
      $this->calculate();

      return $this->total;
    }

    function show_weight() {
      $this->calculate();

      return $this->weight;
    }

    function dist_allowed() {      
      $allowed = true;     
      if (is_array($this->contents)) {        
        foreach(array_keys($this->contents) as $products_id) {
          $distributor_query = tep_db_query("select distributors_id from products where products_id = '" . (int)$products_id . "'");
          $distributor = tep_db_fetch_array($distributor_query);
        
          if ($distributor['distributors_id'] == '1') {	    
            $allowed = false;	    
            break;	  
          }       
        }     
      }      
    
      return $allowed;    
    }
 
    function unserialize($broken) {
	  foreach($broken as $kv) {
        $key=$kv['key'];
        if (gettype($this->$key)!="user function")
        $this->$key=$kv['value'];
      }
    }

  }
?>