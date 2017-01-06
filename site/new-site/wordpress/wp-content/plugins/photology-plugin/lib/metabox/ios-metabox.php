<?php

return array(
    'id'          => 'photology_ios',
    'types'       => array('page'),
    'title'       => 'Photology IOS Slider setup',
    'priority'    => 'high',
    'template'    => array(
        array(
            'type' => 'toggle',
            'name' => 'autoplay',
            'label' => 'Auutoplay Slider',
        ),
        array(
            'type' => 'slider',
            'name' => 'sliderdelay',
            'label' => 'Slider Delay',
            'min' => '1000',
            'max' => '20000',
            'step' => '1000',
            'default' => '5000',
            'dependency' => array(
                'field'    => 'autoplay',
                'function' => 'vp_dep_boolean',
            ),
        ),

    ),
);