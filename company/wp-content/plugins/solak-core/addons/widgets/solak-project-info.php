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
 * Project Info Widget .
 *
 */
class Solak_project_List extends Widget_Base {

	public function get_name() {
		return 'solakprojectinfo';
	}
	public function get_title() {
		return __( 'project Info', 'solak' );
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
				'label'     => __( 'project Info', 'solak' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style',['Style One'] );

		solak_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'All projects');

        $repeater = new Repeater();

		solak_general_fields($repeater, 'icon', 'Icon', 'TEXTAREA2', '');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Label');
		solak_general_fields($repeater, 'description', 'Description', 'TEXTAREA', 'Content'); 
 
		$this->add_control(
			'project_info',
			[
				'label' 		=> __( 'Project Info', 'solak' ),
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
		solak_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .widget_title' );
		solak_common_style_fields( $this, '02', 'Label', '{{WRAPPER}} p' );
		solak_common_style_fields( $this, '03', 'Content', '{{WRAPPER}} h6' );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="widget widget_info">';
				if($settings['title']){
					echo '<h3 class="widget_title">'.wp_kses_post($settings['title']).'</h3>';
				}
				foreach( $settings['project_info'] as $data ){
					echo '<div class="project-info">';
						if(!empty($data['icon'])){
							echo '<div class="project-info_icon">'.wp_kses_post($data['icon']).'</div>';
						}
						echo '<div class="project-info_content">';
							if(!empty($data['title'])){
								echo '<p class="project-info_subtitle">'.esc_html($data['title']).'</p>';
							}
							if(!empty($data['description'])){
								echo '<h6 class="project-info_title">'.wp_kses_post($data['description']).'</h6>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';


		}
	

	}

}