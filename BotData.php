<?php
include_once 'IRCConnection.php';
include 'Password.php';
class IRC_Bot {
	private $password;
	public $server;
	public $port = 6667;

	public $nickname;
	public $username;
	public $hostname = "HOST";
	public $servername = "SERVER";
	public $realname = "PHPIRC 1.0";
	public $irc;

	private $hooks = array();
	private $privmsg_hooks = array();

	public function start ($Account) {
		$a=0;
		$this->password = new Password();
		$Found = false;
		echo ("\nstart");
		$this->password->init();
		$LoginName = unserialize($this->password->getLoginName ());
		$LoginHost = unserialize($this->password->getLoginHost());
		$LoginAccount = unserialize($this->password->getLoginAccount());
		$LoginPassword = unserialize($this->password->getLoginPassword());
		while (isset ($LoginName [$a]) === true) {
			if ($LoginName [$a] === $Account) {
				$this->server = $LoginHost [$a];
				$this->username = $LoginAccount [$a];
				$this->nickname = $LoginAccount [$a];
				$this->password = $LoginPassword [$a];
				$Found = true;
			}
			$a++;
		}
		if (!$Found) {
			throw new Exception("Can't found the correct logindata");
			die(1); // exit with error
		}
	}

	function run() {
		$Account = 'Luke081515Bot@Freenode';
		$this->start ($Account);
		$this->irc = IRC::startConnection($this->server,
			$this->port,
			$this->nickname,
			$this->username,
			$this->servername,
			$this->hostname,
			$this->realname,
			$this->password);
		while (true) {
			$input = $this->irc->get();
			$this->do_hooks($input);
		}
	}

	function add_hook($command, $function) {
		$this->hooks[] = array("command" => $command, "function" => $function);
	}

	function add_privmsg_hook($command, $function, $channel = "*") {
		$this->privmsg_hooks[] = array("command" => $command, "function" => $function, "channel" => $channel);
	}

	function do_hooks($input) {
		foreach ($this->hooks AS $hook) {
			if ($hook["command"] == $input["command"]) {
				call_user_func($hook["function"],
					$this->irc,
					$input["command"],
					$input["params"],
					$input["prefix"]);
			}
		}
		if ($input["command"] == "PRIVMSG") {
			foreach ($this->privmsg_hooks AS $hook) {
				$string = $hook["channel"] . " :" . $hook["command"];
				$string2 = strstr($input["params"], ":");
				if ($hook["channel"] != "*" &&
					substr($input["params"], 0, strlen($string)) == $string) {
					call_user_func($hook["function"],
						$this->irc,
						substr($input["params"], strlen($string) + 1),
						$input["prefix"],
						$hook["channel"]);
				} elseif (substr($string2, 0, strlen($hook["command"]) + 1) == ":" . $hook["command"]) {
					$params_pos = @strpos($input["params"], $hook["command"]) + strlen($hook["command"]) + 1;
					$params = substr($input["params"], $params_pos);
					$channel = substr($input["params"], 0, strpos($input["params"], " "));
					call_user_func($hook["function"],
						$this->irc,
						$params,
						$input["prefix"],
						$channel);
				}
			}
		}
	}
}

?>
