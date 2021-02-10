<?php

class likes
{
	private $db;

	public function __construct()
	{
		$this->db = new database;
	}
	
	public function getAll($postid="")
	{
        $sql = empty($postid) ? "" : "WHERE PostId=$postid";
		$this->db->query("SELECT likes.*, users.Avatar
						FROM likes
						INNER JOIN users ON users.UserId=likes.UserId
                        $sql
						ORDER BY LikeId DESC");
        return $this->db->resultArray();
    }
    

	public function getNotif()
	{
		$this->db->query("SELECT likes.*, users.Avatar, posts.Image FROM likes
                    INNER JOIN posts ON posts.PostId = likes.PostId
                    INNER JOIN users ON users.UserId = likes.UserId
					WHERE posts.UserId=?  AND likes.UserId != ?");
		return $this->db->resultArray(array($_SESSION['userid'], $_SESSION["userid"]));
	}

	public function getLike($userid, $postid)
	{
		$this->db->query("SELECT * FROM users WHERE UserId = ?");
        $this->db->resultOne(array($userid));
        $user = $this->db->rowCount();
        $this->db->query("SELECT * FROM posts WHERE PostId = ?");
        $likedpost = $this->db->resultOne(array($postid));
        $post = $this->db->rowCount();
        if($user > 0 && $post > 0)
        {
            $this->db->query("SELECT * FROM likes WHERE UserId = ? AND PostId=?");
            $data = $this->db->resultOne(array($userid, $postid));
            if($this->db->rowCount() > 0)
            {
                $this->db->query("DELETE FROM likes WHERE UserId = ? AND PostId=?");
                $this->db->execute(array($userid, $postid));
                $likedpost['NumberLikes']--;
            }
            else
            {
                $this->db->query("INSERT INTO likes(Date, UserId, PostId, UserLike) VALUES(now(), :userid, :postid, :user)");
                $this->db->bind('userid', $userid);
                $this->db->bind('postid', $postid);
                $this->db->bind('user', $_SESSION['username']);
                $this->db->execute();
                $likedpost['NumberLikes']++;
            }
            $this->db->query("UPDATE posts SET NumberLikes=? WHERE PostId=?");
            $this->db->execute(array($likedpost['NumberLikes'], $postid));
        }
	}

}
