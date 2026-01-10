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
 * features Widget .
 *
 */
class Solak_Features extends Widget_Base {

	public function get_name() {
		return 'solakfeatures';
	}
	public function get_title() {
		return __( 'Features', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'arrow_section',
			[
				'label'     => __( 'Features', 'solak' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five', 'Style Six' ] );

		solak_media_fields( $this, 'image', 'Choose Image', ['3', '4'] );
		solak_general_fields($this, 'title', 'Title', 'TEXTAREA2', '16', ['4']);
		solak_general_fields($this, 'description', 'Description', 'TEXTAREA', 'Useable Customer', ['4']); 

		$repeater = new Repeater();

		solak_media_fields($repeater, 'choose_icon', 'Choose Icon');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Initial Consultation');
		solak_general_fields($repeater, 'description', 'Description', 'TEXTAREA', ''); 
		solak_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'feature_list',
			[
				'label' 		=> __( 'Features Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Initial Consultation', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

		$repeater = new Repeater();

		solak_media_fields($repeater, 'choose_icon', 'Choose Icon');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Initial Consultation');
		solak_general_fields($repeater, 'description', 'Description', 'TEXTAREA', '');

		$this->add_control(
			'feature_list2',
			[
				'label' 		=> __( 'Features Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Initial Consultation', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['2', '3', '5', '6']
				]
			]
		);

		$repeater = new Repeater();

		solak_media_fields($repeater, 'choose_image', 'Choose Image');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Solar Panel Installation');
		solak_general_fields($repeater, 'description', 'Description', 'TEXTAREA', ''); 
		solak_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Vew Details');
		solak_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'service_list',
			[
				'label' 		=> __( 'Service Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Solar Panel Installation', 'solak' ),
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

		solak_common2_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title a', ['1'] );
		solak_common2_style_fields( $this, '011', 'Title', '{{WRAPPER}} .box-title', ['2', '3', '4'] );
		solak_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} .box-text', [ '1', '2', '3', '4'] );

		solak_common_style_fields( $this, '11', 'Title', '{{WRAPPER}} .service-process_title', ['5'] );
		solak_common_style_fields( $this, '12', 'Description', '{{WRAPPER}} .service-process_text', [ '5'] );


	}

	protected function render() {

    $settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){
			echo '<div class="row gy-4 justify-content-center">';
				foreach( $settings['feature_list'] as $data ){
					echo '<div class="col-md-6 col-xl-3">';
						echo '<div class="feature-card th-ani">';
							if(!empty($data['choose_icon']['url'])){
								echo '<div class="box-icon">';
									echo solak_img_tag( array(
										'url'   => esc_url( $data['choose_icon']['url'] ),
									));
								echo '</div>';
							}
							if(!empty($data['title'])){
								echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
							}
							if(!empty($data['description'])){
								echo '<p class="box-text">'.esc_html($data['description']).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="about-feature-wrap">';
				foreach( $settings['feature_list2'] as $data ){
					echo '<div class="about-feature">';
						if(!empty($data['choose_icon']['url'])){
							echo '<div class="box-icon">';
								echo solak_img_tag( array(
									'url'   => esc_url( $data['choose_icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<div class="media-body">';
							if(!empty($data['title'])){
								echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
							}
							if(!empty($data['description'])){
								echo '<p class="box-text">'.esc_html($data['description']).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="pe-xl-4">';
				if(!empty($settings['image']['url'])){
					echo '<div class="choose-image global-img">';
						echo solak_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="choose-item_wrapp">';
					foreach( $settings['feature_list2'] as $data ){
						echo '<div class="choose-item">';
							if(!empty($data['choose_icon']['url'])){
								echo '<div class="box-icon">';
									echo solak_img_tag( array(
										'url'   => esc_url( $data['choose_icon']['url'] ),
									));
								echo '</div>';
							}
							echo '<div class="box-content">';
								if(!empty($data['title'])){
									echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
								}
								if(!empty($data['description'])){
									echo '<p class="box-text">'.esc_html($data['description']).'</p>';
								}
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="row gy-4 justify-content-center justify-content-lg-between">';
				foreach( $settings['service_list'] as $key => $data ){
					if($key == 0){
						echo '<div class="col-md-6 col-lg-4 col-xxl-5">';
							echo '<div class="choose-feature">';
								if(!empty($data['choose_image']['url'])){
									echo '<div class="box-img th-anim">';
										echo solak_img_tag( array(
											'url'   => esc_url( $data['choose_image']['url'] ),
										));
									echo '</div>';
								}
								echo '<div class="box-content">';
									if(!empty($data['title'])){
										echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
									}
									if(!empty($data['description'])){
										echo '<p class="box-text">'.esc_html($data['description']).'</p>';
									}
									if(!empty($data['button_text'])){
										echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="line-btn th-icon">'.esc_attr($data['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				}
				echo '<div class="col-md-6 col-lg-4 col-xxl-2">';
					echo '<div class="choose-feature style2">';
						echo '<div class="client-box">';
							echo '<div class="client-thumb-group">';
								if(!empty($settings['image']['url'])){
									echo solak_img_tag( array(
										'url'   => esc_url( $settings['image']['url'] ),
									));
								}
							echo '</div>';
							if(!empty($settings['title'])){
								echo '<h4 class="box-counter">'.wp_kses_post($settings['title']).'</h4>';
							}
							if(!empty($settings['description'])){
								echo '<span class="box-title">'.esc_html($settings['description']).'</span>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
				foreach( $settings['service_list'] as $key => $data ){
					if($key == 1){
						echo '<div class="col-md-6 col-lg-4 col-xxl-5">';
							echo '<div class="choose-feature">';
								if(!empty($data['choose_image']['url'])){
									echo '<div class="box-img th-anim">';
										echo solak_img_tag( array(
											'url'   => esc_url( $data['choose_image']['url'] ),
										));
									echo '</div>';
								}
								echo '<div class="box-content">';
									if(!empty($data['title'])){
										echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
									}
									if(!empty($data['description'])){
										echo '<p class="box-text">'.esc_html($data['description']).'</p>';
									}
									if(!empty($data['button_text'])){
										echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="line-btn th-icon">'.esc_attr($data['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){
			echo '<div class="service-process-wrap">';
				foreach( $settings['feature_list2'] as $key => $data ){
					echo '<div class="service-process">';
						if(!empty($data['choose_icon']['url'])){
							echo '<div class="service-process_img">';
								echo solak_img_tag( array(
									'url'   => esc_url( $data['choose_icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<div class="service-process_centent">';
							if(!empty($data['title'])){
								echo '<h5 class="service-process_title">'.esc_html($data['title']).'</h5>';
							}
							if(!empty($data['description'])){
								echo '<p class="service-process_text">'.esc_html($data['description']).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '6' ){
			echo '<div class="choose-feature2-wrap">';
				foreach( $settings['feature_list2'] as $key => $data ){
					echo '<div class="choose-feature2">';
						if(!empty($data['choose_icon']['url'])){
							echo '<div class="box-icon">';
								echo solak_img_tag( array(
									'url'   => esc_url( $data['choose_icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<div class="media-body">';
							if(!empty($data['title'])){
								echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
							}
							if(!empty($data['description'])){
								echo '<p class="box-text">'.esc_html($data['description']).'</p>';
							}
						echo '</div>';
					echo '</div> ';
				}
			echo '</div> ';

		}
		
			
	}
}