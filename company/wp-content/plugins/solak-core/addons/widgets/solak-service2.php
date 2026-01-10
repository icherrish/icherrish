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
 * Service Widget .
 *
 */
class Solak_Service2 extends Widget_Base {

	public function get_name() {
		return 'solakservice2';
	}
	public function get_title() {
		return __( 'Services V2', 'solak' );
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
				'label'     => __( 'Services', 'solak' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three' ] );

		$repeater = new Repeater();

		solak_media_fields($repeater, 'overlay', 'Choose Overlay Image');
		solak_media_fields($repeater, 'choose_image', 'Choose Image');
		solak_media_fields($repeater, 'choose_icon', 'Choose Icon');
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
					'layout_style' => ['1']
				]
			]
		);

		$repeater = new Repeater();

		solak_media_fields($repeater, 'choose_icon', 'Choose Icon/Image');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Solar Panel Installation');
		solak_general_fields($repeater, 'description', 'Description', 'TEXTAREA', 'Our professional installation service ensures'); 
		solak_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Vew Details');
		solak_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'service_list2',
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
					'layout_style' => ['2', '3', '4']
				]
			]
		);

		
        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common2_style_fields( $this, '02', 'Title', '{{WRAPPER}} .box-title a', ['2', '3', '4'] );
		solak_common_style_fields( $this, '04', 'Description', '{{WRAPPER}} .box-text', ['2', '3', '4']  );

		//------Button Style-------
		solak_button_style_fields( $this, '11', 'Button Styling', '{{WRAPPER}} .th-btn', ['2', '3', '4']  );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            echo '<div class="row gy-4">';
                foreach( $settings['service_list'] as $data ){
                    echo '<div class="col-md-6 col-xl-4 col-xxl-3">';
                        echo '<div class="service-card style2">';
                            echo '<div class="service-overlay" data-bg-src="'.esc_url( $data['overlay']['url'] ).'"></div>';
                            echo '<div class="box-content">';
                                if(!empty($data['choose_icon']['url'])){
                                    echo '<div class="box-icon">'; 
                                        echo solak_img_tag( array(
                                            'url'   => esc_url( $data['choose_icon']['url'] ),
                                        ));
                                    echo '</div>';
                                }
                                echo '<div class="box-img" data-mask-src="'.SOLAK_ASSETS.'img/shape/ser-shape.png">';
                                    echo solak_img_tag( array(
                                        'url'   => esc_url( $data['choose_image']['url'] ),
                                    ));
                                echo '</div>';
                                if(!empty($data['title'])){
                                    echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
                                }
                                if(!empty($data['description'])){
                                    echo '<p class="box-text">'.esc_html($data['description']).'</p>';
                                }
                                if(!empty($data['button_text'])){
                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn border-btn th-icon fw-medium text-uppercase"><span class="btn-text" data-back="'.esc_attr($data['button_text']).'" data-front="'.esc_attr($data['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i> </a>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
            echo '<div class="row gy-4">';
                foreach( $settings['service_list2'] as $data ){
                    echo '<div class="col-md-6 col-xl-4 col-xxl-3">';
                        echo '<div class="service-box">';
                            echo '<div class="box-content">';
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
                                if(!empty($data['button_text'])){
                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn border-btn th-icon fw-medium text-uppercase"><span class="btn-text" data-back="'.esc_attr($data['button_text']).'" data-front="'.esc_attr($data['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i> </a>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
            echo '<div class="row gy-4">';
                foreach( $settings['service_list2'] as $data ){
                    echo '<div class="col-lg-6 col-xxl-4">';
                        echo '<div class="service-grid style2">';
                            echo '<div class="service-grid_content">';
                                if(!empty($data['title'])){
                                    echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
                                }
                                if(!empty($data['description'])){
                                    echo '<p class="box-text">'.esc_html($data['description']).'</p>';
                                }
                                if(!empty($data['button_text'])){
                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn border-btn th-radius th-icon fw-semibold"><span class="btn-text" data-back="'.esc_attr($data['button_text']).'" data-front="'.esc_attr($data['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i></a>';
                                }
                            echo '</div>';
                            if(!empty($data['choose_icon']['url'])){
                                echo '<div class="box-img th-anim">';
                                    echo solak_img_tag( array(
                                        'url'   => esc_url( $data['choose_icon']['url'] ),
                                    ));
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){


		}


	}

}