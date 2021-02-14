<?php

class comments
{
	private $db;

	public function __construct()
	{
		$this->db = new database;
	}
	
	public function getAll($postid="")
	{
		$sql = empty($postid) ? "" : " AND posts.PostId=$postid";
		$this->db->query("SELECT *, users.Avatar, posts.Image
						FROM comments
						INNER JOIN users ON users.UserId=comments.UserId
						INNER JOIN posts ON posts.PostId = comments.PostId
						WHERE users.RegStatus=1
						$sql
						ORDER BY CommentId DESC");
        return $this->db->resultArray();
	}

	public function getNotif()
	{
		$this->db->query("SELECT comments.*, users.Avatar, posts.Image FROM comments
                    INNER JOIN posts ON posts.PostId = comments.PostId
                    INNER JOIN users ON users.UserId = comments.UserId
					WHERE posts.UserId=?  AND comments.UserId != ?");
		return $this->db->resultArray(array($_SESSION['userid'], $_SESSION["userid"]));
	}

	public function countComment()
	{
		$this->db->query("SELECT CommentId FROM comments");
		$this->db->resultArray();
		return $this->db->rowCount();
	}

	public function getLatest($limit=5)
	{
		$this->db->query("SELECT *, users.Username 
							FROM comments
							INNER JOIN users ON users.UserId=Comments.UserId
							ORDER BY CommentId DESC LIMIT $limit");
		return $this->db->resultArray();
	}

	public function comment($userid, $postid, $comment)
    {
        $this->db->query("SELECT * FROM users WHERE UserId = ?");
        $this->db->resultOne(array($userid));
        $user = $this->db->rowCount();
		$this->db->query("SELECT * FROM posts WHERE PostId = ?");
		$this->db->resultOne(array($postid));
		$post = $this->db->rowCount();
		echo $user . '/' . $post;
        if($user > 0 && $post > 0)
        {
			$this->db->query("INSERT INTO comments(Date, UserId, PostId, Comment, UserComment) VALUES(now(), :userid, :postid, :com, :user)");
			$this->db->bind('userid', $userid);
			$this->db->bind('postid', $postid);
			$this->db->bind('com', $comment);
			$this->db->bind('user', $_SESSION['username']);
			$this->db->execute();
        }
    }

	public function delete($id)
	{
		$this->db->query("DELETE FROM comments WHERE CommentId=?");
		$this->db->execute(array($id));
	}
}
