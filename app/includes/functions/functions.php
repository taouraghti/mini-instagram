<?php 

function redirect($page, $i=0){
    if($i == 0)
        header('location: ' . URLROOT . '/' . $page);
    else
        header('location: ' . $page);
    exit();   
}

function redirectError($page, $data, $i=0)
{
    echo '<div class="container" style="margin-top:100px;">';
        foreach($data as $e)
            echo "<div class='alert alert-danger text-center'>" . $e . "</div>";
        echo "<div class='alert alert-info text-center'>You Will Be Redirected to the previous After 4 seconds <i class='fa fa-check'></i></div>";
    echo '</div>';
    if($i == 1)
        header('refresh:4;'. $page);
    else
        header('refresh:4;'. URLROOT . '/' . $page);
    exit();
}

function createSessionUser($arr)
{
    $_SESSION['userid'] = $arr['UserId'];
    $_SESSION['username'] = $arr['Username'];
    $_SESSION['fullname'] = $arr['FullName'];
    $_SESSION['group'] = $arr['GroupID'];
    $_SESSION['email'] = $arr['Email'];
    $_SESSION['avatar'] = $arr['Avatar'];
}

/*
function sortFunctionTime( $a, $b ) {
    return strtotime($b[3]) - strtotime($a[3]);
}*/

?>