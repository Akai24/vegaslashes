<?php

return array(
    'id'          => 'photology_media_gallery',
    'types'       => array('page'),
    'title'       => 'Photology Gallery',
    'priority'    => 'high',
    'template'    => array(

        array (
            'type' => 'radiobutton',
            'name' => 'gallery_type',
            'label' => 'Gallery layout type',
            'description' => 'choose between normal or masonry layout',
            'default' => 'normal',
            'items' => array(
                array(
                    'value' => 'normal',
                    'label' => 'Normal Layout',
                ),
                array(
                    'value' => 'masonry',
                    'label' => 'Masonry Layout',
                ),
                array(
                    'value' => 'justified',
                    'label' => 'Justified Layout',
                ),
            ),
        ),

        array(
            'type' => 'slider',
            'name' => 'item_width',
            'label' => 'Gallery item width',
            'description' => 'set your gallery item defaul width, you can also change size of item width on every content of media gallery',
            'min' => '200',
            'max' => '1000',
            'step' => '5',
            'default' => '400',
            'dependency' => array(
                'field'    => 'gallery_type',
                'function' => 'jeg_portfolio_width_value',
            ),
        ),

        array(
            'type' => 'slider',
            'name' => 'item_height',
            'label' => 'Gallery item height dimension',
            'description' => 'item height dimension base on item width size',
            'min' => '0.1',
            'max' => '3',
            'step' => '0.1',
            'default' => '1',
            'dependency' => array(
                'field'    => 'gallery_type',
                'function' => 'jeg_portfolio_height_value',
            ),
        ),

        array(
            'type' => 'slider',
            'name' => 'justified_item_height',
            'label' => 'Justified Image Height',
            'description' => 'height of image on justfied gallery',
            'min' => '150',
            'max' => '500',
            'step' => '10',
            'default' => '250',
            'dependency' => array(
                'field'    => 'gallery_type',
                'function' => 'jeg_portfolio_justified_value',
            ),
        ),

        array(
            'type' 			=> 'toggle',
            'name' 			=> 'use_margin',
            'label' 		=> 'Use margin',
            'description' 	=> 'enable gallery item margin on this page',
        ),

        array(
            'type' => 'slider',
            'name' => 'margin_size',
            'label' => 'Margin size',
            'description' => 'in pixel',
            'min' => '2',
            'max' => '20',
            'step' => '1',
            'default' => '5',
            'dependency' => array(
                'field'    => 'use_margin',
                'function' => 'vp_dep_boolean',
            ),
        ),

        array(
            'type' => 'slider',
            'name' => 'load_limit',
            'label' => 'Partial load image count',
            'description' => 'set your loaded image count, this option will enable you to load image step by step',
            'min' => '5',
            'max' => '250',
            'step' => '1',
            'default' => '50',
        ),

        array(
            'type'  => 'select',
            'name'  => 'expand_mode',
            'label' => 'Gallery Expand Script',
            'description' => 'script that will used when user click the image thumbnail',
            'default' => 'magnific',
            'items' => array(
                array(
                    'value' => 'magnific',
                    'label' => 'Use magnific (Play youtube, vimeo, html 5 video, and soundcloud media)',
                ),
                array(
                    'value' => 'swipebox',
                    'label' => 'Use Swipebox (Play youtube, vimeo, and soundcloud media)',
                ),
            )
        ),


        array(
            'type'  => 'select',
            'name'  => 'load_animation',
            'label' => 'Gallery load animation style',
            'description' => 'select your animation load sytle',
            'default' => 'randomfade',
            'items' => array(
                array(
                    'value' => 'normal',
                    'label' => 'Normal',
                ),
                array(
                    'value' => 'fade',
                    'label' => 'Fade',
                ),
                array(
                    'value' => 'seqfade',
                    'label' => 'Sequence Fade',
                ),
                array(
                    'value' => 'upfade',
                    'label' => 'Up Fade',
                ),
                array(
                    'value' => 'sequpfade',
                    'label' => 'Sequence Up Fade',
                ),
                array(
                    'value' => 'randomfade',
                    'label' => 'Random Fade',
                ),
            )
        ),

    ),
);