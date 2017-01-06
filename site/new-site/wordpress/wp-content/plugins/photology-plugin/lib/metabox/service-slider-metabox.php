<?php

return array(
    'id'          => 'photology_service_slider',
    'types'       => array('page'),
    'title'       => 'Photology Service Slider',
    'priority'    => 'high',
    'template'    => array(
        array(
            'type'      => 'group',
            'repeating' => true,
            'sortable'  => true,
            'length'    => 1,
            'name'      => 'slideritem',
            'title'     => 'Slider Item',
            'fields'    => array(
                array(
                    'type' => 'imageupload',
                    'name' => 'background',
                    'label' => 'Background Image',
                    'description' => 'upload your slider background image',
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'servicetext',
                    'label' => 'Service Text',
                    'description' => 'short service description ex : Photography, Makeup, etc',
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'detailtext',
                    'label' => 'Service Detail Text',
                ),
                array(
                    'type' => 'textbox',
                    'name' => 'url',
                    'label' => 'Service URL',
                ),
            ),
        ),
    ),
);