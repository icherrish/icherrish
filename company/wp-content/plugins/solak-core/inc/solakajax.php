<?php
/**
 * @Packge    : Solak
 * @Version   : 1.0
 * @Author    : Themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 *
 */


// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

function solak_core_essential_scripts( ) {
    wp_enqueue_script('solak-ajax',SOLAK_PLUGDIRURI.'assets/js/solak.ajax.js',array( 'jquery' ),'1.0',true);
    wp_localize_script(
    'solak-ajax',
    'solakajax',
        array(
            'action_url' => admin_url( 'admin-ajax.php' ),
            'nonce'	     => wp_create_nonce( 'solak-nonce' ),
        )
    );
}

add_action('wp_enqueue_scripts','solak_core_essential_scripts');


// solak Section subscribe ajax callback function
add_action( 'wp_ajax_solak_subscribe_ajax', 'solak_subscribe_ajax' );
add_action( 'wp_ajax_nopriv_solak_subscribe_ajax', 'solak_subscribe_ajax' );

function solak_subscribe_ajax( ){
  $apiKey = solak_opt('solak_subscribe_apikey');
  $listid = solak_opt('solak_subscribe_listid');
   if( ! wp_verify_nonce($_POST['security'], 'solak-nonce') ) {
    echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('You are not allowed.', 'solak').'</div>';
   }else{
       if( !empty( $apiKey ) && !empty( $listid )  ){
           $MailChimp = new DrewM\MailChimp\MailChimp( $apiKey );

           $result = $MailChimp->post("lists/{$listid}/members",[
               'email_address'    => esc_attr( $_POST['sectsubscribe_email'] ),
               'status'           => 'subscribed',
           ]);

           if ($MailChimp->success()) {
               if( $result['status'] == 'subscribed' ){
                   echo '<div class="alert alert-success mt-2" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'solak').'</div>';
               }
           }elseif( $result['status'] == '400' ) {
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('This Email address is already exists.', 'solak').'</div>';
           }else{
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Sorry something went wrong.', 'solak').'</div>';
           }
        }else{
           echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Apikey Or Listid Missing.', 'solak').'</div>';
        }
   }

   wp_die();

}

add_action('wp_ajax_solak_addtocart_notification','solak_addtocart_notification');
add_action('wp_ajax_nopriv_solak_addtocart_notification','solak_addtocart_notification');
function solak_addtocart_notification(){

    $_product = wc_get_product($_POST['prodid']);
    $response = [
        'img_url'   => esc_url( wp_get_attachment_image_src( $_product->get_image_id(),array('60','60'))[0] ),
        'title'     => wp_kses_post( $_product->get_title() )
    ];
    echo json_encode($response);

    wp_die();
}