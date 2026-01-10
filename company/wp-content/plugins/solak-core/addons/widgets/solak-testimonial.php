<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Testimonial Slider Widget .
 *
 */
class solak_Testimonial extends Widget_Base{

	public function get_name() {
		return 'solaktestimonialslider';
	}
	public function get_title() {
		return __( 'Testimonials', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'testimonial_slider_section',
			[
				'label' 	=> __( 'Testimonial Slider', 'solak' ), 
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five' ] );

		solak_general_fields( $this, 'subtitle', 'Subitle', 'TEXTAREA2', 'Testimonials', ['2', '3']  );
		solak_general_fields( $this, 'title', 'Title', 'TEXTAREA', 'What Our Clients Say About Our Solar Services?', ['2', '3']  );

		solak_media_fields( $this, 'quote', 'Quote Icon', ['3'] );

		solak_media_fields( $this, 'bg', 'Background Shape', ['2', '3'] );
		solak_media_fields( $this, 'bg2', 'Background Shape 1', ['2', '3'] );
		
		$repeater = new Repeater();

		solak_general_fields( $repeater, 'client_title', 'Client Title', 'TEXT', 'Efficient and Professional Team!' );
		solak_media_fields( $repeater, 'client_image', 'Client Image' );
		solak_general_fields( $repeater, 'client_name', 'Client Name', 'TEXT', 'Alex Michel' );
		solak_general_fields( $repeater, 'client_desig', 'Client Designation', 'TEXT', 'Ui/Ux Designer' );
		solak_general_fields( $repeater, 'client_feedback', 'Client Feedback', 'TEXTAREA', 'Our knowledgeable technicians are happy to provide tips' );

		solak_select_field( $repeater, 'client_rating', 'Client Rating', [ 'One Star', 'Two Star', 'Three Star', 'Four Star', 'Five Star' ] );

		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Slides', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'client_image'	=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ client_name }}}',
				'condition'		=> [ 
					'layout_style' => [ '1', '2', '3', '4', '5' ],
				],
			]
		);


		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		solak_common_style_fields( $this, '20', 'Section Subtitle', '{{WRAPPER}} .sub-title', ['2', '3'] );
		solak_common_style_fields( $this, '21', 'Section Title', '{{WRAPPER}} .sec-title', ['2', '3'] );

		solak_common_style_fields( $this, '001', 'Title', '{{WRAPPER}} .box-title2', ['1', '2', '3', '4', '5'] );

		solak_common_style_fields( $this, '01', 'Name', '{{WRAPPER}} .box-title', ['1', '2', '3', '4', '5'] );
		solak_common_style_fields( $this, '02', 'Designation', '{{WRAPPER}} .box-desig' );
		solak_common_style_fields( $this, '03', 'Feedback', '{{WRAPPER}} .box-text' );
		
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' || $settings['layout_style'] == '5' ){
			if( $settings['layout_style'] == '5'){
				$style = 'style2';
			}else{
				$style = '';
			}
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider testiSlide1 has-shadow" id="testiSlide1" data-slider-options=\'{"loop":true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1400":{"slidesPerView":"4"}}}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['slides'] as $data ){
							echo '<div class="swiper-slide">';
								echo '<div class="testi-card '.esc_attr($style).'">';
									echo '<div class="box-review">';
										if( $data['client_rating'] == '1' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
											echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
											echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
											echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
										}elseif( $data['client_rating'] == '2' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
											echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
											echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
										}elseif( $data['client_rating'] == '3' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
											echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
										}elseif( $data['client_rating'] == '4' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
										}else{
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
										}
									echo '</div>';
									if(!empty($data['client_title'])){
										echo '<h3 class="box-title2">'.esc_html( $data['client_title'] ).'</h3>';
									}
									if(!empty($data['client_feedback'])){
										echo '<p class="box-text">'.esc_html( $data['client_feedback'] ).'</p>';
									}
									echo '<div class="box-wrapp">';
										echo '<div class="box-profile">';
											if(!empty($data['client_image']['url'])){
												echo '<div class="box-author">';
													echo solak_img_tag( array(
														'url'	=> esc_url( $data['client_image']['url'] ),
													) );
												echo '</div>';
											}
											echo '<div class="box-info">';
												if(!empty($data['client_name'])){
													echo '<h3 class="box-title">'.esc_html( $data['client_name'] ).'</h3>';
												}
												if(!empty($data['client_desig'])){
													echo '<p class="box-desig">'.esc_html( $data['client_desig'] ).'</p>';
												}
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
					echo '<div class="slider-pagination"></div>';
				echo '</div>';
				echo '<button data-slider-prev="#testiSlide1" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
                echo '<button data-slider-next="#testiSlide1" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<section class="overflow-hidden space overflow-hidden" id="testi-sec">';
				echo '<div class="container">';
					echo '<div class="row justify-content-between pt-40">';
						echo '<div class="col-xl-5">';
							echo '<div class="title-area">';
								if(!empty($settings['subtitle'])){
									echo '<span class="sub-title">'.wp_kses_post($settings['subtitle']).'</span>';
								}
								if(!empty($settings['title'])){
									echo '<h2 class="sec-title">'.wp_kses_post($settings['title']).'</h2>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';

					echo '<div class="row align-items-end">';
						echo '<div class="col-xl-9">';
							echo '<div class="slider-area">';
								echo '<div class="swiper th-slider testiSlide1 has-shadow" id="testiSlide2" data-slider-options=\'{"loop":true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"},"1400":{"slidesPerView":"3"}}}\'>';
									echo '<div class="swiper-wrapper">';
										foreach( $settings['slides'] as $data ){
											echo '<div class="swiper-slide">';
												echo '<div class="testi-card style2">';
													echo '<div class="box-review">';
														if( $data['client_rating'] == '1' ){
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
															echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
															echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
															echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
														}elseif( $data['client_rating'] == '2' ){
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
															echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
															echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
														}elseif( $data['client_rating'] == '3' ){
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
															echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
														}elseif( $data['client_rating'] == '4' ){
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
														}else{
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
															echo '<i class="fa-sharp fa-solid fa-star"></i>';
														}
													echo '</div>';
													if(!empty($data['client_title'])){
														echo '<h3 class="box-title2">'.esc_html( $data['client_title'] ).'</h3>';
													}
													if(!empty($data['client_feedback'])){
														echo '<p class="box-text">'.esc_html( $data['client_feedback'] ).'</p>';
													}
													echo '<div class="box-wrapp">';
														echo '<div class="box-profile">';
															if(!empty($data['client_image']['url'])){
																echo '<div class="box-author">';
																	echo solak_img_tag( array(
																		'url'	=> esc_url( $data['client_image']['url'] ),
																	) );
																echo '</div>';
															}
															echo '<div class="box-info">';
																if(!empty($data['client_name'])){
																	echo '<h3 class="box-title">'.esc_html( $data['client_name'] ).'</h3>';
																}
																if(!empty($data['client_desig'])){
																	echo '<p class="box-desig">'.esc_html( $data['client_desig'] ).'</p>';
																}
															echo '</div>';
														echo '</div>';
													echo '</div>';
												echo '</div>';
											echo '</div>';
										}
									echo '</div>';
								echo '</div>';
							echo '</echo>';
						echo '</div>';
					echo '</div>';
					echo '<div class="testi-arrow2 text-center mt-60">';
						echo '<div class="icon-box">';
							echo '<button data-slider-prev="#testiSlide2" class="slider-arrow style2 default"><i class="far fa-arrow-left"></i></button>';
							echo '<button data-slider-next="#testiSlide2" class="slider-arrow style2 default"><i class="far fa-arrow-right"></i></button>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				if(!empty($settings['bg']['url'])){
					echo '<div class="shape-mockup testi-shape th-parallax" data-top="5%" data-left="0%">';
						echo solak_img_tag( array(
							'url'	=> esc_url( $settings['bg']['url'] ),
						) );
					echo '</div>';
				}
				if(!empty($settings['bg2']['url'])){
					echo '<div class="shape-mockup testi-img th-parallax d-none d-xl-block" data-top="0%" data-right="0%">';
						echo solak_img_tag( array(
							'url'	=> esc_url( $settings['bg2']['url'] ),
						) );
					echo '</div>';
				}
			echo '</section>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="testi-sec bg-title positive-relative overflow-hidden overflow-hidden space shape-mockup-wrap" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
				echo '<div class="container">';
					echo '<div class="testi-area-wrapp">';
						echo '<div class="title-area pe-xl-5">';
							if(!empty($settings['subtitle'])){
								echo '<span class="sub-title sub-title3">'.wp_kses_post($settings['subtitle']).'</span>';
							}
							if(!empty($settings['title'])){
								echo '<h2 class="sec-title">'.wp_kses_post($settings['title']).'</h2>';
							}
						echo '</div>';
						echo '<div class="swiper th-slider has-shadow testi-slider4" id="testi-thumb" data-slider-options=\'{"effect":"slide","loop":false,"mousewheel":true,"spaceBetween":10,"paginationType":"progressbar","breakpoints":{"0":{"slidesPerView":1},"1199":{"direction":"vertical"}}}\'>';
							echo '<div class="swiper-wrapper">';
								foreach( $settings['slides'] as $data ){
									echo '<div class="swiper-slide">';
										echo '<div class="testi-block">';
											echo '<div class="box-review">';
												if( $data['client_rating'] == '1' ){
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
													echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
													echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
													echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
												}elseif( $data['client_rating'] == '2' ){
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
													echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
													echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
												}elseif( $data['client_rating'] == '3' ){
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
													echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
												}elseif( $data['client_rating'] == '4' ){
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
												}else{
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
												}
											echo '</div>';
											if(!empty($data['client_title'])){
												echo '<h3 class="box-title2">'.esc_html( $data['client_title'] ).'</h3>';
											}
											if(!empty($data['client_feedback'])){
												echo '<p class="box-text">'.esc_html( $data['client_feedback'] ).'</p>';
											}
											echo '<div class="box-profile">';
												if(!empty($data['client_image']['url'])){
													echo '<div class="box-avater">';
														echo solak_img_tag( array(
															'url'	=> esc_url( $data['client_image']['url'] ),
														) );
													echo '</div>';
												}
												echo '<div class="media-body">';
													if(!empty($data['client_name'])){
														echo '<h3 class="box-title">'.esc_html( $data['client_name'] ).'</h3>';
													}
													if(!empty($data['client_desig'])){
														echo '<p class="box-desig">'.esc_html( $data['client_desig'] ).'</p>';
													}
												echo '</div>';
											echo '</div>';
											if(!empty($settings['quote']['url'])){
												echo '<div class="testi-quote">';
													echo solak_img_tag( array(
														'url'	=> esc_url( $settings['quote']['url'] ),
													) );
												echo '</div>';
											}
										echo '</div>';
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="slider-pagination"></div>';
						echo '</div>';
						echo '<div class="testi-thumb" data-slider-tab="#testi-thumb">';
							foreach( $settings['slides'] as $key => $data ){
								$active = ($key == 0) ? 'active' : '';
								$number = str_pad($key + 1, 2, '0', STR_PAD_LEFT);
								echo '<div class="tab-btn ' . esc_attr($active) . '">' . esc_html($number) . '</div>';
							}					
						echo '</div>';
					echo '</div>';
				echo '</div>';
				if(!empty($settings['bg2']['url'])){
					echo '<div class="shape-mockup testi-shape2" data-top="0%" data-left="0%">';
						echo solak_img_tag( array(
							'url'	=> esc_url( $settings['bg2']['url'] ),
						) );
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
            echo '<div class="row gy-30">';
				foreach( $settings['slides'] as $data ){
					echo '<div class="col-md-6 col-xl-4 col-xxl-3">';
						echo '<div class="testi-card">';
							echo '<div class="box-review">';
								if( $data['client_rating'] == '1' ){
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
									echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
									echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
									echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
								}elseif( $data['client_rating'] == '2' ){
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
									echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
									echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
								}elseif( $data['client_rating'] == '3' ){
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
									echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
								}elseif( $data['client_rating'] == '4' ){
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<span class=""><i class="fa-sharp fa-solid fa-star"></i></span>';
								}else{
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
									echo '<i class="fa-sharp fa-solid fa-star"></i>';
								}
							echo '</div>';
							if(!empty($data['client_title'])){
								echo '<h3 class="box-title2">'.esc_html( $data['client_title'] ).'</h3>';
							}
							if(!empty($data['client_feedback'])){
								echo '<p class="box-text">'.esc_html( $data['client_feedback'] ).'</p>';
							}
							echo '<div class="box-wrapp">';
								echo '<div class="box-profile">';
									if(!empty($data['client_image']['url'])){
										echo '<div class="box-author">';
											echo solak_img_tag( array(
												'url'	=> esc_url( $data['client_image']['url'] ),
											) );
										echo '</div>';
									}
									echo '<div class="box-info">';
										if(!empty($data['client_name'])){
											echo '<h3 class="box-title">'.esc_html( $data['client_name'] ).'</h3>';
										}
										if(!empty($data['client_desig'])){
											echo '<p class="box-desig">'.esc_html( $data['client_desig'] ).'</p>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
            echo '</div>';

		}


	}

}