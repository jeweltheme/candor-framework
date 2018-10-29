jQuery(document).ready(function($){
   
    //init Thickbox
    
    ////stop the flash from happening
    $('#TB_window').css('opacity',0);
    
    function calcTB_Pos() {
        $('#TB_window').css({
           'height': ($('#TB_ajaxContent').outerHeight() + 30) + 'px',
           'top' : (($(window).height() + $(window).scrollTop())/2 - (($('#TB_ajaxContent').outerHeight()-$(window).scrollTop()) + 30)/2) + 'px',
           'opacity' : 1
        });
    }
    
    setTimeout(calcTB_Pos,10);
    
    //just incase..
    setTimeout(calcTB_Pos,100);
    
    $(window).resize(calcTB_Pos);
    
    
  //Upload function
  initUpload();
            
            function initUpload(clone){
                
                var itemToInit = null;
                itemToInit = typeof clone !== 'undefined' ? clone : $('.shortcode-dynamic-item');
    
                itemToInit.find('.redux-opts-upload').on('click',function( event ) {
                    
                    var activeFileUploadContext = jQuery(this).parent();
                    var relid = jQuery(this).attr('rel-id');
    
                    event.preventDefault();
    
                    // If the media frame already exists, reopen it.
                    /*if ( typeof(custom_file_frame)!=="undefined" ) {
                        custom_file_frame.open();
                        return;
                    }*/
    
                    // if its not null, its broking custom_file_frame's onselect "activeFileUploadContext"
                    custom_file_frame = null;
    
                    // Create the media frame.
                    custom_file_frame = wp.media.frames.customHeader = wp.media({
                        // Set the title of the modal.
                        title: jQuery(this).data("choose"),
    
                        // Tell the modal to show only images. Ignore if want ALL
                        library: {
                            type: 'image'
                        },
                        // Customize the submit button.
                        button: {
                            // Set the text of the button.
                            text: jQuery(this).data("update")
                        }
                    });
    
                    custom_file_frame.on( "select", function() {
                        // Grab the selected attachment.
                        var attachment = custom_file_frame.state().get("selection").first();
    
                        // Update value of the targetfield input with the attachment url.
                        jQuery('.redux-opts-screenshot',activeFileUploadContext).attr('src', attachment.attributes.url);
                        jQuery('#' + relid ).val(attachment.attributes.url).trigger('change');
    
                        jQuery('.redux-opts-upload',activeFileUploadContext).hide();
                        jQuery('.redux-opts-screenshot',activeFileUploadContext).show();
                        jQuery('.redux-opts-upload-remove',activeFileUploadContext).show();
                });
    
                custom_file_frame.open();
            });
    
        itemToInit.find('.redux-opts-upload-remove').on('click', function( event ) {
            var activeFileUploadContext = jQuery(this).parent();
            var relid = jQuery(this).attr('rel-id');
    
            event.preventDefault();
    
            jQuery('#' + relid).val('');
            jQuery(this).prev().fadeIn('slow');
            jQuery('.redux-opts-screenshot',activeFileUploadContext).fadeOut('slow');
            jQuery(this).fadeOut('slow');
        });
    }
  
  
 
                    
  function calcPercent() {
    var $output = $("<span>");
    $output.addClass('output');
    
    //I see nothing wrong with the length of the selector.
    $("div.shortcode-options[data-name=bar_graph] .shortcode-dynamic-items > div:last-child .content:last-child").append($output);
    $("[data-slider]").bind("slider:ready slider:changed", function (event, data) {
      $(this).nextAll(".output:first").html(data.value + '%').attr('data-num',data.value);
    });
  }     
  
  calcPercent();



    var ed = tinyMCE.activeEditor;
    var content = ed.selection.getContent();
    
    $('#shortcode-content textarea').val(content);
    
    function dynamic_items(){
    
        var code = '';
        var tabID = '1', barID = '1', clientID = '1', columnID = '1', socialID='1', progressID='1', contactID='1', habitID='1', metaID='1', timelineID='1', counterID='1';
        var tabContent, barPercent, tabColumn, socialMedia, socialURL;
        var progressStyle, progressWidth, progressMin, progressMax, progressDefault, progressText
        var contactIcon, contactTitle, contactText
        var columnContent, columnSize
        var habitIcon, habitTitle, habitText
        var counterIcon, counterNumber, counterContent
        var metaIcon, metaTitle, metaText
        var fromTimeline, toTimeline, companyTimeline, jobTitle, jobDetails;
        var barTitle; 
        var clientImage, clientURL;
        
        //column
         if( $('.shortcode-options[data-name=candor_columns]').is(':visible') ){
            $('.shortcode-options[data-name=candor_columns] .shortcode-dynamic-item-size').each(function(){
              // if( $(this).val() != '' ) {
                    columnSize   = $(this).parent().parent().find('.shortcode-dynamic-item-size').val();
                    columnContent      = $(this).parent().parent().find('.shortcode-dynamic-item-text').val();
                    code += '[candor_column size="'+columnSize+'"][/candor_column]'; 
                    counterID++;
                //}
            });
         }



        //Counter
         else if( $('.shortcode-options[data-name=candor_counter]').is(':visible') ){
            $('.shortcode-options[data-name=candor_counter] .shortcode-dynamic-icon').each(function(){
              // if( $(this).val() != '' ) {
                    counterIcon   = $(this).parent().parent().find('.shortcode-dynamic-icon').val();
                    counterNumber      = $(this).parent().parent().find('.shortcode-dynamic-number').val();
                    counterContent      = $(this).parent().parent().find('.shortcode-dynamic-title').val();
                    code += '[counter icon="'+counterIcon+'" number="'+counterNumber+'" content="'+counterContent+'"][/counter]'; 
                    counterID++;
                //}
            });
         }



        // Profile Meta
        else if( $('.shortcode-options[data-name=resume_timeline]').is(':visible') ){
            $('.shortcode-options[data-name=resume_timeline] .shortcode-dynamic-from').each(function(){

                fromTimeline        = $(this).parent().parent().find('.shortcode-dynamic-from').val();
                toTimeline          = $(this).parent().parent().find('.shortcode-dynamic-to').val();
                companyTimeline     = $(this).parent().parent().find('.shortcode-dynamic-company').val();
                companyDesc         = $(this).parent().parent().find('.shortcode-dynamic-content').val();
                jobTitle            = $(this).parent().parent().find('.shortcode-dynamic-job').val();
                jobDetails          = $(this).parent().parent().find('.shortcode-dynamic-job-details').val();
                

                code += '[timeline from="'+fromTimeline+'" to="'+toTimeline+'" company="'+companyTimeline+'" jobtitle="'+jobTitle+'"]'+ jobDetails +'[/timeline]'; 
                timelineID++;
            });
        }



        //social
         else if( $('.shortcode-options[data-name=zee_social]').is(':visible') ){
            $('.shortcode-options[data-name=zee_social] .shortcode-dynamic-item-url').each(function(){
              // if( $(this).val() != '' ) {
                    socialURL      = $(this).parent().parent().find('.shortcode-dynamic-item-url').val();
                    socialMedia    = $(this).parent().parent().find('.shortcode-dynamic-item-media').val();
                    code += '[zee_media name="'+socialMedia+'" url="'+socialURL+'"]'; 
                    socialID++;
                //}
            });
         }

        // progress
        else if( $('.shortcode-options[data-name=candor_progressbar]').is(':visible') ){
            $('.shortcode-options[data-name=candor_progressbar] .shortcode-dynamic-item-width').each(function(){
              // if( $(this).val() != '' ) {
                    progressWidth   = $(this).parent().parent().find('.shortcode-dynamic-item-width').val();
                    progressText    = $(this).parent().parent().find('.shortcode-dynamic-item-text').val();


                    code += '[bar width="'+progressWidth+'"] '+ progressText +' [/bar]'; 
                    progressID++;
                //}
            });
         }
        
        // Language Skills
        else if( $('.shortcode-options[data-name=candor_language_skills]').is(':visible') ){
            $('.shortcode-options[data-name=candor_language_skills] .shortcode-dynamic-item-width').each(function(){
              // if( $(this).val() != '' ) {
                    progressWidth   = $(this).parent().parent().find('.shortcode-dynamic-item-width').val();
                    progressText    = $(this).parent().parent().find('.shortcode-dynamic-item-text').val();


                    code += '[skills width="'+progressWidth+'"] '+ progressText +' [/skills]'; 
                    progressID++;
                //}
            });
         }
                
        // Knowledge Base
        else if( $('.shortcode-options[data-name=candor_knowledge_skills]').is(':visible') ){
            $('.shortcode-options[data-name=candor_knowledge_skills] .shortcode-dynamic-item-text').each(function(){
              // if( $(this).val() != '' ) {

                    knowledgeText    = $(this).parent().parent().find('.shortcode-dynamic-item-text').val();


                    code += '[knowledge] '+ knowledgeText +' [/knowledge]'; 
                    progressID++;
                //}
            });
         }
        


        // contact info
        else if( $('.shortcode-options[data-name=angels_contact_info]').is(':visible') ){
            $('.shortcode-options[data-name=angels_contact_info] .shortcode-dynamic-icon').each(function(){
                
                    contactIcon   = $(this).parent().parent().find('.shortcode-dynamic-icon').val();
                    contactTitle   = $(this).parent().parent().find('.shortcode-dynamic-title').val();
                    contactText    = $(this).parent().parent().find('.shortcode-dynamic-content').val();

                    code += '[contact_info icon="'+contactIcon+'" title="'+contactTitle+'" ] '+ contactText +' [/contact_info]'; 
                    contactID++;
            });
         }

        // Profile Meta
        else if( $('.shortcode-options[data-name=angels_profile_meta]').is(':visible') ){
            $('.shortcode-options[data-name=angels_profile_meta] .shortcode-dynamic-icon').each(function(){

                    metaIcon   = $(this).parent().parent().find('.shortcode-dynamic-icon').val();
                    metaTitle   = $(this).parent().parent().find('.shortcode-dynamic-title').val();
                    metaText    = $(this).parent().parent().find('.shortcode-dynamic-content').val();

                    code += '[profile_meta icon="'+metaIcon+'" title="'+metaTitle+'" ] '+ metaText +' [/profile_meta]'; 
                    metaID++;
            });
         }


        // Habits and Interests info
        else if( $('.shortcode-options[data-name=angels_habits]').is(':visible') ){
            $('.shortcode-options[data-name=angels_habits] .shortcode-dynamic-icon').each(function(){

                    habitIcon   = $(this).parent().parent().find('.shortcode-dynamic-icon').val();
                    habitTitle   = $(this).parent().parent().find('.shortcode-dynamic-title').val();
                    habitText    = $(this).parent().parent().find('.shortcode-dynamic-content').val();

                    code += '[habits icon="'+habitIcon+'" title="'+habitTitle+'" ] '+ habitText +' [/habits]'; 
                    habitID++;
            });
         }



        
        $('#shortcode-storage-d').html(code);
    }
    
    function directToEditor() {
        var name = $('#ccr-shortcodes').val();
        var content = '';
        
        
        ed.selection.setContent( $('#shortcode-storage-o').text() + content);
        return false;   
    }
    
    function update_shortcode(ending){
        
        var name = $('#ccr-shortcodes').val();
        var dataType = $('#options-'+name).attr('data-type');
        var extra_attrs = '', extra_attrs2 = '', extra_attrs3 = '', extra_attrs4 = '';
        
        ending = ending || '';
        
        //take care of the dynamic events easier
        dynamic_items();
        
        //last check
        var code = ' ['+name;
        if( $('#options-'+name).attr('data-type')=='checkbox' ){
            if($('#options-'+name+' input.last').attr('checked') == 'checked') ending = '_last';
        }
        code += ending;
        
        //checkbox loop for extra attrs
        $('#options-'+name+' input[type=checkbox]').each(function(){
             if($(this).attr('checked') == 'checked' && $(this).attr('class') != 'last') extra_attrs += ' ' + $(this).attr('class')+'="true"';  
        });
        
        code += extra_attrs;
        
        //textarea loop for extra attrs
        $('#options-'+name+' textarea:not("#content")').each(function(){
             extra_attrs2 += ' ' + $(this).attr('data-attrname')+'="'+ $(this).val() +'"';  
        });
        
        if(dataType != 'dynamic') code += extra_attrs2;
        
        //select loop for extra attrs
        $('#options-'+name+' select:not(".dynamic")').each(function(){
             extra_attrs3 += ' ' + $(this).attr('id')+'="' + $(this).attr('value') + '"';   
        });
        
        code += extra_attrs3;
        
        //image upload loop for extra attrs
        $('#options-'+name+' [data-name=image-upload] img.redux-opts-screenshot').each(function(){
             extra_attrs4 += ' ' + $(this).attr('id')+'="' + $(this).attr('src') + '"'; 
        });
        
        code += extra_attrs4;
        
        //input loop for extra attrs
        $('#options-'+name+' input.attr').each(function(){
            if( $(this).attr('type') == 'text' ){ code += ' '+ $(this).attr('data-attrname')+'="'+ $(this).val()+'"'; }
            else { if($(this).attr('checked') == 'checked') code += ' '+ $(this).attr('data-attrname')+'="'+ $(this).val()+'"'; }
        });
        
        //take care of icon attrs
        if(name == 'candor_icon' && $('.icon-option i.selected').length > 0 ) code += ' image="'+ $('.icon-option i.selected').attr('class').split(' ')[0] +'"'; 
        
        code += ']';

        $('#shortcode-storage-o').html(code);
        if( dataType!= 'dynamic') $('#shortcode-storage-d').text($('#shortcode-content textarea').val());
        if( dataType != 'regular' && dataType != 'radios' && dataType != 'direct_to_editor') $('#shortcode-storage-c').html('[/'+name+ending+']');
        if( dataType == 'direct_to_editor') directToEditor();
        
     }
     
    //events
    $('#add-shortcode').click(function(){
        var name = $('#ccr-shortcodes').val();
        var dataType = $('#options-'+name).attr('data-type');
        
        update_shortcode();
        if( dataType != 'direct_to_editor') 
            ed.selection.setContent( $('#shortcode-storage-o').text() + $('#shortcode-storage-d').text() + $('#shortcode-storage-c').text() );
            
        tb_remove();
        
        return false;
    });



    //  on shortcode change

    $('.shortcode-options, #shortcode-content , #add-shortcode').hide();

    $('#ccr-shortcodes').change(function(){
        $('.shortcode-options').hide();
        $('#options-'+$(this).val()).show();

        var dataType = $('#options-'+$(this).val()).attr('data-type');
        


        if( dataType == 'checkbox' || dataType == 'simple' ){
            $('#shortcode-content').show().find('textarea').val( content );
        }
        
        else {
            $('#shortcode-content textarea').val('').parent().parent().hide();
        }

        $('#add-shortcode').show();

    });

    $('#options-box input[type="radio"]').click(function(){

        if($(this).val() == 'custom'){
            $('#custom-box-name').attr('data-attrname','style').addClass('attr');
            $('#options-box input[type="radio"]').attr('data-attrname','temp').removeClass('attr');
        }
        else{
            $('#options-box input[type="radio"]').attr('data-attrname','style').addClass('attr');
            $('#custom-box-name').attr('data-attrname','temp').removeClass('attr');
        }
    });
    
    ////Dynamic item events
    $('.add-list-item').click(function(){
        
        if(!$(this).parent().find('.remove-list-item').is(':visible')) $(this).parent().find('.remove-list-item').show();
        
        //clone item 
        var $clone = $(this).parent().find('.shortcode-dynamic-item:first').clone();
        $clone.find('input[type=text],textarea').attr('value','');
        
        //init ss if it's a bar graph
    
        
        //init new upload button and clear image if it's an upload
        if( $clone.find('.redux-opts-upload').length > 0 ) {
            $clone.find('.redux-opts-screenshot').attr('src','');
            $clone.find('.redux-opts-upload-remove').hide();
            $clone.find('.redux-opts-upload').css('display','inline-block');
            setTimeout(function(){ initUpload($clone) },200);
        }
        
        //append clone
        $(this).prevAll('div').append($clone);
        
        
        if( $clone.find('.percent').length > 0 ) calcPercent();
    
        return false;
    });
    
    $('.remove-list-item').live('click', function(){
        if($(this).parent().find('.shortcode-dynamic-item').length > 1){
            $(this).parent().find('#options-item .shortcode-dynamic-item:last').remove();
            dynamic_items();    
        }
        if($(this).parent().find('.shortcode-dynamic-item').length == 1) $(this).hide();
        
        
        return false;
    });
    
    //hide remove btn to start
    $('.remove-list-item').hide();
    
    $('.shortcode-dynamic-item-input, .shortcode-dynamic-item-text').live('keyup', function(){ dynamic_items(); });
    $('.shortcode-dynamic-item-size').live('change', function(){ dynamic_items(); });
    $(".shortcode-dynamic-item textarea").live("input propertychange", function(){ dynamic_items(); });
    
    //icon selection
    $('.icon-option i').click(function(){
        $('.icon-option i').removeClass('selected');
        $(this).addClass('selected');
    });

    
});