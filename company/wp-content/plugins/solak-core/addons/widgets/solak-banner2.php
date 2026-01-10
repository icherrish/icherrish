<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Banner Widget.
 *
 */
class solak_Banner2 extends Widget_Base {

	public function get_name() {
		return 'solakbanner2';
	}
	public function get_title() {
		return __( 'Banner / Hero', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'banner_section',
			[
				'label' 	=> __( 'Banner', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

		solak_media_fields( $this, 'bg', 'Choose Background', ['1'] );
		solak_media_fields( $this, 'image', 'Choose Image', ['1'] );

		solak_general_fields( $this, 'info', 'Info Lists', 'TEXTAREA', '', ['1'] );
		solak_general_fields( $this, 'title', 'Title', 'TEXTAREA', 'Precision Legal Work, Attorneys Who Care' );
		solak_general_fields( $this, 'desc', 'Description', 'TEXTAREA', '', ['1'] );
        
		solak_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'Contact us' );
		solak_url_fields( $this, 'button_url', 'Button URL' );

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .hero-title', ['1'] );
		solak_common_style_fields( $this, 'desc', 'Description', '{{WRAPPER}} .hero-text', ['1'], '--white-color' );
		//------Button Style-------
		solak_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th_btn' );
		solak_button_style_fields( $this, '11', 'Button Styling', '{{WRAPPER}} .th_btn2', ['2'] );

    }

	protected function render() {

    $settings = $this->get_settings_for_display();
 
		if( $settings['layout_style'] == '1' ){
		    echo '<div class="th-hero-wrapper hero-2" id="hero" data-mask-src="'.SOLAK_ASSETS.'/img/shape/hero_bg_shape.png">';
				echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $settings['bg']['url'] ).'"></div>';
				echo '<div class="hero-style2">';
					if(!empty($settings['title'])){
						echo '<h1 class="hero-title">'.wp_kses_post($settings['title']).'</h1>';
					}
					echo '<div class="hero2-image th-anim">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
						echo wp_kses_post($settings['info']);
					echo '</div>';
					echo '<div class="hero-content">';
						if(!empty($settings['desc'])){
							echo '<p class="hero-text">'.wp_kses_post($settings['desc']).'</p>';
						}
						if(!empty($settings['button_text'])){
							echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style2 th-icon th_btn"><span class="btn-text" data-back="'.esc_attr($settings['button_text']).'" data-front="'.esc_attr($settings['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i></a>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
           
		}elseif( $settings['layout_style'] == '2' ){
		    echo '<div class="th-hero-wrapper hero-3" id="hero3" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
				if(!empty($settings['shape']['url'])){
					echo '<div class="shape-mockup jump-reverse" data-left="0%" data-bottom="0%">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['shape']['url'] ),
						));
					echo '</div>';
				}
				if(!empty($settings['shape2']['url'])){
					echo '<div class="shape-mockup jump-reverse d-none d-sm-block" data-right="0%" data-bottom="0%">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['shape2']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="container">';
					echo '<div class="row  gy-4 align-items-center">';
						echo '<div class="col-xl-7 col-lg-7">';
							echo '<div class="hero-style3">';
								if(!empty($settings['subtitle'])){
									echo '<span class="sub-title text-center text-lg-start sub">'.esc_html($settings['subtitle']).'</span>';
								}
								if(!empty($settings['title'])){
									echo '<h1 class="hero-title title">'.wp_kses_post($settings['title']).'</h1>';
								}
								if(!empty($settings['desc'])){
									echo '<p class="hero-text desc">'.wp_kses_post($settings['desc']).'</p>';
								}
								echo '<div class="btn-group justify-content-center">';
									if(!empty($settings['button_text'])){
										echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn th_btn">'.wp_kses_post($settings['button_text']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
									}
									if(!empty($settings['button_text2'])){
										echo '<a href="'.esc_url( $settings['button_url2']['url'] ).'" class="th-btn style3 th_btn2">'.wp_kses_post($settings['button_text2']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
									}
								echo '</div>';
								if($settings['show_thumb'] == 'yes'){
									echo '<div class="client-group-wrap">';
										if($settings['thumb_img']['url'] ){
											echo '<span class="thumb">';
												echo solak_img_tag( array(
													'url'   => esc_url( $settings['thumb_img']['url'] ),
												));
											echo '</span>';
										}
										echo '<div class="client-group-wrap__content">';
											if(!empty($settings['thumb_title'])){
												echo '<span class="client-group-wrap__box-title">'.wp_kses_post($settings['thumb_title']).'</span>';
											}
											if(!empty($settings['thumb_desc'])){
												echo '<div class="client-group-wrap__box-review">'.wp_kses_post($settings['thumb_desc']).'</div>';
											}
										echo '</div>';
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
						echo '<div class="col-xl-5 col-lg-5">';
							echo '<div class="hero-img shape-mockup-wrap">';
								if($settings['show_circle'] == 'yes'){
									echo '<div class="shape-mockup logo-icon-hero-3">';
										echo '<div class="logo-icon-wrap">';
											if($settings['circle_icon']['url'] ){
												echo '<h4 class="logo-icon">';
													echo solak_img_tag( array(
														'url'   => esc_url( $settings['circle_icon']['url'] ),
													));
												echo '</h4>';
											}
											if(!empty($settings['circle_title'])){
												echo '<div class="logo-icon-wrap__text">';
													echo '<span class="logo-animation">'.esc_html($settings['circle_title']).'</span>';
												echo '</div>';
											}
										echo '</div>';
									echo '</div>';
								}
								if(!empty($settings['image']['url'])){
									echo '<div class="img-main">';
										if(!empty($settings['shape3']['url'])){
											echo '<div class="hero_3_1-shape">';
												echo solak_img_tag( array(
													'url'   => esc_url( $settings['shape3']['url'] ),
												));
											echo '</div>';
										}
										echo solak_img_tag( array(
											'url'   => esc_url( $settings['image']['url'] ),
										));
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}

		
	}

}