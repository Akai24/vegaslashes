<?php

return array(
    'id'          => 'photology_slider_gallery',
    'types'       => array('page'),
    'title'       => 'Photology Media Option',
    'priority'    => 'high',
    'template'    => array(

        array(
            'type' => 'toggle',
            'name' => 'toggle_autoplay',
            'label' => 'Autoplay slider',
        ),

        array(
            'type' => 'slider',
            'name' => 'autoplay_delay',
            'label' => 'Autoplay Delay',
            'description' => 'setup your autoplay delay',
            'min' => '1000',
            'max' => '20000',
            'step' => '1000',
            'default' => '5000',
            'dependency' => array(
                'field'    => 'toggle_autoplay',
                'function' => 'vp_dep_boolean',
            ),
        ),

        array(
            'type' => 'toggle',
            'name' => 'show_arrow',
            'label' => 'Show slider arrow',
        ),

        array(
            'type' => 'toggle',
            'name' => 'show_thumb',
            'label' => 'Show slider thumb',
        ),

        array(
            'type'  => 'select',
            'name'  => 'fit_mode',
            'label' => 'Media cover fit mode',
            'default' => 'scaledown',
            'items' => array(
                array(
                    'value' => 'scaledown',
                    'label' => 'Non crop',
                ),
                array(
                    'value' => 'cover',
                    'label' => 'Crop (full screen)',
                )
            )
        ),

    ),
);