<?php
/**
* @version  1.0
* @package  solak
* @Author    : Themeholy
* @Author URI: https://themeforest.net/user/themeholy
*
*/

/**************************************
* Creating Recent Post Widget
***************************************/

class solak_recent_posts_widget extends WP_Widget {

        function __construct() {

            parent::__construct(

                // Base ID of your widget
                'solak_recent_posts_widget',

                // Widget name will appear in UI
                esc_html__( 'Solak :: Recent Posts', 'solak' ),

                // Widget description
                array(
                    'classname'                     => '',
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add Recent Posts Widget', 'solak' ),
                )
            );
        }

        // This is where the action happens
        public function widget( $args, $instance ) {

            $title          = apply_filters( 'widget_title', $instance['title'] );
            $show_date      = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
            $show_date_pos      = isset( $instance['show_date_pos'] ) ? $instance['show_date_pos'] : false;

            //Post Count
            if ( isset( $instance[ 'post_count' ] ) ) {
                $post_count = $instance[ 'post_count' ];
            }else {
                $post_count = '2';
            }

            //Post title Count
            if ( isset( $instance[ 'post_title_count' ] ) ) {
                $post_title_count = $instance[ 'post_title_count' ];
            }else {
                $post_title_count = '2';
            }

            //before and after widget arguments are defined by themes
            echo $args['before_widget'];
                if( !empty( $title  ) ){
                    echo '<h3 class="widget_title">'.esc_html( $title ).'</h3>';
                }

                $query_args = array(
                    "post_type"             => "post",
                    "posts_per_page"        => esc_attr( $post_count ),
                    "post_status"           => "publish",
                    "ignore_sticky_posts"   => true,
                );

                $recentposts = new WP_Query( $query_args );

                if( $recentposts->have_posts(  ) ) {
                    echo '<div class="recent-post-wrap">';
                        while( $recentposts->have_posts(  ) ) {
                            $recentposts->the_post();     
                            echo '<div class="recent-post">';
                                if( has_post_thumbnail() ){
                                    echo '<div class="media-img">';
                                        echo '<a href="'.get_the_permalink().'">';
                                            echo solak_img_tag( array(
                                                "url"   => esc_url( get_the_post_thumbnail_url( null, 'solak_90X90' ) ),
                                            ) );
                                        echo '</a>';
                                    echo '</div>';
                                }
                                echo '<div class="media-body">';
                                    if(!$show_date_pos){
                                        echo '<div class="recent-post-meta">'; 
                                            if($show_date){
                                                echo '<a href="'.esc_url( get_the_permalink() ).'"><i class="fa-sharp fa-solid fa-calendar-days"></i>'.esc_html( get_the_date() ).'</a>';
                                            }
                                        echo '</div>';
                                    }
                                    echo '<h4 class="post-title">';
                                        echo '<a class="text-inherit" href="'.esc_url( get_the_permalink() ).'">'.wp_trim_words( wp_kses_post( get_the_title() ), $post_title_count, '' ).'</a>';
                                    echo '</h4>';
                                    if($show_date_pos){
                                        echo '<div class="recent-post-meta">'; 
                                            if($show_date){
                                                echo '<a href="'.esc_url( get_the_permalink() ).'"><i class="fa-sharp fa-solid fa-calendar-days"></i>'.esc_html( get_the_date() ).'</a>';
                                            }
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        wp_reset_postdata();
                        }        
                    echo '</div>';
                }
            echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {

            //Title
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }else {
                $title = '';
            }

            //Post Count
            if ( isset( $instance[ 'post_count' ] ) ) {
                $post_count = $instance[ 'post_count' ];
            }else {
                $post_count = '3';
            }

           //Post title Count
            if ( isset( $instance[ 'post_title_count' ] ) ) {
                $post_title_count = $instance[ 'post_title_count' ];
            }else {
                $post_title_count = '5';
            }

            // Show Date
            $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
            // Show Date Position
            $show_date_pos = isset( $instance['show_date_pos'] ) ? (bool) $instance['show_date_pos'] : false;

            // Widget admin form
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'solak'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'post_count' ); ?>"><?php _e( 'Number of Posts to show:' ,'solak'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" type="text" value="<?php echo esc_attr( $post_count ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'post_title_count' ); ?>"><?php _e( 'Number of title word to show:' ,'solak'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'post_title_count' ); ?>" name="<?php echo $this->get_field_name( 'post_title_count' ); ?>" type="text" value="<?php echo esc_attr( $post_title_count ); ?>" />
            </p>
            <p>
                <input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post Date?' ); ?></label>
            </p>
            <p>
                <input class="checkbox" type="checkbox"<?php checked( $show_date_pos ); ?> id="<?php echo $this->get_field_id( 'show_date_pos' ); ?>" name="<?php echo $this->get_field_name( 'show_date_pos' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'show_date_pos' ); ?>"><?php _e( 'Date Position By Title?' ); ?></label>
            </p>
            <?php
        }


        // Updating widget replacing old instances with new

        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title']          = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['post_count']     = ( ! empty( $new_instance['post_count'] ) ) ? strip_tags( $new_instance['post_count'] ) : '';
            $instance['post_title_count']     = ( ! empty( $new_instance['post_title_count'] ) ) ? strip_tags( $new_instance['post_title_count'] ) : '';

            $instance['show_date']      = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
            $instance['show_date_pos']      = isset( $new_instance['show_date_pos'] ) ? (bool) $new_instance['show_date_pos'] : false;

            return $instance;
        }
    } // Class solak_recent_posts_widget ends here


    // Register and load the widget
    function solak_recent_posts_load_widget() {
        register_widget( 'solak_recent_posts_widget' );
    }
    add_action( 'widgets_init', 'solak_recent_posts_load_widget' );