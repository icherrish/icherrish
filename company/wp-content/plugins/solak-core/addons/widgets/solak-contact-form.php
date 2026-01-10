<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
/**
 *
 * Contact Form Widget .
 *
 */
class solak_Contact_Form extends Widget_Base {

	public function get_name() {
		return 'solakcontactform';
	}
	public function get_title() {
		return __( 'Contact Form', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	public function get_as_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $as_cfa         = array();
        $as_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $as_forms       = get_posts( $as_cf_args );
        $as_cfa         = ['0' => esc_html__( 'Select Form', 'solak' ) ];
        if( $as_forms ){
            foreach ( $as_forms as $as_form ){
                $as_cfa[$as_form->ID] = $as_form->post_title;
            }
        }else{
            $as_cfa[ esc_html__( 'No contact form found', 'solak' ) ] = 0;
        }
        return $as_cfa;
    }

	protected function register_controls() {

		$this->start_controls_section(
			'contact_form_section',
			[
				'label' 	=> __( 'Contact Form', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five' ] ); 

		solak_general_fields( $this, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Have Any Questions?', ['1', '2', '3'] );
		solak_general_fields( $this, 'title', 'Title', 'TEXTAREA2', 'Get in Touch with Us', ['1', '2', '3', '4', '5'] );
		solak_general_fields( $this, 'desc', 'Description', 'TEXTAREA', '', ['1'] );

		$this->add_control(
            'solak_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'solak' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_as_contact_form(),
            ]
        );

		solak_media_fields( $this, 'image', 'Choose Image', ['1', '2', '5'] );
		solak_media_fields( $this, 'bg', 'Choose Background', ['2'] );
		solak_media_fields( $this, 'bg2', 'Choose Background Shape', ['2'] );

		solak_url_fields( $this, 'video_url', 'Video URL', ['2'] );
		solak_general_fields( $this, 'circle_text', 'Circle Text', 'TEXTAREA2', 'solak-solak enargy since in 1996', ['2' ] );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields( $this, '01', 'Subitle', '{{WRAPPER}} .sub-title', ['1', '2', '3'] );
		solak_common_style_fields( $this, '02', 'Title', '{{WRAPPER}} .title', ['1', '2', '3', '4', '5'] );
		solak_common_style_fields( $this, '03', 'Description', '{{WRAPPER}} .sec-desc', ['1'] );
	//------Button Style-------
	solak_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th-btn', ['3'] );

	}

	protected function render() {

	    $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="appointment-area position-relative">';
                echo '<div class="row">';
                    echo '<div class="col-lg-6">';
                        echo '<div class="title-area mb-0 text-xl-start pe-xxl-5 me-xxl-5 space">';
							if($settings['subtitle']){
								echo '<span class="sub-title">'.esc_html($settings['subtitle']).'</span>';
							}
							if($settings['title']){
								echo '<h2 class="sec-title title">'.esc_html($settings['title']).'</h2>';
							}
							if($settings['desc']){
								echo '<p class="sec-desc me-xl-5">'.esc_html($settings['desc']).'</p>';
							}
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="col-lg-6">';
                        echo '<div class="appointment-area-wrapper">';
                            echo '<div class="appointment-form input-smoke ajax-contact">';
								if( !empty($settings['solak_select_contact_form']) ){
									echo do_shortcode( '[contact-form-7  id="'.$settings['solak_select_contact_form'].'"]' ); 
								}else{
									echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'solak' ). '</p></div>';
								}
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
				if(!empty($settings['image']['url'])){
					echo '<div class="shape-mockup d-none d-xxl-block" data-bottom="0%" data-right="-10%">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="pt-50 pb-50 overflow-hidden shape-mockup-wrap" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
				echo '<div class="container">';
					echo '<div class="row gy-4 align-items-center">';
						echo '<div class="col-lg-4">';
							echo '<div class="contact-wrapp">';
								echo '<div class="discount-wrapp style3">';
									if(!empty($settings['video_url']['url'])){
										echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn popup-video"><i class="fa-solid fa-play"></i></a>';
									}
									if(!empty($settings['circle_text'])){
										echo '<div class="discount-tag">';
											echo '<span class="discount-anime">'.esc_html($settings['circle_text']).'</span>';
										echo '</div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="col-lg-6">';
							echo '<div class="me-xl-5 pe-xl-5">';
								echo '<div class="contact-form ajax-contact">';
									if($settings['subtitle']){
										echo '<span class="sub-title style1">'.esc_html($settings['subtitle']).'</span>';
									}
									if($settings['title']){
										echo '<h2 class="mb-30 title">'.esc_html($settings['title']).'</h2>';
									}
									if( !empty($settings['solak_select_contact_form']) ){
										echo do_shortcode( '[contact-form-7  id="'.$settings['solak_select_contact_form'].'"]' ); 
									}else{
										echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'solak' ). '</p></div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				if(!empty($settings['bg2']['url'])){
					echo '<div class="shape-mockup h-100 th-parallax d-none d-xl-block" data-top="0%" data-left="0%">';
						echo solak_img_tag( array(
							'url'	=> esc_url( $settings['bg2']['url'] ),
						) );
					echo '</div>';
				}
				if(!empty($settings['image']['url'])){
					echo '<div class="shape-mockup d-none d-xl-block" data-bottom="0%" data-right="0%">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
			echo '</div>';
			
		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="row gy-4 align-items-center justify-content-between">';
				echo '<div class="col-xxl-4 col-xl-5 mb-3 mb-lg-0">';
					echo '<div class="title-area text-center mb-0 text-xl-start">';
						if($settings['subtitle']){
							echo '<span class="sub-title style1">'.esc_html($settings['subtitle']).'</span>';
						}
						if($settings['title']){
							echo '<h2 class="sec-title mb-0 title">'.esc_html($settings['title']).'</h2>';
						}
					echo '</div>';
				echo '</div>';
				echo '<div class="col-xxl-8 col-xl-7">';
					echo '<div class="consultation-area">';
						echo '<div class="consultation-form ajax-contact">';
							if( !empty($settings['solak_select_contact_form']) ){
								echo do_shortcode( '[contact-form-7  id="'.$settings['solak_select_contact_form'].'"]' ); 
							}else{
								echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'solak' ). '</p></div>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="contact-form2 input-smoke ajax-contact">';
				if($settings['title']){
					echo '<h3 class="h2 mt-n3 mb-25 title">'.esc_html($settings['title']).'</h3>';
				}
				if( !empty($settings['solak_select_contact_form']) ){
					echo do_shortcode( '[contact-form-7  id="'.$settings['solak_select_contact_form'].'"]' ); 
				}else{
					echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'solak' ). '</p></div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){
			echo '<div class="appoinment-area2 bg-smoke2">';
				echo '<div class="row justify-content-between">';
					echo '<div class="col-xl-6">';
						echo '<div class="appointment-content2">';
							if($settings['title']){
								echo '<div class="title-area mb-15 text-xl-start text-center">';
									echo '<h2 class="sec-title title">'.esc_html($settings['title']).'</h2>';
								echo '</div>';
							}
							echo '<div class="appointment-form2 ajax-contact">';
								if( !empty($settings['solak_select_contact_form']) ){
									echo do_shortcode( '[contact-form-7  id="'.$settings['solak_select_contact_form'].'"]' ); 
								}else{
									echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'solak' ). '</p></div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-xl-6">';
						if(!empty($settings['image']['url'])){
							echo '<div class="contact-image2">';
								echo solak_img_tag( array(
									'url'   => esc_url( $settings['image']['url'] ),
								));
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}
		

	}

}