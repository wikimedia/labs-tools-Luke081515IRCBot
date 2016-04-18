<?php
$bot->add_privmsg_hook($c . "urlencode", "ircbot_urlencode");
function ircbot_urlencode($object, $params, $prefix, $channel) {
	$nick = IRC::get_nick($prefix);
	$param = urlencode($params);
	$param = str_replace ("%0D", "", $param);
	$object->privmsg($channel, ":urlencode@" . $nick . ": " . $param);
}

$bot->add_privmsg_hook($c . "urldecode", "ircbot_urldecode");
function ircbot_urldecode($object, $params, $prefix, $channel) {
	$nick = IRC::get_nick($prefix);
	$object->privmsg($channel, ":urldecode@" . $nick . ": " . urldecode($params));
}
?>
