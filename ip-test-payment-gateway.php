<?php
/**
 * Plugin Name: IP Test Payment Gateway
 * Plugin URI: https://www.inverseparadox.com
 * Description: A simple WooCommerce payment gateway for testing purposes that supports subscriptions.
 * Version: 1.1.1
 * Author: Inverse Paradox
 * Author URI: https://www.inverseparadox.com
 * Text Domain: ip-test-gateway
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Initialize the payment gateway only after WooCommerce has fully loaded.
 */
function ip_init_test_payment_gateway() {
    // Check if WooCommerce is active and the WC_Payment_Gateway class exists.
    if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
        return;
    }

    class IP_Test_Payment_Gateway extends WC_Payment_Gateway {
        /**
         * Constructor for the gateway.
         */
        public function __construct() {
            $this->id                 = 'iptestpay'; // payment gateway ID.
            $this->icon               = ''; // URL of the icon for this gateway.
            $this->has_fields         = false; // No additional payment fields.
            $this->method_title       = __( 'IP Test Payment Gateway', 'ip-test-gateway' );
            $this->method_description = __( 'A simple payment gateway for testing WooCommerce subscriptions.', 'ip-test-gateway' );

            // Load the settings.
            $this->init_form_fields();
            $this->init_settings();

            // Define user settings.
            $this->title              = $this->get_option( 'title' );
            $this->description        = $this->get_option( 'description' );
            $this->enabled            = $this->get_option( 'enabled' );
            $this->supports           = array( 
                'subscriptions', 
                'products', 
                'subscription_reactivation',
                'subscription_suspension',
                'subscription_cancellation',
                'gateway_scheduled_payments',
                'subscription_date_changes',
                'subscription_amount_changes',
            );

            // Hook into WooCommerce subscriptions.
            add_action( 'woocommerce_subscription_payment_method_updated_to_' . $this->id, array( $this, 'update_subscription_payment_method' ), 10, 2 );

            // Save settings.
            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
        }

        /**
         * Initialize gateway settings form fields.
         */
        public function init_form_fields() {
            $this->form_fields = array(
                'enabled' => array(
                    'title'       => __( 'Enable/Disable', 'ip-test-gateway' ),
                    'type'        => 'checkbox',
                    'label'       => __( 'Enable IP Test Payment Gateway', 'ip-test-gateway' ),
                    'default'     => 'yes',
                ),
                'title' => array(
                    'title'       => __( 'Title', 'ip-test-gateway' ),
                    'type'        => 'text',
                    'description' => __( 'Title that the user sees during checkout.', 'ip-test-gateway' ),
                    'default'     => __( 'IP Test Payment Gateway', 'ip-test-gateway' ),
                    'desc_tip'    => true,
                ),
                'description' => array(
                    'title'       => __( 'Description', 'ip-test-gateway' ),
                    'type'        => 'textarea',
                    'description' => __( 'Description the user sees during checkout.', 'ip-test-gateway' ),
                    'default'     => __( 'Simulate payment using the test payment gateway.', 'ip-test-gateway' ),
                    'desc_tip'    => true,
                ),
            );
        }

        /**
         * Process the payment and return the result.
         *
         * @param int $order_id
         * @return array
         */
        public function process_payment( $order_id ) {
            $order = wc_get_order( $order_id );

            // Generate a unique transaction ID.
            $transaction_id = uniqid('iptestpay_');

            // Set the transaction ID.
            $order->set_transaction_id( $transaction_id );

            // Mark the order as complete.
            $order->payment_complete();

            // Reduce stock levels.
            wc_reduce_stock_levels( $order_id );

            // Remove the cart.
            WC()->cart->empty_cart();

            // Return success.
            return array(
                'result'   => 'success',
                'redirect' => $this->get_return_url( $order ),
            );
        }

        // Additional methods...
    }
}
add_action( 'plugins_loaded', 'ip_init_test_payment_gateway', 11 );

/**
 * Register the payment gateway with WooCommerce.
 */
function ip_add_test_payment_gateway( $gateways ) {
    $gateways[] = 'IP_Test_Payment_Gateway';
    return $gateways;
}
add_filter( 'woocommerce_payment_gateways', 'ip_add_test_payment_gateway' );
