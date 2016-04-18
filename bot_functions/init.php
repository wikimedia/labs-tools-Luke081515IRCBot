<?php
$bot->add_hook("422", "ircbot_init");
$bot->add_hook("376", "ircbot_init");

function ircbot_init($object, $command, $params, $prefix) {
	global $channel;
	global $c;
	$a=0;
	while (isset ($channel [$a]) === true) {
		$object->join($channel [$a]);
		admin_notice("Joined: " . $channel [$a]);
		$a++;
	}
}
?>
