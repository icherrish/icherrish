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
 * Price Widget .
 *
 */
class Solak_Price extends Widget_Base {

	public function get_name() {
		return 'solakprice';
	}
	public function get_title() {
		return __( 'Price Box', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'price_section',
			[
				'label' 	=> __( 'Price Box', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

		$repeater = new Repeater();

		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Basic Plan');
		solak_general_fields($repeater, 'desc', 'Description', 'TEXTAREA2', 'Consultation with a lawyer for your person al solution with basic plan.');
		solak_general_fields($repeater, 'tag', 'Tag', 'TEXTAREA2', 'Popular'); 
		solak_general_fields($repeater, 'price', 'Price', 'TEXTAREA', '$99.00'); 
		solak_code_fields($repeater, 'features', 'Features', ''); 
		solak_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Get Started');
		solak_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'price_lists',
			[
				'label' 		=> __( 'Price Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Basic Plan', 'solak' ),
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

		solak_common_style_fields( $this, '01', 'Tag', '{{WRAPPER}} .offer-tag' );
		solak_common_style_fields( $this, '02', 'Title', '{{WRAPPER}} .box-title' );
		solak_common_style_fields( $this, '03', 'Description', '{{WRAPPER}} .box-text2' );
		solak_common_style_fields( $this, '04', 'Price', '{{WRAPPER}} .box-price' );
		solak_common_style_fields( $this, '05', 'Features', '{{WRAPPER}} .available-list li' );

		//------Button Style-------
		solak_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th-btn' );

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' || $settings['layout_style'] == '2' ){
			if($settings['layout_style'] == '2'){
				$class = 'style2';
			}else{
				$class = '';
			}

			echo '<div class="row gy-4 justify-content-center">';
				foreach( $settings['price_lists'] as $key => $data ){
					$active = ($key == 1) ? 'active' : '';
					echo '<div class="col-xl-4 col-md-6">';
						echo '<div class="price-box th-ani '.esc_attr($class .' '.$active).'">';
							if(!empty($data['tag'])){
								echo '<span class="offer-tag">'.esc_html($data['tag']).'</span>';
							}
							if(!empty($data['title'])){
								echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
							}
							if(!empty($data['desc'])){
								echo '<p class="box-text2">'.esc_html($data['desc']).'</p>';
							}
							if(!empty($data['price'])){
								echo '<h4 class="box-price">'.wp_kses_post($data['price']).'</h4>';
							}
							echo '<div class="box-content">';
								if(!empty($data['features'])){
									echo '<div class="available-list">'.wp_kses_post($data['features']).'</div>';
								}
							echo '</div>';
							if(!empty($data['button_text'])){
								echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn black-btn th-icon fw-btn"><span class="btn-text" data-back="'.esc_attr($data['button_text']).'" data-front="'.esc_attr($data['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i></a>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){


		}


	}

}