<?php

/**
 * @author Jegtheme
 */

function jeg_dashboard_option() {
    return array(
        'title' =>  'Photology' ,
        'logo' => '',
        'menus' => array(
            array(
                'title' =>  'General Setting' ,
                'name' => 'generalsetting',
                'icon' => 'font-awesome:fa-check',
                'menus' => array(

                    array(
                        'title' =>  'Copyright' ,
                        'name' => 'copyright',
                        'icon' => 'font-awesome:fa-copyright',
                        'controls' => array(
                            array(
                                'type' => 'textbox',
                                'name' => 'footer_copyright',
                                'label' =>  'Footer Copyright',
                                'default' => 'Copyright &copy; Jegtheme 2015'
                            ),
                        )
                    ),

                    array(
                        'title' =>  'Single Post' ,
                        'name' => 'single_option',
                        'icon' => 'font-awesome:fa-bookmark',
                        'controls' => array(
                            array(
                                'type' => 'select',
                                'name' => 'single_post_layout',
                                'label' => 'Single Post Layout',
                                'description' => 'choose your single post layout',
                                'items' => array(
                                    array(
                                        'value' => 'nosidebar',
                                        'label' => 'No Sidebar',
                                    ),
                                    array(
                                        'value' => 'withsidebar',
                                        'label' => 'With Sidebar',
                                    ),
                                ),
                                'default' => array(
                                    'nosidebar',
                                ),
                            ),
                            array(
                                'type' => 'select',
                                'name' => 'single_post_sidebar',
                                'label' =>  'Single Post Sidebar' ,
                                'description' => 'choose sidebar you want to use on single post',
                                'default' => '{{first}}',
                                'items' => array(
                                    'data' => array(
                                        array(
                                            'source' => 'function',
                                            'value'  => 'jeg_get_sidebar',
                                        ),
                                    ),
                                ),
                                'dependency' => array(
                                    'field'    => 'single_post_layout',
                                    'function' => 'jeg_single_sidebar',
                                ),
                            ),
                        )
                    ),


                    array(
                        'title' =>  'Archive & Search Setting' ,
                        'name' => 'archive_setting',
                        'icon' => 'font-awesome:fa-archive',
                        'controls' => array(
                            array(
                                'type' => 'select',
                                'name' => 'archive_layout',
                                'label' => 'Archive Layout',
                                'description' => 'choose your archive layout',
                                'items' => array(
                                    array(
                                        'value' => 'masonry',
                                        'label' => 'Masonry',
                                    ),
                                    array(
                                        'value' => 'nosidebar',
                                        'label' => 'Normal No Sidebar',
                                    ),
                                    array(
                                        'value' => 'withsidebar',
                                        'label' => 'Normal With Sidebar',
                                    ),
                                ),
                                'default' => array(
                                    'masonry',
                                ),
                            ),
                            array(
                                'type' => 'select',
                                'name' => 'archive_sidebar',
                                'label' =>  'Archive Sidebar' ,
                                'description' => 'choose sidebar you want to use on archive',
                                'default' => '{{first}}',
                                'items' => array(
                                    'data' => array(
                                        array(
                                            'source' => 'function',
                                            'value'  => 'jeg_get_sidebar',
                                        ),
                                    ),
                                ),
                                'dependency' => array(
                                    'field'    => 'archive_layout',
                                    'function' => 'jeg_single_sidebar',
                                ),
                            ),
                        )
                    ),


                    array(
                        'title' =>  'Social Icon' ,
                        'name' => 'social_icon',
                        'icon' => 'font-awesome:fa-share',
                        'controls' => array(

                            array(
                                'type' => 'section',
                                'title' =>  'Insert URL of your social profile' ,
                                'name' => 'right_mouse_click_behaviour',
                                'description' =>  'Social profile will only shown if you are adding url inside this page' ,
                                'fields' => array(
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_facebook',
                                        'label' =>  'Facebook'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_twitter',
                                        'label' =>  'Twitter'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_linkedin',
                                        'label' =>  'Linkedin'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_googleplus',
                                        'label' =>  'Google Plus'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_pinterest',
                                        'label' =>  'Pinterest'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_github',
                                        'label' =>  'Github'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_flickr',
                                        'label' =>  'Flickr'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_tumblr',
                                        'label' =>  'Tumblr'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_dribbble',
                                        'label' =>  'Dribbble'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_soundcloud',
                                        'label' =>  'Soundcloud'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_lastfm',
                                        'label' =>  'Fastfm'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_behance',
                                        'label' =>  'Behance'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_instagram',
                                        'label' =>  'Instagram'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_vimeo',
                                        'label' =>  'Vimeo'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_youtube',
                                        'label' =>  'Youtube'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_500px',
                                        'label' =>  '500px'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_vk',
                                        'label' =>  'VK'
                                    ),
                                    array(
                                        'type' => 'textbox',
                                        'name' => 'social_rss',
                                        'label' =>  'RSS'
                                    ),
                                )
                            ),
                        )
                    ),


                    array(
                        'title' =>  'Additional Code' ,
                        'name' => 'additionalcode',
                        'icon' => 'font-awesome:fa-code',
                        'controls' => array(
                            array(
                                'type' => 'notebox',
                                'name' => 'additionalinfo',
                                'label' =>  'Custom CSS Info' ,
                                'description' =>  'put your additional css right here. so if you updating themes, you wont lose any of your additonal css' ,
                                'status' => 'info',
                            ),
                            array(
                                'type' => 'codeeditor',
                                'name' => 'styleeditor',
                                'label' =>  'Custom CSS' ,
                                'description' =>  'Put your custom css right here.' ,
                                'theme' => 'github',
                                'mode' => 'css',
                            ),
                            array(
                                'type' => 'notebox',
                                'name' => 'additionalinfo',
                                'label' =>  'Custom Javascript Info' ,
                                'description' =>  'put your additional javascript right here. You can use it for your tracking (like google analytic or else)' ,
                                'status' => 'info',
                            ),
                            array(
                                'type' => 'codeeditor',
                                'name' => 'jseditor',
                                'label' =>  'Additional Javascript' ,
                                'description' =>  'Put your additional javascript right here. You don\'t need to include script tag' ,
                                'theme' => 'github',
                                'mode' => 'javascript',
                            ),
                        )
                    ),


                    array(
                        'title' =>  'Additional Font' ,
                        'name' => 'fontadditioanl',
                        'icon' => 'font-awesome:fa-font',
                        'controls' => array(
                            array(
                                'type' => 'notebox',
                                'name' => 'additionalfontinfo',
                                'label' =>  'Info',
                                'description' =>
                                    "<ol>
                                    <li>If you upload font on this additional font block, google font on customizer will be disabled and overwrited by this item setup</li>
                                    <li>Please fill all font. if you having only one kind of font, you can geenerate all of font combination on : <a href='http://www.fontsquirrel.com/tools/webfont-generator' target='_blank'>font squirrel generator</a></li>
                                </ol>",
                                'status' => 'info',
                            ),

                            array(
                                'type' => 'section',
                                'title' =>  'First Additional Font Block' ,
                                'name' => 'additional_font_1',
                                'fields' => array(

                                    array(
                                        'type' => 'textbox',
                                        'name' => 'additional_font_1_fontname',
                                        'label' =>  'Font Name' ,
                                        'description' =>  'please fill your font name...' ,
                                    ),

                                    array(
                                        'type' => 'upload',
                                        'name' => 'additional_font_1_eot',
                                        'label' =>  'EOT File' ,
                                    ),

                                    array(
                                        'type' => 'upload',
                                        'name' => 'additional_font_1_woff',
                                        'label' =>  'WOFF File' ,
                                    ),

                                    array(
                                        'type' => 'upload',
                                        'name' => 'additional_font_1_ttf',
                                        'label' =>  'TTF File' ,
                                    ),

                                    array(
                                        'type' => 'upload',
                                        'name' => 'additional_font_1_svg',
                                        'label' =>  'SVG File' ,
                                    ),
                                )
                            ),

                            array(
                                'type' => 'section',
                                'title' =>  'Second Additional Font Block' ,
                                'name' => 'additional_font_2',
                                'fields' => array(

                                    array(
                                        'type' => 'textbox',
                                        'name' => 'additional_font_2_fontname',
                                        'label' =>  'Font Name' ,
                                        'description' =>  'please fill your font name...' ,
                                    ),

                                    array(
                                        'type' => 'upload',
                                        'name' => 'additional_font_2_eot',
                                        'label' =>  'EOT File' ,
                                    ),

                                    array(
                                        'type' => 'upload',
                                        'name' => 'additional_font_2_woff',
                                        'label' =>  'WOFF File' ,
                                    ),

                                    array(
                                        'type' => 'upload',
                                        'name' => 'additional_font_2_ttf',
                                        'label' =>  'TTF File' ,
                                    ),

                                    array(
                                        'type' => 'upload',
                                        'name' => 'svg',
                                        'label' =>  'SVG File' ,
                                    ),
                                )
                            ),

                        )
                    ),


                    array(
                        'title' =>  'Google Map Key',
                        'name' => 'google_map_key',
                        'icon' => 'font-awesome:fa-map-marker',
                        'controls' => array(

                            array(
                                'type' => 'notebox',
                                'name' => 'upload_notification',
                                'label' => 'Google Map Note',
                                'description' => 'New google map version, will mandatory to have google maps api key. you can create it right here : <a href=" https://developers.google.com/maps/documentation/javascript/get-api-key">Google Map</a>',
                                'status' => 'info',
                            ),

                            array(
                                'type' => 'textbox',
                                'name' => 'googlemap_key',
                                'label' => 'Google Map Key',
                                'description' => 'Please create google map first and insert your google map key right here',
                                'default' => ''
                            ),

                        )
                    ),

                )
            ),


            array(
                'title' =>  'Support' ,
                'name' => 'support',
                'icon' => 'font-awesome:fa-medkit',
                'menus' => array(
                    array(
                        'title' =>  'Tips & Support' ,
                        'name' => 'support',
                        'icon' => 'font-awesome:fa-h-square',
                        'controls' => array(

                            array(
                                'type' => 'notebox',
                                'name' => 'support_request',
                                'label' =>  'How to requesting support' ,
                                'description' =>  'if you have question related with this themes, please send your question to <a href="http://support.jegtheme.com/" target="_blank">our forum support</a>' ,
                                'status' => 'info',
                            ),
                        )
                    )
                )
            )
        )
    );
}

