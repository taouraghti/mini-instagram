<?php
    if(isset($_SESSION['username']))
    {
?>

<div class="container" >
    <div class="row">
        <div class="col-12">
            <div class="card w-75" style="margin:30px auto; max-width:700px">
                <div class='username-post'>
                    <a href='<?php echo URLROOT . "/app/init.php?url=user/profil/" . $data['post']['Username'];?>'>
                    <img class="img-responsive rounded-circle" style="width:40px;height:40px;" src="<?php echo URLROOT . "/uploads/avatars/" . $data['post']['Avatar'];?>" alt="">
                        <?php echo $data['post']['Username'] ?>
                    </a>
                    <?php
                        
                        if($data['post']['Username'] == $_SESSION['username'])
                        {
                            
                    ?>
                            <span class="span-edit-del" onclick="afficheEditeDel()">
                                ...
                            </span>
                            <div id="editeDelete" class="edit-del-post">
                                <a style="color:#fff" href="" class="edit-post btn btn-primary"><i class="far fa-edit"></i> Edit</a>
                                <a style="color:#fff" href='<?php echo URLROOT . "/app/init.php?url=post/deletePost/" . $data['post']['PostId'];?>' class="delete-post btn btn-danger"><i class="far fa-trash-alt"></i> Delete</a>
                            </div>

                        <?php } ?>
                </div>
                <img 
                    style="max-height:750px"
                    src="<?php echo URLROOT . "/uploads/posts/" . $data['post']['Image'];?>" 
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <div>
                        <i
                            id="<?php echo 'postlike' . $data['post']['PostId']; ?>"
                            onclick="getlike(this,<?php echo $_SESSION['userid'].','.$data['post']['PostId'] ?>)"
                            class="
                                <?php
                                $i = 0;
                                foreach($data['like'] as $l)
                                {
                                    if($l['UserId'] == $_SESSION['userid'] && $l['PostId'] == $data['post']['PostId'])
                                    {
                                            echo"fas fa-heart sys-like";
                                            $i = 1;
                                    }
                                }
                                if($i == 0)
                                    echo"far fa-heart sys-like";
                                ?>"
                            style="font-size:25px;margin-right:15px"
                        ></i>
                        <i class="far fa-comment" style="font-size:25px"></i>
                    </div>
                    <span 
                            class="span-likes"
                            id="<?php echo 'nblike' . $data['post']['PostId']; ?>"
                            value="<?php echo $data['post']['NumberLikes'] ?>"
                            onclick="showLikes(<?php echo $data['post']['PostId']; ?>)">
                            <?php echo $data['post']['NumberLikes']. " likes" ?>
                        </span>
                        <div id="<?php echo 'show-likes' . $data['post']['PostId']; ?>" class="show-likes">
                            <div class="title-like">
                                likes
                                <i class="fas fa-times float-right" onclick="showLikes(<?php echo $data['post']['PostId']; ?>)"></i>
                            </div>
                        <?php
                            foreach($data['like'] as $l)
                            {
                                if($l['PostId'] == $data['post']['PostId'])
                                {
                                    echo'<div class="name-like">';
                                        echo '<a href="'.URLROOT . '/app/init.php?url=user/profil/'.$l['UserLike'].'">';
                                        echo '<img class="img-responsive rounded-circle" style="width:30px;height:30px;" src="'. URLROOT . '/uploads/avatars/' . $l['Avatar'] .'" alt="">';
                                        echo ' ' . $l['UserLike'];
                                        echo '</a>';
                                    echo'</div>';
                                }
                            }
                        ?>
                        </div>
                        <p class="card-text">
                            <?php echo "<a href='".URLROOT . "/app/init.php?url=user/profil/" . $data['post']['Username'] . "'>".$data['post']['Username']." </a>" . $data['post']['Description'] ?>
                        </p>
                    
                    <div class="date" style="margin-bottom:20px"><?php echo $data['post']['Date'] ?></div>
                    <div id="com<?php echo $data['post']['PostId']; ?>">
                        <?php 
                            foreach($data['comment'] as $c)
                            {
                                if(isset($c["CommentId"]))
                                { ?>
                                    <div class="comment-box">
                                        <img class="img-responsive img-thumbnail rounded-circle" style="width:43px;height:43px;" src="<?php echo URLROOT . "/uploads/avatars/" . $c['Avatar'];?>" alt="">
                                        <p class="lead"><a href='<?php echo URLROOT . "/app/init.php?url=user/profil/" . $c['UserComment'];?>'><?php echo $c['UserComment'] ?></a>
                                            <?php echo $c['Comment'] ?> </p>
                                    </div>
                                 <?php 
                                }
                            }
                        ?>
                    </div>
                    <div class="add-comment">
                        <textarea name="comment" class="form-control com-box" id="comment<?php echo $data['post']['PostId']; ?>" row="1" placeholder="Add a comment..." onkeyup="submitBtn(this, <?php echo $data['post']['PostId']; ?>)" ></textarea>
                        <button id="submit-btn<?php echo $data['post']['PostId']; ?>" class="submit-btn" disabled onclick="<?php echo "getComment(this," . $_SESSION['userid'] . "," . $data['post']['PostId'] . ", '". $_SESSION['username'] . "', '". $_SESSION['avatar'] . "')";?>"><i class="fas fa-paper-plane"></i></button>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    }
    else
    {
        echo '<div class="container" style="margin-top:100px;">';
            echo "<div class='alert alert-danger text-center'>Sorry you can't brows this page directly </div>";
            echo "<div class='alert alert-info text-center'>You Will Be Redirected to the previous After 3 seconds <i class='fa fa-check'></i></div>";
        echo '</div>';
        header('refresh:3;http://localhost/camagru-test');
    } 
?>