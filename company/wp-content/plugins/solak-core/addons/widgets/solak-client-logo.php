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
 * features Widget .
 *
 */
class Solak_Client_Logos extends Widget_Base {

	public function get_name() {
		return 'solakclientlogos';
	}
	public function get_title() {
		return __( 'Client Logos', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'arrow_section',
			[
				'label'     => __( 'Client Logos', 'solak' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

        $repeater = new Repeater();

		solak_media_fields($repeater, 'image', 'Choose Image');
		solak_url_fields($repeater, 'logo_url', 'Button URL');
		
		$this->add_control(
			'client_logo',
			[
				'label' 		=> __( 'Logos', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
                'default'   => [
                    [
                        'image'    => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'image'    => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'image'    => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'image'    => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'image'    => Utils::get_placeholder_image_src(),
                    ],
                ],
				'condition'	=> [
					'layout_style' => ['1', '2']
				]
			]
		);


        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------


	}

	protected function render() {

    $settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){
			echo '<div class="slider-area text-center">';
				echo '<div class="swiper th-slider" id="brandSlider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"476":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"4"},"1400":{"slidesPerView":"6"}}}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['client_logo'] as $data ){
							echo '<div class="swiper-slide">';
								echo '<div class="brand-item">';
									echo '<a href="'.esc_url( $data['logo_url']['url'] ).'">';
										echo solak_img_tag( array(
											'url'   => esc_url( $data['image']['url'] ),
											'class' => 'original',
										) );
										echo solak_img_tag( array(
											'url'   => esc_url( $data['image']['url'] ),
											'class' => 'gray',
										) );
									echo '</a>';
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="row gy-4 justify-content-center align-items-center">';
				foreach( $settings['client_logo'] as $data ){
					echo ' <div class="col-md-6 col-lg-3">';
						echo '<div class="brand-card">';
							echo '<a href="'.esc_url( $data['logo_url']['url'] ).'">';
								echo solak_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								) );
							echo '</a>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){


		}elseif( $settings['layout_style'] == '4' ){


		}
		
			
	}
}