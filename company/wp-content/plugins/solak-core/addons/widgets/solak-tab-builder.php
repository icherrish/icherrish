<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Tab Builder Widget .
 *
 */
class solak_Tab_Builder extends Widget_Base {

	public function get_name() {
		return 'solaktabbuilder';
	}
	public function get_title() {
		return __( 'Tab Builder', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
    public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'tab_builder_section',
			[
				'label' 	=> __( 'Tab Builder', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

		solak_media_fields($this, 'shape', 'Choose Subtitle Shape', ['2'] );
		solak_general_fields($this, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Explore Recent Projects', ['2'] );
		solak_general_fields($this, 'title', 'Title', 'TEXTAREA', 'We have done the latest projects', ['2'] );

		$repeater = new Repeater();

		solak_general_fields( $repeater, 'title', 'Tab Builder Title', 'TEXTAREA2', 'Tab 1' );

		$repeater->add_control( 
			'solak_tab_builder_option',
			[
				'label'     => __( 'Tab Name', 'solak' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->solak_tab_builder_choose_option(),
				'default'	=> ''
			]
		);

		$this->add_control(
			'tab_builder_repeater',
			[
				'label' 		=> __( 'Tab', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title'    => __( 'Tab 1', 'solak' ),
					],
					
				],
				'title_field' 	=> '{{{ title }}}',
				'condition'		=> [ 
					'layout_style' => [ '1', '2' ],
				],
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields( $this, '01', 'Subtitle', '{{WRAPPER}} .sub-title', ['2'],'--theme-color' );
		solak_common_style_fields( $this, '02', 'Title', '{{WRAPPER}} .sec-title', ['2'] );

    }

	public function solak_tab_builder_choose_option(){

		$solak_post_query = new WP_Query( array(
			'post_type'				=> 'solak_tab_builder',
			'posts_per_page'	    => -1,
		) );

		$solak_tab_builder_title = array();
		$solak_tab_builder_title[''] = __( 'Select a Tab','Foodelio');

		while( $solak_post_query->have_posts() ) {
			$solak_post_query->the_post();
			$solak_tab_builder_title[ get_the_ID() ] =  get_the_title();
		}
		wp_reset_postdata();

		return $solak_tab_builder_title;

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="text-center">';
				echo '<div class="nav tab-menu2 indicator-active" id="tab-menu1" role="tablist">';
					$x = 0;
					foreach( $settings['tab_builder_repeater'] as $data ){
						$x++;
						$active = $x == '1' ? 'active':'';
						echo '<button class="tab-btn '.esc_attr($active).'" id="nav-'.esc_attr($x).'-tab" data-bs-toggle="tab" data-bs-target="#nav-'.esc_attr($x).'" type="button" role="tab" aria-controls="nav-'.esc_attr($x).'" aria-selected="true">'.esc_html( $data['title'] ).'</button>';
					}
				echo '</div>';
			echo '</div>';

			echo '<div class="tab-content">';
				$x = 0;
				foreach( $settings['tab_builder_repeater'] as $data ){
					$x++;
					$active = $x == '1' ? 'active show':'';
					echo '<div class="tab-pane fade '.esc_attr($active).'" id="nav-'.esc_attr($x).'" role="tabpanel" aria-labelledby="nav-'.esc_attr($x).'-tab">';
						$elementor = \Elementor\Plugin::instance();
						if( ! empty( $data['solak_tab_builder_option'] ) ){
							echo $elementor->frontend->get_builder_content_for_display( $data['solak_tab_builder_option'] );
						}
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="row justify-content-between align-items-center">';
				echo '<div class="col-xl-4 col-lg-5">';
					echo '<div class="title-area text-center text-lg-start">';
						if(!empty($settings['subtitle'])){
							echo '<span class="sub-title">';
								echo '<span class="line"></span>';
								echo solak_img_tag( array(
									'url'   => esc_url( $settings['shape']['url'] ),
								)); 
								echo esc_html($settings['subtitle']);
							echo '</span>';
						}
						if(!empty($settings['title'])){
							echo '<h2 class="sec-title">'.wp_kses_post($settings['title']).'</h2>';
						}
					echo '</div>';
				echo '</div>';
				echo '<div class="col-lg-auto">';
					echo '<div class="sec-btn mt-n3 mt-lg-0">';
						echo '<div class="nav tab-menu1 indicator-active" id="tab-menu1" role="tablist">';
							$x = 0;
							foreach( $settings['tab_builder_repeater'] as $data ){
								$x++;
								$active = $x == '1' ? 'active':'';
								echo '<button class="tab-btn '.esc_attr($active).'" id="nav-'.esc_attr($x).'-tab" data-bs-toggle="tab" data-bs-target="#nav-'.esc_attr($x).'" type="button" role="tab" aria-controls="nav-'.esc_attr($x).'" aria-selected="true">'.esc_html( $data['title'] ).'</button>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="tab-content">';
				$x = 0;
				foreach( $settings['tab_builder_repeater'] as $data ){
					$x++;
					$active = $x == '1' ? 'active show':'';
					echo '<div class="tab-pane fade '.esc_attr($active).'" id="nav-'.esc_attr($x).'" role="tabpanel" aria-labelledby="nav-'.esc_attr($x).'-tab">';
						$elementor = \Elementor\Plugin::instance();
						if( ! empty( $data['solak_tab_builder_option'] ) ){
							echo $elementor->frontend->get_builder_content_for_display( $data['solak_tab_builder_option'] );
						}
					echo '</div>';
				}
			echo '</div>';

		}
		
      
	}
}