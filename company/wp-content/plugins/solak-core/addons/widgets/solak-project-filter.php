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
 * Project Filter Widget .
 *
 */
class Solak_Project_Filter extends Widget_Base {

	public function get_name() {
		return 'solakprojectfilter';
	}
	public function get_title() {
		return __( 'Project Filter', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'Project Filter_section',
			[
				'label'		 	=> __( 'Project Filter', 'solak' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three' ] );

        solak_switcher_fields($this, 'show_all', 'Show All Tab?');
		solak_general_fields($this, 'all_title', 'All Tab Text', 'TEXT', 'All');

		$repeater = new Repeater();

		solak_general_fields($repeater, 'tab_title', 'Tab Title', 'TEXT', 'Fixing');
		solak_general_fields($repeater, 'tab_id', 'Filter Tab ID', 'TEXT', 'cat1');

		$this->add_control(
			'project_tab',
			[
				'label' 		=> __( 'project Tab', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'tab_title' 		=> __( 'Fixing', 'solak' ),
					],
				],
			]
		);

		$repeater = new Repeater();

		solak_general_fields($repeater, 'tab_id2', 'Filter Content ID', 'TEXT', 'cat1');
		solak_media_fields($repeater, 'image', 'Choose Image');
		solak_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Furniture assembly');
		solak_general_fields($repeater, 'desc', 'Descrption', 'TEXTAREA', 'Raising a heavy fur muff that covered the viewer regor then turned.');
        solak_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Learn More');
		solak_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'project_list',
			[
				'label' 		=> __( 'Project Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Furniture assembly', 'solak' ), 
					],
				],
				'condition'		=> [ 
					'layout_style' => [ '1', '2'],
				],
			]
		);

		$repeater = new Repeater();

		solak_general_fields($repeater, 'tab_id2', 'Filter Content ID', 'TEXT', 'cat1');
		solak_media_fields($repeater, 'image', 'Choose Image');
		solak_general_fields($repeater, 'icon', 'Icon', 'TEXTAREA2', '<i class="fal fa-plus"></i>');
		solak_general_fields($repeater, 'col', 'Column Class Name', 'TEXTAREA2', '');

		$this->add_control(
			'project_list2',
			[
				'label' 		=> __( 'Project Lists', 'solak' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'icon' 		=> __( '<i class="fal fa-plus"></i>', 'solak' ), 
					],
				],
				'condition'		=> [ 
					'layout_style' => [ '3'],
				],
			]
		);


        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		
		solak_common2_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title a' );
		solak_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} .box-text' );

        solak_button2_style_fields( $this, '11', 'Button Styling', '{{WRAPPER}} .th_btn', ['1'] );
        solak_button_style_fields( $this, '12', 'Button Styling', '{{WRAPPER}} .th_btn', ['2'] );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            echo '<div class="filter-menu indicator-active filter-menu-active">';
                if(!empty($settings['show_all'])){
                    $active = '';
                    if(!empty($settings['all_title'])){
                        $title = $settings['all_title'];
                    }else{
                        $title = 'All';
                    }
                    echo '<button data-filter="*" class="tab-btn active" type="button">'.esc_html($title).'</button>';
                }else{
                    $active = 'active';
                }
                foreach( $settings['project_tab'] as $key => $data ){
                    $id = strtolower($data['tab_id']);
                    $active_class = ($key == 0) ? $active : '';
                    echo '<button data-filter=".'.esc_attr($id).'" class="tab-btn '.esc_attr($active_class).'" type="button">'.esc_html($data['tab_title']).'</button>';
                }
            echo '</div>';
            
            echo '<div class="row gy-4 filter-active">';
                foreach( $settings['project_list'] as $data ){
                    $id = strtolower($data['tab_id2']);
                    echo '<div class="col-xxl-3 col-lg-4 col-md-6 filter-item '.esc_attr($id).'">';
                        echo '<div class="project-grid">';
                            if(!empty($data['image']['url'])){
								echo '<div class="box-img">';
									echo solak_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									));
								echo '</div>';
							}
                            echo '<div class="box-content">';
                                if(!empty($data['title'])){
                                    echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
                                }
                                if(!empty($data['desc'])){
                                    echo '<p class="box-text">'.esc_html($data['desc']).'</p>';
                                }
                                if(!empty($data['button_text'])){
                                    echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn2 style2 btn-sm th_btn">'.esc_html($data['button_text']).'<i class="far fa-arrow-right"></i></a>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="text-center">';
				echo '<div class="filter-menu style2 indicator-active filter-menu-active">';
					if(!empty($settings['show_all'])){
						$active = '';
						if(!empty($settings['all_title'])){
							$title = $settings['all_title'];
						}else{
							$title = 'All';
						}
						echo '<button data-filter="*" class="tab-btn active" type="button">'.esc_html($title).'</button>';
					}else{
						$active = 'active';
					}
					foreach( $settings['project_tab'] as $key => $data ){
						$id = strtolower($data['tab_id']);
						$active_class = ($key == 0) ? $active : '';
						echo '<button data-filter=".'.esc_attr($id).'" class="tab-btn '.esc_attr($active_class).'" type="button">'.esc_html($data['tab_title']).'</button>';
					}
				echo '</div>';
				
				echo '<div class="row gy-4 filter-active">';
					foreach( $settings['project_list'] as $data ){
						$id = strtolower($data['tab_id2']);
						echo '<div class="col-xxl-3 col-lg-4 col-md-6 filter-item '.esc_attr($id).'">';
							echo '<div class="project-grid">';
								if(!empty($data['image']['url'])){
									echo '<div class="box-img">';
										echo solak_img_tag( array(
											'url'   => esc_url( $data['image']['url'] ),
										));
									echo '</div>';
								}
								echo '<div class="box-content">';
									if(!empty($data['title'])){
										echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
									}
									if(!empty($data['desc'])){
										echo '<p class="box-text">'.esc_html($data['desc']).'</p>';
									}
									if(!empty($data['button_text'])){
										echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style2 btn-sm th_btn">'.esc_html($data['button_text']).'<i class="far fa-arrow-right ms-2"></i></a>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
		echo '<div class="text-center">';
			echo '<div class="filter-menu style2 mt-0 indicator-active filter-menu-active">';
				if(!empty($settings['show_all'])){
					$active = '';
					if(!empty($settings['all_title'])){
						$title = $settings['all_title'];
					}else{
						$title = 'All';
					}
					echo '<button data-filter="*" class="tab-btn active" type="button">'.esc_html($title).'</button>';
				}else{
					$active = 'active';
				}
				foreach( $settings['project_tab'] as $key => $data ){
					$id = strtolower($data['tab_id']);
					$active_class = ($key == 0) ? $active : '';
					echo '<button data-filter=".'.esc_attr($id).'" class="tab-btn '.esc_attr($active_class).'" type="button">'.esc_html($data['tab_title']).'</button>';
				}
			echo '</div>';

            echo '<div class="row gy-30 filter-active overlay-direction load-more-active">';
				foreach( $settings['project_list2'] as $data ){
					if(!empty($data['col'])){
						$column = $data['col'];
					}else{
						$column = 'col-xl-3 col-md-6';
					}
					$id = strtolower($data['tab_id2']);
					echo '<div class="'.esc_attr($column).' filter-item '.esc_attr($id).'">';
						echo '<div class="gallery-card">';
							echo '<a class="box-img popup-image" href="'.esc_url( $data['image']['url'] ).'">';
								echo solak_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								));
								if(!empty($data['icon'])){
									echo '<div class="box-content">';
										echo '<span class="box-btn">'.wp_kses_post($data['icon']).'</span>';
									echo '</div>';
								}
							echo '</a>';
						echo '</div>';
					echo '</div>';
				}
            echo '</div>';
        echo '</div>';

		}
	

	}

}