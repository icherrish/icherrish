<?php
/**** Name of the new function for the new page 1 ****/
function newpage1_init() {
		/****  this registers the new page 1into the core system ****/
		ossn_register_page('newpage1', 'newpage1_pages');
		
		/**** 	this adds the new Page css to the core css ****/
		ossn_extend_view('css/ossn.default', 'css/newpage1');
		
		/**** Checks if user is logged in or not ****/
		if(ossn_isLoggedin()) {
				/**** This adds the tiny icon into the menu link ****/
				$icon = ossn_site_url('components/newpage1/image/newpage1.png');
				
				/**** This adds the link to the menu section ****/
				ossn_register_sections_menu('newsfeed', array(
						'name' => 'newpage1',
						
						/**** This is the Menu text taken components/newpage1/locale/ossn.en.php ****/
						/**** Pay attention to the text case here..(Newpage1 NOT newpage1) ****/
						'text' => ossn_print('Newpage1'),
						
						/**** This set the URL of the New Page 1 to http://yoursite.com/newpage1 *****/
						'url' => ossn_site_url('newpage1'),
						
						'icon' => $icon, //for older versions of OSSN v4.x  
						'section' => 'links'
				));
		}
}

/**** This returns an error if the user is not logged in ****/
function newpage1_pages($pages) {
		if(!ossn_isLoggedin()) {
				ossn_error_page();
		}
		
		/**** This prints and loads the New Page if everything is good to go ****/
		$title               = ossn_print('newpage1');
		$contents['content'] = ossn_plugin_view('newpage1/newpage1');
		$content             = ossn_set_page_layout('contents', $contents);
		echo ossn_view_page($title, $content);
}
ossn_register_callback('ossn', 'init', 'newpage1_init');

/**** Example of how to make your own ****/
/**** HOW TO MAKE A NEW PAGE NAMED ie -- Buzzards ****/
/**** Change the name of the main folder to Buzzards ****/
/**** Edit the ossn_com XML file and change at least the name and ID ****/
/**** Change subfolder /plugins/default/newpage1 to buzzards (lowercase) ****/
/**** Open file ossn_com and edit. Change all of the newpage1 instances to buzzards.. and Newpage1 (line22) to Buzzards (watch the case) ****/
/**** Open locale/ossn.en and edit.  Change newpage1 and Newpage1 to buzzards and Buzzards (CASE) ****/
/**** Change the tiny image (16 x 16px)in the image folder. Edit the plugins/default/css file with the new name and/or type****/
/**** ZIP THE MAIN FILE AND UPLOAD FROM ADMIN PANEL AS A NEW COMPONENT ****/
/**** ENABLE THE NEW COMPONENT AND USE ****/