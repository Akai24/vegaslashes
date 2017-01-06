<?php
$template = vp_option('joption.archive_layout', 'masonry');
$title = sprintf( __('Search for : <b>%s</b>', 'photology-themes') ,  esc_html ( get_search_query() ) );

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
