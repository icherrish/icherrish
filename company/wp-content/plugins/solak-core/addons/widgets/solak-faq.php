<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Faq Widget .
 *
 */
class solak_Faq extends Widget_Base {

	public function get_name() {
		return 'solakfaq';
	}
	public function get_title() {
		return __( 'Faq', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'faq_section',
			[
				'label'		 	=> __( 'Faq', 'solak' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

		$this->add_control(
			'show_load_more',
			[
				'label' 		=> __( 'Show Load More Option?', 'solak' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'solak' ),
				'label_off' 	=> __( 'Hide', 'solak' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'	=> [
					'layout_style' => ['5'],
				]
			]
		);
		$this->add_control(
			'faq_item_count',
			[
				'label' 	=> __( 'No of faq to show', 'solak' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => 16,
                'default'  	=> __( '5', 'solak' ),
				'condition'	=> [
					'layout_style' => ['5'],
					'show_load_more' => [ 'yes' ],
				]
			]
        );
		$this->add_control(
			'faq_loop_item_count',
			[
				'label' 	=> __( 'No of faq Loop to show', 'solak' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => 16,
                'default'  	=> __( '3', 'solak' ),
				'condition'	=> [
					'layout_style' => ['5'],
					'show_load_more' => [ 'yes' ],
				]
			]
        );

		solak_general_fields($this, 'load_more_btn', 'Load More Button Text', 'TEXTAREA2', 'Load More', ['5']);

		solak_general_fields($this, 'faq_id', 'Faq ID', 'TEXT2', '1' );
		solak_general_fields($this, 'active_id', 'Active Number', 'NUMBER', '1' );

        $repeater = new Repeater();

		solak_general_fields($repeater, 'faq_question', 'Faq Question', 'TEXTAREA', 'What Services Do You Offer?');
		solak_general_fields($repeater, 'faq_answer', 'Faq Answer', 'WYSIWYG', 'Ensuring safety on a construction site is crucial to protect workers');

		$this->add_control(
			'faq_repeater',
			[
				'label' 		=> __( 'Faq Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'faq_question'    => __( 'What Services Do You Offer?', 'solak' ),
					],
				],
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//--------------------------------------- 

		//------Menu Bar Style-------
        $this->start_controls_section(
			'faq_styling',
			[
				'label'     => __( 'Faq Styling', 'solak' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

		solak_general_fields( $this, 'hr', 'Question Style', 'HEADING', '' );
		solak_color_fields( $this, 'title_color', 'Color', 'color', '{{WRAPPER}} .accordion-button' );
		solak_typography_fields( $this, 'title_font', 'Trpography', '{{WRAPPER}} .accordion-button' );
		solak_general_fields( $this, 'hr2', 'Answer Style', 'HEADING', '' );
		solak_color_fields( $this, 'contnet_color', 'Color', '--body-color', '{{WRAPPER}} .faq-text, {{WRAPPER}} .faq-text p' );
		solak_typography_fields( $this, 'contnet_font', 'Trpography', '{{WRAPPER}} .accordion-body, {{WRAPPER}} p' );

		$this->end_controls_section();

		//-------Title Style-------


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="accordion-area accordion" id="faqAccordion'.esc_attr($settings['faq_id']).'">';
					$x = 0;
					foreach( $settings['faq_repeater'] as $key => $single_data ){
						$unique_id = uniqid();
						$x++;

						$active_id = ($settings['active_id']) ? $settings['active_id'] : '1';

						if( $x == $active_id ){
							$ariaexpanded 	= 'true';
							$class 			= 'show';
							$collesed 		= '';
							$is_active 		= 'active';
						}else{
							$ariaexpanded 	= 'false';
							$class 			= '';
							$collesed 		= 'collapsed';
							$is_active 		= '';
						}

					echo '<div class="accordion-card '.esc_attr( $is_active ).'">';
						echo '<div class="accordion-header" id="collapse-item-'.esc_attr( $unique_id ).'">';
							echo '<button class="accordion-button '.esc_attr( $collesed ).'" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-'.esc_attr( $unique_id ).'" aria-expanded="'.esc_attr( $ariaexpanded ).'" aria-controls="collapse-'.esc_attr( $unique_id ).'">'.wp_kses_post($single_data['faq_question']).'</button>';
						echo '</div>';

						echo '<div id="collapse-'.esc_attr( $unique_id ).'" class="accordion-collapse collapse '.esc_attr( $class ).'" aria-labelledby="collapse-item-'.esc_attr( $unique_id ).'" data-bs-parent="#faqAccordion'.esc_attr($settings['faq_id']).'">';
							echo '<div class="accordion-body">';
								echo '<div class="faq-text">';
									echo wp_kses_post($single_data['faq_answer']);
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){


		}elseif( $settings['layout_style'] == '5' ){
			$faq_item_count = $settings['faq_item_count'];
			$faq_loop_item_count = $settings['faq_loop_item_count'];

			echo '<div class="accordion-1 accordion load-more-active" id="faqAccordion'.esc_attr($settings['faq_id']).'">';
					$x = 0;
					foreach( $settings['faq_repeater'] as $key => $single_data ){
						$unique_id = uniqid();
						$x++;

						$active_id = ($settings['active_id']) ? $settings['active_id'] : '1';

						if( $x == $active_id ){
							$ariaexpanded 	= 'true';
							$class 			= 'show';
							$collesed 		= '';
							$is_active 		= 'active';
						}else{
							$ariaexpanded 	= 'false';
							$class 			= '';
							$collesed 		= 'collapsed';
							$is_active 		= '';
						}

					echo '<div class="accordion-card '.esc_attr( $is_active ).' th-faq-loop">';
						echo '<div class="accordion-header" id="collapse-item-'.esc_attr( $unique_id ).'">';
							echo '<button class="accordion-button '.esc_attr( $collesed ).'" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-'.esc_attr( $unique_id ).'" aria-expanded="'.esc_attr( $ariaexpanded ).'" aria-controls="collapse-'.esc_attr( $unique_id ).'">'.wp_kses_post($single_data['faq_question']).'</button>';
						echo '</div>';

						echo '<div id="collapse-'.esc_attr( $unique_id ).'" class="accordion-collapse collapse '.esc_attr( $class ).'" aria-labelledby="collapse-item-'.esc_attr( $unique_id ).'" data-bs-parent="#faqAccordion'.esc_attr($settings['faq_id']).'">';
							echo '<div class="accordion-body">';
								echo wp_kses_post($single_data['faq_answer']);
							echo '</div>';
						echo '</div>';
					echo '</div>';
					}
			echo '</div>';
			if(!empty($settings['show_load_more'])){
				if($x > $faq_item_count){
					echo '<div class="text-center">';
						echo '<button id="load-more-faq-btn" class="th-btn mt-3">'.esc_html($settings['load_more_btn']).'<i class="fa-duotone fa-spinner ms-2"></i></button>';
					echo '</div>';
				}
			}
			?>
			<script>
				jQuery(document).ready(function($) {
					// Set the number of items to show initially and load on each click
					var itemsToShow = <?php echo $faq_item_count; ?>;
					var itemsPerLoad = <?php echo $faq_loop_item_count; ?>; 
					var currentIndex = itemsToShow;
				
					// Hide items beyond the initial count
					$('.th-faq-loop').slice(itemsToShow).hide();      
				
					// Attach a click event to the "Load More" button
					$('#load-more-faq-btn').on('click', function() {
						// Show the next batch of items
						$('.th-faq-loop').slice(currentIndex, currentIndex + itemsPerLoad).fadeIn();
						
						// Update the current index
						currentIndex += itemsPerLoad;
				
						// Hide the "Load More" button if all items are displayed
						if (currentIndex >= $('.th-faq-loop').length) {
							$('#load-more-faq-btn').hide();
						}
					});
				});
			</script>

		<?php
		}
		
	

	}
}