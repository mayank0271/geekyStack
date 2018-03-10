<?php
    
    session_start();
    $user="root";
    $pass="root";
    $db="geeks";
    $emailErr=$passwordErr="";
    $err=false;
    $errStr="";
    $globalErr=$link="";
    $flag=false;
    if(array_key_exists("submit",$_POST)){
        if(!$_POST['email']||!$_POST['password']){
            $err=true;
            $globalErr="*Some fields are still empty";
        }
        else{
            $link=mysqli_connect("localhost",$user,$pass,$db) or die;
            $query="Select * from faculty";
            $result=mysqli_query($link,$query);
        
            while($row=mysqli_fetch_array($result)){
                if($row["email"]==$_POST["email"] && $row["password"]==$_POST["password"]){
                        $_SESSION['id']=$row['id'];
                        $flag=true;
                        break;
                }
                   
            }
            if($flag==false){
                $err=true;
                $errStr="Incorrect email or password";
            }else{
            header('Location: studentInteract.php');
        
        }
            
        
    }
}
           
        


?>


<html>
    <head>
        <title>Login-Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>     
        <link rel="stylesheet" href="css/login.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">
    </head>
    <body>
        <div class="login">
            <header class="text-center">
            <h1>Faculty Login </h1></header>
            
            <div class="login-form">
            <form method=post>
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                    <span style="color:red"><?php echo $globalErr;?></span>
                    <span style="color:red"><?php echo $errStr;?></span>
                </div><br>
                <input type="submit" name="submit" value="Login" class="form-control btn btn-primary">

                </form>
                <a href="index.html">Home</a>
            </div>
       </div>
        <footer class="text-center"><b>&copy;MAB 9.40</b></footer>
    </body>
</html>