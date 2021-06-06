<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       
 * @since      1.0.0
 *
 * @package    Blog_Sidebar_Widget
 * @subpackage Blog_Sidebar_Widget/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Blog_Sidebar_Widget
 * @subpackage Blog_Sidebar_Widget/admin
 * @author     
 */
class Blog_Sidebar_Widget_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = BSW_PLUGIN_VERSION;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Blog_Sidebar_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Blog_Sidebar_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/blog-sidebar-widget-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'chosen', plugin_dir_url( __FILE__ ) . 'css/chosen.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'wp-color-picker' ); 
    	wp_enqueue_style('thickbox');

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Blog_Sidebar_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Blog_Sidebar_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_media();
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/blog-sidebar-widget-admin.js', array( 'jquery','wp-color-picker' ), $this->version, true );
		wp_localize_script( $this->plugin_name, 'blog_sidebar_widget_theme_toolkit_pro_uploader', array(
        	'upload' => __( 'Upload', 'blog-sidebar-widget' ),
        	'change' => __( 'Change', 'blog-sidebar-widget' ),
        	'msg'    => __( 'Please upload valid image file.', 'blog-sidebar-widget' )
    	));
		$confirming = array( 
					'msg'       => __( 'Are you sure?', 'blog-sidebar-widget' ),
					'category'	=> __('Select Categories','blog-sidebar-widget')
					);
		wp_localize_script( $this->plugin_name, 'sociconsmsg', $confirming );

		wp_localize_script( $this->plugin_name, 'sociconsmsg', array(
				'msg' => __( 'Are you sure you want to delete this Social Media?', 'blog-sidebar-widget' )));

		wp_enqueue_script( 'chosen', plugin_dir_url( __FILE__ ) . 'js/chosen.jquery.min.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( 'font-awesome', plugin_dir_url( __FILE__ ) . 'js/fontawesome/all.js', array( 'jquery'), '5.6.3', true );
		wp_enqueue_script( 'v4-shims', plugin_dir_url( __FILE__ ) . 'js/fontawesome/v4-shims.js', array( 'jquery'), '5.6.3', true );
	}

    public function blog_sidebar_widget_icon_list_enqueue(){
		$obj = new Blog_Sidebar_Widget_Functions;
		$socicons = $obj->blog_sidebar_widget_icon_list();
		echo '<div class="blog-sidebar-widget-icons-wrap-template"><div class="blog-sidebar-widget-icons-wrap"><ul class="blog-sidebar-widget-icons-list">';
		foreach ($socicons as $socicon) {
			if($socicon == 'rss'){
				echo '<li><i class="fas fa-'.$socicon.'"></i></li>';
			}
			else{
				echo '<li><i class="fab fa-'.$socicon.'"></i></li>';
			}
			
		}
		echo'</ul></div></div>';
		echo '<style>
		.blog-sidebar-widget-icons-wrap{
			display:none;
		}
		</style>';
	}
	
	/*
	  * Add a form field in the new category page
	  * @since 1.0.0
	 */
	 public function blog_sidebar_widget_add_category_image ( $taxonomy ) { ?>
	   <div class="form-field term-group">
	     <label for="category-image-id"><?php _e('Image', 'blog-sidebar-widget'); ?></label>
	     <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
	     <div id="category-image-wrapper"></div>
	     <p>
	       <input type="button" class="button button-secondary blog_sidebar_widget_tax_media_button" id="blog_sidebar_widget_tax_media_button" name="blog_sidebar_widget_tax_media_button" value="<?php _e( 'Add Image', 'blog-sidebar-widget' ); ?>" />
	       <input type="button" class="button button-secondary blog_sidebar_widget_tax_media_remove" id="blog_sidebar_widget_tax_media_remove" name="blog_sidebar_widget_tax_media_remove" value="<?php _e( 'Remove Image', 'blog-sidebar-widget' ); ?>" />
	    </p>
	   </div>
	 <?php
	 }
	 
	 /*
	  * Save the form field
	  * @since 1.0.0
	 */
	 public function blog_sidebar_widget_save_category_image ( $term_id ) {
	    if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
	      $image = $_POST['category-image-id'];
	      add_term_meta( $term_id, 'category-image-id', absint( $image ), true );
	    }
	 }
	 
	 /*
	  * Edit the form field
	  * @since 1.0.0
	 */
	 public function blog_sidebar_widget_update_category_image ( $term, $taxonomy='' ) { ?>
	   <tr class="form-field term-group-wrap">
	     <th scope="row">
	       <label for="category-image-id"><?php _e( 'Image', 'blog-sidebar-widget' ); ?></label>
	     </th>
	     <td>
	       <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
	       <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
	       <div id="category-image-wrapper">
	         <?php if ( isset( $image_id ) && $image_id!='' ) { ?>
	           <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
	         <?php } ?>
	       </div>
	       <p>
	         <input type="button" class="button button-secondary blog_sidebar_widget_tax_media_button" id="blog_sidebar_widget_tax_media_button" name="blog_sidebar_widget_tax_media_button" value="<?php _e( 'Add Image', 'blog-sidebar-widget' ); ?>" />
	         <input type="button" class="button button-secondary blog_sidebar_widget_tax_media_remove" id="blog_sidebar_widget_tax_media_remove" name="blog_sidebar_widget_tax_media_remove" value="<?php _e( 'Remove Image', 'blog-sidebar-widget' ); ?>" />
	       </p>
	     </td>
	   </tr>
	 <?php
	 }

	/*
	 * Update the form field value
	 * @since 1.0.0
	 */
	 public function blog_sidebar_widget_updated_category_image ( $term_id ) {
	   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
	     $image = $_POST['category-image-id'];
	     update_term_meta ( $term_id, 'category-image-id', absint( $image ) );
	   } else {
	     update_term_meta ( $term_id, 'category-image-id', '' );
	   }
	 }

	/*
	 * Add script
	 * @since 1.0.0
	 */
	public function blog_sidebar_widget_add_script() { ?>
	   <script>
	     jQuery(document).ready( function($) {
	       function ct_media_upload(button_class) {
	         var _custom_media = true,
	         _orig_send_attachment = wp.media.editor.send.attachment;
	         $('body').on('click', button_class, function(e) {
	           var button_id = '#'+$(this).attr('id');
	           var send_attachment_bkp = wp.media.editor.send.attachment;
	           var button = $(button_id);
	           _custom_media = true;
	           wp.media.editor.send.attachment = function(props, attachment){
	             if ( _custom_media ) {
	               $('#category-image-id').val(attachment.id);
	               $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
	               $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
	             } else {
	               return _orig_send_attachment.apply( button_id, [props, attachment] );
	             }
	            }
	         wp.media.editor.open(button);
	         return false;
	       });
	     }
	     ct_media_upload('.blog_sidebar_widget_tax_media_button.button'); 
	     $('body').on('click','.blog_sidebar_widget_tax_media_remove',function(){
	       $('#category-image-id').val('');
	       $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
	     });
	     // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
	     $(document).ajaxComplete(function(event, xhr, settings) {
	       var queryStringArr = settings.data.split('&');
	       if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
	         var xml = xhr.responseXML;
	         $response = $(xml).find('term_id').text();
	         if($response!=""){
	           // Clear the thumb image
	           $('#category-image-wrapper').html('');
	         }
	       }
	     });
	   });
	 </script>
	 <?php 
	}

	function blog_sidebar_widget_custom_column_header( $columns ){
	  $columns['header_name'] = 'Thumbnail'; 
	  return $columns;
	}


	// To show the column value
	function blog_sidebar_widget_custom_column_content( $value, $column_name, $tax_id ){
	   	$img = get_term_meta( $tax_id, 'category-image-id', false );
	   	$ret = '';
	   	if(isset($img[0]) && $img[0]!='')
		{
			$url = wp_get_attachment_image_url($img[0],'thumbnail');
			$ret = '<img src="'.esc_url($url).'" class="tax-img">';
		}
	   	return $ret;
	}

	function blog_sidebar_widget_client_logo_template(){
		 ?>
		<div class="blog-sidebar-widget-client-logo-template">
			<div class="link-image-repeat"><span class="cross"><a href="#"><i class="fa fa-times"></i></a></span>
				<div class="widget-client-logo-repeater" id="widget-blog_sidebar_widget_client_logo_widget-2-bttkthemecompanion-logo-repeater">
		            <div class="widget-upload">
		            	<label for="widget-blog_sidebar_widget_client_logo_widget-2-image"><?php _e('Upload Image','blog-sidebar-widget');?></label><br>
		            	<input id="widget-blog_sidebar_widget_client_logo_widget-2-image" class="blog-sidebar-widget-upload link" type="hidden" name="widget-blog_sidebar_widget_client_logo_widget[2][image][]" value="" placeholder="No file chosen">
						<input id="upload-widget-blog_sidebar_widget_client_logo_widget-2-image" class="blog-sidebar-widget-upload-button button" type="button" value="Upload">
						<div class="blog-sidebar-widget-screenshot" id="widget-blog_sidebar_widget_client_logo_widget-2-image-image"></div>
					</div>
					<div class="widget-feat-link">
		                <label for="widget-blog_sidebar_widget_client_logo_widget-2-link"><?php _e('Featured Link','blog-sidebar-widget');?></label> 
		                <input class="widefat featured-link" id="widget-blog_sidebar_widget_client_logo_widget-2-link" name="widget-blog_sidebar_widget_client_logo_widget[2][link][]" type="text" value="">            
		            </div>
	        	</div>
        	</div>
	    </div>
	<?php
	echo '<style>.blog-sidebar-widget-client-logo-template{display:none;}</style>';
	}

	function blog_sidebar_widget_faq_template(){
		?> 
		<div class="blog-sidebar-widget-faq-template">
			<div class="faqs-repeat" data-id=""><span class="fa fa-times cross"></span>
	            <label for="widget-raratheme_companion_faqs_widget-2-question-1"><?php _e('Question','blog-sidebar-widget');?></label> 
	            <input class="widefat question" id="widget-raratheme_companion_faqs_widget-2-question-1" name="widget-raratheme_companion_faqs_widget[2][question][1]" type="text" value="">   
	            <label for="widget-raratheme_companion_faqs_widget-2-answer-1"><?php _e('Answer','blog-sidebar-widget');?></label> 
	            <textarea class="answer" id="widget-raratheme_companion_faqs_widget-2-answer-1" name="widget-raratheme_companion_faqs_widget[2][answer][1]"></textarea>         
	        </div>
	    </div>
        <?php
		echo '<style>.blog-sidebar-widget-faq-template{display:none;}</style>';
    }


}
	 