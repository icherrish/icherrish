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
 * Marquee Widget .
 *
 */
class Solak_Marquee extends Widget_Base {

	public function get_name() {
		return 'solakmarquee';
	}
	public function get_title() {
		return __( 'Marquee', 'solak' );
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
				'label'     => __( 'Marquee', 'solak' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

        solak_media_fields($this, 'bg', 'Choose Background', ['1']);

        $repeater = new Repeater();

		solak_media_fields($repeater, 'icon', 'Choose Icon');
		solak_general_fields($repeater, 'title', 'title', 'TEXT', 'Smart Energy');
		
		$this->add_control(
			'marquee_lists',
			[
				'label' 		=> __( 'Marquee Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'button_text' 	=> __( 'Smart Energy', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '2']
				]
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .text', ['1', '2'], '-webkit-text-stroke-color' );

	}

	protected function render() {

    $settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){
            echo '<div class="marquee-area space-extra" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
                echo '<div class="marquee-content positive-relative overflow-hidden">';
                    echo '<div class="marquee">';
                        echo '<div class="marquee-group">';
                            foreach( $settings['marquee_lists'] as $data ){
                                echo '<div class="item ">';
                                    echo solak_img_tag( array(
                                        'url'   => esc_url( $data['icon']['url'] ),
                                    ));
                                    if(!empty($data['title'])){
                                        echo '<span>'.esc_html($data['title']).'</span>';
                                    }
                                echo '</div>';
                            }
                        echo '</div>';
                        echo '<div aria-hidden="true" class="marquee-group">';
                            foreach( $settings['marquee_lists'] as $data ){
                                echo '<div class="item ">';
                                    echo solak_img_tag( array(
                                        'url'   => esc_url( $data['icon']['url'] ),
                                    ));
                                    if(!empty($data['title'])){
                                        echo '<span>'.esc_html($data['title']).'</span>';
                                    }
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
        
                echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="marquee-area2 space-extra">';
				echo '<div class="marquee-content positive-relative overflow-hidden">';
					echo '<div class="marquee">';
						echo '<div class="marquee-group style2">';
							foreach( $settings['marquee_lists'] as $data ){
								echo '<div class="item ">';
									echo solak_img_tag( array(
										'url'   => esc_url( $data['icon']['url'] ),
									));
									if(!empty($data['title'])){
										echo '<span>'.esc_html($data['title']).'</span>';
									}
								echo '</div>';
							}
						echo '</div>';
						echo '<div aria-hidden="true" class="marquee-group style2">';
							foreach( $settings['marquee_lists'] as $data ){
								echo '<div class="item ">';
									echo solak_img_tag( array(
										'url'   => esc_url( $data['icon']['url'] ),
									));
									if(!empty($data['title'])){
										echo '<span>'.esc_html($data['title']).'</span>';
									}
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
		
				echo '</div>';
			echo '</div>';

		}
		
			
	}
}