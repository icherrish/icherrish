<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Counter Up Widget .
 *
 */
class solak_Counterup extends Widget_Base {

	public function get_name() {
		return 'solakcounterup';
	}
	public function get_title() {
		return __( 'Counter Up', 'solak' );
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
				'label' 	=> __( 'Counter Up', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four' ] ); 

		$repeater = new Repeater();

		solak_media_fields($repeater, 'choose_icon', 'Choose Icon');
		solak_general_fields($repeater, 'number', 'Number', 'TEXTAREA2', '100');
		solak_general_fields($repeater, 'after_prefix', 'After Prefix', 'TEXT2', 'k');
		solak_general_fields($repeater, 'description', 'Content', 'TEXTAREA2', 'Completed Projects'); 

		$this->add_control(
			'counter_lists',
			[
				'label' 		=> __( 'Counter List', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'number' 	=> __( '100', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '2', '3']
				]
			]
		);

		$repeater = new Repeater();

		solak_general_fields($repeater, 'number', 'Number', 'TEXTAREA2', '100');
		solak_general_fields($repeater, 'after_prefix', 'After Prefix', 'TEXT2', 'k');
		solak_general_fields($repeater, 'description', 'Content', 'TEXTAREA2', 'Completed Projects'); 

		$this->add_control(
			'counter_lists2',
			[
				'label' 		=> __( 'Counter List', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'number' 	=> __( '100', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['4']
				]
			]
		);


		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields($this, '01', 'Number', '{{WRAPPER}} .box-number .counter-number, {{WRAPPER}} .box-title .counter-number' );
		solak_common_style_fields($this, '02', 'Number Prefix', '{{WRAPPER}} .box-number, {{WRAPPER}} .box-title');
		solak_common_style_fields($this, '03', 'Content', '{{WRAPPER}} .box-text', ['1', '2']);
		solak_common_style_fields($this, '04', 'Content', '{{WRAPPER}} .counter-text', ['3']);

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="counter-card-wrap">';
				foreach( $settings['counter_lists'] as $data ){
					echo '<div class="counter-card">';
						if(!empty($data['choose_icon']['url'])){
							echo '<div class="box-icon">';
								echo solak_img_tag( array(
									'url'   => esc_url( $data['choose_icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<h3 class="box-number"><span class="counter-number">'.esc_html( $data['number'] ).'</span>'.esc_html( $data['after_prefix'] ).'</h3>';
						if(!empty($data['description'])){
							echo '<div class="media-body">';
								echo '<p class="box-text mb-n1">'.esc_html( $data['description'] ).'</p>';
							echo '</div>';
						}
					echo '</div>';
					echo '<div class="divider"></div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="counter-card-wrap style2">';
				foreach( $settings['counter_lists'] as $data ){
					echo '<div class="counter-box">';
						if(!empty($data['choose_icon']['url'])){
							echo '<div class="box-icon">';
								echo solak_img_tag( array(
									'url'   => esc_url( $data['choose_icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<div class="media-body">';
							echo '<h3 class="box-number"><span class="counter-number">'.esc_html( $data['number'] ).'</span>'.esc_html( $data['after_prefix'] ).'</h3>';
							if(!empty($data['description'])){
								echo '<p class="box-text mb-n1">'.esc_html( $data['description'] ).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="counter-item-wrap ps-xl-4">';
				foreach( $settings['counter_lists'] as $data ){
					echo '<div class="counter-item">';
						if(!empty($data['choose_icon']['url'])){
							echo '<div class="box-icon">';
								echo solak_img_tag( array(
									'url'   => esc_url( $data['choose_icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<h3 class="box-number"><span class="counter-number">'.esc_html( $data['number'] ).'</span><span class="plus">'.esc_html( $data['after_prefix'] ).'</span></h3>';
						if(!empty($data['description'])){
							echo '<div class="media-body">';
								echo '<p class="counter-text mb-n1">'.esc_html( $data['description'] ).'</p>';
							echo '</div>';
						}
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="project-box-details">';
				echo '<div class="counter-grid_wrapp style2">';
					foreach( $settings['counter_lists2'] as $data ){
						echo '<div class="counter-grid">';
							echo '<h3 class="counter-grid-title"><span class="counter-number">'.esc_html( $data['number'] ).'</span>'.esc_html( $data['after_prefix'] ).'</h3>';
							if(!empty($data['description'])){
								echo '<p class="counter-text mb-0">'.esc_html( $data['description'] ).'</p>';
							}
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}

	
	}

}