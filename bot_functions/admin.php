<?php
$bot->add_privmsg_hook($c . "quit", "ircbot_quit");
function ircbot_quit($object, $params, $prefix, $channel) {
	global $owner;
	global $quitmsg;

	$nick = IRC::get_nick($prefix);
	if ($nick == $owner) {
		$object->quit(":$quitmsg");
		exit;
	}
}

$bot->add_privmsg_hook($c . "nick", "ircbot_nick");
function ircbot_nick($object, $params, $prefix, $channel) {
	global $owner;

	$nick = IRC::get_nick($prefix);
	if ($nick == $owner) {
		$object->nick($params);
	}
}
?>
