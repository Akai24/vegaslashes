<?php

return array(
    'id'          => 'photology_media_gallery_side',
    'types'       => array('page'),
    'title'       => 'Photology Gallery Side Content',
    'priority'    => 'high',
    'template'    => array(

        array(
            'type' 			=> 'toggle',
            'name' 			=> 'switch_position',
            'label' 		=> 'Switch Content Position to Left',
            'description' 	=> 'enable this option to switch content position to left, and image position to right',
        ),

    ),
);