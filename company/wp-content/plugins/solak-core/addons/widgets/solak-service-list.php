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
 * Service Lists Widget .
 *
 */
class Solak_Service_List extends Widget_Base {

	public function get_name() {
		return 'solakservicelist';
	}
	public function get_title() {
		return __( 'Service Lists', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'service_section',
			[
				'label'     => __( 'Service Lists', 'solak' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

		solak_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'All Services');

		$repeater = new Repeater();

		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Label');
		solak_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'service_list',
			[
				'label' 		=> __( 'Service Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Label', 'solak' ),
					],
				],
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		solak_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .widget_title' );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="widget widget_nav_menu">';
				if($settings['title']){
					echo '<h3 class="widget_title style2">'.wp_kses_post($settings['title']).'</h3>';
				}
				echo '<ul>';
					foreach( $settings['service_list'] as $data ){
						if(!empty($data['title'])){
							echo '<li>';
								echo '<a href="'.esc_url( $data['button_url']['url'] ).'">'.wp_kses_post($data['title']).'</a>';
							echo '</li>';
						}
					}
				echo '</ul>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){


		}
	

	}

}