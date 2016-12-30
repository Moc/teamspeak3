<?php
/*
 * TeamSpeak 3 - an e107 plugin by Tijn Kuyper
 *
 * Copyright (C) 2015-2017 Tijn Kuyper (http://www.tijnkuyper.nl)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

if (!defined('e107_INIT')) { exit; }

$action = vartrue($_GET['action']);

switch(vartrue($action)) 
{
   default:
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
      $replace = array('<a href="https://github.com/Moc/teamspeak3/wiki/Adding-new-servers" target="_blank">', '</a>');
      $text    = str_replace($find, $replace, LAN_TS3_H_03);
      break;
   }
   case 'prefs':
   {
      $find    = array('{', '}');
      $replace = array('<a href="https://github.com/Moc/teamspeak3/wiki/Preferences" target="_blank">', '</a>');
      $text    = str_replace($find, $replace, LAN_TS3_H_04);
      break;
   }
}

if($text)
{
	$ns->tablerender(LAN_TS3_H_01, $text);	
}