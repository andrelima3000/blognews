jQuery(document).ready(function($){
    $('body').on('click', '#add-faq:visible', function(e) {
        e.preventDefault();
        da = $(this).siblings('.widget-client-faq-repeater').attr('id');
        if( $('body').hasClass('elementor-editor-active') ){
            suffix = 'REPLACE_TO_ID';
        }else{
            suffix = da.match(/\d+/); 
        }
        len=0;
        $( '.faqs-repeat:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                len = (value > len) ? value : len;
            }
        });
        var newinput = $('.blog-sidebar-widget-faq-template').clone();
        len++;
        // newinput.html(function(i, oldHTML) {
        // });
        newinput.find( '.faqs-repeat' ).attr('data-id',len);
        newinput.find( '.question' ).attr('name','widget-blog_sidebar_widget_faqs_widget['+suffix+'][question]['+len+']');
        newinput.find( '.answer' ).attr('name','widget-blog_sidebar_widget_faqs_widget['+suffix+'][answer]['+len+']');
        // newinput.html(function(i, oldHTML) {
        //     return oldHTML.replace(/{{indexes}}/g, len);
        // });
        $('.cl-faq-holder').before(newinput.html()).focus().trigger('change');
    });

    
    var file_frame;
    $('.user-signature-image').on('click', function( event ){
        event.preventDefault();

        // If the media frame already exists, reopen it.
        if ( file_frame ) {
            file_frame.open();
            return;
        }
        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: $( this ).data( 'uploader_title' ),
            button: {
            text: $( this ).data( 'uploader_button_text' ),
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first().toJSON();
            $('#user_signature_image').val(attachment.url);
            // Do something with attachment.id and/or attachment.url here
        });

        // Finally, open the modal
        file_frame.open();
    });


    $('body').on('click', '.del-user-social-links', function (e){  
        var confirmation = confirm(sociconsmsg.msg);
        if( ! confirmation ){
            return false;
        }
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
            $('#add-user-socicon').focus().trigger('change');
        });
        return;
    });

    $(document).on('focus','.user-contact-social-profile',function() {
        // if($(this).val()=='')
        // {
            // if( $(this).siblings('.blog-sidebar-widget-icons-list').length < 1 )
            // {
                var $iconlist = $('.blog-sidebar-widget-icons-wrap').clone();
                $(this).after($iconlist.html());
                $(this).siblings('.blog-sidebar-widget-icons-list').fadeIn('slow');
            // }
            
            // if ( $(this).siblings('.blog-sidebar-widget-icons-list').find('#remove-icon-list').length < 1 )
            // {
                var input = '<span id="remove-icon-list" class="fas fa-times"></span>';
                $(this).siblings('.blog-sidebar-widget-icons-list:visible').prepend(input);
            // }
        // }
    });

    $(document).on('blur','.user-contact-social-profile',function(e) {
        e.preventDefault();
        $(this).siblings('.blog-sidebar-widget-icons-list').fadeOut('slow',function(){
            $(this).remove();
        });
    });

    $(document).on('click','.blog-sidebar-widget-icons-list li',function(event) {
        var prefix = $(this).children('svg').attr('data-prefix');
        var icon = $(this).children('svg').attr('data-icon');
        var val = prefix + ' fa-' + icon;

        $(this).parent().siblings('.user-social-profile').attr('value', icon);
        $(this).parent().siblings('.user-contact-social-profile').attr('value', icon);

        $(this).parent().parent().siblings('.blog-sidebar-widget-contact-social-length').attr('value','https://'+icon+'.com');
        $(this).parent().parent().siblings('.blog-sidebar-widget-social-length').attr('value','https://'+icon+'.com');
        $(this).parent().siblings('.user-social-links').attr('value','https://'+icon+'.com');

        $(this).siblings('.blog-sidebar-widget-icons-wrap-search').remove('slow');
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
        });

        $(this).parent().siblings('.user-social-profile').trigger('change');
        $(this).parent().siblings('.user-social-links').trigger('change');
        $(this).parent().siblings('.user-contact-social-profile').trigger('change');
        $(this).parent().siblings('.blog-sidebar-widget-contact-social-length').trigger('change');
        $(this).parent().siblings('.blog-sidebar-widget-social-length').trigger('change');


        event.preventDefault();
    });

    $(document).on('keyup','.user-contact-social-profile',function() {
        var value = $(this).val();
        var matcher = new RegExp(value, 'gi');
        $(this).siblings('.blog-sidebar-widget-icons-list').children('li').show().not(function(){
            return matcher.test($(this).find('svg').attr('data-icon'));
        }).hide();
    });
    
    $(document).on('keyup','.search-itw-icons',function() {
        var value = $(this).val();
        var matcher = new RegExp(value, 'gi');
        $(this).siblings('.blog-sidebar-widget-font-awesome-list').find('li').show().not(function(){
            return matcher.test($(this).find('svg').attr('data-icon'));
        }).hide();
    });
    
    $(document).on('keyup','.blog-sidebar-widget-sc-icons',function() {
        var value = $(this).val();
        var matcher = new RegExp(value, 'gi');
        $(this).siblings('.blog-sidebar-widget-font-awesome-list').find('li').show().not(function(){
            return matcher.test($(this).find('svg').attr('data-icon'));
        }).hide();
    });

    $(document).on('keyup','.blog-sidebar-widget-icons-wrap-search',function() {
        var value = $(this).val();
        var matcher = new RegExp(value, 'gi');
        $(this).parent('.blog-sidebar-widget-icons-list').children('li').show().not(function(){
            return matcher.test($(this).find('svg').attr('data-icon'));
        }).hide();
    });

    $(document).on('keyup','.user-social-profile',function() {
        var value = $(this).val();
        var matcher = new RegExp(value, 'gi');
        $(this).siblings('.blog-sidebar-widget-icons-list').children('li').show().not(function(){
            return matcher.test($(this).find('svg').attr('data-icon'));
        }).hide();
    });

    $(document).on('focus','.user-social-profile',function() {

        // if( $(this).siblings('.blog-sidebar-widget-icons-list').length < 1 )
        // {
            var $iconlist = $('.blog-sidebar-widget-icons-wrap').clone();
            $(this).after($iconlist.html());
            $(this).siblings('.blog-sidebar-widget-icons-list').fadeIn('slow');
        // }
        
        // if ( $(this).siblings('.blog-sidebar-widget-icons-list').find('#remove-icon-list').length < 1 )
        // {
            var input = '<span id="remove-icon-list" class="fas fa-times"></span>';
            $(this).siblings('.blog-sidebar-widget-icons-list:visible').prepend(input);
        // }

    });

    $(document).on('blur','.user-social-profile',function(e) {
        e.preventDefault();
        $(this).siblings('.blog-sidebar-widget-icons-list').fadeOut('slow',function(){
            $(this).remove();
        });
    });

    // $(document).on('click', function (e) {
    //     if( $(event.target).attr('class') == 'user-social-links' || $(event.target).attr('class') == 'blog-sidebar-widget-social-length' || $(event.target).attr('class') == 'blog-sidebar-widget-icons-wrap-search')
    //     {
    //       return;
    //     }
    //     $('.blog-sidebar-widget-icons-list:visible').fadeOut('slow',function(){
    //         $(this).remove();
    //     });
    //     $('.blog-sidebar-widget-icons-wrap-search:visible').fadeOut('slow',function(){
    //         $(this).remove();
    //     });
    // });


       var frame;

    // ADD IMAGE LINK
        $('body').on('click','.blog-sidebar-widget-upload-button',function(e) {
            e.preventDefault();
            var clicked = $(this).closest('div');
            var custom_uploader = wp.media({
                title: 'RARA Image Uploader',
                // button: {
                //     text: 'Custom Button Text',
                // },
                multiple: false  // Set this to true to allow multiple files to be selected
                })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                var str = attachment.url.split('.').pop(); 
                var strarray = [ 'jpg', 'gif', 'png', 'jpeg' ]; 
                if( $.inArray( str, strarray ) != -1 ){
                    clicked.find('.blog-sidebar-widget-screenshot').empty().hide().append('<img src="' + attachment.url + '"><a class="blog-sidebar-widget-remove-image"></a>').slideDown('fast');
                }else{
                    clicked.find('.blog-sidebar-widget-screenshot').empty().hide().append('<small>'+blog_sidebar_widget_theme_toolkit_pro_uploader.msg+'</small>').slideDown('fast');    
                }
                
                clicked.find('.blog-sidebar-widget-upload').val(attachment.id).trigger('change');
                clicked.find('.blog-sidebar-widget-upload-button').val(blog_sidebar_widget_theme_toolkit_pro_uploader.change);
            }) 
            .open();
        });

        $('body').on('click','.blog-sidebar-widget-remove-image',function(e) {
            var selector = $(this).parent('div').parent('div');
            selector.find('.blog-sidebar-widget-upload').val('').trigger('change');
            selector.find('.blog-sidebar-widget-remove-image').hide();
            selector.find('.blog-sidebar-widget-screenshot').slideUp();
            selector.find('.blog-sidebar-widget-upload-button').val(blog_sidebar_widget_theme_toolkit_pro_uploader.upload);
            
            return false;
        });

            // Upload / Change Image
    function blog_sidebar_widget_image_upload( button_class ) {
        
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;

        jQuery( 'body' ).on( 'click', button_class, function(e) {

            var button_id = '#' + jQuery( this ).attr( 'id' ),
                self = jQuery( button_id),
                send_attachment_bkp = wp.media.editor.send.attachment,
                button = jQuery( button_id ),
                id = button.attr( 'id' ).replace( '-button', '' );

            _custom_media = true;

            wp.media.editor.send.attachment = function( props, attachment ){

                if ( _custom_media ) {

                    jQuery( '#' + id + '-preview' ).attr( 'src', attachment.url ).css( 'display', 'block' );
                    jQuery( '#' + id + '-remove' ).css( 'display', 'inline-block' );
                    jQuery( '#' + id + '-noimg' ).css( 'display', 'none' );
                    jQuery( '#' + id ).val( attachment.url ).trigger( 'change' );  

                } else {

                    return _orig_send_attachment.apply( button_id, [props, attachment] );

                }
            };

            wp.media.editor.open( button );

            return false;
        });
    }
    blog_sidebar_widget_image_upload( '.blog-sidebar-widget-media-upload' );

        // set var
    var in_customizer = false;

    // check for wp.customize return boolean
    if (typeof wp !== 'undefined') {
        in_customizer = typeof wp.customize !== 'undefined' ? true : false;
    }

    // Remove Image
    function blog_sidebar_widget_image_remove( button_class ) {

        jQuery( 'body' ).on( 'click', button_class, function(e) {

            var button = jQuery( this ),
            id = button.attr( 'id' ).replace( '-remove', '' );
            jQuery( '#' + id + '-preview' ).css( 'display', 'none' );
            jQuery( '#' + id + '-noimg' ).css( 'display', 'block' );
            button.css( 'display', 'none' );
            jQuery( '#' + id ).val( '' ).trigger( 'change' );

        });
    }
    blog_sidebar_widget_image_remove( '.blog-sidebar-widget-media-remove' );

    $('body').on('click', '#add-user-socicon', function (e){ 
        e.preventDefault();
        da = $(this).siblings('.blog-sidebar-widget-sortable-icons').attr('id');
        if( $('body').hasClass('elementor-editor-active') ){
            suffix = 'REPLACE_TO_ID';
        }else{
            suffix = da.match(/\d+/); 
        }
        var maximum=0;
        $( '.social-share-list' ).each(function() {
        var value =  $(this).attr( 'data-id' );
        if(!isNaN(value))
        {
        	value = parseInt(value);
        	maximum = (value > maximum) ? value : maximum;
        }
        });
        var newField = $( '.blog-sidebar-widget-socicon-template' ).clone();
    	maximum++;
    	var name = 'widget-blog_sidebar_widget_author_bio['+suffix+'][socicon]['+maximum+']';
    	newField.find( '.user-social-links' ).attr('name',name);

        var profile = 'widget-blog_sidebar_widget_author_bio['+suffix+'][socicon_profile]['+maximum+']';
        newField.find( '.user-social-profile' ).attr('name',profile);

        newField.html(function(i, oldHTML) {
            return oldHTML.replace(/{{socicon_index}}/g, maximum);
        });
        $( '.blog-sidebar-widget-socicon-holder' ).before(  newField.html() );
    });

    $('body').on('click', '.blog-sidebar-widget-social-add', function(e) {
        e.preventDefault();
        da = $(this).siblings('.blog-sidebar-widget-sortable-links').attr('id');
        if( $('body').hasClass('elementor-editor-active') ){
            suffix = 'REPLACE_TO_ID';
        }else{
            suffix = da.match(/\d+/); 
        }
        var maximum=0;
        $( '.blog-sidebar-widget-social-icon-wrap:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                maximum = (value > maximum) ? value : maximum;
            }
        });
        var newinput = $('.blog-sidebar-widget-social-template').clone();
        maximum++;
        newinput.find( '.blog-sidebar-widget-social-length' ).attr('name','widget-blog_sidebar_widget_social_links['+suffix+'][social]['+maximum+']');
        newinput.find( '.user-social-profile' ).attr('name','widget-blog_sidebar_widget_social_links['+suffix+'][social_profile]['+maximum+']');
        newinput.html(function(i, oldHTML) {
            return oldHTML.replace(/{{indexes}}/g, maximum);
        });

        $(this).siblings('.blog-sidebar-widget-sortable-links').find('.blog-sidebar-widget-social-icon-holder').before(newinput.html());
    });

    $('body').on('click', '.del-blog-sidebar-widget-icon', function() {
        var con = confirm(sociconsmsg.msg);
        if (!con) {
            return false;
        }
        $(this).parent().fadeOut('slow', function() {
            $(this).remove();
            $('.blog-sidebar-widget-social-title-test').focus().trigger('change');
        });
        return;
    });

    $('body').on('click', '.del-contact-blog-sidebar-widget-icon', function() {
        var con = confirm(sociconsmsg.msg);
        if (!con) {
            return false;
        }
        $(this).parent().fadeOut('slow', function() {
            $(this).remove();
            $('.blog-sidebar-widget-contact-social-title-test').focus().trigger('change');
        });
        return;
    });


    $('body').on('click', '.blog-sidebar-widget-contact-social-add:visible', function(e) {
        e.preventDefault();
        da = $(this).siblings('.blog-sidebar-widget-contact-sortable-links').attr('id');
        if( $('body').hasClass('elementor-editor-active') ){
            suffix = 'REPLACE_TO_ID';
        }else{
            suffix = da.match(/\d+/); 
        }
        var maximum=0;
        $( '.blog-sidebar-widget-contact-social-icon-wrap:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                maximum = (value > maximum) ? value : maximum;
            }
        });
        var newinput = $('.blog-sidebar-widget-contact-social-template').clone();
        maximum++;
        newinput.find( '.blog-sidebar-widget-contact-social-length' ).attr('name','widget-blog_sidebar_widget_contact_social_links['+suffix+'][social]['+maximum+']');
        newinput.find( '.user-contact-social-profile' ).attr('name','widget-blog_sidebar_widget_contact_social_links['+suffix+'][social_profile]['+maximum+']');
        newinput.html(function(i, oldHTML) {
            return oldHTML.replace(/{{ind}}/g, maximum);
        });
        $(this).siblings('.blog-sidebar-widget-contact-sortable-links').find('.blog-sidebar-widget-contact-social-icon-holder').before(newinput.html()).trigger('change');
    });
    // $(document).on('click','.blog-sidebar-widget-icons-wrap-search',function() {
    //     if($(this).val()=='')
    //     {
    //         if( $(this).siblings('.blog-sidebar-widget-icons-list').length < 1 )
    //         {
    //             var $iconlist = $('.blog-sidebar-widget-icons-wrap').clone();
    //             $(this).after($iconlist.html());
    //             $(this).siblings('.blog-sidebar-widget-icons-list').fadeIn('slow');
    //         }
            
    //         if ( $(this).siblings('.blog-sidebar-widget-icons-list').find('.blog-sidebar-widget-icons-wrap-search').length < 1 )
    //         {
    //             // var input = '<span id="remove-icon-list" class="dashicons dashicons-no"></span>';
    //             // $(this).siblings('.blog-sidebar-widget-icons-list:visible').prepend(input);
    //             $('.blog-sidebar-widget-icons-wrap-search').attr('value','');
    //         }
    //     }
    // });


    $('body').on('click', '.blog-sidebar-widget-itw-add', function(e) {
        e.preventDefault();
        da = $(this).siblings('.blog-sidebar-widget-img-text-outer').attr('id');
        if( $('body').hasClass('elementor-editor-active') ){
            suffix = 'REPLACE_TO_ID';
        }else{
            suffix = da.match(/\d+/); 
        }
        var maximum=0;
        $( '.image-text-widget-wrap:visible' ).each(function() {
            var value =  $(this).attr( 'data-id' );
            if(!isNaN(value))
            {
                value = parseInt(value);
                maximum = (value > maximum) ? value : maximum;
            }
        });
        var newinput = $('.blog-sidebar-widget-itw-template').clone();
        
        newinput.html(function(i, oldHTML) {
                maximum++;
            
            newinput.find( '.image-text-widget-wrap' ).attr('data-id',maximum);
            newinput.find( '.text input' ).attr('name','widget-blog_sidebar_widget_image_text_widget['+suffix+'][link_text][]');
            newinput.find( '.link input' ).attr('name','widget-blog_sidebar_widget_image_text_widget['+suffix+'][link][]');
            newinput.find( '.widget-upload input' ).attr('name','widget-blog_sidebar_widget_image_text_widget['+suffix+'][image][]');

            newinput.find( '.text input' ).attr('id','widget-blog_sidebar_widget_image_text_widget['+suffix+'][link_text][]');
            newinput.find( '.link input' ).attr('id','widget-blog_sidebar_widget_image_text_widget['+suffix+'][link][]');
            newinput.find( '.widget-upload input' ).attr('id','widget-blog_sidebar_widget_image_text_widget['+suffix+'][image][]');

            newinput.find( '.text label' ).attr('for','widget-blog_sidebar_widget_image_text_widget['+suffix+'][link_text][]');
            newinput.find( '.link label' ).attr('for','widget-blog_sidebar_widget_image_text_widget['+suffix+'][link][]');
            newinput.find( '.widget-upload label' ).attr('for','widget-blog_sidebar_widget_image_text_widget['+suffix+'][image][]');

            // newinput.find( '.blog-sidebar-widget-screenshot' ).attr('id','widget-blog_sidebar_widget_image_text_widget-'+suffix+'-image');

            // oldHTML.replace(/{{indexes}}/g, maximum);
        });

        $(this).siblings('.blog-sidebar-widget-img-text-outer').find('.itw-holder').before(newinput.html());
        // $(this).siblings('.blog-sidebar-widget-sortable-links').find('.blog-sidebar-widget-social-icon-holder').before(newinput.html());
    });
    $('body').on('click', '.image-text-cancel', function(e) {
        e.preventDefault();
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
        });
    });
    $('body').on('click', '#remove-icon-list', function(e) {
        e.preventDefault();
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
        });
    });

    $('body').on('click', '.add-logo:visible', function(e) {
        e.preventDefault();
        da = $(this).siblings('.widget-client-logo-repeater').attr('id');
        if( $('body').hasClass('elementor-editor-active') ){
            suffix = 'REPLACE_TO_ID';
        }else{
            suffix = da.match(/\d+/); 
        }
        var len = $('.link-image-repeat:visible').length;
        len++;
        var newinput = $('.blog-sidebar-widget-client-logo-template').clone();
        newinput.html(function(i, oldHTML) {
            newinput.find( '.featured-link' ).attr('name','widget-blog_sidebar_widget_client_logo_widget['+suffix+'][link]['+len+']');
            newinput.find( '.widget-upload .link' ).attr('name','widget-blog_sidebar_widget_client_logo_widget['+suffix+'][image]['+len+']');
            $('.widget-client-logo-repeater').trigger('change');
        });
        $(this).siblings('.widget-client-logo-repeater').find('.cl-repeater-holder').before(newinput.html());

    });
    $('body').on('click', '.cross', function(e) {
        e.preventDefault();
        $(this).parent().fadeOut('slow',function(){
            $(this).remove();
            $('.widget-client-logo-repeater').trigger('change');
        });
    });

    $(document).on('click', '.blog-sidebar-widget-font-group li', function() {
        var id = $(this).parents('.widget').attr('id');
        $('#' + id).find('.blog-sidebar-widget-font-group li').removeClass();
        $('#' + id).find('.icon-receiver').children('a').remove('.blog-sidebar-widget-remove-icon');
        $(this).addClass('selected');
        var prefix =  $(this).parents('.blog-sidebar-widget-font-awesome-list').find('.blog-sidebar-widget-font-group li.selected').children('svg').attr('data-prefix');
        var icon =  $(this).parents('.blog-sidebar-widget-font-awesome-list').find('.blog-sidebar-widget-font-group li.selected').children('svg').attr('data-icon');
        var aa = prefix + ' fa-' + icon;
        $(this).parents('.blog-sidebar-widget-font-awesome-list').siblings('p').find('.hidden-icon-input').val(aa);
        $(this).parents('.blog-sidebar-widget-font-awesome-list').siblings('p').find('.icon-receiver').html('<i class="' + aa + '"></i>');
        $('#' + id).find('.icon-receiver').children('i').after('<a class="blog-sidebar-widget-remove-icon"></a>');

        if (in_customizer) {
            $('.hidden-icon-input').trigger('change');
        }
        return $(this).focus().trigger('change');
    });
    $(document).on('click', '.blog-sidebar-widget-remove-icon', function() {
        var id = $(this).parents('.widget').attr('id');
        $('#' + id).find('.blog-sidebar-widget-font-group li').removeClass();
        $('#' + id).find('.hidden-icon-input').val('');
        $('#' + id).find('.icon-receiver').html('<i class=""></i>').children('a').remove('.blog-sidebar-widget-remove-icon');
        if (in_customizer) {
            $('.hidden-icon-input').trigger('change');
        }
        return $('#' + id).find('.icon-receiver').trigger('change');
    });

    /** To add remove button if icon is selected in widget update event */
    $(document).on('widget-updated', function(e, widget) {
        // "widget" represents jQuery object of the affected widget's DOM element
        var $this = $('#' + widget[0].id).find('.yes');
            $this.append('<a class="blog-sidebar-widget-remove-icon"></a>');
    });

    blog_sidebar_widget_pro_check_icon();

    /** function to check if icon is selected and saved when loading in widget.php */
    function blog_sidebar_widget_pro_check_icon() {
        $('.icon-receiver').each(function() {
            // var id = $(this).parents('.widget').attr('id');
            if($(this).hasClass('yes'))
            {
                $(this).append('<a class="blog-sidebar-widget-remove-icon"></a>');
            }
        });
    }
    function initColorPicker(widget) {
        widget.find('.my-widget-color-field').wpColorPicker({
         change: _.throttle(function () { // For Customizer
         jQuery(this).trigger('change');
            }, 3000)
        });
    }
    function onFormUpdate(event, widget) {
       initColorPicker(widget);
    }

    jQuery(document).on('widget-added widget-updated', onFormUpdate);

});
