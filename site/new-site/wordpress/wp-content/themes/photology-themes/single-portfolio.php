<?php

global $post;
$layout = get_post_meta($post->ID, 'portfolio_layout', true);

switch ($layout) {
    case 'ajax':
        get_template_part('fragment/portfolio-ajax');
        break;
    case 'sidecontent':
        get_template_part('fragment/portfolio-side');
        break;
    case 'anotherpage':
        $linkpage = vp_metabox('photology_portfolio_link.portfolio_link', null);
        header("Location: {$linkpage}");
        exit();
        break;
    default:
        break;
}