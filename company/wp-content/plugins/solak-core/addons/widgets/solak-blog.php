<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * Blog Post Widget .
 *
 */
class Solak_Blog extends Widget_Base {

	public function get_name() {
		return 'solakblog';
	}
	public function get_title() {
		return __( 'Blog Post', 'solak' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'solak' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'blog_post_section',
			[
				'label' => __( 'Blog Post', 'solak' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

        solak_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three' ] );

        // solak_general_fields($this, 'arrow_id', 'Arrow ID or Class', 'TEXT', 'blogSlider1', ['1', '2']);

        $this->add_control(
			'blog_post_count',
			[
				'label' 	=> __( 'No of Post to show', 'solak' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default'  	=> __( '3', 'solak' )
			]
        );

        solak_general_fields( $this, 'title_count', 'Title Length', 'TEXT2', '6');
        solak_general_fields( $this, 'excerpt_count', 'Excerpt Length', 'TEXT2', '14' );

        $this->add_control(
			'blog_post_order',
			[
				'label' 	=> __( 'Order', 'solak' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ASC'   	=> __('ASC','solak'),
                    'DESC'   	=> __('DESC','solak'),
                ],
                'default'  	=> 'DESC'
			]
        );
        $this->add_control(
			'blog_post_order_by',
			[
				'label' 	=> __( 'Order By', 'solak' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ID'    	=> __( 'ID', 'solak' ),
                    'author'    => __( 'Author', 'solak' ),
                    'title'    	=> __( 'Title', 'solak' ),
                    'date'    	=> __( 'Date', 'solak' ),
                    'rand'    	=> __( 'Random', 'solak' ),
                ],
                'default'  	=> 'ID'
			]
        );
       
        $this->add_control(
            'post_display_type',
            [
                'label'   => __( 'Post Display Type', 'solak' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'all'      => __( 'All Posts', 'solak' ),
                    'category' => __( 'Category', 'solak' ),
                    'tags'     => __( 'Tags', 'solak' ),
                ],
                'default' => 'category',
            ]
        );        

        $this->add_control(
            'post_customization_note',
            [
                'type'    => \Elementor\Controls_Manager::RAW_HTML,
                'raw'     => __( '<strong>All posts are displayed by default.</strong><br>Use the "Include" or "Exclude" options below to customize which categories, tags, or specific posts should be shown or hidden.', 'solak' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'     => [
                    'post_display_type' => 'all',
                ],
            ]
        );
        $this->add_control(
            'include_exclude_option',
            [
                'label'   => __( 'Include or Exclude', 'solak' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'include' => __( 'Include', 'solak' ),
                    'exclude' => __( 'Exclude', 'solak' ),
                ],
                'default' => 'exclude',
                'condition'     => [
                    'post_display_type' => 'all',
                ],
            ]
        );
        
        $this->add_control(
            'blog_categories',
            [
                'label'         => __( 'Categories', 'solak' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => $this->solak_get_categories(),
                'label_block'   => true,
                'condition'     => [
                    'post_display_type' => ['category', 'all'],
                ],
            ]
        );
        $this->add_control(
            'blog_tags',
            [
                'label'         => __( 'Tags', 'solak' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => $this->solak_get_tags(),
                'label_block'   => true,
                'condition'     => [
                    'post_display_type' => ['tags', 'all'],
                ],
            ]
        );
        $this->add_control(
            'blog_posts',
            [
                'label'         => __( 'Posts', 'solak' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => $this->solak_post_id(),
                'label_block'   => true,
                'condition'     => [
                    'post_display_type' => 'all',
                ],
            ]
        );

        solak_general_fields( $this, 'button_text', 'Read More Text', 'TEXTAREA2', 'Read More' );

        // Get all registered image sizes
        $image_sizes = get_intermediate_image_sizes(); 
        $options = [];
        foreach ( $image_sizes as $size ) {
            $options[ $size ] = ucfirst( str_replace( '_', ' ', $size ) );
        }
        $this->add_control(
            'image_resolution',
            [
                'label'       => __( 'Image Resolution', 'solak' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'thumbnail',
                'options'     => $options,
            ]
        ); 

        solak_switcher_fields( $this, 'show_post_meta_icons', 'Display Post Meta Icons?' );
        solak_switcher_fields( $this, 'show_author', 'Display Post Author?' );
        solak_switcher_fields( $this, 'show_date', 'Display Post Date?' );
        solak_switcher_fields( $this, 'show_category', 'Display Post Category?' );
        solak_switcher_fields( $this, 'show_comment', 'Display Post Comment?' );
        solak_switcher_fields( $this, 'show_min_read', 'Display Read Minute?' );

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//--------------------------------------- 

		//-------Title Style-------
		solak_common2_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title a' );
		solak_common_style_fields( $this, '02', 'Content', '{{WRAPPER}} .box-text' );

        //-------Button Style-------
		$this->start_controls_section(
			'button_styling',
			[
				'label'     => __( 'Button Styling', 'solak' ),
				'tab'       => Controls_Manager::TAB_STYLE,
                'condition'		=> [ 
					'layout_style' => ['1', '2', '3', '4'] 
				],
			]
        );

		solak_color_fields( $this, 'color11', 'Color', '--title-color', '{{WRAPPER}} .line-btn', ['1'] );
		solak_color_fields( $this, 'color22', 'Hover Color', '--theme-color', '{{WRAPPER}} .line-btn:hover', ['1'] );          

		$this->end_controls_section();

    }

    public function solak_get_categories() {
        $cats = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => true,
        ));

        $cat = [];

        foreach( $cats as $singlecat ) {
            $cat[$singlecat->term_id] = __($singlecat->name,'solak');
        }

        return $cat;
    }

    public function solak_get_tags() {
        $tags = get_terms(array(
            'taxonomy' => 'post_tag',
            'hide_empty' => true,
        ));

        $tag = [];

        foreach( $tags as $singletag ) {
            $tag[$singletag->term_id] = __($singletag->name,'solak');
        }

        return $tag;
    }

    // Get Specific Post
    public function solak_post_id(){
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
        );

        $solak_post = new WP_Query( $args );

        $postarray = [];

        while( $solak_post->have_posts() ){
            $solak_post->the_post();
            $postarray[get_the_Id()] = get_the_title();
        }
        wp_reset_postdata();
        return $postarray;
    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        $post_display_type = $settings['post_display_type'];
        $include_exclude_option = isset($settings['include_exclude_option']) ? $settings['include_exclude_option'] : 'exclude';
        $blog_posts = !empty($settings['blog_posts']) ? $settings['blog_posts'] : [];
        $blog_categories = !empty($settings['blog_categories']) ? $settings['blog_categories'] : [];
        $blog_tags = !empty($settings['blog_tags']) ? $settings['blog_tags'] : [];
        
        // Default query arguments
        $args = [
            'post_type'             => 'post',
            'posts_per_page'        => !empty($settings['blog_post_count']) ? esc_attr($settings['blog_post_count']) : 3,
            'order'                 => !empty($settings['blog_post_order']) ? esc_attr($settings['blog_post_order']) : 'DESC',
            'orderby'               => !empty($settings['blog_post_order_by']) ? esc_attr($settings['blog_post_order_by']) : 'ID',
            'ignore_sticky_posts'   => true,
        ];
        
        // Modify query based on `post_display_type` and `include_exclude_option`
        if ($post_display_type === 'all') {
            if ($include_exclude_option === 'include') {
                if (!empty($blog_posts)) {
                    $args['post__in'] = $blog_posts;
                }
                if (!empty($blog_categories)) {
                    $args['category__in'] = $blog_categories;
                }
                if (!empty($blog_tags)) {
                    $args['tag__in'] = $blog_tags;
                }
            } elseif ($include_exclude_option === 'exclude') {
                if (!empty($blog_posts)) {
                    $args['post__not_in'] = $blog_posts;
                }
                if (!empty($blog_categories)) {
                    $args['category__not_in'] = $blog_categories;
                }
                if (!empty($blog_tags)) {
                    $args['tag__not_in'] = $blog_tags;
                }
            }
        } elseif ($post_display_type === 'category') {
            // Show posts only from selected categories
            $args['category__in'] = $blog_categories;

        } elseif ($post_display_type === 'tags') {
            // Show posts only from selected tags
            $args['tag__in'] = $blog_tags;
            
        }
        
        // Create the WP_Query
        $blogpost = new WP_Query($args);     
        
        // Get the dynamic image resolution setting
        $image_resolution = !empty($settings['image_resolution']) ? $settings['image_resolution'] : 'solak-shop-small-image';
        

		if( $settings['layout_style'] == '3'  ){
            echo '<div class="row gx-24 gy-30">';
            
                $count = 0;
                while( $blogpost->have_posts() ){
                    $count++;
                    $blogpost->the_post(); 
                    $categories = get_the_category();
                    $content = get_the_content();
                    $title_count =  $settings['title_count'];
                    $excerpt_count =  $settings['excerpt_count'];
                    if ($count === 1) {
                        echo '<div class="col-xl-6">';
                            echo '<div class="blog-grid">';
                                if ( has_post_thumbnail() ) {
                                    echo '<div class="blog-img">';
                                        echo '<a href="'.esc_url( get_permalink() ).'">';
                                            the_post_thumbnail( 'solak_713X402' );
                                        echo '</a>';
                                    echo '</div>';
                                }
                                echo '<div class="box-content">';
                                    echo '<div class="blog-meta">';
                                        if(!empty($settings['show_author'])){
                                            echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">';
                                                if(!empty($settings['show_post_meta_icons'])){
                                                    echo '<i class="fa-regular fa-user"></i>';
                                                }
                                                echo esc_html__('By ', 'solak') . esc_html( ucwords( get_the_author() ) );
                                            echo '</a>';
                                        }
                                        if(!empty($settings['show_date'])){
                                            echo '<a href="'.esc_url( solak_blog_date_permalink() ).'">';
                                                if(!empty($settings['show_post_meta_icons'])){
                                                    echo '<i class="fa-regular fa-calendar"></i>';
                                                }
                                                echo esc_html( get_the_date() );
                                            echo '</a>';
                                        }
                                        if(!empty($settings['show_category'])){
                                            if(!empty($categories)){
                                                echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="far fa-tag"></i>';
                                                    }
                                                    echo esc_html( $categories[0]->name );
                                                echo '</a>';
                                            }
                                        }
                                        if(!empty($settings['show_comment'])){
                                            $commnet = (get_comments_number() == 1) ? ' Comment ':' Comments ';
                                            echo '<a href="#">';
                                                if(!empty($settings['show_post_meta_icons'])){
                                                    echo '<i class="fa-regular fa-comment"></i>';
                                                }
                                                echo get_comments_number() . esc_html__($commnet, 'solak');
                                            echo '</a>';
                                        }
                                        if(!empty($settings['show_min_read'])){
                                            if (function_exists('solak_get_reading_time')) {
                                                echo solak_get_reading_time(get_the_ID());
                                            }
                                        }
                                    echo '</div>';
                                    echo '<h3 class="box-title"><a href="'.esc_url( get_permalink() ).'">'.esc_html( get_the_title( ) ).'</a></h3>';
                                    if(!empty($settings['button_text'])){
                                        echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn border-btn th-icon th-radius text-uppercase"><span class="btn-text" data-back="'.esc_attr($settings['button_text']).'" data-front="'.esc_attr($settings['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i> </a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }


                    if ($count === 2 || $count === 3) {
                        if ($count === 2) {
                            echo '<div class="col-xl-6">';
                            $mt = '';
                        }else{
                            $mt = 'mt-30';
                        }
                            echo '<div class="blog-grid style2 '.esc_attr($mt).'">';
                                if ( has_post_thumbnail() ) {
                                    echo '<div class="blog-img">';
                                        echo '<a href="'.esc_url( get_permalink() ).'">';
                                            the_post_thumbnail( $image_resolution );
                                        echo '</a>';
                                    echo '</div>';
                                }
                                echo '<div class="box-content">';
                                    echo '<div class="blog-meta">';
                                        if(!empty($settings['show_author'])){
                                            echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">';
                                                if(!empty($settings['show_post_meta_icons'])){
                                                    echo '<i class="fa-regular fa-user"></i>';
                                                }
                                                echo esc_html__('By ', 'solak') . esc_html( ucwords( get_the_author() ) );
                                            echo '</a>';
                                        }
                                        if(!empty($settings['show_date'])){
                                            echo '<a href="'.esc_url( solak_blog_date_permalink() ).'">';
                                                if(!empty($settings['show_post_meta_icons'])){
                                                    echo '<i class="fa-regular fa-calendar"></i>';
                                                }
                                                echo esc_html( get_the_date() );
                                            echo '</a>';
                                        }
                                        if(!empty($settings['show_category'])){
                                            if(!empty($categories)){
                                                echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="far fa-tag"></i>';
                                                    }
                                                    echo esc_html( $categories[0]->name );
                                                echo '</a>';
                                            }
                                        }
                                        if(!empty($settings['show_comment'])){
                                            $commnet = (get_comments_number() == 1) ? ' Comment ':' Comments ';
                                            echo '<a href="#">';
                                                if(!empty($settings['show_post_meta_icons'])){
                                                    echo '<i class="fa-regular fa-comment"></i>';
                                                }
                                                echo get_comments_number() . esc_html__($commnet, 'solak');
                                            echo '</a>';
                                        }
                                        if(!empty($settings['show_min_read'])){
                                            if (function_exists('solak_get_reading_time')) {
                                                echo solak_get_reading_time(get_the_ID());
                                            }
                                        }
                                    echo '</div>';
                                    echo '<h3 class="box-title"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ),  $title_count , '' ) ).'</a></h3>';
                                    if ( ! empty( $content && $excerpt_count ) ) {
                                        echo '<p class="box-text">' . esc_html( wp_trim_words( $content, $excerpt_count , '' ) ) . '</p>';
                                    }
                                    if(!empty($settings['button_text'])){
                                        echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn border-btn th-icon th-radius text-uppercase"><span class="btn-text" data-back="'.esc_attr($settings['button_text']).'" data-front="'.esc_attr($settings['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i> </a>';
                                    }
                                echo '</div>';
                            echo '</div>';

                        if ($count === 3) {
                            echo '</div>';
                        }
                    }

                    if ($count >= 4) {
                        echo '<div class="col-xl-6">';
                            echo '<div class="blog-grid style2">';
                                if ( has_post_thumbnail() ) {
                                    echo '<div class="blog-img">';
                                        echo '<a href="'.esc_url( get_permalink() ).'">';
                                            the_post_thumbnail( $image_resolution );
                                        echo '</a>';
                                    echo '</div>';
                                }
                                echo '<div class="box-content">';
                                    echo '<div class="blog-meta">';
                                        if(!empty($settings['show_author'])){
                                            echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">';
                                                if(!empty($settings['show_post_meta_icons'])){
                                                    echo '<i class="fa-regular fa-user"></i>';
                                                }
                                                echo esc_html__('By ', 'solak') . esc_html( ucwords( get_the_author() ) );
                                            echo '</a>';
                                        }
                                        if(!empty($settings['show_date'])){
                                            echo '<a href="'.esc_url( solak_blog_date_permalink() ).'">';
                                                if(!empty($settings['show_post_meta_icons'])){
                                                    echo '<i class="fa-regular fa-calendar"></i>';
                                                }
                                                echo esc_html( get_the_date() );
                                            echo '</a>';
                                        }
                                        if(!empty($settings['show_category'])){
                                            if(!empty($categories)){
                                                echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="far fa-tag"></i>';
                                                    }
                                                    echo esc_html( $categories[0]->name );
                                                echo '</a>';
                                            }
                                        }
                                        if(!empty($settings['show_comment'])){
                                            $commnet = (get_comments_number() == 1) ? ' Comment ':' Comments ';
                                            echo '<a href="#">';
                                                if(!empty($settings['show_post_meta_icons'])){
                                                    echo '<i class="fa-regular fa-comment"></i>';
                                                }
                                                echo get_comments_number() . esc_html__($commnet, 'solak');
                                            echo '</a>';
                                        }
                                        if(!empty($settings['show_min_read'])){
                                            if (function_exists('solak_get_reading_time')) {
                                                echo solak_get_reading_time(get_the_ID());
                                            }
                                        }
                                    echo '</div>';
                                    echo '<h3 class="box-title"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ),  $title_count , '' ) ).'</a></h3>';
                                    if ( ! empty( $content && $excerpt_count ) ) {
                                        echo '<p class="box-text">' . esc_html( wp_trim_words( $content, $excerpt_count , '' ) ) . '</p>';
                                    }
                                    if(!empty($settings['button_text'])){
                                        echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn border-btn th-icon th-radius text-uppercase"><span class="btn-text" data-back="'.esc_attr($settings['button_text']).'" data-front="'.esc_attr($settings['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i> </a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }

                }wp_reset_postdata(); 

            echo '</div>';

		}else{
            if( $settings['layout_style'] == '2'  ){
                $class = 'blog-box';
                $img_class = 'blog-img global-img';
                $style = ' ';
            }else{
                $class = 'blog-card';
                $img_class = 'box-img global-img';
                $style = '';
            }
            echo '<div class="slider-area">';
                echo '<div class="swiper th-slider has-shadow" id="blogSlider" data-slider-options=\'{"loop":true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
                    echo '<div class="swiper-wrapper">';
                        while( $blogpost->have_posts() ){
                            $blogpost->the_post(); 
                            $categories = get_the_category();
                            $content = get_the_content();
                            $title_count =  $settings['title_count'];
                            $excerpt_count =  $settings['excerpt_count'];

                            echo '<div class="swiper-slide">';
                                echo '<div class="'.esc_attr($class .' '.$style).'">';
                                    if ( has_post_thumbnail() ) {
                                        echo '<div class="'.esc_attr($img_class).'">';
                                            echo '<a href="'.esc_url( get_permalink() ).'">';
                                                the_post_thumbnail( $image_resolution );
                                            echo '</a>';
                                        echo '</div>';
                                    }
                                    echo '<div class="box-content">';
                                        echo '<div class="blog-meta">';
                                            if(!empty($settings['show_author'])){
                                                echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="fa-regular fa-user"></i>';
                                                    }
                                                    echo esc_html__('By ', 'solak') . esc_html( ucwords( get_the_author() ) );
                                                echo '</a>';
                                            }
                                            if(!empty($settings['show_date'])){
                                                echo '<a href="'.esc_url( solak_blog_date_permalink() ).'">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="fa-regular fa-calendar"></i>';
                                                    }
                                                    echo esc_html( get_the_date() );
                                                echo '</a>';
                                            }
                                            if(!empty($settings['show_category'])){
                                                if(!empty($categories)){
                                                    echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">';
                                                        if(!empty($settings['show_post_meta_icons'])){
                                                            echo '<i class="far fa-tag"></i>';
                                                        }
                                                        echo esc_html( $categories[0]->name );
                                                    echo '</a>';
                                                }
                                            }
                                            if(!empty($settings['show_comment'])){
                                                $commnet = (get_comments_number() == 1) ? ' Comment ':' Comments ';
                                                echo '<a href="#">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="fa-regular fa-comment"></i>';
                                                    }
                                                    echo get_comments_number() . esc_html__($commnet, 'solak');
                                                echo '</a>';
                                            }
                                            if(!empty($settings['show_min_read'])){
                                                if (function_exists('solak_get_reading_time')) {
                                                    echo solak_get_reading_time(get_the_ID());
                                                }
                                            }
                                        echo '</div>';
                                        echo '<h3 class="box-title"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ),  $title_count , '' ) ).'</a></h3>';
                                        if ( ! empty( $content && $excerpt_count ) ) {
                                            echo '<p class="box-text pb-3">' . esc_html( wp_trim_words( $content, $excerpt_count , '' ) ) . '</p>';
                                        }
                                        if(!empty($settings['button_text'])){
                                            echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn border-btn th-icon text-uppercase fw-semibold"><span class="btn-text" data-back="'.esc_attr($settings['button_text']).'" data-front="'.esc_attr($settings['button_text']).'"></span><i class="fa-regular fa-arrow-right ms-2"></i> </a>';
                                        }
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';

                        }wp_reset_postdata(); 
                    echo '</div>';
                echo '</div>';
                echo '<button data-slider-prev="#blogSlider" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
                echo '<button data-slider-next="#blogSlider" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
            echo '</div>';

        }
	
      
	}
}