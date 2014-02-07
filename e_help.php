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

$action = vartrue($_GET['action']);

switch(vartrue($action)) {
   case 'list':
   {
      $text = LAN_TS3_H_02;
      break;
   }
   case 'create':
   case 'edit':
   {
      $text = LAN_TS3_H_03;
      break;
   }

   case 'prefs':
   {
      $text = LAN_TS3_H_05;
      break;
   }
   default: 
   {
      $text = "";
   }
}

if($text)
{
	$ns -> tablerender(LAN_TS3_H_01, $text);	
}

?>