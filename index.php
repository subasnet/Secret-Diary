<?php
     
     if (array_key_exists("submit", $_POST)) {
         
         $link = mysqli_connect("localhost", "mysqlusername", "mysqlpassword", "Secret Diary");
         
         if (mysqli_connect_error()) {
             
             die ("Database connection error.");
             
         }
         
         $error = "";
         
         if (!$_POST['email']) {
             
             $error .= "An email address is required.<br>";
             
         }
         
         if (!$_POST['password']) {
             
             $error .= "Password is required.<br>";
             
         }
         
         if ($error != "") {
             
             $error = "<p> There were error(s) in your form:</p>".$error;
             
         } else {
             
             $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
             
             $result = mysqli_query($link, $query);
             
             if (mysqli_num_rows($result) > 0) {
                 
                 $error = "The email address is already taken.";
                 
             } else {
                 
                 $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";
                 
                 if (!mysqli_query($link, $query)) {
                     
                     $error = "<p>Couldn't sign you up, please try again.</p>";
                 
             }
             
         }
         
        }
     }
     
?>



<div id="error"><?php echo $error; ?></div>

<form method="post">
    
    <input type="email" name="email" placeholder="Email">
    
    <input type="password" name="password" placeholder="Password">
    
    <input type="checkbox" name="stayLoggedIn" value="1">
    
    <input type="submit" name="submit" value="Sign up">
    
</form>