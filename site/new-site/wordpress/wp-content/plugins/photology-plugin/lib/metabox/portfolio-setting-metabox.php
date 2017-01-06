<?php

return array(
    'id'          => 'photology_portfolio_setting',
    'types'       => array('portfolio'),
    'title'       => 'Photology Portfolio Setting',
    'priority'    => 'high',
    'context'     => 'side',
    'mode'			=> WPALCHEMY_MODE_EXTRACT,
    'template'    => array(
        array(
            'type'  => 'select',
            'name'  => 'portfolio_layout',
            'label' => 'Choose your portfolio layout (for single portfolio)',
            'default' => 'ajax',
            'allowsingle' => true,
            'items' => array(
                array(
                    'value' => 'ajax',
                    'label' => 'Ajax portfolio',
                ),
                array(
                    'value' => 'sidecontent',
                    'label' => 'Side content portfolio',
                ),
                array(
                    'value' => 'anotherpage',
                    'label' => 'To another page (Link)',
                ),
            )
        ),
        array(
            'type'  => 'select',
            'name'  => 'portfolio_parent',
            'label' => 'Choose your portfolio parent',
            'allowsingle' => true,
            'default' => '{{first}}',
            'items' => array(
                'data' => array(
                    array(
                        'source' => 'function',
                        'value'  => 'jeg_get_portfolio_page',
                    ),
                ),
            ),
        ),

        array(
            'type' => 'imageupload',
            'name' => 'coverimage',
            'label' => 'Image Cover',
        ),

        array(
            'type'  => 'select',
            'name'  => 'coverwidth',
            'label' => 'Thumb Width',
            'default' => '1',
            'allowsingle' => true,
            'description' => 'Only if you are using normal mode on portfolio list',
            'items' => array(
                array(
                    'value' => '0.25',
                    'label' => '1/4x width',
                ),
                array(
                    'value' => '0.5',
                    'label' => '1/2x width',
                ),
                array(
                    'value' => '1',
                    'label' => '1x width',
                ),
                array(
                    'value' => '2',
                    'label' => '2x width',
                ),
                array(
                    'value' => '3',
                    'label' => '3x width',
                ),
            )
        ),


        array(
            'type'  => 'select',
            'name'  => 'coverheight',
            'label' => 'Thumb Height',
            'default' => '1',
            'allowsingle' => true,
            'description' => 'Only if you are using normal mode on portfolio list',
            'items' => array(
                array(
                    'value' => '0.25',
                    'label' => '1/4x height',
                ),
                array(
                    'value' => '0.5',
                    'label' => '1/2x height',
                ),
                array(
                    'value' => '1',
                    'label' => '1x height',
                ),
                array(
                    'value' => '2',
                    'label' => '2x height',
                ),
                array(
                    'value' => '3',
                    'label' => '3x height',
                ),
            )
        ),

    ),
);