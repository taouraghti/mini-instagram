<?php

class users
{
	private $db;

	public function __construct()
	{
		$this->db = new database;
	}
	
	public function login($username, $password)
	{
		$this->db->query('SELECT * FROM users WHERE Username = ? AND Password = ?');
		$arr = $this->db->resultOne(array($username, $password));
        if($this->db->rowCount() == 1)
            return $arr;
        else
		    return -1;
	}

	public function signup($data)
	{
		$this->db->query('INSERT INTO users(Username, Password, Email, FullName, Avatar, Date)
							VALUES(:xuser, :xpass, :xemail, :xfullname, :xavatar, now())');
		$this->db->bind('xuser', $data['username']);
		$this->db->bind('xpass', $data['password']);
		$this->db->bind('xemail', $data['email']);
		$this->db->bind('xfullname', $data['fullname']);
		$this->db->bind('xavatar', 'inko.png');
		$this->db->execute();
		return $this->login($data['username'], $data['password']);
	}
	
	public function getAll()
	{
		$this->db->query("SELECT * FROM users ORDER BY UserId DESC");
		return $this->db->resultArray();
	}

	public function getOne($id)
	{
		$sql = "WHERE UserId=$id";
		$this->db->query("SELECT * FROM users $sql ORDER BY UserId DESC");
		return $this->db->resultOne();
	}

	public function countAll()
	{
		$this->db->query("SELECT UserId FROM users WHERE GroupID=0");
		return $this->db->rowCount();
	}

	public function countPend()
	{
		$this->db->query("SELECT UserId FROM users WHERE RegStatus=0");
		return $this->db->rowCount();
	}

	public function getLatest($limit=5)
	{
		$this->db->query("SELECT * FROM users ORDER BY UserId DESC LIMIT $limit");
		return $this->db->resultArray();
	}

	public function findUserByUsername($username, $id=0)
	{
		$query = ($id == 0) ? "" : "AND UserId != ?"; 
		$this->db->query("SELECT * FROM users WHERE Username = ? $query ");
		if($id == 0)
			$arr = $this->db->resultOne(array($username));
		else
			$arr = $this->db->resultOne(array($username, $id));
		return $this->db->rowCount();
	}

	public function insert($data)
	{
		$this->db->query("INSERT INTO users(Username, Password, Email, FullName, Avatar,RegStatus, Date) 
							VALUES(:xuser, :xpass, :xemail, :xname, :xavatar, 1, now())");
		$this->db->bind('xuser', $data['username']);
		$this->db->bind('xpass', $data['password']);
		$this->db->bind('xemail', $data['email']);
		$this->db->bind('xname', $data['fullname']);
		$this->db->bind('xavatar', $data['avatar']);
		$this->db->execute();
	}

	public function update($data)
	{
		$this->db->query("UPDATE users SET Username=?, Email=?, FullName=?, Password=?, Avatar=? WHERE UserID=?");
		$this->db->execute(array($data['username'], $data['email'], $data['fullname'], $data['password'], $data['avatar'], $data['id']));
	}
   
	public function delete($id)
	{
		$this->db->query("DELETE FROM users WHERE UserId=?");
		$this->db->execute(array($id));
	}

	public function activate($id)
	{
		$this->db->query("UPDATE users SET RegStatus=1 WHERE UserId=?");
		$this->db->execute(array($id));
	}
}