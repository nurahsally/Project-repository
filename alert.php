<?php
if(isset($_SESSION["info"])){
        $info = $_SESSION["info"];
         echo "<div class=''>$info</div>";
         unset($_SESSION["info"]);
}elseif(isset($_SESSION["err"])){
         $err = $_SESSION["err"];
         echo "<div class=''>$err</div>";
         unset($_SESSION["err"]);
 }
?>