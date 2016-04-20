<?php
$bot->add_hook("joinActions", "ircbot_joinActions");

/** joinActions
* This hook gets triggered if someone joins
* @params $nick - Nickname, $command - has the value "JOIN", always, $params - Name of the joined channel, $prefix - Nickname with hostdomain/cloak
* Remember that the bot triggers this hook itself if he joins a channel
*/
function ircbot_joinActions($object, $command, $params, $prefix) {
    global $owner;
    global $c;
	$nick = IRC::get_nick($prefix);
	// define your custom actions here
}
?>
