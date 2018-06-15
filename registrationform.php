<?php
# @Author: SPEDI srl
# @Date:   24-01-2018
# @Email:  sviluppo@spedi.it
# @Last modified by:   SPEDI srl
# @Last modified time: 15-06-2018
# @License: GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
# @Copyright: Copyright (c) SPEDI srl

defined('_JEXEC') or die;

class plgUserRegistrationForm extends JPlugin {

		public function onUserAfterSave($user, $isnew, $success, $msg) {

			if ($isnew AND $success) {
				// Call a function in the external app to create the user
				// ThirdPartyApp::createUser($user['id'], $args);
				$params = json_encode(array(	"PAGE" 					  => $_SERVER['REQUEST_URI'],
																			"REQUEST_METHOD"  => $_SERVER['REQUEST_METHOD'],
																			"SERVER_PROTOCOL" => $_SERVER['SERVER_PROTOCOL'],
																			"REQUEST_SCHEME"  => $_SERVER['REQUEST_SCHEME']
																		));

				//Get a db connection.
				$db = JFactory::getDbo();

				// Create a new query object.
				$query = $db->getQuery(true);

				// Insert columns.
				$columns = array('user_id', 'accept', 'timestamp', 'params');
				// Insert values.
				$values = array();
				$values[] = $db->quote($user['id']);
				$values[] = 1;
				$values[] = $db->quote(date("Y-m-d H:i:s"));
				$values[] = $db->quote($params);

				// Prepare the insert query.
				$query
				    ->insert($db->quoteName('#__user_registration_form'))
				    ->columns($db->quoteName($columns))
				    ->values(implode(',', $values));

				// Set the query using our newly populated query object and execute it.
				$db->setQuery($query);
				$db->execute();
			}

		}

}
