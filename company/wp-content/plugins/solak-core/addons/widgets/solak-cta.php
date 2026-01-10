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
 * CTA Widget .
 *
 */
class solak_Cta extends Widget_Base {

	public function get_name() {
		return 'solakcta';
	}
	public function get_title() {
		return __( 'CTA', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_title_section',
			[
				'label'		 	=> __( 'CTA', 'solak' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT, 
				
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

		solak_media_fields( $this, 'bg', 'Choose Background', ['2'] );
		solak_general_fields( $this, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Contact for inquery', ['2'] );
		solak_general_fields( $this, 'title', 'Title', 'TEXTAREA2', '', ['2'] );
		solak_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'Contact us', ['2'] );
		solak_url_fields( $this, 'button_url', 'Button URL', ['2'] );

		$repeater = new Repeater();

		solak_media_fields($repeater, 'choose_icon', 'Choose Icon');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Initial Consultation');
		solak_general_fields($repeater, 'description', 'Description', 'TEXTAREA', ''); 

		$this->add_control(
			'feature_list',
			[
				'label' 		=> __( 'Features Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Initial Consultation', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);
			
        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title', ['1'] );
		solak_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} .box-text', ['1'] );

		solak_common_style_fields( $this, '011', 'Subtitle', '{{WRAPPER}} .sub-title', ['2'] );
		solak_common_style_fields( $this, '022', 'Title', '{{WRAPPER}} .banner-title', ['2'] );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="row gx-0">';
				foreach( $settings['feature_list'] as $data ){
					echo '<div class="col-lg-6 cta-item_wrapp">';
						echo '<div class="cta-item">';
							if(!empty($data['choose_icon']['url'])){
								echo '<div class="box-icon">';
									echo solak_img_tag( array(
										'url'   => esc_url( $data['choose_icon']['url'] ),
									));
								echo '</div>';
							}
							if(!empty($data['title'])){
								echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
							}
							if(!empty($data['description'])){
								echo '<p class="box-text">'.esc_html($data['description']).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="widget widget_offer" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
				echo '<div class="offer-banner">';
					if(!empty($settings['subtitle'])){
						echo '<span class="sub-title style1">'.esc_html($settings['subtitle']).'</span>';
					}
					if(!empty($settings['title'])){
						echo '<h5 class="banner-title">'.wp_kses_post($settings['title']).'</h5>';
					}
					if(!empty($settings['button_text'])){
						echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style1 th-icon"><span class="btn-text" data-back="'.esc_attr($settings['button_text']).'" data-front="'.esc_attr($settings['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i> </a>';
					}
				echo '</div>';
			echo '</div>';
			
		}
		

	}

}