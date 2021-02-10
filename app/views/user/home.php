<?php
    if(isset($_SESSION['username']))
    {

?>

<div class="container" >

    <div class="row">
        <?php
            foreach($data['post'] as $d)
            {
            ?>
                
            <div class="col-12">
                    <div class="card w-75" style="margin:30px auto;max-width:700px">
                    <div class='username-post'>
                        <a href='<?php echo URLROOT . "/app/init.php?url=user/profil/" . $d['Username'];?>'>
                        <img class="img-responsive rounded-circle" style="width:40px;height:40px;" src="<?php echo URLROOT . "/uploads/avatars/" . $d['Avatar'];?>" alt="">
                            <?php echo $d['Username'] ?>
                            </a>
                    </div>
                    <img
                        style="max-height:750px"
                        src="<?php echo URLROOT . '/uploads/posts/' . $d['Image'] ?>" 
                        class="card-img-top" alt="...">
                    <div class="card-body" style="position:relative;">
                        <div>
                            <i
                                id="<?php echo 'postlike' . $d['PostId']; ?>"
                                onclick="getlike(this,<?php echo $_SESSION['userid'].','.$d['PostId'] ?>)"
                                class="
                                    <?php
                                    $i = 0;
                                    foreach($data['like'] as $l)
                                    {
                                        if($l['UserId'] == $_SESSION['userid'] && $l['PostId'] == $d['PostId'])
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
                        <?php  ?>
                        <span 
                            class="span-likes"
                            id="<?php echo 'nblike' . $d['PostId']; ?>"
                            value="<?php echo $d['NumberLikes'] ?>"
                            onclick="showLikes(<?php echo $d['PostId']; ?>)">
                            <?php
                                if($d['NumberLikes'] == 0)
                                    $text = "";
                                else if($d['NumberLikes'] == 1)
                                    $text = $d['NumberLikes'] . " like";
                                else
                                    $text = $d['NumberLikes'] . " likes";
                                echo $text; 
                             ?>
                             </span>
                        <?php  ?>
                        <div id="<?php echo 'show-likes' . $d['PostId']; ?>" class="show-likes">
                            <div class="title-like">
                                likes
                                <i class="fas fa-times float-right" onclick="showLikes(<?php echo $d['PostId']; ?>)"></i>
                            </div>
                        <?php
                            foreach($data['like'] as $l)
                            {
                                if($l['PostId'] == $d['PostId'])
                                {
                                    echo'<div class="name-like">';
                                        echo '<a href="">';
                                        echo '<img class="img-responsive rounded-circle" style="width:30px;height:30px;" src="'. URLROOT . '/uploads/avatars/' . $l['Avatar'] .'" alt="">';
                                        echo ' ' . $l['UserLike'];
                                        echo '</a>';
                                    echo'</div>';
                                }
                            }
                        ?>
                        </div>
                        <p class="card-text">
                            <?php echo "<a href='".URLROOT . "/app/init.php?url=users/profile/" . $d['Username'] . "'>".$d['Username']." </a>" . $d['Description'] ?>
                        </p>
                        <div class="date" style="margin-bottom:20px"><?php echo $d['Date'] ?></div>
                        <div id="com<?php echo $d['PostId']; ?>">
                            <?php 
                                $tmp = [];
                                foreach($data['comment'] as $c)
                                {
                                    if($c['PostId'] == $d['PostId'])
                                        $tmp[] = $c;
                                }
                                if(count($tmp) > 0)
                                {
                                    $i = (count($tmp) - 2 >= 0) ? count($tmp) - 2 : 0;
                                    while($i < count($tmp))
                                    { ?>
                                        <div class="comment-box">
                                            <img class="img-responsive img-thumbnail rounded-circle" style="width:43px;height:43px;" src="<?php echo URLROOT . "/uploads/avatars/" . $tmp[$i]['Avatar'];?>" alt="">
                                            <p class="lead"><a href='<?php echo URLROOT . "/app/init.php?url=users/profile/" . $tmp[$i]['UserComment'];?>'><?php echo $tmp[$i]['UserComment'] ?></a>
                                                <?php echo $tmp[$i]['Comment'] ?> </p>
                                        </div>
                                    <?php 
                                    $i++;
                                    }
                                }
                            ?>
                        </div>
                        <a href="<?php echo URLROOT . "/app/init.php?url=post/showPost/".$d["PostId"] ?>" style="display:block;margin-top:10px">View all comments</a>

                        <div class="add-comment">
                            <textarea name="comment" class="form-control com-box" id="comment<?php echo $d['PostId']; ?>" row="1" placeholder="Add a comment..." onkeyup="submitBtn(this, <?php echo $d['PostId']; ?>)" ></textarea>
                            <button id="submit-btn<?php echo $d['PostId']; ?>" class="submit-btn" disabled onclick="<?php echo "getComment(this," . $_SESSION['userid'] . "," . $d['PostId'] . ", '". $_SESSION['username'] . "', '". $_SESSION['avatar'] . "')";?>"><i class="fas fa-paper-plane"></i></button>
                        </div>   
                    </div>
                </div>
            </div>
            <?php
                }    
        ?>
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
    ob_end_flush(); 
?>