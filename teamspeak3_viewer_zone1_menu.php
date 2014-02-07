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

// Load and initialize the TeamSpeak3 viewer class
require_once("teamspeak3_viewer_class.php");
$viewer_class = new teamspeak3_viewer_class;

// Display TS3 servers in zone 1
$viewer_class->viewer_zone('1'); 

?>