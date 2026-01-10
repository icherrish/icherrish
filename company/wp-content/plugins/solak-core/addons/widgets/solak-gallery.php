<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Gallery Widget .
 *
 */
class Solak_Gallery extends Widget_Base {

	public function get_name() {
		return 'solakgallery';
	}
	public function get_title() {
		return __( 'Gallery', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'counter_section',
			[
				'label' 	=> __( 'Gallery', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        ); 

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

		solak_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'Gallery Post', ['2']);

		$repeater = new Repeater();

		solak_media_fields($repeater, 'image', 'Choose Image');
		solak_general_fields($repeater, 'icon', 'Icon', 'TEXTAREA2', '<i class="fab fa-instagram"></i>');
		solak_url_fields($repeater, 'button_url', 'Button URL');
		
		$this->add_control(
			'gallery_lists',
			[
				'label' 		=> __( 'Gallery Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

		$repeater = new Repeater();

		solak_media_fields($repeater, 'image', 'Choose Image');
		solak_general_fields($repeater, 'icon', 'Icon', 'TEXTAREA2', '<i class="fab fa-instagram"></i>');

		$this->add_control(
			'gallery_lists2',
			[
				'label' 		=> __( 'Gallery Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'condition'	=> [
					'layout_style' => ['2']
				]
			]
		);

		//---------------------------------------
			//Style Section Start
		//---------------------------------------


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="swiper th-slider" id="gallerySlider1" data-slider-options=\'{"spaceBetween": 0,"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"4"},"1300":{"slidesPerView":"5"},"1500":{"slidesPerView":"6"}}}\'>';
				echo '<div class="swiper-wrapper">';
					foreach ( $settings['gallery_lists'] as $data ){
						echo '<div class="swiper-slide">';
							echo '<div class="gallery-insta">';
								echo '<a target="_blank" href="'.esc_url( $data['button_url']['url'] ).'" class="box-btn">'.wp_kses_post($data['icon']).'</a>';
								echo solak_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								));
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="widget footer-widget">';
				if($settings['title']){
                    echo '<h3 class="widget_title">';
                        echo esc_html($settings['title']);
                    echo '</h3>';
                }
				echo '<div class="sidebar-gallery">';
					foreach ( $settings['gallery_lists2'] as $data ){
						echo '<div class="gallery-thumb">';
							echo solak_img_tag( array(
								'url'   => esc_url( $data['image']['url'] ),
							));
							echo '<a href="'.esc_url( $data['image']['url'] ).'" class="gallery-btn popup-image">'.wp_kses_post($data['icon']).'</a>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){


		}elseif( $settings['layout_style'] == '4' ){


		}

		
	}

}