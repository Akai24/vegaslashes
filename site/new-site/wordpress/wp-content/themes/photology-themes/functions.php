<?php
/**
 * @author : Jegtheme
 */

$jplugincompatible = '1.0.6';
$photologyplugincompatible = '1.0.1';

require_once get_template_directory() . '/lib/init.php';
require_once get_template_directory() . '/lib/common-function.php';
require_once get_template_directory() . '/tgm/plugin-list.php';
require_once get_template_directory() . '/lib/load-script.php';
require_once get_template_directory() . '/lib/ajax-response.php';
require_once get_template_directory() . '/lib/additional-filter.php';
require_once get_template_directory() . '/lib/init-widget.php';
require_once get_template_directory() . '/lib/init-menu.php';
require_once get_template_directory() . '/lib/theme-customizer.php';
require_once get_template_directory() . '/lib/plugin-update-notice.php';

if( defined('JEG_PLUGIN_VERSION') ) {
    require_once get_template_directory() . '/lib/import/import-content.php';
}