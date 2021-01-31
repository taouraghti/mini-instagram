<?php

class posts
{
	private $db;

	public function __construct()
	{
		$this->db = new database;
	}
	
	public function getAll()
	{
		$this->db->query("SELECT posts.*, users.Username 
							FROM posts
							INNER JOIN users ON posts.UserID = users.UserID
							ORDER BY postID DESC");
        return $this->db->resultArray();
	}

	public function getPost($id)
	{
		$this->db->query("SELECT * FROM posts WHERE postId=?");
        return $this->db->resultOne(array($id));
	}
	public function countpost()
	{
		$this->db->query("SELECT postId FROM posts");
		return $this->db->rowCount();
	}

	public function getLatest($limit=5)
	{
		$this->db->query("SELECT * FROM posts ORDER BY postId DESC LIMIT $limit");
		return $this->db->resultArray();
	}

	public function insert($desc, $img)
    {
        $this->db->query("INSERT INTO posts(Description, image, UserId, Date)
                        VALUES(:desc, :img, :userid, now())");
        $this->db->bind("desc", $desc);
        $this->db->bind("img", $img);
        $this->db->bind("userid", $_SESSION['userid']);
        $this->db->execute();
        if($this->db->rowCount() > 0)
            return 1;
        else
            return 0;
	}
	
	public function update($id, $desc, $status)
	{
		$this->db->query("UPDATE posts SET Description=?, Approve=? WHERE postId=?");
		$this->db->execute(array($desc, $status, $id));
	}

	public function delete($id)
	{
		$this->db->query("DELETE FROM posts WHERE postId=?");
		$this->db->execute(array($id));
	}
	public function approve($id)
	{
		$this->db->query("UPDATE posts SET Approve=1 WHERE postId=?");
		$this->db->execute(array($id));
	}
}