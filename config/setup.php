<?php
$DB_DSN 	 = 'mysql:host=localhost;';
$DB_NAME	 = 'instagram';
$DB_USER 	 = 'root';
$DB_PASSWORD = '';

/******* CREATING A NEW DATABASE instagram **************/

try
{
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $con = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);

    $sql = "DROP DATABASE IF EXISTS ". $DB_NAME . ";";
    $con->exec($sql);

    $sql = "CREATE DATABASE IF NOT EXISTS " . $DB_NAME . ";";
    $con->exec($sql);
    
    echo "DataBase Created Successfully\n";
    $con->exec("use " . $DB_NAME . ";");
}
catch(PDOException $e)
{
    echo "CREATING DATABASE FAILED " . $e->getMessage();
    exit(-1);
}

/* ****************************************************** */

/**************** CREATING USERS TABLE **********************/

try
{
    $sql = "CREATE TABLE `users`(
        `UserId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `Username` varchar(255) NOT NULL,
        `Password` varchar(255) NOT NULL,
        `Email` varchar(255) NOT NULL,
        `FullName` varchar(255) NOT NULL,
        `RegStatus` smallint DEFAULT 0,
        `GroupID` smallint DEFAULT 0,
        `Date` date NOT NULL,
        `Avatar` varchar(255) NOT NULL
    )ENGINE=InnoDB";

    $con->exec($sql);
    echo "User Table Created Successfully";
}
catch(PDOException $e)
{
    echo "CREATING USERS TABLE FAILED " . $e->getMessage();
}

/******************************************************* */

/**************** CREATING POSTS TABLE **********************/

try
{
    $sql = "CREATE TABLE `posts`(
        `PostId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `Description` text NOT NULL,
        `Date` date NOT NULL,
        `Image` varchar(255) NOT NULL,
        `Approve` smallint NOT NULL DEFAULT '1',
        `NumberLikes` INT(11) NOT NULL DEFAULT '0',
        `UserId` int(11) NOT NULL,
        CONSTRAINT `fk_posts_userid`
        FOREIGN KEY (`UserId`)
        REFERENCES `instagram`.`users` (`UserId`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
        )ENGINE=InnoDB";
    $con->exec($sql);
    echo "posts Table Created Successfully";
}
catch(PDOException $e)
{
    echo "CREATING POSTS TABLE FAILED " . $e->getMessage();
}

/******************************************************* */

/************** CREATING LIKES TABLE  ********************/

try
{
    $sql = "CREATE TABLE `likes`(
        `LikeId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `UserLike` varchar(255) NOT NULL,
        `LikeView` SMALLINT NOT NULL DEFAULT '0',
        `Date` datetime NOT NULL,
        `UserId` int(11) NOT NULL,
        `PostId` int(11) NOT NULL,
        CONSTRAINT `fk_likes_userid`
        FOREIGN KEY (`UserId`)
        REFERENCES `instagram`.`users` (`UserId`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
        CONSTRAINT `fk_likes_postid`
        FOREIGN KEY (`PostId`)
        REFERENCES `instagram`.`posts` (`PostId`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
        )ENGINE=InnoDB";

    $con->exec($sql);
    echo "Likes Table Created Successfully";
}
catch(PDOException $e)
{
    echo "CREATING Likes TABLE FAILED " . $e->getMessage();
}
/******************************************************* */


/**************** CREATING COMMENTS TABLE **********************/

try
{
    $sql = "CREATE TABLE `comments`(
        `CommentId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `UserComment` varchar(255) NOT NULL,
        `Comment` text NOT NULL,
        `Date` datetime NOT NULL,
        `Status` SMALLINT NOT NULL DEFAULT '0',
        `UserId` int(11) NOT NULL,
        `PostId` int(11) NOT NULL,
        CONSTRAINT `fk_comments_userid`
        FOREIGN KEY (`UserId`)
        REFERENCES `instagram`.`users` (`UserId`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
        CONSTRAINT `fk_comments_postid`
        FOREIGN KEY (`PostId`)
        REFERENCES `instagram`.`posts` (`PostId`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
        )ENGINE=InnoDB";
    $con->exec($sql);
    echo "Comments Table Created Successfully";
}
catch(PDOException $e)
{
    echo "CREATING COMMENTS TABLE FAILED " . $e->getMessage();
}
/******************************************************* */


?>