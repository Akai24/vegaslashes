<?php

function jeg_import_view() { ?>

    <h2>Import Dummy Data</h2>

    <?php echo jeg_import_notice(); ?>

    <p>Before importing content, please read several notice for importing content. </p>
    <div class="jeg-dummydata">
        <ul>
            <li>You can use dummy data to learn how this themes work.</li>
            <li>Menu will be recreated.</li>
            <li>Widget content will be replaced with demo widget.</li>
            <li>Demo content not included within demo content due to copyright of those image.</li>
            <li>Please make sure that your server able to do outbound request, we need to download image that used on demo.</li>
            <li>Using this import, you won't have double content of import content.</li>
            <li>Please wait until Process is finished. and please leave your browser open during import process. Closing Browser will stop the import process</li>
        </ul>
    </div>


    <?php if ( is_plugin_active( 'wordpress-importer/wordpress-importer.php' ) ) { ?>
    <div class="disable-wp-importer"><strong>[IMPORTANT]</strong> Our Import Dummy Data will not work correctly when WordPress Importer enabled. Please disable WordPress Importer Plugin first.</div>
    <?php } else { ?>
    <form class="jeg-import-form" method="post">
        <input type="hidden" name="jeg-nonce" value="<?php echo wp_create_nonce('jeg-dummy-import'); ?>" />
        <input name="reset" class="jeg-dummydata-button" type="submit" value="Import Dummy Data" />
        <input type="hidden" value="jeg-dummy-import" name="action" />
    </form>
    <?php } ?>


    <style>
        .jeg-dummydata ul {
            margin-left: 20px;
        }
        .jeg-dummydata ul li, .jeg-demonotice ul li {
            list-style: disc;
        }
        .jeg-dummydata-button, .jeg-dummydata-button:hover {
            background: none repeat scroll 0 0 #2ea2cc;
            box-shadow: 0 1px 0 rgba(120, 200, 230, 0.5) inset, 0 1px 0 rgba(0, 0, 0, 0.15);
            color: #fff;
            text-decoration: none;
            height: 30px;
            line-height: 28px;
            margin: 0;
            padding: 0 12px;
            border-radius: 3px;
            border: 1px solid #0074a2;
            cursor: pointer;
            display: inline-block;
            font-size: 13px;
            white-space: nowrap;
        }
        .jeg-import-form {
            margin-bottom: 30px;
            margin-top: 30px;
        }
        .jeg-demonotice {
            background: none repeat scroll 0 0 #e5fafd;
            border: 1px solid #ccc;
            margin: 10px 10px 10px 0;
            padding: 5px 20px;
        }
        .jeg-demonotice > ul {
            padding-left: 20px;
        }
        .disable-wp-importer {
            background: none repeat scroll 0 0 #ddd;
            border: 2px solid;
            color: red;
            padding: 20px;
        }
        .import-notice {
            display: list-item;
            font-size: 14px;
            font-style: italic;
            font-weight: bold;
            margin-left: 20px;
        }
    </style>
    <?php

    if(  isset($_REQUEST['action']) &&  $_REQUEST['action'] == 'jeg-dummy-import' && check_admin_referer('jeg-dummy-import' , 'jeg-nonce')){
        defined( 'WP_LOAD_IMPORTERS' ) or define('WP_LOAD_IMPORTERS', true);
        require_once ABSPATH . 'wp-admin/includes/import.php';
        $importer_error = false;

        if ( !class_exists( 'WP_Importer' ) ) {
            $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
            if ( file_exists( $class_wp_importer ) ){
                require_once($class_wp_importer);
            }
            else {
                $importer_error = true;
            }
        }

        if ( !class_exists( 'WP_Import' ) ) {
            $class_wp_import = JEG_PLUGIN_DIR . '/importer/wordpress-importer.php';
            if ( file_exists( $class_wp_import ) ) {
                require_once($class_wp_import);
            }
            else {
                $importer_error = true;
            }
        }

        if($importer_error){
            die("Error in import :(");
        } else {
            if(!is_file( get_template_directory() . '/lib/import/data/dummy.xml')){
                echo "The XML file containing the dummy content is not available or could not be read .. You might want to try to set the file permission to chmod 755.<br/>If this doesn't work please use the wordpress importer and import the XML file (should be located in your download .zip: Sample Content folder) manually ";
            }
            else {
                jeg_prepare_import();

                ob_start();
                $wp_import = new WP_Import();
                $wp_import->fetch_attachments = true;
                $wp_import->import( get_template_directory() . '/lib/import/data/dummy.xml');
                ob_end_clean();
                jeg_create_notice("Finish Import Dummy Data");

                jeg_end_import();
            }
        }
    }
}

function jeg_create_notice($notice){
    echo "<div class='import-notice'>$notice</div><br/>";
}

function jeg_prepare_import() {

    // prevent double menu

    $termarray = array();
    $termarray[0] = get_term_by('name','Main Menu', 'nav_menu');

    foreach($termarray as $term) {
        if(is_object($term)) {
            wp_delete_nav_menu($term->term_id);
        }
    }

}

function jeg_import_notice()
{
    $shownotice = false;
    $noticelist = '';

    if($shownotice) {
        return '<div class="jeg-demonotice"><p>Plugin Check : </p><ul>' . $noticelist . '</ul></div>';
    }
}

function jeg_panel_import()
{
    global $joptionglobal;

    ob_start();
    require_once get_template_directory() . '/lib/import/data/backend.json';
    $content = ob_get_contents();
    ob_end_clean();

    $joptionglobal->import_option($content);
}

function jeg_set_menu_location()
{
    $mainmenu = get_term_by('name','Main Menu', 'nav_menu');

    $locations = get_theme_mod('nav_menu_locations');
    $locations['navigation']        = $mainmenu->term_id;
    $locations['mobile_navigation'] = $mainmenu->term_id;

    set_theme_mod( 'nav_menu_locations', $locations );
}


function reset_widget_content() {
    $sidebarOptions = get_option('sidebars_widgets');

    foreach($sidebarOptions as $sidebar_name => $sidebar_value) {
        if(is_array($sidebar_value)) {
            unset($sidebarOptions[$sidebar_name]);
            $sidebarOptions[$sidebar_name] = array();
        }
    }

    update_option('sidebars_widgets', $sidebarOptions);
}


function jeg_add_widget_to_sidebar($sidebarSlug, $widgetSlug, $countMod, $widgetSettings = array())
{
    $sidebarOptions = get_option('sidebars_widgets');

    if(!isset($sidebarOptions[$sidebarSlug])){
        $sidebarOptions[$sidebarSlug] = array();
    }

    $newWidget = get_option('widget_'.$widgetSlug);
    if(!is_array($newWidget))$newWidget = array();
    $count = count($newWidget) + 1 + $countMod;
    $sidebarOptions[$sidebarSlug][] = $widgetSlug.'-'.$count;

    $newWidget[$count] = $widgetSettings;

    update_option('sidebars_widgets', $sidebarOptions);
    update_option('widget_'.$widgetSlug, $newWidget);
}


function jeg_set_widget()
{
    reset_widget_content();

    jeg_add_widget_to_sidebar( JEG_DEFAULT_WIDGET , 'jeg_ads_widget', 0,  array(
        'title' => 'Ads',
        'adsimage' => 'http://photology.jegtheme.com/wp-content/uploads/2015/08/ads.jpg',
        'adsurl' => 'http://bit.ly/falive-theme'
    ));

    jeg_add_widget_to_sidebar( JEG_DEFAULT_WIDGET , 'jeg_popular_post_widget', 1,  array(
        'title' => 'Popular Post',
        'numberpost' => '5'
    ));

    jeg_add_widget_to_sidebar( JEG_DEFAULT_WIDGET , 'jeg_facebook_fans_widget', 2,  array(
        'title' => 'Facebook Fans',
        'facebookurl' => 'http://www.facebook.com/jegtheme'
    ));
}

function jeg_set_homepage() {
    update_option('show_on_front', 'page');

    $homepage = get_page_by_title('Portfolio - Metro');
    update_option('page_on_front', $homepage->ID);
}

function jeg_end_import()
{
    // set widget
    jeg_set_widget();
    jeg_create_notice("Finish Import Widget");

    // import panel
    jeg_panel_import();
    jeg_create_notice("Finish Import Theme Panel Setting");

    // set home page
    jeg_set_homepage();

    // set menu location
    jeg_set_menu_location();
    jeg_create_notice("Finish Import Menu Location");

    echo "<h3>Congratulation, Import Finished!</h3>";
}