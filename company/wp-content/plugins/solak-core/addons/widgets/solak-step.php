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
 * Step Widget .
 *
 */
class solak_Step extends Widget_Base {

	public function get_name() {
		return 'solakstep';
	}
	public function get_title() {
		return __( 'Step/Process', 'solak' );
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
				'label'		 	=> __( 'Steps', 'solak' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] ); 

		$repeater = new Repeater();
 
		solak_media_fields($repeater, 'choose_image', 'Choose Image');
		solak_general_fields($repeater, 'number', 'Number', 'TEXTAREA2', '01');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Consultation & Site Assessment');
		solak_general_fields($repeater, 'description', 'Description', 'TEXTAREA', 'Proactively envisioned multimedia based expertisee cross-media growth'); 

		$this->add_control(
			'process_list',
			[
				'label' 		=> __( 'Process Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Consultation & Site Assessment', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

		$repeater = new Repeater();
 
		solak_media_fields($repeater, 'choose_image', 'Choose Image');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Consultation & Site Assessment');
		solak_general_fields($repeater, 'description', 'Description', 'TEXTAREA', 'Proactively envisioned multimedia based expertisee cross-media growth'); 

		$this->add_control(
			'process_list2',
			[
				'label' 		=> __( 'Process Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Consultation & Site Assessment', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['2']
				]
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title', [ '1', '2', '3' ] );
		solak_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} .box-text', [ '1', '2', '3' ] );

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="step-wrap">';
				echo '<div class="process-card_wrapp">';
					foreach( $settings['process_list'] as $data ){
						echo '<div class="process-card">';
							echo '<div class="process-image">';
								if(!empty($data['choose_image']['url'])){
									echo '<div class="box-img global-img">';
										echo solak_img_tag( array(
											'url'   => esc_url( $data['choose_image']['url'] ),
										));
									echo '</div>';
								}
								if(!empty($data['number'])){
									echo '<span class="number">'.esc_html($data['number']).'</span>';
								}
							echo '</div>';
							echo '<div class="box-content">';
								if(!empty($data['title'])){
									echo '<h2 class="box-title">'.wp_kses_post($data['title']).'</h2>';
								}
								if(!empty($data['description'])){
									echo '<p class="box-text">'.wp_kses_post($data['description']).'</p>';
								}
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="row gy-5">';
				foreach( $settings['process_list2'] as $data ){
					echo '<div class="col-md-6 col-lg-3 process-box-wrap">';
						echo '<div class="process-box">';
							if(!empty($data['choose_image']['url'])){
								echo '<div class="box-img">';
									echo solak_img_tag( array(
										'url'   => esc_url( $data['choose_image']['url'] ),
									));
								echo '</div>';
							}
							echo '<div class="box-content">';
								if(!empty($data['title'])){
									echo '<h2 class="box-title">'.wp_kses_post($data['title']).'</h2>';
								}
								if(!empty($data['description'])){
									echo '<p class="box-text">'.wp_kses_post($data['description']).'</p>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){


		}
	

	}

}