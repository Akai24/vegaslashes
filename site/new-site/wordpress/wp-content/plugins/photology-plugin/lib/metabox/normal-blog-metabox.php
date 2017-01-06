<?php

return array(
    'id'          => 'photology_normal_blog',
    'types'       => array('page'),
    'title'       => 'Photology Normal Blog Type',
    'priority'    => 'high',
    'template'    => array(

        array(
            'type' => 'select',
            'name' => 'normal_blog_layout',
            'label' => 'Single Post Layout',
            'description' => 'choose your single post layout',
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
            'name' => 'normal_blog_sidebar',
            'label' =>  'Single Post Sidebar' ,
            'description' => 'choose sidebar you want to use on single post',
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
                'field'    => 'normal_blog_layout',
                'function' => 'jeg_single_sidebar',
            ),
        ),
    ),
);