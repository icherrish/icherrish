<?php
    /**
     * Class For Builder
     */
    class SolakBuilder{

        function __construct(){
            // register admin menus
        	add_action( 'admin_menu', [$this, 'register_settings_menus'] );

            // Custom Footer Builder With Post Type
			add_action( 'init',[ $this,'post_type' ],0 );

 		    add_action( 'elementor/frontend/after_enqueue_scripts', [ $this,'widget_scripts'] );

			add_filter( 'single_template', [ $this, 'load_canvas_template' ] );

            add_action( 'elementor/element/wp-page/document_settings/after_section_end', [ $this,'solak_add_elementor_page_settings_controls' ],10,2 );

		}

		public function widget_scripts( ) {
			wp_enqueue_script( 'solak-core',SOLAK_PLUGDIRURI.'assets/js/solak-core.js',array( 'jquery' ),'1.0',true );
		}


        public function solak_add_elementor_page_settings_controls( \Elementor\Core\DocumentTypes\Page $page ){

			$page->start_controls_section(
                'solak_header_option',
                [
                    'label'     => __( 'Header Option', 'solak' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );


            $page->add_control(
                'solak_header_style',
                [
                    'label'     => __( 'Header Option', 'solak' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'solak' ),
    					'header_builder'       => __( 'Header Builder', 'solak' ),
    				],
                    'default'   => 'prebuilt',
                ]
			);

            $page->add_control(
                'solak_header_builder_option',
                [
                    'label'     => __( 'Header Name', 'solak' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->solak_header_choose_option(),
                    'condition' => [ 'solak_header_style' => 'header_builder'],
                    'default'	=> ''
                ]
            );

            $page->end_controls_section();

            $page->start_controls_section(
                'solak_footer_option',
                [
                    'label'     => __( 'Footer Option', 'solak' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );
            $page->add_control(
    			'solak_footer_choice',
    			[
    				'label'         => __( 'Enable Footer?', 'solak' ),
    				'type'          => \Elementor\Controls_Manager::SWITCHER,
    				'label_on'      => __( 'Yes', 'solak' ),
    				'label_off'     => __( 'No', 'solak' ),
    				'return_value'  => 'yes',
    				'default'       => 'yes',
    			]
    		);
            $page->add_control(
                'solak_footer_style',
                [
                    'label'     => __( 'Footer Style', 'solak' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'solak' ),
    					'footer_builder'       => __( 'Footer Builder', 'solak' ),
    				],
                    'default'   => 'prebuilt',
                    'condition' => [ 'solak_footer_choice' => 'yes' ],
                ]
            );
            $page->add_control(
                'solak_footer_builder_option',
                [
                    'label'     => __( 'Footer Name', 'solak' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->solak_footer_build_choose_option(),
                    'condition' => [ 'solak_footer_style' => 'footer_builder','solak_footer_choice' => 'yes' ],
                    'default'	=> ''
                ]
            );

			$page->end_controls_section();

        }

		public function register_settings_menus(){
			add_menu_page(
				esc_html__( 'Solak Builder', 'solak' ),
            	esc_html__( 'Solak Builder', 'solak' ),
				'manage_options',
				'solak',
				[$this,'register_settings_contents__settings'],
				'dashicons-admin-site',
				2
			);

			add_submenu_page('solak', esc_html__('Footer Builder', 'solak'), esc_html__('Footer Builder', 'solak'), 'manage_options', 'edit.php?post_type=solak_footerbuild');
			add_submenu_page('solak', esc_html__('Header Builder', 'solak'), esc_html__('Header Builder', 'solak'), 'manage_options', 'edit.php?post_type=solak_header');
			add_submenu_page('solak', esc_html__('Tab Builder', 'solak'), esc_html__('Tab Builder', 'solak'), 'manage_options', 'edit.php?post_type=solak_tab_builder');
			add_submenu_page('solak', esc_html__('Megamenu', 'solak'), esc_html__('Megamenu', 'solak'), 'manage_options', 'edit.php?post_type=solak_megamenu');
		}

		// Callback Function
		public function register_settings_contents__settings(){
            echo '<h2>';
			    echo esc_html__( 'Welcome To Header, Footer and Megamenu Builder Of This Theme','solak' );
            echo '</h2>';
		}

		public function post_type() {

			$labels = array(
				'name'               => __( 'Footer', 'solak' ),
				'singular_name'      => __( 'Footer', 'solak' ),
				'menu_name'          => __( 'Solak Footer Builder', 'solak' ),
				'name_admin_bar'     => __( 'Footer', 'solak' ),
				'add_new'            => __( 'Add New', 'solak' ),
				'add_new_item'       => __( 'Add New Footer', 'solak' ),
				'new_item'           => __( 'New Footer', 'solak' ),
				'edit_item'          => __( 'Edit Footer', 'solak' ),
				'view_item'          => __( 'View Footer', 'solak' ),
				'all_items'          => __( 'All Footer', 'solak' ),
				'search_items'       => __( 'Search Footer', 'solak' ),
				'parent_item_colon'  => __( 'Parent Footer:', 'solak' ),
				'not_found'          => __( 'No Footer found.', 'solak' ),
				'not_found_in_trash' => __( 'No Footer found in Trash.', 'solak' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'solak_footerbuild', $args );

			$labels = array(
				'name'               => __( 'Header', 'solak' ),
				'singular_name'      => __( 'Header', 'solak' ),
				'menu_name'          => __( 'Solak Header Builder', 'solak' ),
				'name_admin_bar'     => __( 'Header', 'solak' ),
				'add_new'            => __( 'Add New', 'solak' ),
				'add_new_item'       => __( 'Add New Header', 'solak' ),
				'new_item'           => __( 'New Header', 'solak' ),
				'edit_item'          => __( 'Edit Header', 'solak' ),
				'view_item'          => __( 'View Header', 'solak' ),
				'all_items'          => __( 'All Header', 'solak' ),
				'search_items'       => __( 'Search Header', 'solak' ),
				'parent_item_colon'  => __( 'Parent Header:', 'solak' ),
				'not_found'          => __( 'No Header found.', 'solak' ),
				'not_found_in_trash' => __( 'No Header found in Trash.', 'solak' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'solak_header', $args );

			$labels = array(
				'name'               => __( 'Tab Builder', 'solak' ),
				'singular_name'      => __( 'Tab Builder', 'solak' ),
				'menu_name'          => __( 'Gesund Tab Builder', 'solak' ),
				'name_admin_bar'     => __( 'Tab Builder', 'solak' ),
				'add_new'            => __( 'Add New', 'solak' ),
				'add_new_item'       => __( 'Add New Tab Builder', 'solak' ),
				'new_item'           => __( 'New Tab Builder', 'solak' ),
				'edit_item'          => __( 'Edit Tab Builder', 'solak' ),
				'view_item'          => __( 'View Tab Builder', 'solak' ),
				'all_items'          => __( 'All Tab Builder', 'solak' ),
				'search_items'       => __( 'Search Tab Builder', 'solak' ),
				'parent_item_colon'  => __( 'Parent Tab Builder:', 'solak' ),
				'not_found'          => __( 'No Tab Builder found.', 'solak' ),
				'not_found_in_trash' => __( 'No Tab Builder found in Trash.', 'solak' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'solak_tab_builder', $args );

			$labels = array(
				'name'               => __( 'Megamenu', 'solak' ),
				'singular_name'      => __( 'Megamenu', 'solak' ),
				'menu_name'          => __( 'solak Megamenu', 'solak' ),
				'name_admin_bar'     => __( 'Megamenu', 'solak' ),
				'add_new'            => __( 'Add New', 'solak' ),
				'add_new_item'       => __( 'Add New Megamenu', 'solak' ),
				'new_item'           => __( 'New Megamenu', 'solak' ),
				'edit_item'          => __( 'Edit Megamenu', 'solak' ),
				'view_item'          => __( 'View Megamenu', 'solak' ),
				'all_items'          => __( 'All Megamenu', 'solak' ),
				'search_items'       => __( 'Search Megamenu', 'solak' ),
				'parent_item_colon'  => __( 'Parent Megamenu:', 'solak' ),
				'not_found'          => __( 'No Megamenu found.', 'solak' ),
				'not_found_in_trash' => __( 'No Megamenu found in Trash.', 'solak' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'solak_megamenu', $args );
			
		}

		function load_canvas_template( $single_template ) {

			global $post;

			if ( 'solak_footerbuild' == $post->post_type || 'solak_header' == $post->post_type || 'solak_tab_build' == $post->post_type ) {

				$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

				if ( file_exists( $elementor_2_0_canvas ) ) {
					return $elementor_2_0_canvas;
				} else {
					return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
				}
			}

			return $single_template;
		}

        public function solak_footer_build_choose_option(){

			$solak_post_query = new WP_Query( array(
				'post_type'			=> 'solak_footerbuild',
				'posts_per_page'	    => -1,
			) );

			$solak_builder_post_title = array();
			$solak_builder_post_title[''] = __('Select a Footer','solak');

			while( $solak_post_query->have_posts() ) {
				$solak_post_query->the_post();
				$solak_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $solak_builder_post_title;

		}

		public function solak_header_choose_option(){

			$solak_post_query = new WP_Query( array(
				'post_type'			=> 'solak_header',
				'posts_per_page'	    => -1,
			) );

			$solak_builder_post_title = array();
			$solak_builder_post_title[''] = __('Select a Header','solak');

			while( $solak_post_query->have_posts() ) {
				$solak_post_query->the_post();
				$solak_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $solak_builder_post_title;

        }

    }

    $builder_execute = new SolakBuilder();