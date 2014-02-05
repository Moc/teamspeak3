<?php
/*
 * TeamSpeak 3 plugin
 *
 * Copyright (C) 2014 - Tijn Kuyper (http://www.tijnkuyper.nl)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

if (!defined('e107_INIT')) { exit; }

// Load language files
e107::lan('teamspeak 3', false, true);

// Load the plugin preferences
$ts3_pref = e107::getPlugPref('teamspeak3');

// Load and initialize the TeamSpeak 3 Framework
require_once("libraries/TeamSpeak3/TeamSpeak3.php");
TeamSpeak3::init();

// If 'ts3_flags' pref is set to true, enable flags by setting the flag path. If empty, the viewer will not show flags. . 
if($ts3_pref['ts3_flags']) { $flags = e_PLUGIN."teamspeak3/images/flags/"; }

// Gather the servers from the database
$sql = e107::getDb();
$ts3_servers = $sql->retrieve('teamspeak3_servers', 'name, ip, port, qport, status', '', TRUE);

// Check if there are servers entered in the database and, if there are, loop through them
if($ts3_servers)
{
	foreach ($ts3_servers as $ts3_server) 
	{
		$text 	= "";
	    $name  	= $ts3_server['name'];
	    $ip    	= $ts3_server['ip'];
	    $port  	= $ts3_server['port'];
	    $qport	= $ts3_server['qport'];
	    $status	= $ts3_server['status'];

	    // Clear cache in dev mode. 
	    if($ts3_pref['ts3_devmode'] == 1) { e107::getCache()->clear("ts3_viewer_".$name.""); }

	    // Check if the server has been cached
		if(!e107::getCache()->retrieve("ts3_viewer_".$name."", '2'))
	   	{
		    // Try and query the server
		   	try
		   	{	   
		   		// Check if the teamspeak server should be displayed
		   		if($status == "1")
			    { 
			    	// Connect to the teamspeak 3 server
			      	$ts3_ServerInstance = TeamSpeak3::factory("serverquery://".$ip.":".$qport."/?server_port=".$port."#no_query_clients");

			      	// Show the viewer using the in-build viewer functionality. 
		      		$text .=  $ts3_ServerInstance->getViewer(new TeamSpeak3_Viewer_Html(e_PLUGIN_ABS."teamspeak3/images/viewer/", $flags));
		 			
		 			// Show additional info (current/max clients for now)
			    	$text .= "<br />";
			    	$text .= "<b>".TS3_001."</b>: ".$ts3_ServerInstance->clientCount()." / ".$ts3_ServerInstance['virtualserver_maxclients']; 
			      	
			      	// Cache it, so it doesn't query the server on every page load. 
			      	e107::getCache()->set("ts3_viewer_".$name."", $text);

			      	// Render the menu
			      	$ns->tablerender($name, $text);
			    }
			}	 
			// Error quering the server, show the error
			catch(Exception $e)
		  	{
		  		// Only show the error code for admins, show general message for other users
				if(ADMIN)
				{
					$text .= "Error (ID".$e->getCode()."): <br />
						  	 <b>".$e->getMessage()."</b>";
				}
				else
				{
					$text .= "TeamSpeak Viewer offline. Please contact the site administrator.";
				}
				
				// Render the menu containing the error message
				$ns->tablerender($name, $text);
		  	}	     	
		}
		// Server has been cached already, display it
		else
		{
			$text = e107::getCache()->retrieve("ts3_viewer_".$name."");
			$ns->tablerender($name, $text, 'ts3_viewer');
		}     	
	}
}

?>