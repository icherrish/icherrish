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
class solak_Animated_Shape extends Widget_Base {

	public function get_name() {
		return 'solakshapeimage';
	}
	public function get_title() {
		return __( 'Animated Image', 'solak' );
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

		solak_select_field( $this, 'layout_style', 'Layout Style', ['Style One'] );    

        $this->add_control(
			'image',
			[
				'label' 		=> __( 'Choose Image', 'solak' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
			]
		);
		$this->add_control(
			'effect_style',
			[
				'label' 		=> esc_html__( 'Add Styling Attributes', 'solak' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'options' 		=> [
					'jump'  			=> esc_html__( 'Jump Effect', 'solak' ),
					'jump-reverse'  	=> esc_html__( 'Jump Reverse Effect', 'solak' ),
					'moving'  			=> esc_html__( 'Moving Effect', 'solak' ),
					'movingX'  			=> esc_html__( 'Moving Reverse Effect(X)', 'solak' ),
					'spin'			=> esc_html__( 'Spin Effect', 'solak' ),
					'pulse'			=> esc_html__( 'Pulse Effect', 'solak' ),
					'rotate-x'			=> esc_html__( 'Rotate Effect', 'solak' ),
					''			=> esc_html__( 'No Effect', 'solak' ),
				],
				'default' => [ 'jump'],
			]
		);
		$this->add_control(
			'from_top',
			[
				'label' 		=> __( 'Top', 'solak' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
				],
			]
		);
		$this->add_control(
			'from_left',
			[
				'label' 		=> __( 'Left', 'solak' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' 		=> [
					'%' 			=> [
						'min' 			=> 0,
						'max' 			=> 100,
					],
				],
				'default' => [
					'unit' => '%',
				],
			]
		);
		$this->add_control(
			'from_right',
			[
				'label' 		=> __( 'Right', 'solak' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' 		=> [
					'%' 			=> [
						'min' 			=> 0,
						'max' 			=> 100,
					],
				],
				'default' => [
					'unit' => '%',
				],
			]
		);
		$this->add_control(
			'from_bottom',
			[
				'label' 		=> __( 'Bottom', 'solak' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' 		=> [
					'%' 			=> [
						'min' 			=> 0,
						'max' 			=> 100,
					],
				],
				'default' => [
					'unit' => '%',
				],
			]
		);
		$this->add_control(
			'responsive_style',
			[
				'label' 		=> esc_html__( 'Responsive Styling', 'solak' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT2,
				'label_block' 	=> true,
				'multiple' 		=> true,
				'options' 		=> [
					'd-xxl-block'  		=> esc_html__( 'Hide From Extra large Device (xxl)', 'solak' ),
					'd-xl-block'  		=> esc_html__( 'Hide From large Device (xl)', 'solak' ),
					'd-lg-block'  		=> esc_html__( 'Hide From Tablet (lg)', 'solak' ),
					'd-md-block'  		=> esc_html__( 'Hide From Mobile (md)', 'solak' ),
					'd-sm-block'  		=> esc_html__( 'D Small Device (sm)', 'solak' ),
					'd-none'  			=> esc_html__( 'Display None', 'solak' ),
					' '  				=> esc_html__( 'Default', 'solak' ),
				],
			]
		);
		$this->add_control(
			'image_class', [
				'label' 		=> __( 'Image Wrap Class Name', 'solak' ),
				'description' 		=> __( 'Need to add image wrapper class name', 'solak' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'label_block' 	=> true,
			]
        );
		$this->add_control(
			'image_class2', [
				'label' 		=> __( 'Image Class Name', 'solak' ),
				'description' 		=> __( 'Need to add image class name', 'solak' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'label_block' 	=> true,
				'condition'		=> [ 
					'layout_style' => [ '1' ]
				],
			]
        );

        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper','class','shape-mockup');
		if(!empty($settings['image_class'])){
			$this->add_render_attribute('wrapper','class', $settings['image_class']);
		}
        $this->add_render_attribute('wrapper','class', $settings['effect_style']);
        $this->add_render_attribute('wrapper','class', $settings['responsive_style']);

	    if($settings['from_top']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-top', $settings['from_top']['size'] . $settings['from_top']['unit'] );
	    }
		if($settings['from_bottom']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-bottom', $settings['from_bottom']['size'] . $settings['from_bottom']['unit'] );
	    }
	    if($settings['from_right']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-right', $settings['from_right']['size'] . $settings['from_right']['unit'] );
	    }
	    if($settings['from_left']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-left', $settings['from_left']['size'] . $settings['from_left']['unit'] );
	    }

		if( $settings['layout_style'] == '2' ){
			$this->add_render_attribute('wrapper','data-mask-src',  $settings['image']['url']);
		}

		if( $settings['layout_style'] == '1' ){
			if( !empty( $settings['image']['id'] ) ) {
				echo '<!-- Image -->';
					echo '<div '.$this->get_render_attribute_string('wrapper').'>';
						echo '<img class="'.esc_attr($settings['image_class2']).'" src="'.esc_url( $settings['image']['url']).'" alt="'.esc_attr__('Shape Image', 'solak').'" >';
					echo '</div>';
				echo '<!-- End Image -->';
			}
		}
		
	}
}