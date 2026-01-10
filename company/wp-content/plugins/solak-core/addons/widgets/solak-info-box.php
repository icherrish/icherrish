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
 * Info Box Widget .
 *
 */
class solak_Info_Box extends Widget_Base {

	public function get_name() {
		return 'solakinfobox';
	}
	public function get_title() {
		return __( 'Info Box', 'solak' );
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
				'label'		 	=> __( 'Info Box', 'solak' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
				
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

		$repeater = new Repeater();

		solak_general_fields($repeater, 'year', 'Year', 'TEXTAREA2', '2001');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Title');
		solak_general_fields($repeater, 'description', 'Description', 'TEXTAREA', 'Content'); 

		$this->add_control(
			'feature_list',
			[
				'label' 		=> __( 'Features Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'First office set up by Stephen Barrett', 'solak' ),
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

		solak_common_style_fields( $this, '12', 'Year', '{{WRAPPER}} .feature-date', ['1'] );
		solak_common_style_fields( $this, '13', 'Title', '{{WRAPPER}} .box-title', ['1'] );
		solak_common_style_fields( $this, '14', 'Description', '{{WRAPPER}} .box-text', ['1'] );


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

			if( $settings['layout_style'] == '1' ){
				echo '<div class="feature-timeline">';
					echo '<div class="swiper-pagination swiper-pagination-progressbar swiper-pagination-horizontal"></div>';
					echo '<ul class="swiper-pagination-custom">';
						foreach( $settings['feature_list'] as $key => $data ){
							$active = ($key == 0) ? 'item-active':'';
							echo '<li class="swiper-pagination-switch hover-item '.esc_attr($active).'">';
								if(!empty($data['year'])){
									echo '<span class="feature-date">'.esc_html($data['year']).'</span>';
								}
								echo '<span class="switch-title"></span>';
								echo '<div class="feature-area-title">';
									if(!empty($data['title'])){
										echo '<h2 class="box-title">'.esc_html($data['title']).'</h2>';
									}
									if(!empty($data['description'])){
										echo '<p class="box-text">'.esc_html($data['description']).'</p>';
									}
								echo '</div>';
							echo '</li>';
						}
					echo '</ul>';
				echo '</div>';
				
			}elseif( $settings['layout_style'] == '2' ){
				

			}

	}

}