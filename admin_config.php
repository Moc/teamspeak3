<?php
/*
 * TeamSpeak 3 plugin
 *
 * Copyright (C) 2014 - Tijn Kuyper (http://www.tijnkuyper.nl)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

require_once('../../class2.php');
if (!getperms('P')) 
{
	header('location:'.e_BASE.'index.php');
	exit;
}

class teamspeak3_admin extends e_admin_dispatcher
{
	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'teamspeak3_servers_ui',
			'path' 			=> null,
			'ui' 			=> 'teamspeak3_servers_form_ui',
			'uipath' 		=> null
		),

	);	
	
	
	protected $adminMenu = array(

		'main/list'			=> array('caption'=> LAN_MANAGE, 'perm' => 'P'),
		'main/create'		=> array('caption'=> LAN_CREATE, 'perm' => 'P'),
			
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),	

	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = 'TeamSpeak 3';
}

				
class teamspeak3_servers_ui extends e_admin_ui
{
		protected $pluginTitle		= 'TeamSpeak 3';
		protected $pluginName		= 'teamspeak3';
		protected $table			= 'teamspeak3_servers';
		protected $pid				= 'id';
		protected $perPage 			= 10; 
			
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'name' =>   array ( 'title' => LAN_NAME, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'filter' => true, 'inline' => true, 'validate' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'ip' =>   array ( 'title' => LAN_IP, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'filter' => true, 'inline' => true, 'validate' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'port' =>   array ( 'title' => LAN_TS3_PORT, 'type' => 'number', 'data' => 'str', 'width' => 'auto', 'filter' => true, 'inline' => true, 'validate' => true, 'help' => 'Port of the server. Default is 9987.', 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'qport' =>   array ( 'title' => LAN_TS3_QPORT, 'type' => 'number', 'data' => 'str', 'width' => 'auto', 'filter' => true, 'inline' => true, 'validate' => true, 'help' => 'Query port. Default is 10011.', 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'status' =>   array ( 'title' => LAN_STATUS, 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'filter' => true, 'inline' => true, 'validate' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'center', 'thclass' => 'center',  ),
		  'options' =>   array ( 'title' => 'Options', 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('id', 'name', 'ip', 'port', 'qport', 'status');
	
		protected $prefs = array(	
			'ts3_devmode'		=> array('title'=> LAN_TS3_DEVMODE, 'type'=>'boolean', 'data' => 'int','help'=>'Developer mode is used for testing and development. Do not enable unless specifically advised!'),
			'ts3_flags'		=> array('title'=> LAN_TS3_FLAGS, 'type'=>'boolean', 'data' => 'int','help'=>'Shows the clients\'s country flag in the teamspeak viewer'),
		); 
			
}				


class teamspeak3_servers_form_ui extends e_admin_form_ui
{

}		
		
		
new teamspeak3_admin();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>