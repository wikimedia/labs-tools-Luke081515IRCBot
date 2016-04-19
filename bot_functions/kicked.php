<?php
$bot->add_hook("KICKED", "ircbot_kicked");

function ircbot_kicked($object, $command, $params, $prefix) {
	global $channel;
	global $nick;

	$a=0;
	while (isset ($channel [$a]) === true) {
		$string = $channel [$a] . " " . $nickname;
		if (substr($params, 0, strlen($string)) == $string) {
			$object->join($channel [$a]);
			admin_notice ("Kicked from " . $channel [$a]);
		}
		$a++;
	}
}
?>
