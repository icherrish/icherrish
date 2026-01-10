<?php

function solak_add_custom_menu_fields($item_id, $item, $depth, $args) {
    $selected_megamenu = get_post_meta($item_id, '_menu_item_solak_megamenu', true);
    $megamenu_posts = get_posts(array(
        'post_type' => 'solak_megamenu',
        'posts_per_page' => -1
    ));
    ?>
    <p class="description description-wide">
        <label for="edit-menu-item-solak-megamenu-<?php echo $item_id; ?>">
            <?php _e('Select Mega Menu', 'solak'); ?><br />
            <select id="edit-menu-item-solak-megamenu-<?php echo $item_id; ?>" class="widefat" name="menu-item-solak-megamenu[<?php echo $item_id; ?>]">
                <option value=""><?php _e('None', 'solak'); ?></option>
                <?php foreach ($megamenu_posts as $post) : ?>
                    <option value="<?php echo esc_attr($post->ID); ?>" <?php selected($selected_megamenu, $post->ID); ?>><?php echo esc_html($post->post_title); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </p>
    <?php
}

add_action('wp_nav_menu_item_custom_fields', 'solak_add_custom_menu_fields', 10, 4);


function solak_add_megamenu_class($classes, $item, $args, $depth) {
    $megamenu_id = get_post_meta($item->ID, '_menu_item_solak_megamenu', true);

    if ($megamenu_id) {
        $classes[] = 'dropdown';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'solak_add_megamenu_class', 10, 4);


function solak_save_custom_menu_fields($menu_id, $menu_item_db_id, $args) {
    if (isset($_POST['menu-item-solak-megamenu'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_menu_item_solak_megamenu', sanitize_text_field($_POST['menu-item-solak-megamenu'][$menu_item_db_id]));
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_solak_megamenu');
    }
}
add_action('wp_update_nav_menu_item', 'solak_save_custom_menu_fields', 10, 3);




function solak_display_mega_menu_elementor($item_output, $item, $depth, $args) {
    $megamenu_id = get_post_meta($item->ID, '_menu_item_solak_megamenu', true);

    if ($megamenu_id && \Elementor\Plugin::$instance) {
        $megamenu_content = \Elementor\Plugin::$instance->frontend->get_builder_content($megamenu_id);

        if ($megamenu_content) {
            $item_output .= '<ul class="mega-menu mega-menu-content">' . $megamenu_content . '</ul>';
        }
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'solak_display_mega_menu_elementor', 10, 4);