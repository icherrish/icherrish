<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
/**
 * 
 * Footer Widgets .
 *
 */
class Solak_Footer_Widgets extends Widget_Base {

	public function get_name() {
		return 'solakfooterwidgets';
	}
	public function get_title() {
		return __( 'Footer Widgets', 'solak' ); 
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label'     => __( 'Footer Widget Style', 'solak' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

        solak_media_fields( $this, 'logo', 'Choose Logo', ['1'] );
		solak_general_fields( $this, 'title', 'Title', 'TEXT', 'Title', ['2'] );
		solak_general_fields( $this, 'desc', 'Description', 'TEXTAREA', '', ['1'] );

        solak_social_fields( $this, 'social_icon_list', 'Social Media', ['1'] );

        $repeater = new Repeater();

		solak_general_fields($repeater, 'icon', 'Icon', 'TEXTAREA2', '');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Label');
		solak_general_fields($repeater, 'desc', 'Content', 'TEXTAREA', 'Content');
		
		$this->add_control(
			'contact_lists',
			[
				'label' 		=> __( 'Contact Info', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Label', 'solak' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['2']
				]
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		solak_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .widget_title', ['2'] );
		solak_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} .desc', ['1'] );

		solak_common_style_fields( $this, '001', 'Contact Title', '{{WRAPPER}} .footer-info-title', ['2'] );
		solak_common_style_fields( $this, '002', 'Contact Info', '{{WRAPPER}} .footer-info span, {{WRAPPER}} .footer-info span a', ['2'] );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            echo '<div class="widget footer-widget">';
                echo '<div class="th-widget-about">';
                    if(!empty($settings['logo']['url'])){
                        echo '<div class="about-logo">';
                            echo '<a href="'.esc_url( home_url('/') ).'">';
                                echo solak_img_tag( array(
                                    'url'   => esc_url( $settings['logo']['url'] ),
                                ));
                            echo '</a>';
                        echo '</div>';
                    }
                    if($settings['desc']){
                        echo '<p class="about-text desc">'.esc_html($settings['desc']).'</p>';
                    }
                    echo '<div class="th-social">';
                        foreach( $settings['social_icon_list'] as $social_icon ){
                            $social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
                            $social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

                            echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

                            \Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );

                            echo '</a> ';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div> ';

		}elseif( $settings['layout_style'] == '2' ){
            echo '<div class="widget footer-widget">';
                if($settings['title']){
                    echo '<h3 class="widget_title">';
                        echo esc_html($settings['title']);
                    echo '</h3>';
                }
                echo '<div class="th-widget-about">';
                    foreach( $settings['contact_lists'] as $data ){
                        if(!empty($data['title'])){
                            echo '<h4 class="footer-info-title">'.esc_html($data['title']).'</h4>';
                        }
                        echo '<p class="footer-info">';
                            if(!empty($data['icon'])){
                                echo wp_kses_post($data['icon']);
                            }
                            if(!empty($data['desc'])){
                                echo '<span>'.wp_kses_post($data['desc']).'</span>';
                            }
                        echo '</p>';
                    }
                echo '</div>';
            echo '</div>';
            
		}elseif( $settings['layout_style'] == '3' ){


        }
	

	}
}
						