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
 * Skill Widget .
 *
 */
class solak_Skill extends Widget_Base {

	public function get_name() {
		return 'solakskill';
	}
	public function get_title() {
		return __( 'Skill Bar', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

        $this->start_controls_section(
            'skill_bar_section',
                [
                    'label' 	=> __( 'Skill Bar', 'solak' ),
                    'tab' 		=> Controls_Manager::TAB_CONTENT,
                ]
        );

        solak_select_field( $this, 'layout_style', 'Layout Style', ['Style One', 'Style Two', 'Style Three'] );

        solak_media_fields( $this, 'image', 'Choose Image', ['1'] );
        solak_media_fields( $this, 'image2', 'Choose Image', ['1'] );

        $repeater = new Repeater();

        solak_general_fields($repeater, 'skill_title', 'Title', 'TEXT', 'Success Rate');
        solak_general_fields($repeater, 'skill_num', 'Number', 'TEXT', '90');

        $this->add_control(
            'skill_lists',
            [
                'label' 		=> __( 'Skill Lists', 'solak' ),
                'type' 			=> Controls_Manager::REPEATER,
                'fields' 		=> $repeater->get_controls(),
                'default' 		=> [
                        [
                            'skill_title' => __( 'Success Rate', 'solak' ),
                        ],
                ],
            ]
        );

        $this->end_controls_section();

        //---------------------------------------
            //Style Section Start
        //---------------------------------------

        solak_common_style_fields($this, '01', 'Title', '{{WRAPPER}} .box-title', ['1']);
        solak_common_style_fields($this, '011', 'Title', '{{WRAPPER}} .progress-title-holder', ['3']);
        solak_common_style_fields($this, '02', 'Title', '{{WRAPPER}} .text', ['2']);
        solak_common_style_fields($this, '03', 'Number', '{{WRAPPER}} .th-progress .progress-bars', ['1'], 'fill');
        solak_common_style_fields($this, '032', 'Number', '{{WRAPPER}} .counter', ['2'] );

	}

	protected function render() {

    $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="row gx-0 align-items-end">';
                echo '<div class="col-lg-5">';
                    echo '<div class="img-box4">';
                        if(!empty($settings['image']['url'])){
                            echo '<div class="img1">';
                                echo solak_img_tag( array(
                                    'url'   => esc_url( $settings['image']['url'] ),
                                ));
                            echo '</div>';
                        }
                        foreach( $settings['skill_lists'] as $key => $data ){
                            if($key == 0){
                                echo '<div class="th-progress" data-progress-value="'.esc_attr($data['skill_num']).'">';
                                    echo '<svg viewBox="0 0 110 60" class="progress-bars">
                                        <defs>
                                            <linearGradient id="gradient2" x1="0" y1="0" x2="0" y2="1">
                                                <stop offset="0%" stop-color="#FFB30F" />
                                                <stop offset="100%" stop-color="#FFB30F" />
                                            </linearGradient>
                                        </defs>
                                        <path class="grey" d="M30,90 A40,40 0 1,1 80,90" fill="none" stroke="#E0E0E0" stroke-width="5" />
                                        <path class="half-circle" d="M30,90 A40,40 0 1,1 80,90" fill="none" stroke="url(#gradient2)" stroke-width="5" stroke-dasharray="251.2" stroke-dashoffset="251.2" />
                                        <text x="55" y="55" dominant-baseline="middle" text-anchor="middle">0%</text>
                                    </svg>';
                                    if(!empty($data['skill_title'])){
                                        echo '<h3 class="box-title">'.esc_html($data['skill_title']).'</h3>';
                                    }
                                echo '</div>';
                            }
                        }
                    echo '</div>';
                echo '</div>';
                echo '<div class="col-lg-7">';
                    echo '<div class="progress-wrapper">';
                    foreach ($settings['skill_lists'] as $key => $data) {
                        if ($key > 0) {
                            if (in_array($key, [1, 3, 5])) {
                                $stop_color = "#57B33E";
                            } else {
                                $stop_color = "#FFFA84";
                            }
                    
                            echo '<div class="th-progress" data-progress-value="'.esc_attr($data['skill_num']).'">';
                                echo '<svg viewBox="0 0 110 60" class="progress-bars">
                                    <defs>
                                        <linearGradient id="gradient1-' . $key . '" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="' . $stop_color . '" />
                                            <stop offset="100%" stop-color="' . $stop_color . '" />
                                        </linearGradient>
                                    </defs>
                                    <path class="grey" d="M30,90 A40,40 0 1,1 80,90" fill="none" stroke="#E0E0E0" stroke-width="5" />
                                    <path class="half-circle" d="M30,90 A40,40 0 1,1 80,90" fill="none" stroke="url(#gradient1-' . $key . ')" stroke-width="5" stroke-dasharray="251.2" stroke-dashoffset="251.2" />
                                    <text x="55" y="55" dominant-baseline="middle" text-anchor="middle">0%</text>
                                </svg>';
                                if(!empty($data['skill_title'])){
                                    echo '<h3 class="box-title">'.esc_html($data['skill_title']).'</h3>';
                                }
                            echo '</div>';
                            if ($key < count($settings['skill_lists']) - 1) {
                                echo '<div class="divider"></div>';
                            }
                        }
                    }                    
                    echo '</div>';
                    echo '<div class="img-box5">';
                        if(!empty($settings['image2']['url'])){
                            echo '<div class="img1">';
                                echo solak_img_tag( array(
                                    'url'   => esc_url( $settings['image2']['url'] ),
                                ));
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }elseif( $settings['layout_style'] == '2' ){
            echo '<div class="choose-progress-bar">';
                foreach( $settings['skill_lists'] as $data ){
                    echo '<div class="progress-bar">';
                        echo '<div class="progress-track">';
                            echo '<div class="progress-fill">';
                                if(!empty($data['skill_num'])){
                                    echo '<span class="counter">'.esc_attr($data['skill_num']).'%</span>';
                                }
                                if(!empty($data['skill_title'])){
                                    echo '<span class="text">'.esc_html($data['skill_title']).'</span>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

        }elseif( $settings['layout_style'] == '3' ){
            foreach( $settings['skill_lists'] as $data ){
                echo '<div class="skill-feature">';
                    echo '<div class="progress-bar" data-percentage="'.esc_attr($data['skill_num']).'%">';
                        if(!empty($data['skill_title'])){
                            echo '<h4 class="progress-title-holder">'.esc_html($data['skill_title']).'<span class="progress-number-wrapper">';
                                    echo '<span class="progress-number-mark">';
                                        echo '<span class="percent"></span>';
                                    echo '</span>';
                                echo '</span>';
                            echo '</h4>';
                        }
                        echo '<div class="progress-content-outter">';
                            echo '<div class="progress-content"></div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

            }

        }


	}

}