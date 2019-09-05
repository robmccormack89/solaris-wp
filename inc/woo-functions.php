<?php
/**
 * Woo functions
 *
 * @package RMcC_Uikit_Starter
 */

// if woocommerce is activated, do this stuff, or not
 if ( class_exists( 'WooCommerce' ) ) {

   function grd_remove_woocommerce_styles_scripts() {
   	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
   	remove_action( 'wp_enqueue_scripts', array( $GLOBALS['woocommerce'], 'frontend_scripts' ) );
   }
   define( 'WOOCOMMERCE_USE_CSS', false );
   add_action( 'init', 'grd_remove_woocommerce_styles_scripts', 99 );

   function woo_dequeue_select2() {

      if ( class_exists( 'woocommerce' ) ) {
          wp_dequeue_style( 'select2' );
          wp_deregister_style( 'select2' );
          wp_dequeue_script( 'selectWoo');
          wp_deregister_script('selectWoo');
      }
   }
   add_action( 'wp_enqueue_scripts', 'woo_dequeue_select2', 100 );


 } else {

   // you don't appear to have WooCommerce activated
 }

 remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );

// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
    $fields['billing']['billing_first_name']['class'] = array('uk-width-1-2');
    $fields['billing']['billing_last_name']['class'] = array('uk-width-1-2');
    $fields['billing']['billing_company']['class'] = array('uk-width-1-1');
    $fields['billing']['billing_address_1']['class'] = array('uk-width-1-1');
    $fields['billing']['billing_address_2']['class'] = array('uk-width-1-1');
    $fields['billing']['billing_city']['class'] = array('uk-width-1-1');
    $fields['billing']['billing_postcode']['class'] = array('uk-width-1-1');
    $fields['billing']['billing_country']['class'] = array('uk-width-1-1');
    $fields['billing']['billing_state']['class'] = array('uk-width-1-1');
    $fields['billing']['billing_email']['class'] = array('uk-width-1-2');
    $fields['billing']['billing_phone']['class'] = array('uk-width-1-2');

    $fields['billing']['billing_first_name']['placeholder'] = 'First Name';
    $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
    $fields['billing']['billing_company']['placeholder'] = 'Company';
    $fields['billing']['billing_address_1']['placeholder'] = 'Street Address';
    $fields['billing']['billing_address_2']['placeholder'] = 'Address Additional';
    $fields['billing']['billing_city']['placeholder'] = 'City / Town';
    $fields['billing']['billing_postcode']['placeholder'] = 'Postcode';
    $fields['billing']['billing_email']['placeholder'] = 'Email Address';
    $fields['billing']['billing_phone']['placeholder'] = 'Phone No.';

    return $fields;
}
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

add_filter('woocommerce_form_field_args','wc_form_field_args',10,3);

function wc_form_field_args( $args, $key, $value = null ) {

/*********************************************************************************************/
/** This is not meant to be here, but it serves as a reference of what is possible to be changed. **/

// $defaults = array(
//     'type'              => 'text',
//     'label'             => '',
//     'description'       => '',
//     'placeholder'       => '',
//     'maxlength'         => false,
//     'required'          => false,
//     'id'                => $key,
//     'class'             => array(),
//     'label_class'       => array(),
//     'input_class'       => array(),
//     'return'            => false,
//     'options'           => array(),
//     'custom_attributes' => array(),
//     'validate'          => array(),
//     'default'           => '',
// );
/*********************************************************************************************/

// Start field type switch case

switch ( $args['type'] ) {

    case "select" :  /* Targets all select input type elements, except the country and state select input types */
        $args['class'][] = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
        $args['input_class'] = array('uk-select');
        //$args['custom_attributes']['data-plugin'] = 'select2';
        $args['label_class'] = array('uk-form-label');
        // $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  ); // Add custom data attributes to the form input itself
    break;

    case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
        $args['class'][] = 'form-group single-country';
        $args['label_class'] = array('uk-form-label');
        $args['input_class'] = array('uk-select');
    break;

    case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
        $args['class'][] = 'form-group'; // Add class to the field's html element wrapper
        $args['input_class'] = array('uk-select');
        //$args['custom_attributes']['data-plugin'] = 'select2';
        $args['label_class'] = array('uk-form-label');
        $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  );
    break;


    case "password" :

    case "text" :
      $args['input_class'] = array('uk-input', 'uk-form-controls');
      $args['label_class'] = array('uk-form-label');
    break;


    case "email" :
      $args['input_class'] = array('uk-input');
      $args['label_class'] = array('uk-form-label');
    break;


    case "tel" :
      $args['input_class'] = array('uk-input');
      $args['label_class'] = array('uk-form-label');
    break;

    case "number" :
        $args['input_class'] = array('uk-input');
        $args['label_class'] = array('uk-form-label');
    break;

    case 'textarea' :
        $args['input_class'] = array('uk-textarea');
        $args['custom_attributes'] = array( 'rows' => '8'  );
        $args['label_class'] = array('uk-form-label');
    break;

    case 'checkbox' :
    break;

    case 'radio' :
    break;

    default :
        $args['class'][] = 'form-group';
        $args['input_class'] = array('form-control', 'input-lg');
        $args['label_class'] = array('control-label');
    break;
    }

    return $args;
}



add_filter( 'woocommerce_get_price_html', 'wpa83367_price_html', 100, 2 );
function wpa83367_price_html( $price, $product ){
    return '' . str_replace( '<del>', ' <del class="uk-text-meta">', $price );
}


add_filter( 'woocommerce_sale_flash', 'rmcc_onsale_html_to_badge' );
function rmcc_onsale_html_to_badge( $html ) {
return str_replace( __( 'onsale' ), __( 'uk-card-badge uk-label' ), $html );
}