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
$candor_shortcodes['angels_page_title'] = array( 
    'type'=>'angels-simple', 
    'title'=>__('Page Title', 'candor'),
    'attr'=>array(

        'title'=>array(
            'type'=>'text',
            'title'=>__('Title', 'candor'),
            'values'=>__('Portfolio', 'candor')
        ),

        'subtitle'=>array(
            'type'=>'text', 
            'title'=>__('Sub Title', 'candor'),
            'values'=>__('Top Quality Performance', 'candor')
            ),
        )
    );


//Section Title
$candor_shortcodes['angels_section_title'] = array( 
    'type'=>'angels-simple', 
    'title'=>__('Section Title', 'candor'),
    'attr'=>array(

        'title'=>array(
            'type'=>'text',
            'title'=>__('Title', 'candor'),
            'values'=>__('My Offers', 'candor')
            )
        )
    );




//Contact Form Shortcode
$candor_shortcodes['angels_contact_form'] = array( 
    'type'=>'simple', 
    'title'=>__('Contact Form 7', 'candor'),
    'values'=>__('Contact Form 7 Shortcode', 'candor')
);



//Basic
$candor_shortcodes['header_1'] = array( 
    'type'=>'heading', 
    'title'=>__('Basic', 'candor')
    );

//container
$candor_shortcodes['angels_container'] = array( 
    'type'=>'angels-simple', 
    'title'=>__('Container', 'candor'),
    );



//Dropcap
$candor_shortcodes['candor_dropcap'] = array( 
    'type'=>'simple', 
    'title'=>__('Dropcap', 'candor' ),
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




// // Habits and Interests
$candor_shortcodes['angels_profile_meta'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Profiles Meta', 'candor' ), 
    'attr'=>array(
        'habits'=>array('type'=>'custom')
        )
    );


// Profile Details
$candor_shortcodes['candor_profile_details'] = array( 
    'type'=>'simple', 
    'title'=>__('Profile Details', 'candor' ), 
    'attr'=>array(
        'image'=>array(
            'type'=>'text', 
            'title'=>__('Image. eg. 01,II,A','candor')
            ),
        
        'color'=>array(
            'type'=>'text', 
            'title'=>__('Number Color. eg. #fff','candor')
            ),
        'background'=>array(
            'type'=>'text', 
            'title'=>__('Background Color. eg. #000','candor')
            ),

        'borderradius'=>array(
            'type'=>'text', 
            'title'=>__('Type Border Radius. eg. 4px, 100%','candor')
            ),
        )
    );


// // Habits and Interests
$candor_shortcodes['resume_timeline'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Resume Timeline', 'candor' ), 
    'attr'=>array(
        'timeline'=>array('type'=>'custom')
        )
    );



//columns
$candor_shortcodes['angels_resume_button'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Resume Signature & Button', 'candor' ), 
    'attr'=>array(
        'signature'     =>array(
            'type'      =>'text', 
            'title'     => __('Signature', 'candor'),
            'value'     =>'Robert Doe',
            ),
        'resume_btn'    =>array(
            'type'      =>'text', 
            'title'     => __('Rusume Button', 'candor'),
            'value'     =>'Download Resume',
            ),
        'resume_url'    =>array(
            'type'      =>'text', 
            'title'     => __('Rusume Button URL', 'candor'),
            'value'     =>'#',
            ),
        )
    );



//Elements
$candor_shortcodes['header_3'] = array( 
    'type'=>'heading', 
    'title'=>__('Elements', 'candor')
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

// Language Skills
$candor_shortcodes['candor_language_skills'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Language Skills', 'candor' ), 
    'attr'=>array(
        'progressbar'=>array('type'=>'custom'),
        'title'=>array(
            'type'=>'text', 
            'title'=> __('Title', 'candor')
            )
        ),

    );

// Knowledge 
$candor_shortcodes['candor_knowledge_skills'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Knowledge Skills', 'candor' ), 
    'attr'=>array(
        'knowledge'=>array('type'=>'custom'),
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


// Contact Info
$candor_shortcodes['angels_contact_info'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Contact Info', 'candor' ), 
    'attr'=>array(
        'contact_info'=>array('type'=>'custom')
        )
    );

// Habits and Interests
$candor_shortcodes['angels_habits'] = array( 
    'type'=>'dynamic', 
    'title'=>__('Habits & Intersets', 'candor' ), 
    'attr'=>array(
        'habits'=>array('type'=>'custom')
        )
    );



// //Icon
// $candor_shortcodes['candor_icon'] = array( 
//     'type'=>'regular', 
//     'title'=>__('Icon', 'candor'), 
//     'attr'=>array(
//         'icons' => array(
//             'type'=>'icons', 
//             'title'=>'Icon', 
//             'values'=> $fontawesome_icons
//             )

//         ) 

//     );





//Post Types
$candor_shortcodes['header_4'] = array( 
    'type'=>'heading', 
    'title'=>__('Post Types', 'candor')
    );


//Blog Posts
$candor_shortcodes['angels_blog'] = array( 
    'type'=>'radios', 
    'title'=>__('Blog Posts', 'candor'), 
    'attr'=>array(
        'count'=>array(
            'type'=>'text', 
            'title'=>__('Count. eg. 2','candor'),
            'value'=>'2'
            ),
        )
    );


//Services
$candor_shortcodes['angels_service'] = array( 
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




$terms = array(__('All Categories', 'candor'));
foreach(get_terms('pricing_category', 'orderby=count&hide_empty=0') as $term ){

    $terms[$term->term_id] = $term->name;
} 

//pricing
$candor_shortcodes['angels_pricing'] = array( 
    'type'=>'radios', 
    'title'=>__('Pricing table', 'candor'), 
    'attr'=>array(

        'category'=>array(
            'type'=>'select', 
            'title'=> __('Category', 'candor'), 
            'values'=> $terms
            ),
        ) 

    );


// portfolio
$candor_shortcodes['angels_portfolio'] = array( 
    'type'=>'radios', 
    'title'=>__('Portfolio', 'candor' ),
    'attr'=>array(
        'column'=>array(
            'type'=>'select', 
            'title'=> __('Column Number', 'candor'), 
            'values'=>array(
                '2'=>'2',
                '3'=>'3',
                '4'=>'4',
                '5'=>'5',
                '6'=>'6',
                )
            ),
        ) 
    );


// Happy Words
$candor_shortcodes['angels_happy_words'] = array( 
    'type'=>'radios', 
    'title'=>__('Happy Words', 'candor' ),
    'attr'=>array(
        'count'=>array(
            'type'=>'text', 
            'title'=>__('Count. eg. 2','candor'),
            'value'=>'5'
            ),
        )
    );

// Happy Clients
$candor_shortcodes['angels_happy_clients'] = array( 
    'type'=>'radios', 
    'title'=>__('Happy Clients', 'candor' ),
    'attr'=>array(
        'count'=>array(
            'type'=>'text', 
            'title'=>__('Count. eg. 2','candor'),
            'value'=>'4'
            ),
        )
    );


