<?php

return array(
    'id'          => 'photology_kenburn',
    'types'       => array('page'),
    'title'       => 'Photology Kenburn Slider',
    'priority'    => 'high',
    'template'    => array(
        array(
            'type' => 'slider',
            'name' => 'displaytime',
            'label' => 'Display Time',
            'description' => 'in milli second',
            'min' => '5000',
            'max' => '20000',
            'step' => '1000',
            'default' => '10000',
        ),
        array(
            'type' => 'slider',
            'name' => 'fadetime',
            'label' => 'Fade Time',
            'description' => 'in milli second',
            'min' => '500',
            'max' => '2000',
            'step' => '100',
            'default' => '1000',
        ),
        array(
            'type' => 'slider',
            'name' => 'zoom',
            'label' => 'Image Zoom',
            'min' => '1',
            'max' => '2',
            'step' => '0.1',
            'default' => '1.2',
        ),
    ),
);