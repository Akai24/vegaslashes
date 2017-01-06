<?php

/**
 * slider metabox
 ***/

function photology_slider_gallery()
{
    return array(
        array(
            'id'			=> 'postgallery',
            'type'			=> 'mediagallery',
            'title'			=> 'Media Builder',
            'description'	=> 'Build Media Content ( you can use drag to change sequence )',
            'multi'			=> true,
            'default'		=> '',
            'option'			=> array(
                'nowidth'		=> true,
                'include'		=> array('image', 'youtube', 'vimeo'),
                'videocover' 	=> true
            )
        ),
    );
}

$slidermetabox = new jeg_metabox_panel(array(
    'panelid'		=> 'photology_slider_gallery',
    'screen'		=> array('page'),
    'pagetitle'		=> 'Photology Media Metabox',
    'context'		=> 'normal',
    'priority'		=> 'high',
    'metacontent'	=> 'photology_slider_gallery'
));




/**
 * Media Gallery
 ***/

function photology_media_gallery()
{
    return array(
        array(
            'id'			=> 'photology_gallery',
            'type'			=> 'mediagallery',
            'title'			=> 'Media Builder',
            'description'	=> 'Build Media Gallery Content ( you can use drag to change sequence )',
            'multi'			=> true,
            'default'		=> '',
            'option'			=> array(
                'nowidth'		=> false,
                'include'		=> array('image', 'youtube', 'vimeo', 'soundcloud', 'html5video'),
                'videocover' 	=> true
            )
        ),
    );
}

$slidermetabox = new jeg_metabox_panel(array(
    'panelid'		=> 'photology_media_gallery',
    'screen'		=> array('page'),
    'pagetitle'		=> 'Photology Media Gallery',
    'context'		=> 'normal',
    'priority'		=> 'high',
    'metacontent'	=> 'photology_media_gallery'
));


/**
 * Portfolio Gallery
 */

function photology_portfolio_media_gallery()
{
    return array(
        array(
            'id'			=> 'photology_portfolio_media_gallery',
            'type'			=> 'mediagallery',
            'title'			=> 'Media Builder',
            'description'	=> 'Build Media Gallery Content ( you can use drag to change sequence )',
            'multi'			=> true,
            'default'		=> '',
            'option'			=> array(
                'nowidth'		=> false,
                'include'		=> array('image', 'youtube', 'vimeo', 'soundcloud', 'html5video'),
                'videocover' 	=> true
            )
        ),
    );
}

$portfoliometabox = new jeg_metabox_panel(array(
    'panelid'		=> 'photology_portfolio_media_gallery',
    'screen'		=> array('portfolio'),
    'pagetitle'		=> 'Portfolio Media Gallery Builder',
    'context'		=> 'normal',
    'priority'		=> 'high',
    'metacontent'	=> 'photology_portfolio_media_gallery'
));