<?php

if (isset($_POST['password'])){
    $password=$_POST['password'];
    if (password_verify($password,'$2y$10$XOwfDwcfDPyoCyV8iPuRae8YOTCr9PaFsvT5c2.LICsTZnagJ1pyC')){
        echo "Logged in";
    }else{
        echo "<div class='alert alert-danger' role='alert'> Incorrect password! </div>";
    }
 }


 ?>