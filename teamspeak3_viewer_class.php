<?php
/*
 * TeamSpeak 3 plugin
 *
 * Copyright (C) 2014 - Tijn Kuyper (http://www.tijnkuyper.nl)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

class teamspeak3_viewer_class
{

	// TODO split this massive function up into seperate functions. Also, OOP!
	public function viewer_zone($zone = 1)
	{
		$sql = e107::getDb(); 
		$ns = e107::getRender(); 

		$ts3_pref = e107::getPlugPref('teamspeak3'); // loads the plugin preferences
	
		require_once("libraries/TeamSpeak3/TeamSpeak3.php");
		TeamSpeak3::init();

		// If 'ts3_flags' pref is set to true, enable flags by setting the flag path. If empty, the viewer will not show flags. 
		if($ts3_pref['ts3_flags']) { $flags = e_PLUGIN."teamspeak3/images/flags/"; }
		
		// retrieve active (status = 1) servers in specified zone (default = 1), 
		$ts3_servers = $sql->retrieve('teamspeak3_servers', 'name, ip, port, qport, zone, status', 'zone = '.$zone.' AND status = 1', TRUE);

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

			    $cache_name = "menu_ts3_viewer_".$name.""; 

			    // Clear cache when in development mode. 
			    if($ts3_pref['ts3_devmode'] == 1) { e107::getCache()->clear($cache_name); }

		   		// Check if the server has been cached, refresh when older than 1 minute. 
				if(!e107::getCache()->retrieve($cache_name, '1'))
			   	{
				    // Try and query the server
				   	try
				   	{	 
				    	// Connect to the teamspeak 3 server. Using #no_query_clients skips serverquery as client
				      	$ts3_ServerInstance = TeamSpeak3::factory("serverquery://".$ip.":".$qport."/?server_port=".$port."#no_query_clients");

				      	// Show the viewer using the viewer functionality in the TeamSpeak 3 Framework. 
			      		$text .= $ts3_ServerInstance->getViewer(new TeamSpeak3_Viewer_Html(e_PLUGIN_ABS."teamspeak3/images/viewer/", $flags));
			 			
			 			// TODO: move this out of here, create a separate method which displays additional data based on preferences. Styling => template. 
						// Show additional info (current/max clients for now)
			    		if($ts3_pref['ts3_additional_data']) 
			    		{
			    			$text .= "<div class='ts3_additional_data'>
    							  		<strong>".LAN_TS3_001."</strong>: ".$ts3_ServerInstance->clientCount()." / ".$ts3_ServerInstance['virtualserver_maxclients']."
    							  	  </div>";
    					}
				      	
				      	// Cache the results, so the viewer does not query the server on every different page load. 
				      	e107::getCache()->set($cache_name, $text);

				      	// Render the menu
				      	$ns->tablerender($name, $text);
					}			 
					// Error quering the server, show the error
					catch(Exception $e)
				  	{
				  		// TODO: move this out of here, create a separate method which displays the error
				  		// Only show the error code for admins, show general message for other users
						if(ADMIN)
						{
							$text .= "Error (ID: ".$e->getCode()."): <br />
								  	 <b>".$e->getMessage()."</b>";
						}
						else
						{
							$text .= LAN_TS3_E_01;
						}
						
						// If developer mode enabled, log the error to the log file
						if($ts3_pref['ts3_devmode'] == 1) 
						{
							e107::getAdminLog()->addError("Error when quering the server ".$name.", ".$ip.":".$port." (".$qport."), ".$e->getCode().": ".$e->getMessage()." ");
							e107::getAdminLog()->toFile('teamspeak3_log', 'TeamSpeak3 plugin logfile', TRUE);
							
						}

						// Render the menu containing the error message
						$ns->tablerender($name, $text);
				  	}     	
				}
				// Server has been cached and is not older than one minute, so display it. 
				else
				{
					$text = e107::getCache()->retrieve($cache_name);
					$ns->tablerender($name, $text, 'ts3_viewer');
				}     	
			} // end foreach
		} // No server records found in the database
	}

	private function display_ts3_error()
	{

		
	}

	private function display_additional_data()
	{


	}


}
?>