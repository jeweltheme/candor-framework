<?php
#-----------------------------------------------------------------
# Columns
#-----------------------------------------------------------------

$candor_shortcodes = array();



//Basic
$candor_shortcodes['header_11'] = array( 
    'type'=>'heading', 
    'title'=>__('Basic Shortcodes', 'candor')
    );

//Page Title
$candor_shortcodes['foody_page_title'] = array( 
    'type'=>'foody-simple', 
    'title'=>__('Parallax Title', 'candor'),
    'attr'=>array(

        'title'=>array(
            'type'=>'text',
            'title'=>__('Title', 'candor'),
            'values'=>__('Portfolio', 'candor')
            )
        )
    );


//Section Title
$candor_shortcodes['foody_section_title'] = array( 
    'type'=>'foody-simple', 
    'title'=>__('Section Title', 'candor'),
    'attr'=>array(

        'title'=>array(
            'type'=>'text',
            'title'=>__('Section Title', 'candor'),
            'values'=>'Our Menus'
            )
        )
    );


//Tweets
$candor_shortcodes['foody_tweets'] = array( 
    'type'=>'radios', 
    'title'=>__('Twitter Tweets', 'candor'), 
    'attr'=>array(
        'count'=>array(
            'type'=>'text', 
            'title'=>__('Show Tweets. eg. 5','candor'),
            'value'=>'5'
            ),
        )
    );


//Contact Form Shortcode
$candor_shortcodes['foody_contact_form'] = array( 
    'type'=>'simple', 
    'title'=>__('Contact Form 7', 'candor'),
    'values'=>__('Contact Form 7 Shortcode', 'candor')
);


//Foody Open/Close Time
$candor_shortcodes['foody_open_close'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Open/Close Time', 'candor' ), 
    'attr'=>array(
        'section_title'     =>array(
            'type'      =>'text', 
            'title'     => __('Section Title', 'candor'),
            'value'     =>'We are waiting for you! Visit us',
            ),

        //Left Section
        'left_open_close_title'    =>array(
            'type'      =>'text', 
            'title'     => __('Left Open/Close Days', 'candor'),
            'value'     =>'Every Monday to Friday',
            ),
        'left_open_close_time'    =>array(
            'type'      =>'text', 
            'title'     => __('Left Open/Close Time', 'candor'),
            'value'     =>'09:00 AM - 09:30 PM',
            ), 

        //Right Section
        'right_open_close_title'    =>array(
            'type'      =>'text', 
            'title'     => __('Right Open/Close Days', 'candor'),
            'value'     =>'Every Monday to Friday',
            ),
        'right_open_close_time'    =>array(
            'type'      =>'text', 
            'title'     => __('Right Open/Close Time', 'candor'),
            'value'     =>'09:00 AM - 09:30 PM',
            ),


        )
    );

//Foody Best Deal
$candor_shortcodes['foody_best_deal'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Best Deal', 'candor' ), 
    'attr'=>array(
        'text_1'     =>array(
            'type'      =>'text', 
            'title'     => __('Text Line#1', 'candor'),
            'value'     =>'Best Deal',
            ),
        'text_2'    =>array(
            'type'      =>'text', 
            'title'     => __('Text Line#2', 'candor'),
            'value'     =>'Chicken Fry + Beef Grills',
            ),
        'text_3'    =>array(
            'type'      =>'text', 
            'title'     => __('Text Line#3', 'candor'),
            'value'     =>'Only @ <span>$25</span>',
            ), 

        )
    );

//Foody Mobile App
$candor_shortcodes['foody_mobile_app'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Mobile App', 'candor' ), 
    'attr'=>array(
        'img_url'     =>array(
            'type'      =>'text', 
            'title'     => __('Image URL', 'candor'),
            'value'     =>'#',
            ),        
        'text_1'     =>array(
            'type'      =>'text', 
            'title'     => __('Text Line#1', 'candor'),
            'value'     =>'Happy to Announce',
            ),
        'text_2'    =>array(
            'type'      =>'text', 
            'title'     => __('Text Line#2', 'candor'),
            'value'     =>'Mobile App',
            ),
        'text_3'    =>array(
            'type'      =>'text', 
            'title'     => __('Text Line#3', 'candor'),
            'value'     =>'is Available in every os platform.',
            ), 
        'btn_text'    =>array(
            'type'      =>'text', 
            'title'     => __('Left Open/Close Time', 'candor'),
            'value'     =>'Download Now',
            ), 
        'btn_url'    =>array(
            'type'      =>'text', 
            'title'     => __('Button URL', 'candor'),
            'value'     =>'#',
            ), 


        )
    );




//Elements
$candor_shortcodes['header_3'] = array( 
    'type'=>'heading', 
    'title'=>__('Elements', 'candor')
    );


//Dropcap
$candor_shortcodes['candor_dropcap'] = array( 
    'type'=>'simple', 
    'title'=>__('Dropcap', 'candor' ),
    'attr'=>array(
        'style'=>array(
            'type'=>'select', 
            'title'=>__('Dropcap Style','candor'),
            'values'=>array(
                'default'   =>'Default',
                'box'       =>'Box',
                'round'     =>'Round'
                )
            ),
        )
    );



//columns
$candor_shortcodes['candor_columns'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Columns', 'candor' ), 
    'attr'=>array(
        'column'=>array(
            'type'=>'custom'
            ),
        )
    );


//Button
$candor_shortcodes['candor_button'] = array( 
    'type'=>'radios', 
    'title'=>__('Button', 'candor'), 
    'attr'=>array(

        'size'=>array(
            'type'=>'select', 
            'title'=> __('Button Size', 'candor'), 
            'values'=>array(
                ''=>'Default',
                'xlg'=>'Extra Large',
                'lg'=>'Large',
                'sm'=>'Medium',
                'xs'    =>'Small',
                )
            ),


        'type'=>array(
            'type'=>'select', 
            'title'=> __('Button Type', 'candor'), 
            'values'=>array(
                'default'=>'Default',
                'primary'=>'Primary',
                'success'=>'Success',
                'info'  =>'Info',
                'warning'=>'Warning',
                'danger'=>'Danger',
                'link'=>'Link',
                )
            ),

        'url'=>array(
            'type'=>'text', 
            'title'=>__('Link URL', 'candor')
            ),
        'text'=>array(
            'type'=>'text', 
            'title'=>__('Text', 'candor')
            ),

        'icon'=>array(
            'type'=>'icon', 
            'title'=>__('Select Icon', 'candor'),
            'values'=> $fontawesome_icons,

            ),

        ) 

    );


// progressbar
$candor_shortcodes['candor_progressbar'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Progress Bars', 'candor' ), 
    'attr'=>array(
        'progressbar'=>array('type'=>'custom'),
        'title'=>array(
            'type'=>'text', 
            'title'=> __('Title', 'candor')
            )
        ),

    );


// Counter
$candor_shortcodes['candor_counter'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Counter', 'candor' ), 
    'attr'=>array(
        'counter'=>array('type'=>'custom')
        )
    );




//Post Types
$candor_shortcodes['header_4'] = array( 
    'type'=>'heading', 
    'title'=>__('Post Types', 'candor')
    );


//Blog Posts
$candor_shortcodes['foody_blog'] = array( 
    'type'=>'radios', 
    'title'=>__('Blog Posts', 'candor'), 
    'attr'=>array(
        'count'=>array(
            'type'=>'text', 
            'title'=>__('Show Posts. eg. 2','candor'),
            'value'=>'4'
            ),
        )
    );


//Menu
$candor_shortcodes['foody_menu'] = array( 
    'type'=>'radios', 
    'title'=>__('Menu', 'candor'), 
    'attr'=>array(
        'count'=>array(
            'type'=>'text', 
            'title'=>__('Count. eg. 4','candor'),
            'value'=>'4'
            ),
        'paginate'=>array(
            'type'=>'select', 
            'title'=>__('Show Pagination','candor'),
            'values'=>array(
                'yes'=>'Yes',
                'no'=>'No'
                )
            ),


        )
    );

//Services
$candor_shortcodes['foody_services'] = array( 
    'type'=>'radios', 
    'title'=>__('Services', 'candor'), 
    'attr'=>array(
        'count'=>array(
            'type'=>'text', 
            'title'=>__('Count. eg. 2','candor'),
            'value'=>'3'
            ),
        )
    );


//Testimonials
$candor_shortcodes['foody_testimonials'] = array( 
    'type'=>'radios', 
    'title'=>__('Testimonials', 'candor'), 
    'attr'=>array(
        'count'=>array(
            'type'=>'text', 
            'title'=>__('Count. eg. 2','candor'),
            'value'=>'3'
            ),
        )
    );



// Team
$candor_shortcodes['foody_team'] = array( 
    'type'=>'radios', 
    'title'=>__('Team/Crew', 'candor' ),
    'attr'=>array(
        'count'=>array(
            'type'=>'text', 
            'title'=> __('Column Number', 'candor'), 
            'value'=>'3'
            ),
        ) 
    );

// Events
$candor_shortcodes['foody_events'] = array( 
    'type'=>'radios', 
    'title'=>__('Events', 'candor' ),
    'attr'=>array(
        'count'=>array(
            'type'=>'text', 
            'title'=> __('Column Number', 'candor'), 
            'value'=>'4'
            ),
        ) 
    );
