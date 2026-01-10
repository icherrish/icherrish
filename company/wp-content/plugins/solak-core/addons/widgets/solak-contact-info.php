
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
 * Contact Info Widget .
 *
 */
class Solak_Contact_Info extends Widget_Base {

	public function get_name() {
		return 'solakcontactinfo';
	}
	public function get_title() {
		return __( 'Contact Info', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() { 

		$this->start_controls_section(
			'title_section',
			[
				'label' 	=> __( 'Contact Info', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One' ] );

		$repeater = new Repeater();

		solak_general_fields($repeater, 'icon', 'Icon', 'TEXTAREA2', '');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Label');
		solak_general_fields($repeater, 'desc', 'Description', 'TEXTAREA', 'Content');
		
		$this->add_control(
			'contact_lists',
			[
				'label' 		=> __( 'Contact Info', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Label', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '2', '3']
				]
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields( $this, '01', 'Label', '{{WRAPPER}} .box-title', ['1'] );
		solak_common_style_fields( $this, '02', 'Content', '{{WRAPPER}} .box-text, {{WRAPPER}} .box-text a', ['1'] );
		
	}

	protected function render() {

        $settings = $this->get_settings_for_display(); 
			
		if( $settings['layout_style'] == '1' ){
            echo '<div class="row gy-4">';
				foreach( $settings['contact_lists'] as $data ){
					echo '<div class="col-xl-4 col-md-6">';
						echo '<div class="contact-media">';
							if(!empty($data['icon'])){
								echo '<div class="icon-btn">'.wp_kses_post($data['icon']).'</div>';
							}
							echo '<div class="media-body">';
								if(!empty($data['title'])){
									echo '<h4 class="box-title">'.esc_html($data['title']).'</h4>';
								}
								if(!empty($data['desc'])){
									echo '<p class="box-text">'.wp_kses_post($data['desc']).'</p>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){


		}
       

	}

}
