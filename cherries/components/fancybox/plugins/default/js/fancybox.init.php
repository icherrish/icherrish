<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
//<script>
var FANCYBOX_FANCY_IN_ALBUM_PHOTOS = <?php echo __FANCYBOX_FANCY_IN_ALBUM_PHOTOS__; ?>;
if (FANCYBOX_FANCY_IN_ALBUM_PHOTOS == true) {
    Ossn.register_callback('ossn', 'init', 'com_fancybox_init_albums');
}
Ossn.register_callback('ossn', 'init', 'com_fancybox_init');
function com_fancybox_init() {
    $(document).ready(function() {
        Fancybox.defaults.l10n = {
            CLOSE: Ossn.Print('fancybox:close'),
            NEXT: Ossn.Print('fancybox:nex'),
            PREV: Ossn.Print('fancybox:prev'),
            MODAL: Ossn.Print('fancybox:modal'),
            ERROR: Ossn.Print('fancybox:error'),
            IMAGE_ERROR: Ossn.Print('fancybox:image_error'),
            ELEMENT_NOT_FOUND: Ossn.Print('fancybox:element_not_found'),
            AJAX_NOT_FOUND: Ossn.Print('fancybox:ajax_not_found'),
            AJAX_FORBIDDEN: Ossn.Print('fancybox:ajax_forbidden'),
            IFRAME_ERROR: Ossn.Print('fancybox:iframe_error'),
            TOGGLE_ZOOM: Ossn.Print('fancybox:toggle:zoom'),
            TOGGLE_THUMBS: Ossn.Print('fancybox:toggle_thumbs'),
            TOGGLE_SLIDESHOW: Ossn.Print('fancybox:toggle_slideshow'),
            TOGGLE_FULLSCREEN: Ossn.Print('fancybox:toggle_fullscreen'),
            DOWNLOAD: Ossn.Print('fancybox:download'),
        }
        com_fancybox_set_attr();
        com_fancybox_set_attr_albumphoto_wall();
        com_fancybox_set_attr_comment_item();

        Fancybox.bind("[data-fancybox]", {});
        Fancybox.bind("#gallery a", {
            groupAll: false,
        });
    });
    $(document).ajaxComplete(function() {
        com_fancybox_set_attr();
        com_fancybox_set_attr_comment_item();
    });
}
function com_fancybox_set_attr() {
    $(".ossn-wall-item .post-contents img").each(function() {
        if ($(this).attr('data-fancybox') == undefined) {
            $(this).attr('data-fancybox', '');
        }
    });
    $(".user-activity .comments-item .comment-contents img").each(function(){
        if ($(this).attr('data-fancybox') == undefined) {
            $(this).attr('data-fancybox', '');
        }
    });
}

function com_fancybox_set_attr_albumphoto_wall() {
    if ($('.ossn-wall-item .ossn-photos-wall img').length > 0) {
        $('.ossn-wall-item .ossn-photos-wall img').each(function() {
            $(this).attr('data-fancybox', 'gallery');
            var urlImage = $(this).attr('src').replace("size=album", "size=view");
            var idGroup = $(this).closest('.ossn-wall-item').attr('id');
            $(this).attr('data-src', urlImage).attr('data-fancybox',idGroup);
        });
    }
}

function com_fancybox_set_attr_comment_item(){
    if ($('.user-activity .comments-item .comment-contents img').length > 0) {
        $(".user-activity .comments-item .comment-contents img").each(function(){
            $(this).attr('data-fancybox', 'gallery');
            var urlImageComment = $(this).attr('src').replace("comment/image", "comment-image");
            var idGroupComment = $(this).closest('.comments-item').attr('id');
            $(this).attr('data-src', urlImageComment).attr('data-fancybox', idGroupComment);
        });
    }
}

function com_fancybox_init_albums() {
    $(document).ready(function() {
        com_fancybox_set_attr_albumphoto_wall();
    });
}