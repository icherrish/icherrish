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

class Blog extends OssnObject {
		/**
		 * InitializeAttributes;
		 *
		 * return void;
		 */
		private function initializeAttributes() {
				$this->annontation = new OssnAnnotaions;
		}
		/**
		 * Add blog;
		 *
		 * @param string $title A title for blog
		 * @param string $descriptionn A body/contents for blog
		 *
		 * return boolean;
		 */
		public function addBlog($title = '', $description = '') {
				$user = ossn_loggedin_user();
				$access = OSSN_PUBLIC;
				if (!empty($title) && !empty($description) && $user) {
						$this->title              = $title;
						$this->description        = $description;
						$this->type               = 'user';
						$this->subtype            = 'blog';
						$this->owner_guid         = $user->guid;
						if ($this->addObject()) {
								$objectId = $this->getObjectId();
								$params['object_guid'] = $objectId;
								$params['poster_guid'] = $user->guid;
								ossn_trigger_callback('blog', 'created', $params);
								return $objectId;
						}
				}
				return false;
		}
		/**
		 * Get a blog by blog id;
		 *
		 * @param integer $guid A valid blog id
		 *
		 * return object|false;
		 */
		public function getBlog($guid = '') {
				if (!empty($guid)) {
						$blog = ossn_get_object($guid);
						if ($blog) {
								return $blog;
						}
				}
				return false;
		}
		/**
		 * Get all site blogs sorted by date
		 *
		 * return object|false;
		 */
		public function getBlogsByDate(array $params = array()) {
				return $this->searchObject(array_merge(array(
						'type' => 'user',
						'subtype' => 'blog',
						'order_by' => 'time_created DESC'
				), $params));
		}
		/**
		 * Get all site blogs sorted by name
		 *
		 * return object|false;
		 */
		public function getBlogsByMember(array $params = array()) {
				$order_by = 'blogger.first_name ASC, o.time_created DESC';
				if (com_is_active('DisplayUsername')) {
					$order_by = 'blogger.username ASC, o.time_created DESC';
				}
				return $this->searchObject(array_merge(array(
						'type' => 'user',
						'subtype' => 'blog',
						'params' => array('o.guid', 'o.time_created', 'o.owner_guid', 'o.title'),
						'joins' => array('JOIN ossn_users as blogger ON o.owner_guid=blogger.guid'),
						'order_by' => $order_by
				), $params));
		}
		/**
		 * Get user blogs
		 *
		 * @param object $user A valid users
		 *
		 * return object|false;
		 */
		public function getUserBlogs($user, $params = array()) {
				if ($user instanceof OssnUser) {
						return $this->searchObject(array_merge(array(
								'type' => 'user',
								'subtype' => 'blog',
								'owner_guid' => $user->guid,
								'order_by' => 'time_created DESC'
						), $params));
				}
				return false;
		}
		/**
		 * Profile URL of blog
		 *
		 * return string;
		 */
		public function profileURL($type = 'view') {
				$title = OssnTranslit::urlize($this->title);
				//return ossn_site_url("blog/{$type}/$this->guid/$title");
				return ossn_site_url("blog/{$type}/$this->guid");
		}
		/**
		 * Delete URL of blog
		 *
		 * return string;
		 */
		public function deleteURL($type = 'view') {
				return ossn_site_url("action/blog/delete?guid=$this->guid", true);
		}		
		/**
		 * Add blog to wall
		 *
		 * @param integer $itemguid A album guid
		 *
		 * @return boolean
		 */
		public function addWall($itemguid = '') {
				$album = ossn_get_object($itemguid);
				if (!$album || !class_exists('OssnWall')) {
						return false;
				}
				$this->wall                     = new OssnWall;
				$this->wall->type               = 'user';
				$this->wall->item_type          = 'blog:created';
				$this->wall->owner_guid         = ossn_loggedin_user()->guid;
				$this->wall->poster_guid        = ossn_loggedin_user()->guid;
				$this->wall->item_guid          = $itemguid;
				$blog_wallpost_guid = $this->wall->Post('null:data', '', '', '');
				if ($blog_wallpost_guid) {
					return true;
				}
				return false;
		}
		
} //class