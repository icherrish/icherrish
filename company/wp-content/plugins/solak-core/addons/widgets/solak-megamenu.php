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
 * Megamenu Widget .
 *
 */
class Solak_Megamenu extends Widget_Base {

	public function get_name() {
		return 'solakmegamenu';
	}
	public function get_title() {
		return __( 'Megamenu Content', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'megamenu_section',
			[
				'label'		 	=> __( 'Megamenu Content', 'solak' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One'] );

        $repeater = new Repeater();

		solak_media_fields($repeater, 'image', 'Choose Image');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Home One');
        solak_general_fields( $repeater, 'button_text', 'Button Text', 'TEXT', 'View Demo' );
        solak_url_fields( $repeater, 'button_url', 'Button URL' );
		
		$this->add_control(
			'megamenu_list',
			[
				'label' 		=> __( 'Megamenu Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Home', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

        $this->end_controls_section();

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<li>';
                echo '<div class="container">';
	                echo '<div class="row gy-4">';
	                    foreach( $settings['megamenu_list'] as $data ){
		                    echo '<div class="col-lg-4">';
		                        echo '<div class="mega-menu-box">';
		                            echo '<div class="mega-menu-img">';
                                        echo solak_img_tag( array(
                                            'url'   => esc_url( $data['image']['url'] ),
                                        )); 
                                        if(!empty($data['button_text'])){
                                            echo '<div class="btn-wrap">';
                                                echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn ">'.esc_html($data['button_text']).'</a>';
                                            echo '</div>';
                                        }
		                            echo '</div>';
		                            if(!empty( $data['title'] )){
			                            echo '<h3 class="mega-menu-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.wp_kses_post( $data['title'] ).'</a></h3>';
			                        }
		                        echo '</div>';
		                    echo '</div>';
		                }
	                echo '</div>';
                echo '</div>';
            echo '</li>';
		}
	}
}