<?php
class Password
{
	private $LoginName;
	private $LoginHost;
	private $LoginAccount;
	private $Password;

	public function Password()
	{}

	public function init()
	{
		$this->LoginName = array(
			'Botname@Network',
		);
		$this->LoginHost = array(
			'Servername', // for example card.freenode.net
		);
		$this->LoginAccount = array(
			'Nickname',
		);
		$this->LoginPassword = array(
			'Password',
		);
	}
	public function getLoginName () {
		return serialize ($this->LoginName);
	}
	public function getLoginHost () {
		return serialize ($this->LoginHost);
	}
	public function getLoginAccount () {
		return serialize ($this->LoginAccount);
	}
	public function getLoginPassword () {
		return serialize ($this->LoginPassword);
	}
}
?>