<?php

return array(
    'id'          => 'photology_default_page',
    'types'       => array('page'),
    'title'       => 'Photology Default Page',
    'priority'    => 'high',
    'template'    => array(

        array(
            'type' => 'select',
            'name' => 'page_layout',
            'label' => 'Page Layout',
            'description' => 'choose your page layout',
            'items' => array(
                array(
                    'value' => 'nosidebar',
                    'label' => 'No Sidebar',
                ),
                array(
                    'value' => 'withsidebar',
                    'label' => 'With Sidebar',
                ),
            ),
            'default' => array(
                'nosidebar',
            ),
        ),
        array(
            'type' => 'select',
            'name' => 'page_sidebar',
            'label' =>  'Page Sidebar' ,
            'description' => 'choose sidebar you want to use on this page',
            'default' => '{{first}}',
            'items' => array(
                'data' => array(
                    array(
                        'source' => 'function',
                        'value'  => 'jeg_get_sidebar',
                    ),
                ),
            ),
            'dependency' => array(
                'field'    => 'page_layout',
                'function' => 'jeg_single_sidebar',
            ),
        ),
    ),
);