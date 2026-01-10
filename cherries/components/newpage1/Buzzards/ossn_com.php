<?php
/**** Name of the new function for the new page 1 ****/
function buzzards_init() {

/****  this registers the new page 1into the core system ****/	
ossn_register_page('buzzards', 'buzzards_pages');

/**** 	this adds the new Page css to the core css ****/		
ossn_extend_view('css/ossn.default', 'css/buzzards');	
  
/**** Checks if user is logged in or not ****/
if (ossn_isLoggedin()) { 

/**** This adds the tiny icon into the mehu link ****/      		
$icon = ossn_site_url('components/buzzards/image/buzzards.png'); 

/**** This adds the link to the menu section ****/  	
ossn_register_sections_menu('newsfeed', array('name' => 'buzzards',
 
/**** This is the Menu text taken components/buzzards/locale/ossn.en.php ****/ 
/**** Pay attention to the text case here..(Buzzards NOT buzzards) ****/      	
'text' => ossn_print('Buzzards'),

/**** This set the URL of the New Page 1 to http://yoursite.com/buzzards *****/     	
'url' => ossn_site_url('buzzards'),
			
/**** This 'icon' setting will replace the <i class="fa"></i> with the font-awesome icon ****/        	 
'icon' => fa-buzzards,'section' => 'links'));
	}
}

/**** This returns an error if the user is not logged in ****/
function buzzards_pages($pages) { 
if (!ossn_isLoggedin()) {            
ossn_error_page();   
}

/**** This prints and loads the New Page if everything is good to go ****/
$title = ossn_print('buzzards');   
$contents['content'] = ossn_plugin_view('buzzards/buzzards');   
$content = ossn_set_page_layout('contents', $contents);   
echo ossn_view_page($title, $content);}ossn_register_callback('ossn', 'init', 'buzzards_init');

/**** Example of how to make your own ****/
/**** TO MAKE A NEW PAGE NAMED ie -- Buzzards ****/
/**** Change the name of the main folder to Buzzards ****/
/**** Change subfolder /plugins/default/buzzards to buzzards (lowercase) ****/
/**** Open file ossn.com and edit. Change all of the buzzards instances to buzzards.. and Newpage1 (line22) to Buzzards (watch the case) ****/
/**** Open locale/ossn.en and edit.  Change buzzards and Newpage1 to buzzards and Buzzards (CASE) ****/
/**** Change the tiny image in the image folder. Edit the plugins/default/css file ****/
/**** ZIP THE MAIL FILE AND UPLOAD FROM ADMIN PANEL AS A NEW COMPONENT ****/
/**** ENABLE THE NEW COMPONENT AND USE ****/