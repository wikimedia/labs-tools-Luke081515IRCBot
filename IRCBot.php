<?php
include("BotData.php");

$bot = new IRC_Bot;

// Config for the bot

// Define channels here like $channel [0] = "#wikimedia-codereview";
// ToDo: Load the config from a config file

$c = "!";
$owner = "Luke081515";
$quitmsg = "Leaving";
$log_format = "d.m H:i";
$info["owner"] = $owner;
$info["commands"] = $c . "info, " . $c . "urlencode " . $c . "urldecode";
$info["admin_commands"] = $c . "quit, " . $c . "nick, ";
// Config end

$dir = "bot_functions/";
$dirh = opendir($dir);
	while ($file = readdir($dirh)) {
		if (substr($file, -4) == ".php") {
			include_once($dir . $file);
		}
	}
closedir($dirh);
$bot->run();
?>
