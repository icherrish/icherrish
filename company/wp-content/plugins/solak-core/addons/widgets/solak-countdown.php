<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Countdown Widget .
 *
 */
class Solak_Countdown extends Widget_Base {

	public function get_name() {
		return 'solakcountdown';
	}
	public function get_title() {
		return __( 'Countdown', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'counter_section',
			[
				'label' 	=> __( 'Countdown', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] ); 

        solak_media_fields( $this, 'shape', 'Choose Shape', ['1'] );
		solak_general_fields( $this, 'title', 'Title', 'TEXTAREA', 'Noise' );
		solak_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'GET TICKETS' );
		solak_url_fields( $this, 'button_url', 'Button URL' );
        solak_switcher_fields( $this, 'show_date', 'Show Countdown?', ['1'] );
        $this->add_control(
			'date', [
				'label' 		=> __( 'Offer End Date With Time', 'solak' ),
				'type' 			=> Controls_Manager::DATE_TIME,
				'label_block' 	=> true,
			]
        );

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		
        //-------Title Style-------
        solak_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title' );
        //------Button Style (gradient-color)-------
        solak_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th_btn' );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            $offer_date_end = $settings['date'];
            $replace 	= array('-');
            $with 		= array('/');
    
            $date 	= str_replace( $replace, $with, $offer_date_end );

			echo '<div class="countdown-area" data-bg-src="'.esc_url($settings['bg']['url']).'">';
                echo '<div class="row gx-60 align-items-center">';
                if($settings['show_date'] == 'yes'){
                    echo '<div class="col-xl-7">';
                        echo '<ul class="counter-list event-counter" data-offer-date="'.esc_attr($date).'">';
                            echo '<li>';
                                echo '<div class="day count-number">00</div>';
                                echo '<span class="count-name">'.esc_html__('Days', 'solak').'</span>';
                            echo '</li>';
                            echo '<li>';
                                echo '<div class="hour count-number">00</div>';
                                echo '<span class="count-name">'.esc_html__('Hour', 'solak').'</span>';
                            echo '</li>';
                            echo '<li>';
                                echo '<div class="minute count-number">00</div>';
                                echo '<span class="count-name">'.esc_html__('Minute', 'solak').'</span>';
                            echo '</li>';
                            echo '<li>';
                                echo '<div class="seconds count-number">00</div>';
                                echo '<span class="count-name">'.esc_html__('Second', 'solak').'</span>';
                            echo '</li>';
                        echo '</ul>';
                    echo '</div>';
                }
                    echo '<div class="col-xl-5">';
                        echo '<div class="ms-0 ms-xl-3 mt-35 mt-xl-0 text-center text-xl-start">';
                            if(!empty($settings['title'])){
                                echo '<h3 class="sec-title mb-20 title">'.wp_kses_post($settings['title']).'</h3>';
                            }
                            if(!empty($settings['button_text'])){
                                echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn gr-bg1 shadow-none th_btn">'.wp_kses_post($settings['button_text']).'</a>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
		

		}

	
	}

}