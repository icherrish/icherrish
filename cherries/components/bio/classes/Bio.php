<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   bio
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
class Bio extends OssnDatabase {
	/**
	 * @param array $query SearchString, $count
	 * @return array of objects
	 */
	public function searchBios($params)
	{
		if ($params['visitor']) {
			// view from logged-in user
			if ($params['is_admin']) {
				// admin view - fetch all records
				if ($params['count'] == true) {
					$statement = "SELECT COUNT(username) AS total_count FROM ossn_users AS o
						JOIN ossn_entities AS e0 ON e0.owner_guid = o.guid
						JOIN ossn_entities_metadata AS emd0 ON e0.guid = emd0.guid
						WHERE
						(
						emd0.value REGEXP '{$params['query']}[^=|^;|^\:]'
						AND
						(e0.type = 'user' AND e0.subtype = 'bio') 
						)
					;";
					$this->statement($statement);
					$this->execute();
					$entities = $this->fetch();
					return $entities->total_count;
				}

				$offset = 1;
				if (input('offset')) {
					$offset = input('offset');
				}
				$offset = ($offset * 10) - 10;
				$statement = "SELECT username, first_name, last_name FROM ossn_users AS o
					JOIN ossn_entities AS e0 ON e0.owner_guid = o.guid
					JOIN ossn_entities_metadata AS emd0 ON e0.guid = emd0.guid
					WHERE
					(
					emd0.value REGEXP '{$params['query']}[^=|^;|^\:]'
					AND
					(e0.type = 'user' AND e0.subtype = 'bio') 
					)
					ORDER BY o.guid DESC
					LIMIT {$offset}, 10
				;"; 
				$this->statement($statement);
				$this->execute();
				$entities = $this->fetch(true);
				return $entities;
			} else {
				// view from normal user - fetch public and friend records
				if ($params['blocked_check']) {
					$blocked = "(o.guid NOT IN (SELECT DISTINCT relation_to FROM `ossn_relationships` WHERE relation_from={$params['visitor']->guid} AND type='userblock') AND o.guid NOT IN (SELECT 	DISTINCT relation_from FROM `ossn_relationships` WHERE relation_to={$params['visitor']->guid} AND type='userblock'))";
				} else {
					$blocked = 1;
				}

				$friends = $params['visitor']->getFriends();
				$friend_guids = array();
				if ($friends) {
					foreach ($friends as $friend) {
						$friend_guids[] = $friend->guid;
					}
				}
				$friend_guids[] = $params['visitor']->guid;
				$friend_guids   = implode(',', $friend_guids);
			
				if ($params['count'] == true) {
					$statement = "SELECT COUNT(DISTINCT o.guid) AS total_count FROM ossn_users AS o
						JOIN ossn_entities AS e0 ON e0.owner_guid = o.guid
						JOIN ossn_entities_metadata AS emd0 ON e0.guid = emd0.guid
						JOIN ossn_entities AS e1 ON e1.owner_guid = o.guid
						JOIN ossn_entities_metadata AS emd1 ON e1.guid = emd1.guid
						WHERE
						(
						emd0.value REGEXP '{$params['query']}[^=|^;|^\:]'
						AND {$blocked}
						AND
						(
						(e0.type = 'user' AND e0.subtype = 'bio' AND e1.type = 'user' AND e1.subtype = 'bio_access' AND emd1.value = '2') 
						OR
						(e0.type = 'user' AND e0.subtype = 'bio' AND e1.type = 'user' AND e1.subtype = 'bio_access' AND emd1.value = '3' AND e0.owner_guid IN ({$friend_guids}) )
						)
						)
					;";
					$this->statement($statement);
					$this->execute();
					$entities = $this->fetch();
					return $entities->total_count;
				}

				$offset = 1;
				if (input('offset')) {
					$offset = input('offset');
				}
				$offset = ($offset * 10) - 10;
				$statement = "SELECT DISTINCT username, first_name, last_name FROM ossn_users AS o
					JOIN ossn_entities AS e0 ON e0.owner_guid = o.guid
					JOIN ossn_entities_metadata AS emd0 ON e0.guid = emd0.guid
					JOIN ossn_entities AS e1 ON e1.owner_guid = o.guid
					JOIN ossn_entities_metadata AS emd1 ON e1.guid = emd1.guid
					WHERE
					(
					emd0.value REGEXP '{$params['query']}[^=|^;|^\:]'
					AND {$blocked}
					AND
					(
					(e0.type = 'user' AND e0.subtype = 'bio' AND e1.type = 'user' AND e1.subtype = 'bio_access' AND emd1.value = '2') 
					OR
					(e0.type = 'user' AND e0.subtype = 'bio' AND e1.type = 'user' AND e1.subtype = 'bio_access' AND emd1.value = '3' AND e0.owner_guid IN ({$friend_guids}) )
					)
					)
					ORDER BY o.guid DESC
					LIMIT {$offset}, 10
				;"; 
				$this->statement($statement);
				$this->execute();
				$entities = $this->fetch(true);
				return $entities;
			}
		} else {
			// view from logged off user - fetch public records only
			if ($params['count'] == true) {
				$statement = "SELECT COUNT(DISTINCT username) AS total_count FROM ossn_users AS o
					JOIN ossn_entities AS e0 ON e0.owner_guid = o.guid
					JOIN ossn_entities_metadata AS emd0 ON e0.guid = emd0.guid
					JOIN ossn_entities AS e1 ON e1.owner_guid = o.guid
					JOIN ossn_entities_metadata AS emd1 ON e1.guid = emd1.guid
					WHERE
					(
					emd0.value REGEXP '{$params['query']}[^=|^;|^\:]'
					AND
					(e0.type = 'user' AND e0.subtype = 'bio' AND e1.type = 'user' AND e1.subtype = 'bio_access' AND emd1.value = '2') 
					)
				;";
				$this->statement($statement);
				$this->execute();
				$entities = $this->fetch();
				return $entities->total_count;
			}

			$offset = 1;
			if (input('offset')) {
				$offset = input('offset');
			}
			$offset = ($offset * 10) - 10;
			$statement = "SELECT DISTINCT username, first_name, last_name FROM ossn_users AS o
				JOIN ossn_entities AS e0 ON e0.owner_guid = o.guid
				JOIN ossn_entities_metadata AS emd0 ON e0.guid = emd0.guid
				JOIN ossn_entities AS e1 ON e1.owner_guid = o.guid
				JOIN ossn_entities_metadata AS emd1 ON e1.guid = emd1.guid
				WHERE
				(
				emd0.value REGEXP '{$params['query']}[^=|^;|^\:]'
				AND
				(e0.type = 'user' AND e0.subtype = 'bio' AND e1.type = 'user' AND e1.subtype = 'bio_access' AND emd1.value = '2') 
				)
				ORDER BY o.guid DESC
				LIMIT {$offset}, 10
			;"; 
			$this->statement($statement);
			$this->execute();
			$entities = $this->fetch(true);
			return $entities;
		}
	}
}