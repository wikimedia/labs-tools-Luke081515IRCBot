<?php
$bot->add_privmsg_hook($c . "remove", "ircbot_remove");
function ircbot_remove($object, $params, $prefix, $channel) {
	global $owner;
	$nick = IRC::get_nick($prefix);
	if ($nick == $owner)
		$object->remove($channel . " " . $params);
}
?>