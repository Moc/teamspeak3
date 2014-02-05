<?php
/*
 * TeamSpeak 3 plugin
 *
 * Copyright (C) 2014 - Tijn Kuyper (http://www.tijnkuyper.nl)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

class teamspeak3_setup
{
	
	function install_pre($var)
	{
		// print_a($var);
		$mes = eMessage::getInstance();
		// $mes->add("custom install 'pre' function.", E_MESSAGE_SUCCESS);
	}

	function install_post($var)
	{
		$sql = e107::getDb();
		$mes = eMessage::getInstance();
		// $mes->add("custom install 'post' function.", E_MESSAGE_SUCCESS);
	}

	function uninstall_pre($var)
	{
		$sql = e107::getDb();
		$mes = eMessage::getInstance();
		// $mes->add("custom uninstall 'pre' function.", E_MESSAGE_SUCCESS);
	}


	// IMPORTANT : This function below is for modifying the CONTENT of the tables only, NOT the table-structure. 
	// To Modify the table-structure, simply modify your {plugin}_sql.php file and an update will be detected automatically. 
	/*
	 * @var $needed - true when only a check for a required update is being performed.
	 * Return: Reason the upgrade is required, otherwise set it to return FALSE. 
	 */
	function upgrade_post($needed)
	{
	
	}
}
