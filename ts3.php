<?php
/*
 * TeamSpeak 3 plugin
 *
 * Copyright (C) 2015 - Tijn Kuyper (http://www.tijnkuyper.nl)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

require_once("../../class2.php");

// Make this page unaccessible when plugin is not installed. 
if (!e107::isInstalled('teamspeak3'))
{
	header('location:'.e_BASE.'index.php');
	exit;
}

// Exit when running PHP < 5.3 to motivate people to move to 5.3+. 
// Oh right, and to be sure that I can use the latest PHP functions! :)
$php_version = phpversion();
if(version_compare($php_version, 5.3, "<"))
{
	require_once(HEADERF);
	$text = LAN_TS3_E_03;
	e107::getRender()->tablerender("TeamSpeak3 - Error", $text); 
	require_once(FOOTERF);
	exit;
}

// Load the LAN files
e107::lan('teamspeak3', false, true);

require_once(HEADERF);

// Ok, all neccessary files are included, all checks have been passed: we are good to go.

$text = LAN_TS3_E_04;

// Let's render and show it!
e107::getRender()->tablerender(LAN_TS3_E_05, $text);

require_once(FOOTERF);
exit;
?>
