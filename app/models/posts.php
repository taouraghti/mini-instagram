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
		$this->db->query("SELECT posts.*, users.Username, users.Avatar
							FROM posts
							INNER JOIN users ON posts.UserId = users.UserId
							WHERE users.RegStatus=1
							ORDER BY PostId DESC");
        return $this->db->resultArray();
	}

	public function getPost($id)
	{
		$this->db->query("SELECT posts.*, users.Username, users.Avatar
							FROM posts
							INNER JOIN users ON posts.UserId = users.UserId
							WHERE PostId=?");
        return $this->db->resultOne(array($id));
	}
	public function countpost()
	{
		$this->db->query("SELECT PostId FROM posts");
		$this->db->resultArray();
		return $this->db->rowCount();
	}

	public function getLatest($limit=5)
	{
		$this->db->query("SELECT * FROM posts ORDER BY PostId DESC LIMIT $limit");
		return $this->db->resultArray();
	}

	public function getProfilPost()
    {
        $this->db->query("SELECT *
                         FROM posts
                         WHERE UserId=?
                         ORDER BY PostId DESC");
        $arr = $this->db->resultArray(array($_SESSION['userid']));
        for($i=0; $i < count($arr) ; $i++)
        { 
            $this->db->query("SELECT COUNT(CommentId) AS nbComments
                            FROM comments
                            WHERE PostId = ?");
            $c = $this->db->resultOne(array($arr[$i]["PostId"]));
            $arr[$i] += $c;
        }
        return $arr;
    }


	public function insert($desc, $img)
    {
        $this->db->query("INSERT INTO posts(Description, Image, UserId, Date)
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
		$this->db->query("UPDATE posts SET Description=?, Approve=? WHERE PostId=?");
		$this->db->execute(array($desc, $status, $id));
	}

	public function delete($id)
	{
		$this->db->query("DELETE FROM posts WHERE PostId=?");
		$this->db->execute(array($id));
	}
	public function approve($id)
	{
		$this->db->query("UPDATE posts SET Approve=1 WHERE PostId=?");
		$this->db->execute(array($id));
	}

	public function notifView($userid)
    {
        $this->db->query("SELECT * FROM likes INNER JOIN posts ON posts.PostId = likes.PostId WHERE posts.UserId = ?");
        $like = $this->db->resultArray(array($userid));
        $this->db->query("SELECT * FROM comments INNER JOIN posts ON posts.PostId = comments.PostId WHERE posts.UserId = ?");
        $com = $this->db->resultArray(array($userid));
        foreach($like as $l)
        {
            $this->db->query("UPDATE likes SET LikeView=1 WHERE LikeId=?");
            $this->db->execute(array($l['LikeId']));
        }
        foreach($com as $c)
        {
            $this->db->query("UPDATE comments SET CommentView=1 WHERE CommentId=?");
            $this->db->execute(array($c['CommentId']));
        }
    }

}