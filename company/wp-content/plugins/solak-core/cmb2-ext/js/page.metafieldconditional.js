(function($){
    "use strict";
    
    let $solak_page_breadcrumb_area      = $("#_solak_page_breadcrumb_area");
    let $solak_page_settings             = $("#_solak_page_breadcrumb_settings");
    let $solak_page_breadcrumb_image     = $("#_solak_breadcumb_image");
    let $solak_page_title                = $("#_solak_page_title");
    let $solak_page_title_settings       = $("#_solak_page_title_settings");

    if( $solak_page_breadcrumb_area.val() == '1' ) {
        $(".cmb2-id--solak-page-breadcrumb-settings").show();
        if( $solak_page_settings.val() == 'global' ) {
            $(".cmb2-id--solak-breadcumb-image").hide();
            $(".cmb2-id--solak-page-title").hide();
            $(".cmb2-id--solak-page-title-settings").hide();
            $(".cmb2-id--solak-custom-page-title").hide();
            $(".cmb2-id--solak-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--solak-breadcumb-image").show();
            $(".cmb2-id--solak-page-title").show();
            $(".cmb2-id--solak-page-breadcrumb-trigger").show();
    
            if( $solak_page_title.val() == '1' ) {
                $(".cmb2-id--solak-page-title-settings").show();
                if( $solak_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--solak-custom-page-title").hide();
                } else {
                    $(".cmb2-id--solak-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--solak-page-title-settings").hide();
                $(".cmb2-id--solak-custom-page-title").hide();
    
            }
        }
    } else {
        $solak_page_breadcrumb_area.parents('.cmb2-id--solak-page-breadcrumb-area').siblings().hide();
    }


    // breadcrumb area
    $solak_page_breadcrumb_area.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--solak-page-breadcrumb-settings").show();
            if( $solak_page_settings.val() == 'global' ) {
                $(".cmb2-id--solak-breadcumb-image").hide();
                $(".cmb2-id--solak-page-title").hide();
                $(".cmb2-id--solak-page-title-settings").hide();
                $(".cmb2-id--solak-custom-page-title").hide();
                $(".cmb2-id--solak-page-breadcrumb-trigger").hide();
            } else {
                $(".cmb2-id--solak-breadcumb-image").show();
                $(".cmb2-id--solak-page-title").show();
                $(".cmb2-id--solak-page-breadcrumb-trigger").show();
        
                if( $solak_page_title.val() == '1' ) {
                    $(".cmb2-id--solak-page-title-settings").show();
                    if( $solak_page_title_settings.val() == 'default' ) {
                        $(".cmb2-id--solak-custom-page-title").hide();
                    } else {
                        $(".cmb2-id--solak-custom-page-title").show();
                    }
                } else {
                    $(".cmb2-id--solak-page-title-settings").hide();
                    $(".cmb2-id--solak-custom-page-title").hide();
        
                }
            }
        } else {
            $(this).parents('.cmb2-id--solak-page-breadcrumb-area').siblings().hide();
        }
    });

    // page title
    $solak_page_title.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--solak-page-title-settings").show();
            if( $solak_page_title_settings.val() == 'default' ) {
                $(".cmb2-id--solak-custom-page-title").hide();
            } else {
                $(".cmb2-id--solak-custom-page-title").show();
            }
        } else {
            $(".cmb2-id--solak-page-title-settings").hide();
            $(".cmb2-id--solak-custom-page-title").hide();

        }
    });

    //page settings
    $solak_page_settings.on("change",function(){
        if( $(this).val() == 'global' ) {
            $(".cmb2-id--solak-breadcumb-image").hide();
            $(".cmb2-id--solak-page-title").hide();
            $(".cmb2-id--solak-page-title-settings").hide();
            $(".cmb2-id--solak-custom-page-title").hide();
            $(".cmb2-id--solak-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--solak-breadcumb-image").show();
            $(".cmb2-id--solak-page-title").show();
            $(".cmb2-id--solak-page-breadcrumb-trigger").show();
    
            if( $solak_page_title.val() == '1' ) {
                $(".cmb2-id--solak-page-title-settings").show();
                if( $solak_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--solak-custom-page-title").hide();
                } else {
                    $(".cmb2-id--solak-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--solak-page-title-settings").hide();
                $(".cmb2-id--solak-custom-page-title").hide();
    
            }
        }
    });

    // page title settings
    $solak_page_title_settings.on("change",function(){
        if( $(this).val() == 'default' ) {
            $(".cmb2-id--solak-custom-page-title").hide();
        } else {
            $(".cmb2-id--solak-custom-page-title").show();
        }
    });
    
})(jQuery);