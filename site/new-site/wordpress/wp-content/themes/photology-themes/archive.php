<?php
/**
 * @author Jegbagus
 */

$template = vp_option('joption.archive_layout', 'masonry');

$title = '';
if (function_exists('is_tag') && is_tag()) {
    $title =  sprintf( __('Tag archive for : <b>%s</b>', 'photology-themes') , single_tag_title('', false) );
} elseif (is_category()){
    $title =  sprintf( __('Post filled under : <b>%s</b>', 'photology-themes') , single_cat_title('', false) );
} elseif (is_author()){
    $title =  sprintf( __('Post written by : <b>%s</b>', 'photology-themes') , get_userdata(get_query_var('author'))->display_name );
} elseif (is_archive()) {
    $title =  sprintf( __('%s - Archive', 'photology-themes'),  wp_title('', false)) ;
}


if($template === 'masonry') {
    $pageoption = array(
        'title' => $title,
    );
    locate_template(array('fragment/archive-blog-masonry.php'), true, true);
} else {
    $pageoption = array(
        'usesidebar' => vp_option('joption.archive_layout'),
        'sidebarname' => vp_option('joption.archive_sidebar'),
        'title' => $title,
    );

    locate_template(array('fragment/archive-blog-normal.php'), true, true);
}
