<?php

return array(
    'id'          => 'photology_masonry_blog',
    'types'       => array('page'),
    'title'       => 'Photology Blog Masonry',
    'priority'    => 'high',
    'template'    => array(
        array(
            'type' => 'toggle',
            'name' => 'hide_filter',
            'label' => 'Hide Blog Masonry Filter',
            'description' => 'Check this option to hide filter Head',
        ),
    ),
);