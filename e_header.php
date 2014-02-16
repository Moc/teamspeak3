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

// Minor styling, attempt to fix issue #1 - https://github.com/Moc/teamspeak3/issues/1
e107::css('inline', 
"
/* TeamSpeak CSS */
.ts3_viewer
{
	text-align: left; 
}
");


?>