<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Button Widget 
 *
 */
class solak_Button extends Widget_Base {

	public function get_name() {
		return 'solakbutton';
	}
	public function get_title() {
		return __( 'Button', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'button_section',
			[
				'label' 	=> __( 'Button', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', ['Style One'] );

		solak_general_fields($this, 'button_text', 'Button Text', 'TEXT', 'Button Text');
		solak_general_fields($this, 'button_extra_class', 'Button Extra Class', 'TEXT', '');
		solak_url_fields($this, 'button_url', 'Button URL');
		solak_general_fields($this, 'button_icon', 'Button Icon Class', 'TEXT', '');

		$this->add_control(
			'button_icon_position',
			[
				'label' 	=> __( 'Button Icon Position', 'solak' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '2',
				'options' 	=> [
					'1'  		=> __( 'Before Text', 'solak' ),
					'2' 		=> __( 'After Text', 'solak' ),
				],
			]
		);

		$this->add_control(
			'button_space',
			[
				'label' => esc_html__( 'Button Icon Spacing (PX)', 'solak' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .th_btn i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition'	=> [
					'button_icon_position' => ['1']
				]	
			]
		);

		$this->add_control(
			'button_space2',
			[
				'label' => esc_html__( 'Button Icon Spacing (PX)', 'solak' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .th_btn i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition'	=> [
					'button_icon_position' => ['2']
				]	
			]
		);

        $this->add_responsive_control(
			'button_align',
			[
				'label' 		=> __( 'Alignment', 'solak' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' 	=> [
						'title' 		=> __( 'Left', 'solak' ),
						'icon' 			=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' 		=> __( 'Center', 'solak' ),
						'icon' 			=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' 		=> __( 'Right', 'solak' ),
						'icon' 			=> 'eicon-text-align-right',
					],
				],
				'default' 		=> 'left',
				'toggle' 		=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .btn-wrapper' => 'text-align: {{VALUE}}',
                ],
			]
        );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//------Button Style-------
		solak_button_style_fields($this, '10', 'Button Styling', '{{WRAPPER}} .th_btn', ['1']);
		solak_button2_style_fields($this, '11', 'Button Styling', '{{WRAPPER}} .th_btn', ['2']);
		
    }

	protected function render() { 

        $settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'btn-wrapper');
		if( $settings['layout_style'] == '2' ){
			$this->add_render_attribute( 'button', 'class', 'th-btn2 th_btn' );
		}else{
			$this->add_render_attribute( 'button', 'class', 'th-btn th_btn' );
		}


		$this->add_render_attribute( 'button', 'class', $settings['button_extra_class'] );

        if( ! empty( $settings['button_url']['url'] ) ) {
            $this->add_render_attribute( 'button', 'href', esc_url( $settings['button_url']['url'] ) );
        }
        if( ! empty( $settings['button_url']['nofollow'] ) ) {
            $this->add_render_attribute( 'button', 'rel', 'nofollow' );
        }
        if( ! empty( $settings['button_url']['is_external'] ) ) {
            $this->add_render_attribute( 'button', 'target', '_blank' );
        }

		echo '<div '.$this->get_render_attribute_string('wrapper').'>';
			if( ! empty( $settings['button_text'] ) ) {
				echo '<a '.$this->get_render_attribute_string('button').'>';
				if( ! empty( $settings['button_icon'] ) && $settings['button_icon_position'] == '1'  ){
					echo wp_kses_post($settings['button_icon']);
				}

				echo '<span class="btn-text" data-back="'.esc_html( $settings['button_text'] ).'" data-front="'.esc_html( $settings['button_text'] ).'"></span>';
				
				if( ! empty( $settings['button_icon'] ) && $settings['button_icon_position'] == '2'  ){
					echo wp_kses_post($settings['button_icon']);
				}
				echo '</a>';
			}
		echo '</div>';

		
	}

}