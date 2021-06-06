<?php
/**
 * Icon Text Widget
 *
 * @package Blog_Sidebar_Widget
 */

// register Blog_Sidebar_Widget_Image_Text_Widget widget
function blog_sidebar_widget_register_image_text_widget(){
    register_widget( 'Blog_Sidebar_Widget_Image_Text_Widget' );
}
add_action('widgets_init', 'blog_sidebar_widget_register_image_text_widget');
 
 /**
 * Adds Blog_Sidebar_Widget_Image_Text_Widget widget.
 */
class Blog_Sidebar_Widget_Image_Text_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        add_action( 'admin_print_footer_scripts', array( $this,'image_text_widget_template' ) );
        parent::__construct(
			'blog_sidebar_widget_image_text_widget', // Base ID
			__( 'Blog Sidebar: Image Text', 'blog-sidebar-widget' ), // Name
			array( 'description' => __( 'An Image Text Widget.', 'blog-sidebar-widget' ), ) // Args
		);
    }

    function image_text_widget_template(){ 
        $obj = new Blog_Sidebar_Widget_Functions();
        $image = '';
        ?>
        <div class="blog-sidebar-widget-itw-template">
            <div class="image-text-widget-wrap" data-id="1"><a href="#" class="image-text-cancel"><span class="dashicons dashicons-no"></span></a>
                <?php $obj->blog_sidebar_widget_get_image_field( $this->get_field_id( 'image[]' ), $this->get_field_name( 'image[]' ), $image, __( 'Upload Image', 'blog-sidebar-widget' ) ); 
                ?>
                <p class="text">
                    <label for="<?php echo esc_attr( $this->get_field_id( 'link_text[]' ) ); ?>"><?php esc_html_e( 'Link Text', 'blog-sidebar-widget' ); ?></label> 
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text[]' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text[]' ) ); ?>" type="text" />            
                </p>
                <p class="link">
                    <label for="<?php echo esc_attr( $this->get_field_id( 'link[]' ) ); ?>"><?php esc_html_e( 'Featured Link', 'blog-sidebar-widget' ); ?></label> 
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link[]' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link[]' ) ); ?>" type="text" />            
                </p>
            </div>
        </div>
    <?php
        echo 
        '<style>
            .blog-sidebar-widget-itw-template{
                display: none;
            }
        </style>';
    }
    
    function blog_sidebar_widget_itw_get_image_id( $image_url ) {
        global $wpdb;
        $attachment = $wpdb->get_col( $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) ); 
        return $attachment[0]; 
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
        
        $obj = new Blog_Sidebar_Widget_Functions();
        $it_img_size = apply_filters( 'blog_sidebar_widget_it_img_size', 'post-slider-thumb-size' );
        $title   = ! empty( $instance['title'] ) ? $instance['title'] : '' ;	

        $target = 'target="_blank"';
        if( isset( $instance['target'] ) && $instance['target']!='' ){
            $target = 'target="_self"';
        }	
        
        echo $args['before_widget'];
        ob_start();
        if ( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title']; 
        ?>
            <ul class="blog-sidebar-widget-itw-holder">
                <?php
                if( isset( $instance['link'] ) )
                {
                    $size = sizeof( $instance['link'] );
                    $max = max( array_keys( $instance['link'] ) );
                    for ( $i=0; $i <= $max; $i++ ) {

                        if ( isset( $instance['link'][$i] ) && $instance['link'][$i] != '' ){
                            echo '<li>';
                            ?>
                            <a href="<?php echo esc_url( $instance['link'][$i] );?>" <?php echo $target;?>>
                                <?php
                                if( isset( $instance['image'][$i] ) && $instance['image'][$i] !='' ){ 
                                    $image_id = $instance['image'][$i];
                                    if ( !filter_var( $instance['image'][$i], FILTER_VALIDATE_URL ) === false ) {
                                        $image_id = $obj->blog_sidebar_widget_get_attachment_id( $instance['image'][$i] );
                                    }
                                    echo wp_get_attachment_image( $image_id, $it_img_size );
                                }
                                if( $instance['image'][$i] == '' ){
                                    //fallback svg
                                    $obj->blog_sidebar_widget_get_fallback_svg( $it_img_size );
                                }
                                ?>
                            </a>
                            <?php 

                            if( isset( $instance['link_text'][$i] ) && $instance['link_text'][$i] !='' && isset( $instance['link'][$i] ) && $instance['link'][$i] !='' )
                            { 
                                echo '<a class="btn-readmore" href="'.esc_url( $instance['link'][$i] ).'" '.$target.'>'.esc_attr( $instance['link_text'][$i] ).'</a>'; ?>								
                            <?php 
                            }
                            echo '</li>'; 
                        }
                    }
                } 
                ?>
			</ul>
        <?php 
        $html = ob_get_clean();
        echo apply_filters( 'blog_sidebar_widget_imagetext_widget_filter', $html, $args, $instance );   
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
        $title      = ! empty( $instance['title'] ) ? $instance['title'] : '' ;
        $target    = ! empty( $instance['target'] ) ? $instance['target'] : '';
        ?>
        <script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.blog-sidebar-widget-img-text-outer').sortable({
                    cursor: 'move',
                    update: function (event, ui) {
                        $('.blog-sidebar-widget-img-text-outer .image-text-widget-wrap input').trigger('change');
                    }
                });
            });
        </script>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'blog-sidebar-widget' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr($title);?>" type="text" />            
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php echo checked( $target, 1 );?> /><?php esc_html_e( 'Open in Same Tab', 'blog-sidebar-widget' ); ?> </label>
        </p>
        <div class="blog-sidebar-widget-img-text-outer" id="<?php echo esc_attr( $this->get_field_id( 'blog-sidebar-widget-img-text-outer' ) ); ?>">
            <?php
            $obj = new Blog_Sidebar_Widget_Functions();
            if( isset( $instance['link'] ) )
            {
                $size = sizeof( $instance['link']);
                $max = max( array_keys( $instance['link'] ) );
                for ( $i=0; $i <= $max; $i++ ) { 
                    if ( isset($instance['link'][$i]) && $instance['link'][$i] != '' ) {
                        ?> 
                        <div class="image-text-widget-wrap" data-id="<?php echo $i;?>"><a href="#" class="image-text-cancel"><span class="dashicons dashicons-no"></span></a>
                            <p>
                                <?php 
                                $obj->blog_sidebar_widget_get_image_field( $this->get_field_id( 'image[]' ), $this->get_field_name( 'image[]' ), !empty( $instance['image'][$i] ) ? esc_attr( $instance['image'][$i] ) : '', __( 'Upload Image', 'blog-sidebar-widget' ) ); ?>
                            </p>
                            <p class="text">
                                <label for="<?php echo esc_attr( $this->get_field_id( 'link_text[]' ) ); ?>"><?php esc_html_e( 'Link Text', 'blog-sidebar-widget' ); ?></label> 
                                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text[]' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text[]' ) ); ?>" value="<?php echo !empty( $instance['link_text'][$i] ) ? esc_attr( $instance['link_text'][$i] ) : '';?>" type="text" />            
                            </p>
                            <p class="link">
                                <label for="<?php echo esc_attr( $this->get_field_id( 'link[]' ) ); ?>"><?php esc_html_e( 'Featured Link', 'blog-sidebar-widget' ); ?></label> 
                                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link[]' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link[]' ) ); ?>" value="<?php echo !empty( $instance['link'][$i] ) ? esc_url( $instance['link'][$i] ) : '';?>" type="text" />
                            </p>

                        </div>
                <?php 
                    }   
                }
            }
            ?>
            <span class="itw-holder"></span>
        </div>
        <input class="blog-sidebar-widget-itw-add button-secondary" type="button" value="<?php _e('Add Image Text','blog-sidebar-widget');?>"><br>
        <?php
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
        $instance['title']        = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '' ;
        $instance['target']         = ! empty( $new_instance['target'] ) ? esc_attr( $new_instance['target'] ) : '';
        if( isset( $new_instance['link'] ) )
        {
            $size = sizeof($new_instance['link']);
            for ($i=0; $i < $size; $i++) { 
                $instance['image'][$i]        = ! empty( $new_instance['image'][$i] ) ? esc_attr( $new_instance['image'][$i] ) : '';
                $instance['link'][$i]         = ! empty( $new_instance['link'][$i] ) ? esc_url( $new_instance['link'][$i] ) : '';
                $instance['link_text'][$i]    = ! empty( $new_instance['link_text'][$i] ) ? esc_attr( $new_instance['link_text'][$i] ) : '';
            }
        }
        return $instance;
	}
}