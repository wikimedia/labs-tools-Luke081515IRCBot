<?php
$bot->add_privmsg_hook($c . "kick", "ircbot_kick");
function ircbot_kick($object, $params, $prefix, $channel) {
	global $owner;
	$nick = IRC::get_nick($prefix);
	if ($nick == $owner)
		$object->kick($channel . " " . $params);
}
?>