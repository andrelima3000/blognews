<?php
/**
 * Icon Text Widget
 *
 * @package Blog_Sidebar_Widget
 */

// register Blog_Sidebar_Widget_Advertisement_Widget widget
function blog_sidebar_widget_register_advertisement_widget(){
    register_widget( 'Blog_Sidebar_Widget_Advertisement_Widget' );
}
add_action('widgets_init', 'blog_sidebar_widget_register_advertisement_widget');
 
 /**
 * Adds Blog_Sidebar_Widget_Advertisement_Widget widget.
 */
class Blog_Sidebar_Widget_Advertisement_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
			'blog_sidebar_widget_advertisement_widget', // Base ID
			__( 'Blog Sidebar: Advertisement Widget', 'blog-sidebar-widget' ), // Name
			array( 'description' => __( 'An Advertisement Widget.', 'blog-sidebar-widget' ), ) // Args
		);
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        
        $obj       = new Blog_Sidebar_Widget_Functions();
        $title     = ! empty( $instance['title'] ) ? $instance['title'] : '' ;		
        $image     = ! empty( $instance['image'] ) ? $instance['image'] : '';
        $code      = ! empty( $instance['code'] ) ? $instance['code'] : '';
        $link      = ! empty( $instance['link'] ) ? $instance['link'] : '';
        $ad_option = ! empty( $instance['advertisement-option'] ) ? $instance['advertisement-option'] : 'photo';

        if( $image ){
            $attachment_id = $image;
            if ( !filter_var( $image, FILTER_VALIDATE_URL ) === false ) {
                $attachment_id = $obj->blog_sidebar_widget_get_attachment_id( $image );
            }
            $icon_img_size = apply_filters( 'blog_sidebar_widget_ad_img_size', 'thumbnail' );   
        }else{
        	$code = $code;
        }
        
        echo $args['before_widget'];
        ob_start(); 
        ?>        
            <div class="blog-sidebar-widget-add-holder">
                <div class="blog-sidebar-widget-add-inner-holder">
                    <div class="text-holder">
	                    <?php 
	                        if( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title'];
                        ?>                              
                    </div>
                    <?php if( $image &&  $ad_option == 'photo' ){ ?>
                        <div class="icon-holder">
                            <?php
                            $target = 'target="_blank"';
                            if( isset( $instance['target'] ) && $instance['target'] !='' ){
                                $target = 'target="_self"';
                            }

                            if( isset( $link ) && $link != '' ){
                                echo '<a href="'.esc_url( $link ).'" '.$target.'>'?>
                            <?php }

                            echo wp_get_attachment_image( $attachment_id, $icon_img_size, false, 
                                        array( 'alt' => esc_html( $title )));

                            if( isset( $link ) && $link != '' ){ echo '</a>'; } ?>

                        </div>
                    <?php } else{ 
                            echo html_entity_decode( $code ); 
                        }	               
                    ?>                
        
                </div>
			</div>
        <?php
        $html = ob_get_clean();
        echo apply_filters( 'blogsiderbar_advertisement_widget_filter', $html, $args, $instance );    
        echo $args['after_widget'];
    }

    /**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        
        $obj       = new Blog_Sidebar_Widget_Functions();
        $title     = ! empty( $instance['title'] ) ? $instance['title'] : '' ;		
        $image     = ! empty( $instance['image'] ) ? $instance['image'] : '';
        $link      = ! empty( $instance['link'] ) ? $instance['link'] : '';
        $code      = ! empty( $instance['code'] ) ? $instance['code'] : '';
        $target    = ! empty( $instance['target'] ) ? $instance['target'] : '';
        $ad_option = ! empty( $instance['advertisement-option'] ) ? $instance['advertisement-option'] : 'photo';
        ?>
		
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'blog-sidebar-widget' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />            
		</p>

        <p>
            <label><?php _e('Display Advertisement from:','blog-sidebar-widget'); ?></label>
            <input class="ad-option" type="radio" name="<?php echo esc_attr( $this->get_field_name( 'advertisement-option' ) );?>" id="<?php echo esc_attr( $this->get_field_id( 'advertisement-option' . '-text' ) );?>" value="text" <?php if( $ad_option == 'text' ) echo 'checked'; ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'advertisement-option' ) . '-text' );?>" class="radio-btn-wrap"><?php _e('Ad Code','blog-sidebar-widget');?></label>
            <input class="ad-option" type="radio" name="<?php echo esc_attr( $this->get_field_name( 'advertisement-option' ) );?>" id="<?php echo esc_attr( $this->get_field_id( 'advertisement-option' . '-photo' ) );?>" value="photo" <?php if( $ad_option == 'photo' ) echo 'checked'; ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'advertisement-option' ) . '-photo' );?>" class="radio-btn-wrap"><?php _e('Uploaded Photo','blog-sidebar-widget');?></label>
        </p>
        
        <?php $obj->blog_sidebar_widget_get_image_field( $this->get_field_id( 'image' ), $this->get_field_name( 'image' ), $image, __( 'Upload Image', 'blog-sidebar-widget' ) ); ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php echo checked($target,1);?> /><?php esc_html_e( 'Open in Same Tab', 'blog-sidebar-widget' ); ?> </label>
        </p>
        
        <p class="ad-feat-link">
            <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Featured Link', 'blog-sidebar-widget' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_url( $link ); ?>" />            
        </p>

        <p class="ad-link">
            <label for="<?php echo esc_attr( $this->get_field_id( 'code' ) ); ?>"><?php esc_html_e( 'Ad Code', 'blog-sidebar-widget' ); ?></label> 
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'code' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'code' ) ); ?>"><?php echo $code; ?></textarea>            
        </p>
        
        <?php
        echo 
        '<script>
        jQuery(document).ready(function($){
            $( ".ad-option:checked" ).each(function() {
                var val = $(this).val();
                if( val == "text" )
                {
                    $(this).parent().next(".widget-upload").hide();
                    $(this).parent().siblings(".ad-link").show();
                    $(this).parent().siblings(".ad-feat-link").hide();

                }
                if( val == "photo" )
                {
                    $(this).parent().siblings(".ad-link").hide();
                    $(this).parent().siblings(".ad-feat-link").show();
                    $(this).parent().siblings(".widget-side-note").hide();
                }
            });

            $(".ad-option").change(function () {
               if( $(this).val() == "text" )
               {
                    $(this).parent().next(".widget-upload").hide();
                    $(this).parent().siblings(".ad-link").show();
                    $(this).parent().siblings(".ad-feat-link").hide();

               }
               if( $(this).val() == "photo" )
               {
                    $(this).parent().siblings(".ad-link").hide();
                    $(this).parent().siblings(".ad-feat-link").show();
                    $(this).parent().next(".widget-upload").show();
               }
            });
        });
        </script>';
	}
    
    /**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
        $instance['title']                = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '' ;
        $instance['image']                = ! empty( $new_instance['image'] ) ? esc_attr( $new_instance['image'] ) : '';
        $instance['link']                 = ! empty( $new_instance['link'] ) ? esc_attr( $new_instance['link'] ) : '';
        $instance['code']                 = ! empty( $new_instance['code'] ) ? esc_attr( $new_instance['code'] ) : '';
        $instance['advertisement-option'] = ! empty( $new_instance['advertisement-option'] ) ? esc_attr($new_instance['advertisement-option']) : 'photo';
        $instance['target']               = ! empty( $new_instance['target'] ) ? esc_attr( $new_instance['target'] ) : '';

        return $instance;
	}
    
}  // class Blog_Sidebar_Widget_Advertisement_Widget / class Blog_Sidebar_Widget_Advertisement_Widget 