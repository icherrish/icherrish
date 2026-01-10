<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Header Widget . 
 *
 */
class Solak_Header2 extends Widget_Base {

	public function get_name() {
		return 'solakheader2';
	}
	public function get_title() {
		return __( 'Header V2', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label' 	=> __( 'Header', 'solak' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		solak_select_field( $this, 'layout_style', 'Layout Style', ['Style One'] );

		$this->add_control(
			'logo_image',

			[
				'label' 		=> __( 'Upload Logo', 'solak' ),
				'type' 			=> Controls_Manager::MEDIA,
			]
		);				

		$menus = $this->solak_menu_select();

		if( !empty( $menus ) ){
	        $this->add_control(
				'solak_menu_select',
				[
					'label'     	=> __( 'Select solak Menu', 'solak' ),
					'type'      	=> Controls_Manager::SELECT,
					'options'   	=> $menus,
					'description' 	=> sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'solak' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		}else {
			$this->add_control(
				'no_menu',
				[
					'type' 				=> Controls_Manager::RAW_HTML,
					'raw' 				=> '<strong>' . __( 'There are no menus in your site.', 'solak' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'solak' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' 		=> 'after',
					'content_classes' 	=> 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		solak_switcher_fields($this, 'show_search_btn', 'Show Search Button?', ['1']);
		solak_switcher_fields($this, 'show_offcanvas_btn', 'Show Offcanvas Button?', ['1']);

		solak_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'Get a Quote', ['1'] );
		solak_url_fields( $this, 'button_url', 'Button URL', ['1'] );


        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------General Style-------
		 $this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'Background Styling', 'solak' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

		solak_color_fields( $this, 'menu_bg', 'Background', 'background', '{{WRAPPER}} .menu-area', ['1'] );                      

		$this->end_controls_section();

		//------Menu Bar Style-------
        $this->start_controls_section(
			'menubar_styling2',
			[
				'label'     => __( 'Menu Styling', 'solak' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

		solak_color_fields( $this, 'menu_color1', 'Color', 'color', '{{WRAPPER}} .main-menu>ul>li>a' );
		solak_color_fields( $this, 'menu_color2', 'Hover Color', 'color', '{{WRAPPER}} .main-menu>ul>li>a:hover' );
		solak_color_fields( $this, 'menu_color3', 'Dropdown Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a' );
		solak_color_fields( $this, 'menu_color4', 'Dropdown Hover Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a:hover' );
		solak_color_fields( $this, 'menu_color5', 'Menu Icon Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a:before, {{WRAPPER}} .main-menu ul li.menu-item-has-children > a:after' );

		solak_typography_fields( $this, 'menu_font', 'Menu Trpography', '{{WRAPPER}} .main-menu>ul>li>a, {{WRAPPER}} .main-menu ul.sub-menu li a' );

		solak_dimensions_fields( $this, 'menu_margin', 'Menu Margin', 'margin', '{{WRAPPER}} .main-menu>ul>li>a' );
		solak_dimensions_fields( $this, 'menu_padding', 'Menu Padding', 'padding', '{{WRAPPER}} .main-menu>ul>li>a' );

		$this->end_controls_section();

		//------Button Style-------
		solak_button_style_fields( $this, '12', 'Button Styling', '{{WRAPPER}} .th_btn' );

    }

    public function solak_menu_select(){
	    $solak_menu = wp_get_nav_menus();
	    $menu_array  = array();
		$menu_array[''] = __( 'Select A Menu', 'solak' );
	    foreach( $solak_menu as $menu ){
	        $menu_array[ $menu->slug ] = $menu->name;
	    }
	    return $menu_array;
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		global $woocommerce;

        //Menu by menu select
        $solak_avaiable_menu   = $this->solak_menu_select();
		if( ! $solak_avaiable_menu ){
			return;
		}
		$args = [
			'menu' 			=> $settings['solak_menu_select'],
			'menu_class' 	=> 'solak-menu',
			'container' 	=> '',
		];

		//Mobile menu, Offcanvas, Search
        echo solak_mobile_menu();
		// echo solak_header_cart_offcanvas();
		if(!empty( $settings['show_offcanvas_btn'])){
			echo solak_header_offcanvas();
		}
		if(!empty( $settings['show_search_btn'])){
			echo solak_search_box();
		}
		// Header sub-menu icon
		if( class_exists( 'ReduxFramework' ) ){ 
			if(solak_opt('solak_header_sticky')){
                $sticky = '';
            }else{
                $sticky = '-no';
            }

			if(solak_opt('solak_menu_icon')){
				$menu_icon = '';
			}else{
				$menu_icon = 'hide-icon';
			}
		}

		if( $settings['layout_style'] == '1' ){
			echo '<div class="th-header header-layout3 header-absolute">';
				echo '<div class="sticky-wrapper'.esc_attr($sticky).'">';
					echo '<!-- Main Menu Area -->';
					echo '<div class="container th-container2">';
						echo '<div class="menu-area">';
							echo '<div class="row align-items-center justify-content-between">';
								echo '<div class="col-auto">';
									echo '<div class="header-logo">';
										echo '<a href="'.esc_url( home_url( '/' ) ).'">';
											echo solak_img_tag( array(
												'url'   => esc_url( $settings['logo_image']['url'] ),
											));
										echo '</a>';
									echo '</div>';
								echo '</div>';
								echo '<div class="col-auto ms-xl-auto">';
									echo '<nav class="main-menu style2 d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
										if( ! empty( $settings['solak_menu_select'] ) ){
											wp_nav_menu( $args );
										}else{
											wp_nav_menu( array(
												"theme_location"    => 'primary-menu',
												"container"         => '',
												"menu_class"        => ''
											) );
										}
									echo '</nav>';
									echo '<div class="header-button">';
										echo '<button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>';
									echo '</div>';
								echo '</div>';
								echo '<div class="col-auto d-none d-xl-block">';
									echo '<div class="header-button">';
										if(!empty($settings['show_search_btn'])){
											echo '<button type="button" class="icon-btn searchBoxToggler"><i class="far fa-search"></i></button>';
										}
										if(!empty($settings['show_offcanvas_btn'])){
											echo '<a href="#" class="icon-btn sideMenuToggler d-none d-lg-block"><img src="'.SOLAK_ASSETS.'/img/grid.svg" alt=""></a>';
										}
										if(!empty( $settings['button_text'])){
											echo '<a href="'.esc_attr($settings['button_url']['url']).'" class="th-btn style1 th-radius th-icon th_btn"><span class="btn-text" data-back="'.esc_html($settings['button_text']).'" data-front="'.esc_html($settings['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i> </a>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		
		}elseif( $settings['layout_style'] == '2' ){
		

		}


	}
}