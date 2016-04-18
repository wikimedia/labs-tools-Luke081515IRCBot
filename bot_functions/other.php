<?php
function admin_notice($msg) {
	global $bot;
	global $owner;
	$bot->irc->privmsg($owner, ":" . $msg);
}
?>
