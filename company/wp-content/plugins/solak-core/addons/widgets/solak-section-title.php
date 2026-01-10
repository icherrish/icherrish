<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * Section Title Widget .
 *
 */
class Solak_Section_Title extends Widget_Base {

	public function get_name() {
		return 'solaksectiontitle';
	}
	public function get_title() {
		return __( 'Section Title', 'solak' );
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
				'label'		 	=> __( 'Section Title', 'solak' ), 
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

		$this->add_control(
			'shape',
			[
				'label' 		=> __( 'Upload Shape if Change', 'solak' ),
				'type' 			=> Controls_Manager::MEDIA,
				'condition'		=> [ 
					'layout_style' => [ '2' ],
				],
			]
		);
		
		solak_general_fields( $this, 'section_subtitle', 'Subtitle', 'TEXT', 'Subtitle' );
		solak_general_fields( $this, 'section_title', 'Title', 'TEXTAREA', 'Title Here' );
		
        $this->add_control(
			'section_title_tag', 
			[
				'label' 	=> __( 'Title Tag', 'solak' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'span'  => 'span',
				],
				'default' => 'h2',
			]
        );

		solak_general_fields( $this, 'section_desc', 'Description', 'TEXTAREA', '' );

        $this->add_responsive_control(
			'section_align',
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
				'default' 	=> '',
				'toggle' 	=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .title-area' => 'text-align: {{VALUE}};',
                ]
			]
		);

		solak_general_fields( $this, 'wrap_class', 'Wraper Extra Class', 'TEXT', '' );
		solak_general_fields( $this, 'section_subtitle_class', 'Subtitle Extra Class', 'TEXT', '' );
		solak_general_fields( $this, 'section_title_class', 'Title Extra Class', 'TEXT', '' );
		solak_general_fields( $this, 'section_desc_class', 'Description Class', 'TEXT', '' );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------------------------General Style-----------------------//
        $this->start_controls_section(
			'general_style_section',
			[
				'label' => __( 'General Style', 'solak' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		solak_dimensions_fields($this, 'menu_margin', 'Margin', 'margin', '{{WRAPPER}} .title-area');

		$this->end_controls_section();

		//-------Subtitle Style-------
		solak_common_style_fields($this, 'subtitle', 'Subtitle', '{{WRAPPER}} .sub-title', ['1', '2', '3'], '--theme-color');
		//-------Title Style-------
		solak_common_style_fields($this, 'title', 'Title', '{{WRAPPER}} .sec-title');
		//-------Description Style-------
		solak_common_style_fields($this, 'desc', 'Description', '{{WRAPPER}} p');

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

	if (isset($settings['section_align'])) {
		if ($settings['section_align'] == 'left') {
			$wrap_align_class = 'text-left';
		} elseif ($settings['section_align'] == 'center') {
			$wrap_align_class = 'text-center';
		} elseif ($settings['section_align'] == 'right') {
			$wrap_align_class = 'text-right';
		} else {
			$wrap_align_class = '';
		}
	} else {
		$wrap_align_class = 'text-left';
	}

	if( $settings['layout_style'] == '2' ){
		$this->add_render_attribute( 'subtitle_args', 'class', 'sub-title2 '. $settings['section_subtitle_class'] );
	}else{
		$this->add_render_attribute( 'subtitle_args', 'class', 'sub-title '. $settings['section_subtitle_class'] );
	}
	$this->add_render_attribute( 'title_args', 'class', 'sec-title '. $settings['section_title_class']  );

	?>
		<div class="title-area <?php echo esc_attr($wrap_align_class . ' ' . $settings['wrap_class']); ?>">
			<?php	
				if ( !empty($settings['section_subtitle' ]) ){
					echo '<span '.$this->get_render_attribute_string( 'subtitle_args' ).'>';
						echo wp_kses_post( $settings['section_subtitle' ] );
					echo '</span>';
				}
			
				if ( !empty($settings['section_title' ]) ){
					printf( '<%1$s %2$s>%3$s</%1$s>',
					$settings['section_title_tag'],
					$this->get_render_attribute_string( 'title_args' ),
					wp_kses_post( $settings['section_title' ] )
					);
				}

				if( ! empty( $settings['section_desc'] ) ){
					echo solak_paragraph_tag( array(
						'text'	=> wp_kses_post( $settings['section_desc'] ),
						'class'	=> esc_attr($settings['section_desc_class']),
					) );
				}

			?>
		</div>

	<?php
		
	}
}