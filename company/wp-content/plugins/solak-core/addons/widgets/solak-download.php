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
 * download Widget .
 *
 */
class Solak_Download extends Widget_Base {

	public function get_name() {
		return 'solakdownload';
	}
	public function get_title() {
		return __( 'Download Files', 'solak' );
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
				'label'     => __( 'Downloads', 'solak' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One'] );

		solak_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'Downloads');

		$repeater = new Repeater();

		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Label');
		solak_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'download_list',
			[
				'label' 		=> __( 'Download', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Label', 'solak' ),
					],
				],
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		solak_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .widget_title' );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="widget widget_download  ">';
				if($settings['title']){
					echo '<h4 class="widget_title style2">'.wp_kses_post($settings['title']).'</h4>';
				}
				echo '<div class="download-media-wrap">';
					foreach( $settings['download_list'] as $data ){
						// Get the file URL
						$file_url = esc_url( $data['button_url']['url'] );
						// Parse the URL to extract the file extension
						$file_extension = pathinfo( parse_url( $file_url, PHP_URL_PATH ), PATHINFO_EXTENSION );
						// Define allowed file extensions for download
						$allowed_extensions = ['pdf', 'zip', 'jpg', 'jpeg', 'png', 'docx', 'xlsx'];

						// Check if the file extension is in the allowed list
						$download_attr = in_array( strtolower( $file_extension ), $allowed_extensions ) ? ' download' : '';

						echo '<div class="download-media">';
							echo '<div class="download-media_info">';
								echo '<h5 class="download-media_title">'.esc_html( $data['title'] ).'</h5>';
							echo '</div>';
							echo '<a href="'.esc_url( $file_url ).'" class="download-media_btn"'. $download_attr .'><i class="far fa-arrow-right"></i></a>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){


		}
	

	}

}