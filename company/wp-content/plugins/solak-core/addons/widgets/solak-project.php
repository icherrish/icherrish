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
 * Project Widget .
 *
 */
class Solak_Project extends Widget_Base {

	public function get_name() {
		return 'solakproject';
	}
	public function get_title() {
		return __( 'Projects', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'project_section',
			[
				'label'		 	=> __( 'Projects', 'solak' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five', 'Style Six', 'Style Seven' ] );

		solak_media_fields($this, 'bg', 'Choose Background', ['1', '2']);
		solak_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'Our Projects', ['2']);

		$repeater = new Repeater();

		solak_media_fields($repeater, 'image', 'Choose Image');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Bay Area Solar Farm');
		solak_general_fields($repeater, 'desc', 'Description', 'TEXTAREA2', 'Your Legal Shield');
		solak_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'View Details');
		solak_url_fields($repeater, 'button_url', 'Button URL');

		solak_general_fields($repeater, 'f_title1', 'Feature Title 1', 'TEXTAREA2', '96');
		solak_general_fields($repeater, 'f_content1', 'Feature Content 1', 'TEXTAREA2', 'Capacity');
		solak_general_fields($repeater, 'f_title2', 'Feature Title 2', 'TEXTAREA2', '160');
		solak_general_fields($repeater, 'f_content2', 'Feature Content 2', 'TEXTAREA2', 'Total Area');
		solak_general_fields($repeater, 'f_title3', 'Feature Title 3', 'TEXTAREA2', '2023');
		solak_general_fields($repeater, 'f_content3', 'Feature Content 3', 'TEXTAREA2', 'Year Built');
		solak_general_fields($repeater, 'f_title4', 'Feature Title 4', 'TEXTAREA2', '16');
		solak_general_fields($repeater, 'f_content4', 'Feature Content 4', 'TEXTAREA2', 'USD Dollar Budget');
		
		$this->add_control(
			'projects',
			[
				'label' 		=> __( 'Projects', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Initial Consultation', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '7']
				]
			]
		);

		$repeater = new Repeater();

		solak_media_fields($repeater, 'image', 'Choose Image');
		solak_general_fields($repeater, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Renewable Energy');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Wind Turbine ECO Farm');
		solak_url_fields($repeater, 'project_url', 'Button URL');
		
		$this->add_control(
			'projects2',
			[
				'label' 		=> __( 'Projects', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Wind Turbine ECO Farm', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => [ '2', '3', '4', '5', '6' ]
				]
			]
		);

		solak_general_fields($this, 'button_text', 'Button Text', 'TEXT', 'Show More Projects', ['3']);
		solak_url_fields($this, 'button_url', 'Button URL', ['3']);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields( $this, '01', 'Subtitle', '{{WRAPPER}} .box-subtitle', ['2', '3'] );
		solak_common2_style_fields( $this, '02', 'Title', '{{WRAPPER}} .box-title a', ['1', '2', '3'] );
		solak_common_style_fields( $this, '03', 'Description', '{{WRAPPER}} .box-text', ['1'] );
		//------Button Style-------
		solak_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th-btn', ['1'] );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="project-box-static-wrap">';
				foreach( $settings['projects'] as $key => $data ){
					echo '<div class="project-box-static" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
						echo '<div class="project-box">';
							if($data['image']['url'] ){
								echo '<div class="project-box-img">';
									echo solak_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									)); 
								echo '</div>';
							}
							echo '<div class="project-box-details">';
								if(!empty($data['title'])){
									echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.wp_kses_post($data['title']).'</a></h3>';
								}
								if(!empty($data['desc'])){
									echo '<p class="box-text">'.esc_html($data['desc']).'</p>';
								}
								echo '<div class="counter-grid_wrapp">';
									if( !empty($data['f_title1'] || $data['f_content1']) ){
										echo '<div class="counter-grid">';
											if(!empty($data['f_title1'])){
												echo '<h3 class="counter-grid-title">'.wp_kses_post($data['f_title1']).'</h3>';
											}
											if(!empty($data['f_content1'])){
												echo '<p class="counter-text mb-0">'.esc_html($data['f_content1']).'</p>';
											}
										echo '</div>';
									}
									if( !empty($data['f_title2'] || $data['f_content2']) ){
										echo '<div class="counter-grid">';
											if(!empty($data['f_title2'])){
												echo '<h3 class="counter-grid-title">'.wp_kses_post($data['f_title2']).'</h3>';
											}
											if(!empty($data['f_content2'])){
												echo '<p class="counter-text mb-0">'.esc_html($data['f_content2']).'</p>';
											}
										echo '</div>';
									}
									if( !empty($data['f_title3'] || $data['f_content3']) ){
										echo '<div class="counter-grid">';
											if(!empty($data['f_title3'])){
												echo '<h3 class="counter-grid-title">'.wp_kses_post($data['f_title3']).'</h3>';
											}
											if(!empty($data['f_content3'])){
												echo '<p class="counter-text mb-0">'.esc_html($data['f_content3']).'</p>';
											}
										echo '</div>';
									}
									if( !empty($data['f_title4'] || $data['f_content4']) ){
										echo '<div class="counter-grid">';
											if(!empty($data['f_title4'])){
												echo '<h3 class="counter-grid-title">'.wp_kses_post($data['f_title4']).'</h3>';
											}
											if(!empty($data['f_content4'])){
												echo '<p class="counter-text mb-0">'.esc_html($data['f_content4']).'</p>';
											}
										echo '</div>';
									}
								echo '</div>';
								if(!empty($data['button_text'])){
									echo '<div class="mt-50">';
										echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn border-btn th-icon"><span class="btn-text" data-back="'.esc_attr($data['button_text']).'" data-front="'.esc_attr($data['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i></a>';
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<section class="project-area2 overflow-hidden" id="project-sec" data-background="'.esc_url( $settings['bg']['url'] ).'">';
				if(!empty($settings['title'])){
					echo '<div class="title-area mb-0">';
						echo '<div class="shadow-title">'.esc_html($settings['title']).'</div>';
					echo '</div>';
				}
				echo '<div class="slider-area">';
					echo '<div class="swiper th-slider has-shadow" id="projectSlider2" data-slider-options=\'{"spaceBetween":0,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"4"}}}\'>';
						echo '<div class="swiper-wrapper">';
							foreach( $settings['projects2'] as $key => $data ){
								echo '<div class="swiper-slide">';
									echo '<div class="project-item" data-bg="'.esc_url( $data['image']['url'] ).'">';
										echo '<div class="box-content">';
											if(!empty($data['subtitle'])){
												echo '<p class="box-subtitle">'.esc_html($data['subtitle']).'</p>';
											}
											if(!empty($data['title'])){
												echo '<h3 class="box-title"><a href="'.esc_url( $data['project_url']['url'] ).'">'.wp_kses_post($data['title']).'</a></h3>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</section>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider projectSlider4 has-shadow" id="projectSlider4" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"767":{"slidesPerView":"2","centeredSlides":"true"},"992":{"slidesPerView":"2","centeredSlides":"true"},"1200":{"slidesPerView":"3","centeredSlides":"true"},"1400":{"slidesPerView":"5","centeredSlides":"true"}}}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['projects2'] as $key => $data ){
							echo '<div class="swiper-slide">';
								echo '<div class="project-item2">';
									if($data['image']['url'] ){
										echo '<div class="box-img">';
											echo solak_img_tag( array(
												'url'   => esc_url( $data['image']['url'] ),
											)); 
										echo '</div>';
									}
									echo '<div class="box-content">';
										if(!empty($data['subtitle'])){
											echo '<p class="box-subtitle">'.esc_html($data['subtitle']).'</p>';
										}
										if(!empty($data['title'])){
											echo '<h3 class="box-title"><a href="'.esc_url( $data['project_url']['url'] ).'">'.wp_kses_post($data['title']).'</a></h3>';
										}
									echo '</div>';
									if($data['image']['url'] ){
										echo '<div class="box-btn"><a href="'.esc_url( $data['image']['url'] ).'" class="icon-btn popup-image"><i class="fa-solid fa-arrow-up-right"></i></a></div>';
									}
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
			if(!empty($settings['button_text'])){
				echo '<div class="sec-shape2 text-center mt-3">';
					echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="line-btn style-radius">'.esc_attr($settings['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
				echo '</div>';
			}

		}elseif( $settings['layout_style'] == '7' ){
			echo '<div>';
				foreach( $settings['projects'] as $key => $data ){
					echo '<div class="project-box style2">';
						if($data['image']['url'] ){
							echo '<div class="project-box-img">';
								echo solak_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								)); 
							echo '</div>';
						}
						echo '<div class="project-box-details">';
							if(!empty($data['title'])){
								echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.wp_kses_post($data['title']).'</a></h3>';
							}
							if(!empty($data['desc'])){
								echo '<p class="box-text">'.esc_html($data['desc']).'</p>';
							}
							echo '<div class="counter-grid_wrapp">';
								if( !empty($data['f_title1'] || $data['f_content1']) ){
									echo '<div class="counter-grid">';
										if(!empty($data['f_title1'])){
											echo '<h3 class="counter-grid-title">'.wp_kses_post($data['f_title1']).'</h3>';
										}
										if(!empty($data['f_content1'])){
											echo '<p class="counter-text mb-0">'.esc_html($data['f_content1']).'</p>';
										}
									echo '</div>';
								}
								if( !empty($data['f_title2'] || $data['f_content2']) ){
									echo '<div class="counter-grid">';
										if(!empty($data['f_title2'])){
											echo '<h3 class="counter-grid-title">'.wp_kses_post($data['f_title2']).'</h3>';
										}
										if(!empty($data['f_content2'])){
											echo '<p class="counter-text mb-0">'.esc_html($data['f_content2']).'</p>';
										}
									echo '</div>';
								}
								if( !empty($data['f_title3'] || $data['f_content3']) ){
									echo '<div class="counter-grid">';
										if(!empty($data['f_title3'])){
											echo '<h3 class="counter-grid-title">'.wp_kses_post($data['f_title3']).'</h3>';
										}
										if(!empty($data['f_content3'])){
											echo '<p class="counter-text mb-0">'.esc_html($data['f_content3']).'</p>';
										}
									echo '</div>';
								}
								if( !empty($data['f_title4'] || $data['f_content4']) ){
									echo '<div class="counter-grid">';
										if(!empty($data['f_title4'])){
											echo '<h3 class="counter-grid-title">'.wp_kses_post($data['f_title4']).'</h3>';
										}
										if(!empty($data['f_content4'])){
											echo '<p class="counter-text mb-0">'.esc_html($data['f_content4']).'</p>';
										}
									echo '</div>';
								}
							echo '</div>';
							if(!empty($data['button_text'])){
								echo '<div class="mt-50">';
									echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn border-btn th-icon"><span class="btn-text" data-back="'.esc_attr($data['button_text']).'" data-front="'.esc_attr($data['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i></a>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}else{
			if( $settings['layout_style'] == '4' ){
				$row = 'row gy-4';
				$col = 'col-md-6 col-xl-4';
			}elseif( $settings['layout_style'] == '5' ){
				$row = 'row gy-80 gx-80';
				$col = 'col-md-6';
			}elseif( $settings['layout_style'] == '6' ){
				$row = 'row gy-4 filter-active';
				$col = 'col-md-6 col-xxl-auto filter-item';
			}
			echo '<div class="'.esc_attr($row).'">';
				foreach( $settings['projects2'] as $key => $data ){
					echo '<div class="'.esc_attr($col).'">';
						echo '<div class="project-item2">';
							if($data['image']['url'] ){
								echo '<div class="box-img">';
									echo solak_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									)); 
								echo '</div>';
							}
							echo '<div class="box-content">';
								if(!empty($data['subtitle'])){
									echo '<p class="box-subtitle">'.esc_html($data['subtitle']).'</p>';
								}
								if(!empty($data['title'])){
									echo '<h3 class="box-title"><a href="'.esc_url( $data['project_url']['url'] ).'">'.wp_kses_post($data['title']).'</a></h3>';
								}
							echo '</div>';
							if($data['image']['url'] ){
								echo '<div class="box-btn"><a href="'.esc_url( $data['image']['url'] ).'" class="icon-btn popup-image"><i class="fa-solid fa-arrow-up-right"></i></a></div>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}
	

	}

}