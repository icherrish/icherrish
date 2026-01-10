<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
/**
 * 
 * Newsletter Widget .
 *
 */
class Solak_Newsletter extends Widget_Base {

	public function get_name() {
		return 'solaknewsletter';
	}
	public function get_title() {
		return __( 'Newsletter', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label'     => __( 'Newsletter Style', 'solak' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );
		
		solak_media_fields( $this, 'bg', 'Choose Background', ['1'] );
		solak_general_fields( $this, 'subtitle', 'Subtitle', 'TEXT', 'Newsletter', ['1'] );
		solak_general_fields( $this, 'title', 'Title', 'TEXT2', 'Sign Up to get latest Update', ['1'] );
		solak_general_fields( $this, 'newsletter_placeholder', 'Placeholder', 'TEXT', 'Enter your Email' );
		solak_general_fields( $this, 'newsletter_button', 'Subscribe Button', 'TEXT', 'Subscribe' );

		solak_media_fields( $this, 'shape', 'Choose Shape', ['1'] );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields($this, '01', 'Subtitle', '{{WRAPPER}} .subscribe-box_text');
		solak_common_style_fields($this, '02', 'Title', '{{WRAPPER}} .subscribe-box_title');
		

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="news-letter-1-wrapper" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
				if(!empty($settings['shape']['url'])){
					echo '<div class="shape-mockup jump d-none d-xxl-block z-index-3" data-top="10%" data-left="0">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['shape']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="container">';
					echo '<div class="subscribe-box">';
						echo '<div class="row gy-40 gx-60 align-items-center justify-content-center">';
							echo '<div class="col-xl-6">';
								if($settings['subtitle']){
									echo '<p class="subscribe-box_text">'.wp_kses_post($settings['subtitle']).'</p>';
								}
								if($settings['title']){
									echo '<h4 class="subscribe-box_title">'.wp_kses_post($settings['title']).'</h4>';
								}
							echo '</div>';
							echo '<div class="col-xl-6 col-lg-8">';
								echo '<form class="newsletter-form">';
									echo '<div class="form-group">';
										echo '<input class="form-control" type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" required="">';
									echo '</div>';
									echo '<button type="submit" class="th-btn theme-bg">'.wp_kses_post( $settings['newsletter_button'] ).'<i class="fa-regular fa-arrow-right-long"></i></button>';
								echo '</form>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){

		}
	

	}
}
						