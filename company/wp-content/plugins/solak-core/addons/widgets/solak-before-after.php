<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
/**
 *
 * Before_Afters Widget .
 *
 */
class Solak_Before_After extends Widget_Base {

	public function get_name() {
		return 'solakbeforeafter';
	}

	public function get_title() {
		return __( 'BeforeAfter', 'solak' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label'     => __( 'Layout Style', 'solak' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', ['Style One'] );

		solak_media_fields($this, 'image', 'Choose Before Image');
		solak_media_fields($this, 'image2', 'Choose After Image');

		$this->end_controls_section();

		 //---------------------------------------
			//Style Section Start
		//---------------------------------------

      
	}

	protected function render() {

	    $settings = $this->get_settings_for_display();

	    if( $settings['layout_style'] == '1' ){
			echo '<div class="img-box4">';
				echo '<div class="comparison-img">';
					echo '<div class="img background-img" data-bg-src="'.esc_url( $settings['image']['url'] ).'"></div>';
					echo '<div class="img foreground-img" data-bg-src="'.esc_url( $settings['image2']['url'] ).'"></div>';
					echo '<input type="range" min="1" max="100" value="50" class="compslider" name="compslider" id="compslider">';
					echo '<div class="slider-button" style="left: calc(50% - 28px);"></div>';
				echo '</div>';
			echo '</div>';

	    }elseif( $settings['layout_style'] == '2' ){

		}


	}
}