<?php

class user
{
	public function mainPage()
	{
		echo "main<br>";
	}
	public function download()
	{
		echo "download<br>";
	}
	public function search()
	{
		echo "search<br>";
	}
	
}
class rpi_user extends user
{
	private $rcsid;
	public function comment()
	{
		echo "comment<br>";
	}
	public function rate()
	{
		echo "rate<br>";
	}
	public function flag()
	{
		echo "flag<br>";
	}
	public function login()
	{
		echo "login<br>";
	}
	public function logout()
	{
		echo "logout<br>";
	}
}

class moderator extends rpi_user
{
	public function ban_user()
	{
	}
	public function un_ban_user()
	{
	}
	public function remove_comment()
	{
	}
	public function remove_project()
	{
	}
}

class admin extends moderator
{
	public function change_privilege_level()
	{
	}
}

?>