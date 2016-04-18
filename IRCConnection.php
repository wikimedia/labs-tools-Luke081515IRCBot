<?php
class IRC {
	public $server;
	public $port;
	public $nickname;
	public $username;
	public $hosthostname;
	public $servername;
	public $realname;
	private $password;

	private $stack = array();

	private $handle;
	public $errno;
	public $errstr;

	static function startConnection($server, $port, $nick, $user, $host, $servername, $realname, $password) {
		$irc = new IRC;
		$irc->server = $server;
		$irc->port = $port;
		$irc->nickname = $nick;
		$irc->username = $user;
		$irc->hostname = $host;
		$irc->servername = $servername;
		$irc->realname = $realname;
		$irc->password = $password;
		$irc->connect();

		// Register
		$irc->pass($irc->password);
		$irc->nick($nick);
		$irc->user($user, $host, $servername, ":" . $realname);

		return $irc;
	}

	function connect() {
		$this->handle = fsockopen($this->server, $this->port, $this->errno, $this->errstr);
		if (!is_resource($this->handle)) {
			die("error with connection");
		}
		return 1;
	}

	function __call($command, $params) {
		$data = strtoupper($command) . " " . implode(" ", $params) . "\n";
		fwrite($this->handle, $data);
	}

	function get() {
		if (empty($this->stack)) {
			$data = fread($this->handle, 100000);
			$data = explode("\n", $data);
			unset($data[count($data) - 1]);
			$this->stack = $data;
		}
		$line = array_shift($this->stack);
		echo $line . "\n";
		return self::analyse($line, $this);
	}

	function action($dest, $text) {
		$this->privmsg($dest, ":" . chr(1) . "ACTION " . $text . chr(1));
	}

	static function analyse($data, $object) {
		if ($data == "") {
			return 0;
		}
		if (substr($data, 0, 1) == ":") {
			$retval["prefix"] = substr($data, 1, strpos($data, " "));
			$data = substr($data, strpos($data, " ") + 1);
		}
		$retval["command"] = substr($data, 0, strpos($data, " "));
		$retval["command"] = strtoupper($retval["command"]);
		$retval["params"] = substr($data, strpos($data, " ") + 1);
		if ($retval["command"] == "PING") {
			$object->pong($retval["params"]);
		}
		return $retval;
	}

	static function get_nick($prefix) {
		$nick = substr($prefix, 0, strpos($prefix, "!"));
		$nick = str_replace(":", "", $nick);
		return $nick;
	}
}
?>
