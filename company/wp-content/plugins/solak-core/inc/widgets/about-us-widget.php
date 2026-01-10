<?php
/**
* @version  1.0
* @package  solak
* @Author    : Themeholy
* @Author URI: https://themeforest.net/user/themeholy
*
*/

/**************************************
* Creating About Us Widget
***************************************/

class solak_aboutus_widget extends WP_Widget {

        function __construct() {

            parent::__construct(
                // Base ID of your widget
                'solak_aboutus_widget',

                // Widget name will appear in UI
                esc_html__( 'Solak :: About Us Widget', 'solak' ),

                // Widget description
                array(
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add About Us Widget', 'solak' ),
                    'classname'                     => 'no-class',
                )
            );

        }

        // This is where the action happens
        public function widget( $args, $instance ) {

            $title   = apply_filters( 'widget_title', $instance['title'] );
            $about_us   = apply_filters( 'widget_about_us', $instance['about_us'] );
            $social_icon      = isset( $instance['social_icon'] ) ? $instance['social_icon'] : false;
            $logo_title      = isset( $instance['logo_title'] ) ? $instance['logo_title'] : false;

            if ( isset( $instance[ 'logo_url' ] ) ) {
                $logo_url = $instance[ 'logo_url' ];
            }else {
                $logo_url = '';
            }

            //before and after widget arguments are defined by themes
            echo $args['before_widget'];
                echo '<div class="widget footer-widget">';
                    echo '<div class="th-widget-about">';
                    if($logo_title){
                        echo '<div class="about-logo">';
                            echo '<a href="'.esc_url( home_url('/') ).'">';
                                echo solak_img_tag( array(
                                    'url'   => esc_url( $logo_url ),
                                ) );
                            echo '</a>';
                        echo '</div>';
                    }else{
                        echo '<h3 class="widget_title">'.esc_html($title).'</h3>';
                    }
                        echo '<p class="about-text">'.wp_kses_post( $about_us ).'</p>';
                        if($social_icon){
                            echo '<div class="th-social">';
                                echo solak_social_icon();
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';

            echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {
            //Logo url
            if ( isset( $instance[ 'logo_url' ] ) ) {
                $logo_url = $instance[ 'logo_url' ];
            }else {
                $logo_url = '';
            }

            //Title
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }else {
                $title = '';
            }
            
            if ( isset( $instance[ 'about_us' ] ) ) {
                $about_us = $instance[ 'about_us' ];
            }else {
                $about_us = '';
            }

            //Social text
            if ( isset( $instance[ 'social_text' ] ) ) {
                $social_text = $instance[ 'social_text' ];
            }else {
                $social_text = '';
            }

            $social_icon = isset( $instance['social_icon'] ) ? (bool) $instance['social_icon'] : false;
            $logo_title = isset( $instance['logo_title'] ) ? (bool) $instance['logo_title'] : false;
            
            // Widget admin form
            ?>
             <p>
                <input class="checkbox" type="checkbox"<?php checked( $logo_title ); ?> id="<?php echo $this->get_field_id( 'logo_title' ); ?>" name="<?php echo $this->get_field_name( 'logo_title' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'logo_title' ); ?>"><?php _e( 'Display: Checked = Logo || Unchecked=Title' ); ?></label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'logo_url' ); ?>"><?php _e( 'Logo URL:' ,'solak'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'logo_url' ); ?>" name="<?php echo $this->get_field_name( 'logo_url' ); ?>" type="text" value="<?php echo esc_attr( $logo_url ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                    <?php
                        _e( 'Title:' ,'solak');
                    ?>
                </label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" placeholder="<?php echo esc_attr__('About Us', 'solak'); ?>" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'about_us' ); ?>">
                    <?php
                        _e( 'About Text:' ,'solak');
                    ?>
                </label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'about_us' ); ?>" name="<?php echo $this->get_field_name( 'about_us' ); ?>" rows="8" cols="80"><?php echo esc_html( $about_us ); ?></textarea>
            </p>

            <p>
                <input class="checkbox" type="checkbox"<?php checked( $social_icon ); ?> id="<?php echo $this->get_field_id( 'social_icon' ); ?>" name="<?php echo $this->get_field_name( 'social_icon' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'social_icon' ); ?>"><?php _e( 'Display Social Icon?' ); ?></label>
            </p>

            <?php
        }


         // Updating widget replacing old instances with new
         public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['logo_title']      = isset( $new_instance['logo_title'] ) ? (bool) $new_instance['logo_title'] : false;
            $instance['logo_url']    = ( ! empty( $new_instance['logo_url'] ) ) ? strip_tags( $new_instance['logo_url'] ) : '';
            $instance['title']        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['about_us']           = ( ! empty( $new_instance['about_us'] ) ) ? strip_tags( $new_instance['about_us'] ) : '';
            $instance['social_text']           = ( ! empty( $new_instance['social_text'] ) ) ? strip_tags( $new_instance['social_text'] ) : '';
            $instance['social_icon']      = isset( $new_instance['social_icon'] ) ? (bool) $new_instance['social_icon'] : false;
            return $instance;
        }
    } // Class solak_aboutus_widget ends here


    // Register and load the widget
    function solak_aboutus_load_widget() {
        register_widget( 'solak_aboutus_widget' );
    }
    add_action( 'widgets_init', 'solak_aboutus_load_widget' );