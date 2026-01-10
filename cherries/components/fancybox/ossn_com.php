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
/*
 * EXPERIMENTAL: TRY AT YOUR OWN RISK. 
 * 
 * This parameter enable/disable fancybox into albums photos on the wall. 
 * 
 * Taking the work from Rafael, $arsalan  after changing the below value to false you must flush cache of OSSN.
 * 
 */
define('__FANCYBOX_FANCY_IN_ALBUM_PHOTOS__', true);

function fancybox_init() {
    ossn_extend_view('js/ossn.site', 'js/fancybox.init');
    ossn_extend_view('ossn/site/head', 'fancybox');
    ossn_register_page('comment-image', 'fancybox_comment_image');
}

function fancybox() {
    $fancybox = ossn_html_css(array(
        'href' => "https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
    ));
    $fancybox .= ossn_html_js(array(
        'src' => "https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"
    ));

    return $fancybox;
}

/**
 * Show comment image in a bigger size 
 * 
 * @param type $pages
 */
function fancybox_comment_image($pages) {
    if (!empty($pages[0]) && !empty($pages[1])) {
        $file = ossn_get_userdata("annotation/{$pages[0]}/comment/photo/{$pages[1]}");
        if (is_file($file)) {
            $etag = md5($pages[1]);
            header("Etag: $etag");

            if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) == "\"$etag\"") {
                header("HTTP/1.1 304 Not Modified");
                exit;
            }
            $image = ossn_resize_image($file, 1400, 1400);
            $filesize = strlen($image);
            header("Content-type: image/jpeg");
            header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', strtotime("+6 months")), true);
            header("Pragma: public");
            header("Cache-Control: public");
            header("Content-Length: $filesize");
            header("ETag: \"$etag\"");
            echo $image;
        } else {
            ossn_error_page();
        }
    } else {
        ossn_error_page();
    }
}

ossn_register_callback('ossn', 'init', 'fancybox_init');