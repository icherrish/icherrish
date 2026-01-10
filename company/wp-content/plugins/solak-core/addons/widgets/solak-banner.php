<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Banner Slider Widget.
 *
 */
class Solak_Banner1 extends Widget_Base {

	public function get_name() {
		return 'solakbanner1';
	}
	public function get_title() {
		return __( 'Banner Slider', 'solak' );
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
				'label' 	=> __( 'Banner Slider', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', ['Style One', 'Style Two'] ); 

		solak_media_fields($this, 'overlay', 'Choose Overlay', ['1']);
		solak_media_fields($this, 'title_icon', 'Choose Title Icon', ['2']);

		$repeater = new Repeater();

		solak_media_fields($repeater, 'bg', 'Choose Background');
		solak_general_fields($repeater, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Empower Your Future With');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA', 'Solar Power Energy');
		solak_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Contact us');
		solak_url_fields($repeater, 'button_url', 'Button URL');
		
		$this->add_control(
			'banner_slides',
			[
				'label' 		=> __( 'Banners', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'We offer home', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

		$repeater = new Repeater();

		solak_media_fields($repeater, 'bg', 'Choose Background');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA', 'Green Future with Wind Energy');
		solak_general_fields($repeater, 'desc', 'Description', 'TEXTAREA', 'Solari is a leading solar company dedicated');
		solak_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Discover more');
		solak_url_fields($repeater, 'button_url', 'Button URL');
		solak_general_fields($repeater, 'video_text', 'Video Text', 'TEXT', 'Watch Our Story');
		solak_url_fields($repeater, 'video_url', 'Video URL');
		
		$this->add_control(
			'banner_slides2',
			[
				'label' 		=> __( 'Banners', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'We offer home', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['2']
				]
			]
		);

		solak_switcher_fields( $this, 'show_sec', 'Show Bottom Section', ['1'] );
		solak_media_fields($this, 'image', 'Choose Image', ['1'] );
		solak_media_fields($this, 'image2', 'Choose Image 2', ['1'] );
		solak_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'Cost Savings', ['1'] );
		solak_general_fields($this, 'desc', 'Description', 'TEXTAREA', '', ['1'] );
		solak_media_fields($this, 'icon', 'Icon', ['1']);

		solak_switcher_fields( $this, 'show_social', 'Show Social', ['2'] );
		solak_social_fields($this, 'social_icon_list', 'Social List', ['2'] );

		solak_general_fields($this, 'button_text', 'Button Text', 'TEXT', 'Discover more', ['2'] );
		solak_url_fields($this, 'button_url', 'Button URL', ['2'] );

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields( $this, '01', 'Subtitle', '{{WRAPPER}} .sub-title', ['1'] );
		solak_common_style_fields( $this, '02', 'Title', '{{WRAPPER}} .hero-title', ['1', '2'] );
		solak_common_style_fields( $this, '03', 'Desc', '{{WRAPPER}} .hero-text', ['2'] );
		//------Button Style-------
		solak_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th_btn', ['1', '2'] );

		solak_common_style_fields( $this, '001', 'Box Title', '{{WRAPPER}} .box-title', ['1'] );
		solak_common_style_fields( $this, '002', 'Box Text', '{{WRAPPER}} .box-text', ['1'] );

    }

	protected function render() {

    $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="th-hero-wrapper hero-1" id="hero">';
				echo '<div class="swiper th-slider hero-slider-1" id="heroSlide1" data-slider-options=\'{"effect":"fade"}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['banner_slides'] as $key => $data ){
							echo '<div class="swiper-slide">';
								echo '<div class="hero-inner">';
									echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['bg']['url'] ).'">';
										if($settings['overlay']['url'] ){
											echo '<div class="hero-shape-1" data-ani="slideinleft" data-ani-delay="0.7s">';
												echo solak_img_tag( array(
													'url'   => esc_url( $settings['overlay']['url'] ),
												)); 
											echo '</div>';
										}
									echo '</div>';
									echo '<div class="container">';
										echo '<div class="hero-style1">';
											if(!empty($data['subtitle'])){
												echo '<span class="sub-title" data-ani="slideindown" data-ani-delay="0.2s">'.esc_html($data['subtitle']).'</span>';
											}
											if(!empty($data['title'])){
												echo '<h1 class="hero-title" data-ani="slideinleft" data-ani-delay="0.4s">'.wp_kses_post($data['title']).'</h1>';
											}
											if(!empty($data['button_text'])){
												echo '<div class="btn-group justify-content-lg-start justify-content-center" data-ani="slideinup" data-ani-delay="0.6s">';
													echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style1 th-icon th_btn"><span class="btn-text" data-back="'.esc_attr($data['button_text']).'" data-front="'.esc_attr($data['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i></a>';
												echo '</div>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
					echo '<button data-slider-prev="#heroSlide" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
					echo '<button data-slider-next="#heroSlide" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
				echo '</div>';
				if($settings['show_sec'] == 'yes'){
				echo '<div class="hero-over-image">';
					echo '<div class="container">';
						echo '<div class="row gy-4">';
							echo '<div class="col-xl-5 col-lg-4">';
								if($settings['image']['url'] ){
									echo '<div class="hero-image global-img">';
										echo solak_img_tag( array(
											'url'   => esc_url( $settings['image']['url'] ),
										)); 
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="col-xl-3 col-lg-4">';
								echo '<div class="hero1-item">';
									if($settings['icon']['url'] ){
										echo '<div class="box-icon">';
											echo solak_img_tag( array(
												'url'   => esc_url( $settings['icon']['url'] ),
											)); 
										echo '</div>';
									}
									echo '<div class="box-content">';
										if(!empty($settings['title'])){
											echo '<h3 class="box-title">'.esc_html($settings['title']).'</h3>';
										}
										if(!empty($settings['desc'])){
											echo '<p class="box-text">'.esc_html($settings['desc']).'</p>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
							echo '<div class="col-xl-4 col-lg-4">';
								if($settings['image2']['url'] ){
									echo '<div class="hero-image global-img">';
										echo solak_img_tag( array(
											'url'   => esc_url( $settings['image2']['url'] ),
										)); 
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				}
			echo '</div>';
           
		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="th-hero-wrapper hero-3" id="hero">';
				echo '<div class="swiper th-slider hero-slider-3" id="heroSlide3" data-slider-options=\'{"effect":"fade"}\'>';
					echo '<div class="swiper-wrapper">';
					foreach( $settings['banner_slides2'] as $key => $data ){
						echo '<div class="swiper-slide">';
							echo '<div class="hero-inner">';
								echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['bg']['url'] ).'"></div>';
								echo '<div class="container">';
									echo '<div class="hero-style3">';
										if(!empty($data['title'])){
											echo '<h1 class="hero-title" data-ani="slideinleft" data-ani-delay="0.4s">';
												echo wp_kses_post($data['title']);
												echo solak_img_tag( array(
													'url'   => esc_url( $settings['title_icon']['url'] ),
												)); 
											echo '</h1>';
										}
										if(!empty($data['desc'])){
											echo '<p class="hero-text" data-ani="slideinleft" data-ani-delay="0.6s">'.wp_kses_post($data['desc']).'</p>';
										}
										echo '<div class="btn-group justify-content-center justify-content-lg-start">';
											if(!empty($data['button_text'])){
												echo '<div class="" data-ani="slideinleft" data-ani-delay="0.8s">';
													echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style1 th-radius th-icon th_btn"><span class="btn-text" data-back="'.esc_attr($data['button_text']).'" data-front="'.esc_attr($data['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i> </a>';
												echo '</div>';
											}
											if(!empty( $data['video_url']['url'] )){
												echo '<div class="call-btn" data-ani="slideinright" data-ani-delay="0.9s">';
													echo '<a href="'.esc_url( $data['video_url']['url'] ).'" class="play-btn popup-video"><i class="fas fa-play"></i></a>';
													if(!empty($data['video_text'])){
														echo '<div class="media-body">';
															echo '<a href="'.esc_url( $data['video_url']['url'] ).'" class="btn-title popup-video">'.esc_html($data['video_text']).'</a>';
														echo '</div>';
													}
												echo '</div>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
					echo '<button data-slider-prev="#heroSlide3" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
					echo '<button data-slider-next="#heroSlide3" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
				echo '</div>';
				if($settings['show_social'] == 'yes'){
					echo '<div class="social-links">';
						foreach( $settings['social_icon_list'] as $social_icon ){
							$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
							$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

							echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

							\Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );

							echo '</a> ';
						}
					echo '</div>';
				}
				if(!empty($settings['button_text'])){
					echo '<div class="hero-btn">';
						echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style1 th-icon"><span class="btn-text" data-back="'.esc_attr($settings['button_text']).'" data-front="'.esc_attr($settings['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i></a>';
					echo '</div>';
				}
			echo '</div>';

		}

		
	}

} 