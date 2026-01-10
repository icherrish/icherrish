<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
/**
 *
 * Image Widget .
 *
 */
class Solak_Image extends Widget_Base {

	public function get_name() {
		return 'solakimage';
	}
	public function get_title() {
		return __( 'Image', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'image_section',
			[
				'label' 	=> __( 'Image', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five', 'Style Six', 'Style Seven' ] );

		solak_media_fields( $this, 'image', 'Choose Image' );
		solak_media_fields( $this, 'image2', 'Choose Image', ['6', '7'] );
		solak_media_fields( $this, 'shape', 'Choose Shape', ['7'] );

		solak_general_fields( $this, 'title', 'Title', 'TEXTAREA2', '49', ['1', '3', '7'] );
		solak_general_fields( $this, 'desc', 'Description', 'TEXTAREA2', 'Years Experience', ['1', '3', '7'] );

		solak_media_fields( $this, 'feature_icon', 'Feature Icon', [ '3', ] );
		solak_general_fields( $this, 'feature_title', 'Feature Title', 'TEXTAREA2', 'Our Goals', ['3'] );
		solak_general_fields( $this, 'feature_desc', 'Feature Content', 'TEXTAREA2', 'Our advanced energy storage solutions allow', ['3'] );


       $this->end_controls_section();

      	//---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title', ['3'] );
		solak_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} .box-text', ['3'] );		
		

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
       
		if( $settings['layout_style'] == '1' ){
			echo '<div class="img-box2 pe-xl-5 me-xl-2"> ';
				if(!empty($settings['image']['url'])){
					echo '<div class="img1 th-parallax">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="discount-wrapp style2">';
					if(!empty($settings['title'])){
						echo '<h2 class="box-counter"><span class="counter-number">'.wp_kses_post($settings['title']).'</span></h2>';
					}
					if(!empty($settings['desc'])){
						echo '<div class="discount-tag">';
							echo '<span class="discount-anime">'.wp_kses_post($settings['desc']).'</span>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			if(!empty($settings['image']['url'])){
				echo '<div class="faq-image th-parallax">';
					echo solak_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
					));
				echo '</div>';
			}

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="choose-wrapper">';
				echo '<div class="choose-discount">';
					echo '<div class="discount-wrapp style3">';
						if(!empty($settings['title'])){
							echo '<h2 class="counter"><span class="counter-number">'.wp_kses_post($settings['title']).'</span></h2>';
						}
						if(!empty($settings['desc'])){
							echo '<div class="discount-tag">';
								echo '<span class="discount-anime">'.wp_kses_post($settings['desc']).'</span>';
							echo '</div>';
						}
					echo '</div>';
					echo '<div class="choose-item">';
						if(!empty($settings['feature_icon']['url'])){
							echo '<div class="box-icon">';
								echo solak_img_tag( array(
									'url'   => esc_url( $settings['feature_icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<div class="box-content">';
							if(!empty($settings['feature_title'])){
								echo '<h3 class="box-title">'.esc_html($settings['feature_title']).'</h3>';
							}
							if(!empty($settings['feature_desc'])){
								echo '<p class="box-text">'.esc_html($settings['feature_desc']).'</p>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
				if(!empty($settings['image']['url'])){
					echo '<div class="choose-image2 global-img">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			if(!empty($settings['image']['url'])){
				echo '<div class="choose-image3 th-anim">';
					echo solak_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
					));
				echo '</div>';
			}

		}elseif( $settings['layout_style'] == '5' ){
			if(!empty($settings['image']['url'])){
				echo '<div class="page-img global-img">';
					echo solak_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
					));
				echo '</div>';
			}

		}elseif( $settings['layout_style'] == '6' ){
			echo '<div class="row">';
				echo '<div class="col-6">';
					if(!empty($settings['image']['url'])){
						echo '<div class="page-img style1 global-img">';
							echo solak_img_tag( array(
								'url'   => esc_url( $settings['image']['url'] ),
								'class' => 'w-100'
							));
						echo '</div>';
					}
				echo '</div>';
				echo '<div class="col-6">';
					if(!empty($settings['image2']['url'])){
						echo '<div class="page-img style1 global-img">';
							echo solak_img_tag( array(
								'url'   => esc_url( $settings['image2']['url'] ),
								'class' => 'w-100'
							));
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '7' ){
			echo '<div class="img-box3">';
				if(!empty($settings['image']['url'])){
					echo '<div class="img1">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
				if(!empty($settings['image2']['url'])){
					echo '<div class="img2">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['image2']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="about-wrapp">';
					echo '<div class="discount-wrapp style2">';
						if(!empty($settings['title'])){
							echo '<h2 class="box-counter"><span class="counter-number">'.wp_kses_post($settings['title']).'</span></h2>';
						}
						if(!empty($settings['desc'])){
							echo '<div class="discount-tag">';
								echo '<span class="discount-anime">'.wp_kses_post($settings['desc']).'</span>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
				if(!empty($settings['shape']['url'])){
					echo '<div class="about-shape">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['shape']['url'] ),
						));
					echo '</div>';
				}
			echo '</div>';

		}


	}

}