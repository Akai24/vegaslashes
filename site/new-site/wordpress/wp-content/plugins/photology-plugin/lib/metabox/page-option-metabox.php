<?php

return array(
    'id'          => 'photology_general',
    'types'       => array('post', 'page'),
    'title'       => 'Photology General Option',
    'priority'    => 'low',
    'context'     => 'side',
    'template'    => array(


        array(
            'type' => 'toggle',
            'name' => 'override_background',
            'label' => 'Override Default Background Setup',
            'description' => 'if you want this page having different background',
        ),

        array(
            'type'      => 'group',
            'repeating' => false,
            'length'    => 1,
            'name'      => 'override_background_group',
            'title'     => 'Override Background',
            'dependency' => array(
                'field'    => 'override_background',
                'function' => 'vp_dep_boolean',
            ),
            'fields'    => array(
                array(
                    'type' => 'color',
                    'name' => 'color_background',
                    'label' => 'Background color',
                    'description' => 'Background Color',
                    'default' => '#FFF',
                    'format' => 'HEX',
                ),

                array(
                    'type' => 'imageupload',
                    'name' => 'image_background',
                    'label' => 'Image Background',
                    'description' => 'Upload your website image background',
                ),

                array(
                    'type' => 'select',
                    'name' => 'background_vertical_position',
                    'label' => 'Image background vertical position',
                    'items' => array(
                        array(
                            'value' => 'left',
                            'label' => 'Left',
                        ),
                        array(
                            'value' => 'center',
                            'label' => 'Center',
                        ),
                        array(
                            'value' => 'right',
                            'label' => 'right',
                        ),
                    ),
                    'default' => array(
                        'center',
                    ),
                ),

                array(
                    'type' => 'select',
                    'name' => 'background_horizontal_position',
                    'label' => 'Image background horizontal position',
                    'items' => array(
                        array(
                            'value' => 'top',
                            'label' => 'top',
                        ),
                        array(
                            'value' => 'center',
                            'label' => 'Center',
                        ),
                        array(
                            'value' => 'bottom',
                            'label' => 'bottom',
                        ),
                    ),
                    'default' => array(
                        'center',
                    ),
                ),

                array(
                    'type' => 'select',
                    'name' => 'background_repeat',
                    'label' => 'Image background repeat',
                    'items' => array(
                        array(
                            'value' => 'repeat-x',
                            'label' => 'Repeat Horizontal',
                        ),
                        array(
                            'value' => 'repeat-y',
                            'label' => 'Repeat Vertical',
                        ),
                        array(
                            'value' => 'repeat',
                            'label' => 'Repeat Image',
                        ),
                        array(
                            'value' => 'no-repeat',
                            'label' => 'No Repeat',
                        ),
                    ),
                    'default' => array(
                        'no-repeat',
                    ),
                ),

                array(
                    'type' => 'toggle',
                    'name' => 'background_fullscreen',
                    'label' => 'Enable fullscreen background',
                    'default' => '0',
                ),
            ),
        ),

    ),
);