<?php
$bot->add_privmsg_hook($c . "info", "ircbot_info");

function ircbot_info($object, $params, $prefix, $channel) {
	global $info;
	if (trim($params) == "") {
		$i = 1;
		foreach ($info AS $key=>$value) {
			$i++;
			$object->privmsg($channel, ":" . chr(3) . $i . "##" . chr(3) . chr(2) . $key . chr(2) . ": " . $value);
		}
	} elseif (trim($params) == "short") {
		$text = "";
		foreach ($info AS $key=>$value) {
			$text .= $key . " ";
		}
		$object->privmsg($channel, ":" . $text);
	} elseif (isset($info[trim($params)])) {
		$object->privmsg($channel, ":" . chr(3) . rand(0, 15) . "##" . chr(3) . chr(2) . $params . chr(2) . ": " . $info[$params]);
	} else {
		$object->privmsg($channel, ":" . chr(21) . "\"$params\"" . chr(21) . ": 404 - Not found");
	}
}
?>
