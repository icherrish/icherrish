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
 * Choose Us Widget .
 *
 */
class solak_Choose_Us extends Widget_Base {

	public function get_name() {
		return 'solakchooseus';
	}
	public function get_title() {
		return __( 'Choose Us', 'solak' );
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
				'label'		 	=> __( 'Choose Us', 'solak' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
				
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

		solak_media_fields( $this, 'image', 'Choose Image' );
		solak_general_fields($this, 'title', 'Title', 'TEXTAREA2', '3,600');
		solak_general_fields($this, 'description', 'Description', 'TEXTAREA', 'We have over 3,600+ Happy Customers'); 

		solak_media_fields( $this, 'image2', 'Choose Image' );
		solak_general_fields($this, 'title2', 'Title', 'TEXTAREA2', '3,650');
		solak_general_fields($this, 'description2', 'Description', 'TEXTAREA', 'Customers are served by the Solar Power Energy department'); 

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		solak_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-number' );
		solak_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} .box-text' );


	}


	protected function render() {

        $settings = $this->get_settings_for_display();

			if( $settings['layout_style'] == '1' ){
				echo '<div class="choose-wrapper2">';
					echo '<div class="choose-item2">';
						if(!empty($settings['image']['url'])){
							echo '<div class="choose-img">';
								echo solak_img_tag( array(
									'url'   => esc_url( $settings['image']['url'] ),
								));
							echo '</div>';
						}
						echo '<div class="choose-content">';
							if(!empty($settings['title'])){
								echo '<h3 class="box-number">'.wp_kses_post($settings['title']).'</h3>';
							}
							if(!empty($settings['description'])){
								echo '<p class="box-text">'.esc_html($settings['description']).'</p>';
							}
						echo '</div>';
					echo '</div>';
					echo '<div class="choose-item2">';
						if(!empty($settings['image2']['url'])){
							echo '<div class="choose-img">';
								echo solak_img_tag( array(
									'url'   => esc_url( $settings['image2']['url'] ),
								));
							echo '</div>';
						}
						echo '<div class="choose-content">';
							if(!empty($settings['title2'])){
								echo '<h3 class="box-number">'.wp_kses_post($settings['title2']).'</h3>';
							}
							if(!empty($settings['description2'])){
								echo '<p class="box-text">'.esc_html($settings['description2']).'</p>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
				
			}elseif( $settings['layout_style'] == '2' ){


			}


	}

}