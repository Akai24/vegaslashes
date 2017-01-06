<?php

return array(
    'id'          => 'photology_page',
    'types'       => array('page'),
    'title'       => 'Photology Page Option',
    'priority'    => 'high',
    'template'    => array(
        array(
            'type' => 'toggle',
            'name' => 'hide_meta',
            'label' => 'Hide Page Meta',
        ),
        array(
            'type' => 'toggle',
            'name' => 'hide_sharing',
            'label' => 'Hide Page Sharing',
        ),
    ),
);