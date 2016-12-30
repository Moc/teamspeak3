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

// Load language files
e107::lan('teamspeak 3', false, true);

// Load and initialize the TeamSpeak3 viewer class
require_once("teamspeak3_viewer_class.php");
$viewer_class = new teamspeak3_viewer_class;

// Display TS3 servers in zone 3
$viewer_class->viewer_zone('3'); 