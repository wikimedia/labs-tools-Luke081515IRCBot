<?php
$bot->add_hook("INVITE", "ircbot_invite");

function ircbot_invite($object, $command, $params, $prefix) {
	global $nick;
	global $owner;
	$user = IRC::get_nick($prefix);
	if ($user == $owner) {
		if (substr($params, 0, strlen($nick)) == $nick) {
			$object->join(substr($params, strpos($params, ":") + 1));
		}
	}
}
?>
