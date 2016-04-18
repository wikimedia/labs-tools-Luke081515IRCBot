<?php
$bot->add_hook("PRIVMSG", "ircbot_msglog");

function ircbot_msglog($object, $command, $params, $prefix) {
	global $log_format;

	$nick = IRC::get_nick($prefix);
	$dest = substr($params, 0, strpos($params, " "));
	$msg = substr($params, strpos($params, " :") + 2);
	$file = "logfile";
	file_put_contents($file, date($log_format) . " $dest <$nick> $msg\n", FILE_APPEND);
}
?>
