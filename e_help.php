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

switch(vartrue($action)) 
{
   case 'list':
   {
      $find    = array('[br]', '{', '}');
      $replace = array('<br />', '<a href="https://github.com/Moc/teamspeak3/wiki" target="_blank">', '</a>');
      $text    = str_replace($find, $replace, LAN_TS3_H_02);
      break;
   }
   case 'create':
   case 'edit':
   {
      $find    = array('{', '}');
      $replace = array('<a href="https://github.com/moc/teamspeak3/wiki/Adding-new-servers" target="_blank">', '</a>');
      $text    = str_replace($find, $replace, LAN_TS3_H_03);
      break;
   }
   case 'prefs':
   {
      $find    = array('{', '}');
      $replace = array('<a href="https://github.com/moc/teamspeak3/wiki/Preferences" target="_blank">', '</a>');
      $text = LAN_TS3_H_04;
      break;
   }
   default: 
   {
      $text = LAN_TS3_H_02;
   }
}

if($text)
{
	$ns->tablerender(LAN_TS3_H_01, $text);	
}

?>