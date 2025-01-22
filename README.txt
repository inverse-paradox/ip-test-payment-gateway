=== IP Test Payment Gateway ===
Contributors: inverseparadox  
Tags: woocommerce, payment gateway, subscriptions, testing  
Requires at least: 5.8  
Tested up to: 6.3  
Requires PHP: 7.4  
Stable tag: 1.1.0  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

A simple WooCommerce payment gateway for testing purposes that supports subscriptions.

== Description ==

The **IP Test Payment Gateway** plugin provides a straightforward payment gateway for WooCommerce, designed for testing purposes. It supports WooCommerce Subscriptions, making it a useful tool for developers and site administrators to test subscription workflows and related functionality.

**Features:**
- Compatible with WooCommerce Subscriptions.
- Supports subscription reactivation, suspension, cancellation, and more.
- Simple configuration with no external payment integration required.
- Mark orders as complete automatically for testing purposes.

This plugin is intended for development and testing only and should not be used on a live site.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/ip-test-payment-gateway` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Navigate to **WooCommerce > Settings > Payments** and enable the "IP Test Payment Gateway."
4. Configure the gateway settings as needed.

== Frequently Asked Questions ==

= Can I use this plugin on a live site? =

This plugin is intended for testing and development purposes only. It does not process actual payments and should not be used on a live e-commerce site.

= Does this plugin support WooCommerce Subscriptions? =

Yes, it fully supports WooCommerce Subscriptions, including functionalities such as reactivation, suspension, cancellation, and scheduled payments.

== Changelog ==

= 1.1.1 =
- Generate a transaction ID for each test payment processed

= 1.1.0 =
- Added support for WooCommerce Subscriptions advanced features.
- Improved settings configuration and form field validation.
- Updated compatibility with WordPress 6.3 and WooCommerce 7.0.

= 1.0.0 =
- Initial release of the plugin.
- Basic payment gateway functionality for testing.

== Upgrade Notice ==

= 1.1.0 =
This version adds advanced subscription support. Ensure WooCommerce Subscriptions is up-to-date before upgrading.

== License ==

This plugin is open-source and licensed under the GPLv2 or later.
