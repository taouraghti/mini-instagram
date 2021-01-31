<?php

    if(empty($data))
        echo "<div class='alert alert-success'><strong>Success</strong></div>";
    else
    {
        echo "<div class='container' style='margin-top:50px'>";
        foreach($data as $e)
        {
            echo "<div class='alert alert-danger'>".$e."</div>";
        }
        echo "</div>";
    }

?>