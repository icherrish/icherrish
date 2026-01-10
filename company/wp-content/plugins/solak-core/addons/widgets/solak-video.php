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
 * Video Widget .
 *
 */
class solak_Video extends Widget_Base {

	public function get_name() {
		return 'solakvideo';
	}
	public function get_title() {
		return __( 'Video Box', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'video_section',
			[
				'label' 	=> __( 'video Box', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three' ] ); 

		solak_media_fields( $this, 'image1', 'Choose Image', [ '1', '2', '3' ] );
		solak_general_fields( $this, 'title', 'Title', 'TEXTAREA2', 'Watch Video', ['3'] );
		solak_general_fields( $this, 'icon', 'Icon', 'TEXTAREA2', '<i class="fa-sharp fa-solid fa-play"></i>' );
		solak_url_fields( $this, 'video_url', 'Video URL' );
		solak_general_fields( $this, 'circle_text', 'Circle Text', 'TEXTAREA2', 'solak-solak enargy since in 1996', [ '1', '2', '3' ] );

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

	
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="img-box1">';
				echo '<div class="img1 th-anim th-parallax">';
					echo solak_img_tag( array(
						'url'   => esc_url( $settings['image1']['url'] ),
					));
				echo '</div>';
				echo '<div class="about-wrapp">';
					echo '<div class="discount-wrapp">';
						if(!empty($settings['video_url']['url'])){
							echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn popup-video">'.wp_kses_post($settings['icon']).'</a>';
						}
						if(!empty($settings['circle_text'])){
							echo '<div class="discount-tag">';
								echo '<span class="discount-anime">'.esc_html($settings['circle_text']).'</span>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="img-box7">';
				echo '<div class="img1 th-anim">';
					echo solak_img_tag( array(
						'url'   => esc_url( $settings['image1']['url'] ),
					));
				echo '</div>';
				echo '<div class="about-wrapp">';
					echo '<div class="discount-wrapp">';
						if(!empty($settings['video_url']['url'])){
							echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn popup-video">'.wp_kses_post($settings['icon']).'</a>';
						}
						if(!empty($settings['circle_text'])){
							echo '<div class="discount-tag">';
								echo '<span class="discount-anime">'.esc_html($settings['circle_text']).'</span>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="video-box1" data-bg-src="'.esc_url( $settings['image1']['url'] ).'">';
				if(!empty($settings['title'])){
					echo '<h3 class="box-title">'.esc_html($settings['title']).'</h3>';
				}
				echo '<div class="video-shape">';
					echo '<div class="discount-wrapp">';
						if(!empty($settings['video_url']['url'])){
							echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn popup-video">'.wp_kses_post($settings['icon']).'</a>';
						}
						if(!empty($settings['circle_text'])){
							echo '<div class="discount-tag">';
								echo '<span class="discount-anime">'.esc_html($settings['circle_text']).'</span>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}


	}

}