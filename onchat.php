<?php
/**
 * Plugin Name: OnChat
 * Plugin URI: https://www.onchat.ai
 * Description: Reduce your support costs by adding an AI powered chatbot to your Wordpress website or WooCommerce online store.
 * Version: 1.0.0
 * Author: OnChat
 * Author URI: https://www.onchat.ai/
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Add the options page to the admin menu
function OnchatAddSettingsPage()
{
    add_options_page('OnChat', 'OnChat', 'administrator', 'chatbot_id', 'OnchatSettingsPage');
    add_action('admin_init', 'OnchatRegisterSettings');
}

add_action('admin_menu', 'OnchatAddSettingsPage');

// Register the options settings
function OnchatRegisterSettings()
{
    register_setting('onchat_settings', 'chatbot_id');
}

// Define the content of the options page
function OnchatSettingsPage()
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('onchat_settings'); ?>
            <?php do_settings_sections('onchat_settings'); ?>
            <table class="form-table" role="presentation">
              <tbody>
                <tr>
                  <th scope="row"><label for="chatbot_id">Your OnChat chatbot ID:</label></th>
                  <td>
                    <input name="chatbot_id" type="text" id="chatbot_id" value="<?php echo esc_html(get_option('chatbot_id')); ?>" class="regular-text">
                    <p class="description" id="tagline-description">To find your chatbot ID login into your <a href="http://onchat.ai" target="_blank">OnChat Dashboard</a>!</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

// Embed the script on the site using the ID entered in the options page
function OnchatEmbedCode()
{
     echo "<script src=\"https://onchat.ai/onchat.js?bot=".esc_attr(get_option('chatbot_id'))."\"></script>";
}

add_action('wp_footer', 'OnchatEmbedCode');

?>
