<?php 

function jwtheme_option_element( $name, $attr_option, $type, $shortcode ){
    
    $option_element = null;

    if( !isset($attr_option['value']) ) $attr_option['value']='';
    
    (isset($attr_option['desc']) && !empty($attr_option['desc'])) ? $desc = '<p class="description">'.$attr_option['desc'].'</p>' : $desc = '';

    switch( $attr_option['type'] ){
        
        case 'radio':

        $option_element .= '<div class="label"><strong>'.$attr_option['title'].': </strong></div><div class="content">';
        foreach( $attr_option['opt'] as $val => $title ){

            (isset($attr_option['def']) && !empty($attr_option['def'])) ? $def = $attr_option['def'] : $def = '';

            $option_element .= '
            <label for="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'">'.$title.'</label>
            <input class="attr" type="radio" data-attrname="'.$name.'" name="'.$shortcode.'-'.$name.'" value="'.$val.'" id="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'"'. ( $val == $def ? ' checked="checked"':'').'>';
        }
        
        $option_element .= $desc . '</div>';
        
        break;
        
        case 'checkbox':
        
        $option_element .= '<div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div>    <div class="content"> <input type="checkbox" class="' . $name . '" id="' . $name . '" />'. $desc. '</div> ';
        
        break;  

        case 'select':
        
        $option_element .= '
        <div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        
        <div class="content"><select id="'.$name.'">';
        $values = $attr_option['values'];
        foreach( $values as $index=>$value ){
            $option_element .= '<option value="'.$index.'">'.$value.'</option>';
        }
        $option_element .= '</select>' . $desc . '</div>';
        
        break;  

        case 'icon':
        case 'class':
        
        $option_element .= '
        <div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        
        <div class="content"><select id="'.$name.'">';
        $values = $attr_option['values'];
        $option_element .= '<option value=""> -None- </option>';
        foreach( $values as $index=>$value ){
            $option_element .= '<option value="'.$value.'">'.$value.'</option>';
        }
        $option_element .= '</select>' . $desc . '</div>';
        
        break;
        
        case 'icons':
        
        $option_element .= '

        <div class="icon-option">';
        $values = $attr_option['values'];
        foreach( $values as $value ){
            $option_element .= '<i class="'.$value.'"></i>';
        }
        $option_element .= $desc . '</div>';
        
        break;
        
        case 'custom':


        if( $name == 'progressbar' ){
            $option_element .= '
            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">

                    <div class="label">
                    <label><strong> Width: </strong> eg. 70</label>
                    </div>

                    <div class="content">
                    <input id="width" class="shortcode-dynamic-item-width" type="text">
                    </div>  


                    <div class="label">
                    <label><strong> Content: </strong> eg. wordpress</label>
                    </div>

                    <div class="content">
                    <input id="content" class="shortcode-dynamic-item-text" type="text">
                    </div>  


                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'candor' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'candor' ).'</a>';
            
        } 

        if( $name == 'knowledge' ){
            $option_element .= '
            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">

                    <div class="label">
                    <label><strong> Content: </strong> eg. Web Developer</label>
                    </div>

                    <div class="content">
                    <input id="content" class="shortcode-dynamic-item-text" type="text">
                    </div>  


                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'candor' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'candor' ).'</a>';
            
        } 

        if( $name == 'contact_info' ){
            $option_element .= '

            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">



                    <div class="label">
                    <label><strong> Icon: </strong> eg. icons icon-call-in</label>
                    </div>

                    <div class="content">
                    <input id="icon" class="shortcode-dynamic-icon" type="text">
                    </div>  


                    <div class="label">
                    <label><strong> Title: </strong> eg. Phone</label>
                    </div>

                    <div class="content">
                    <input id="title" class="shortcode-dynamic-title" type="text">
                    </div>  

                    <div class="label">
                    <label><strong> Content: </strong> eg. +012 3456789</label>
                    </div>

                    <div class="content">
                    <input id="content" class="shortcode-dynamic-content" type="text">
                    </div>  


                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'candor' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'candor' ).'</a>';            
        } 

        if( $name == 'habits' ){
            $option_element .= '

            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">



                    <div class="label">
                    <label><strong> Icon: </strong> eg. icons icon-call-in</label>
                    </div>

                    <div class="content">
                    <input id="icon" class="shortcode-dynamic-icon" type="text">
                    </div>  


                    <div class="label">
                    <label><strong> Title: </strong> eg. Phone</label>
                    </div>

                    <div class="content">
                    <input id="title" class="shortcode-dynamic-title" type="text">
                    </div>  

                    <div class="label">
                    <label><strong> Content: </strong> eg. +012 3456789</label>
                    </div>

                    <div class="content">
                        <textarea id="content" class="shortcode-dynamic-content"></textarea>                 
                    </div>  



                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'candor' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'candor' ).'</a>';            
        } 


        if( $name == 'counter' ){
            $option_element .= '

            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">



                    <div class="label">
                    <label><strong> Icon: </strong> eg. fa-clock-o</label>
                    </div>
                    <div class="content">
                    <input id="icon" class="shortcode-dynamic-icon" type="text">
                    </div>  

                    <div class="label">
                    <label><strong> Number: </strong> eg. 239</label>
                    </div>
                    <div class="content">
                        <input id="number" class="shortcode-dynamic-number" type="text">
                    </div>  

                    <div class="label">
                    <label><strong> Title: </strong> eg. Hours Worked</label>
                    </div>
                    <div class="content">
                    <input id="title" class="shortcode-dynamic-title" type="text">
                    </div>    



                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'candor' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'candor' ).'</a>';            
        }         



        if( $name == 'profile_meta' ){
            $option_element .= '

            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">



                    <div class="label">
                    <label><strong> Icon: </strong> eg. fa-calender</label>
                    </div>

                    <div class="content">
                    <input id="icon" class="shortcode-dynamic-icon" type="text">
                    </div>  


                    <div class="label">
                    <label><strong> Title: </strong> eg. Phone</label>
                    </div>

                    <div class="content">
                    <input id="title" class="shortcode-dynamic-title" type="text">
                    </div>  

                    <div class="label">
                    <label><strong> Content: </strong> eg. +012 3456789</label>
                    </div>

                    <div class="content">
                        <textarea id="content" class="shortcode-dynamic-content"></textarea>                 
                    </div>  



                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'candor' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'candor' ).'</a>';            
        } 




        if( $name == 'timeline' ){
            $option_element .= '

            <div class="shortcode-dynamic-items" id="timeline-item" data-name="item">

                <div class="shortcode-dynamic-item">



                    <div class="label">
                    <label><strong> From: </strong> eg. 2012</label>
                    </div>
                    <div class="content">
                    <input id="from" class="shortcode-dynamic-from" type="text">
                    </div>  


                    <div class="label">
                    <label><strong> To: </strong> eg. Present</label>
                    </div>
                    <div class="content">
                    <input id="to" class="shortcode-dynamic-to" type="text">
                    </div>  


                    <div class="label">
                    <label><strong> Company Name: </strong> eg. Company Name</label>
                    </div>
                    <div class="content">
                    <input id="company" class="shortcode-dynamic-company" type="text">
                    </div>  


                    <div class="label">
                    <label><strong> Content: </strong></label>
                    </div>
                    <div class="content">
                        <textarea id="content" class="shortcode-dynamic-content"></textarea>                 
                    </div>  


                    <div class="label">
                    <label><strong> Job Title: </strong> eg. Job Title</label>
                    </div>
                    <div class="content">
                    <input id="job" class="shortcode-dynamic-job" type="text">
                    </div>  


                    <div class="label">
                    <label><strong> Job Details: </strong></label>
                    </div>
                    <div class="content">
                        <textarea id="job-details" class="shortcode-dynamic-job-details"></textarea>                 
                    </div>  



                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'candor' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'candor' ).'</a>';            
        } 




        elseif( $name == 'social' ){
            $option_element .= '
            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">

                    <div class="label">
                        <label><strong>Select Media: </strong></label>
                    </div>

                    <div class="content">
                        <select id="media" class="shortcode-dynamic-item-media dynamic">
                            <option value="facebook">Facebook</option>  
                            <option value="twitter">Twitter</option>
                            <option value="gplus">Google Plus</option>
                            <option value="flickr">Flickr</option>  
                            <option value="pintrest">Pintrest</option>
                            <option value="linkedin">Linkedin</option>  
                            <option value="youtube">Youtube</option>
                            <option value="skype">Skype</option>
                            <option value="github">Github</option>  
                            <option value="dribbble">Dribbble</option>
                            <option value="instagram">Instagram</option>                    
                        </select>
                    </div>




                    <div class="label">
                        <label><strong> Url: </strong></label>
                    </div>

                    <div class="content">
                        <input id="url" class="shortcode-dynamic-item-url" type="text">
                    </div>  

                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'candor' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'candor' ).'</a>';
            
        } 


        elseif( $name == 'column' ){
            $option_element .= '
            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">

                    <div class="label"><label><strong>Column Size: </strong></label></div>
                    <div class="content">
                        <select name="" class="shortcode-dynamic-item-size dynamic">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>


                    <div class="label"><label><strong> Content: </strong></label></div>
                    <div class="content"><textarea class="shortcode-dynamic-item-text" type="text" name="" /></textarea></div>
                </div>
            </div>
            <a href="#" class="btn yellow remove-list-item">'.__('Remove Column', 'candor' ). '</a> <a href="#" class="btn yellow add-list-item">'.__('Add Column', 'candor' ).'</a>';
            
        } 



        elseif( $name == 'profile' ){
            $option_element .= '

            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">



                    <div class="label">
                    <label><strong> Icon: </strong> eg. icons icon-call-in</label>
                    </div>

                    <div class="content">
                    <input id="icon" class="shortcode-dynamic-icon" type="text">
                    </div>  


                    <div class="label">
                    <label><strong> Title: </strong> eg. Phone</label>
                    </div>

                    <div class="content">
                    <input id="title" class="shortcode-dynamic-title" type="text">
                    </div>  

                    <div class="label">
                    <label><strong> Content: </strong> eg. +012 3456789</label>
                    </div>

                    <div class="content">
                        <textarea id="content" class="shortcode-dynamic-content"></textarea>                 
                    </div>  



                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'candor' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'candor' ).'</a>';       
            
        } 
        



        
        elseif( $name == 'image' ){
            $option_element .= '
            <div class="shortcode-dynamic-item" id="options-item" data-name="image-upload">
            <div class="label"><label><strong> '.$attr_option['title'].' </strong></label></div>
            <div class="content">

            <input type="hidden" id="options-item"  />
            <img class="redux-opts-screenshot" id="image_url" src="" />
            <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);"class="redux-opts-upload button-secondary" rel-id="">' . __('Upload', 'candor') . '</a>
            <a href="javascript:void(0);" class="redux-opts-upload-remove" style="display: none;">' . __('Remove Upload', 'candor') . '</a>';

            if(!empty($desc)) $option_element .= $desc;

            $option_element .='
            </div>
            </div>';
        }
        
    
        
        elseif( $type == 'checkbox' ){
            $option_element .= '<div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div>    <div class="content"> <input type="checkbox" class="' . $name . '" id="' . $name . '" />' . $desc . '</div> ';
        } 
        
        
        break;
        
        case 'textarea':
        $option_element .= '
        <div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        <div class="content"><textarea data-attrname="'.$name.'">'.$attr_option['value'].'</textarea> ' . $desc . '</div>';
        break;

        case 'color':
        $option_element .= '
        <div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        <div class="content"><input class="attr" type="color" data-attrname="'.$name.'" value="'.$attr_option['value'].'" />' . $desc . '</div>';
        break;

        case 'text':
        default:
        $option_element .= '
        <div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        <div class="content"><input class="attr" type="text" data-attrname="'.$name.'" value="'.$attr_option['value'].'" />' . $desc . '</div>';
        break;
    }
    
    $option_element .= '<div class="clear"></div>';

    return $option_element;
}

