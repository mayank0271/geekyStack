<?php
    
    session_start();
    include "checkError.php";
    $user="root";
    $pass="root";
    $db="geeks";
    $nameErr=$usnErr=$emailErr=$passwordErr=$phoneErr=$cgpaErr="";
    $err=false;
    $link="";
    $name="";
    if(array_key_exists("submit",$_POST)){
        if(test_input($nameErr,$usnErr,$emailErr,$passwordErr,$phoneErr,$cgpaErr)==-1){
            $err=true;
            $globalErr="*Some fields are still empty or have invalid inputs";
        }
        else{
            $link=mysqli_connect("localhost",$user,$pass,$db) or die;
            $query="Select * from students";
            $result=mysqli_query($link,$query);
        
            while($row=mysqli_fetch_array($result)){
                if($row["usn"]==$_POST["usn"]){
                    $usnErr="USN already exists";
                    $err=true;
                    break;
                }else if($row["email"]==$_POST["email"]){
                    $emailErr="Email already exists";
                    $err=true;
                    break;
                }
            }
        }
        if(!$err){
            $query="Insert into `students` (`name`,`email`,`usn`,`password`,`phone`,`cgpa`,`points`) values('".$_POST['name']."','".$_POST['email']."','".$_POST['usn']."','".$_POST['password']."','".$_POST['phone']."',".$_POST['cgpa'].",0)";
            echo $query;
            mysqli_query($link,$query);
            
            
                
            $result=mysqli_query($link,"Select id from students where email='".$_POST['email']."'");
            $row=mysqli_fetch_array($result);
            $_SESSION['id']=$row['id'];
            
            foreach($_POST['favLang'] as $lang)
               mysqli_query($link,"Insert into `languages` values(".$row['id'].",'".$lang."')");
                
            
           foreach($_POST['project'] as $s)
               if($s!=""){
                mysqli_query($link,"Insert into `projects` values(".$row['id'].",'".$s."')");
               }
            header('Location: feed.php');
        
        }
            
        
    }
        


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login-Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>     
        <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    
        
        <div class="signup">
            <header class="text-center">
            <h1>Sign Up</h1></header>
            <div class="signup-form">
            <form method="post">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Full Name"><span style="color:red;" ><?php echo $nameErr?></span>
                    
                </div>
                <div class="form-group">
                    <input type="text" name="usn" class="form-control" placeholder="USN">
                    <span  style="color:red;"><?php echo $usnErr ?></span>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span  style="color:red;"><?php echo $emailErr ?></span>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span  style="color:red;"><?php echo $passwordErr ?></span>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" maxlength="10"  class="form-control" placeholder="Phone">
                    <span  style="color:red;"><?php echo $phoneErr ?></span>
                </div>
                 <div class="form-group">
                    <input type="number" step=0.01 name="cgpa" class="form-control" placeholder="CGPA">
                     <span  style="color:red;"><?php echo $cgpaErr ?></span>
                </div>
        
                <div class="form-group">
                    <label class="labelClass"><b>Languages Known</b></label><br>
                    <input type="checkbox" name="favLang[]" value="Java" class="checkboxClass"><b><span style="color:white;">Java</span>&nbsp;&nbsp;</b>
                    <input type="checkbox" name="favLang[]" value="Python" class="checkboxClass"><b><span style="color:white;">Python</span>&nbsp;&nbsp; </b>
                    <input type="checkbox" name="favLang[]" value="C" class="checkboxClass"><b><span style="color:white;">C</span> &nbsp;&nbsp;</b>
                    <input type="checkbox" name="favLang[]" value="C++" class="checkboxClass"><b><span style="color:white;">C++</span> &nbsp;&nbsp;</b>
                    <input type="checkbox" name="favLang[]" value="R" class="checkboxClass"><b><span style="color:white;">R</span> &nbsp;&nbsp;</b>
                    <input type="checkbox" name="favLang[]" value="PHP" class="checkboxClass"><b><span style="color:white;">PHP</span> &nbsp;&nbsp;</b>
                    
                </div>
                                            

    <!--Third row-->
         <label class="labelClass"><b>Projects Undertaken</b></label><br>
    <div class="row">
       

        <!--First column-->
        <div class="col-md-4">
            <div class="md-form">
                <input type="text" id="form41" class="form-control" name="project[]">
                <label for="form41" class="labelClass" >Project 1</label>
            </div>
        </div>

        <!--Second column-->
        <div class="col-md-4">
            <div class="md-form">
                <input type="text" id="form51" class="form-control" name="project[]">
                <label for="form51" class="labelClass">Project 2</label>
            </div>
        </div>

        <!--Third column-->
        <div class="col-md-4">
            <div class="md-form">
                <input type="text" id="form61" class="form-control" name="project[]">
                <label for="form61" class="labelClass">Project 3</label>
            </div>
        </div>

    </div>
    <!--/.Third row-->
              
                    
                <br>
                
                <input type="submit" name="submit" value="Register" class="form-control btn btn-primary">
        <br><br>
                        <label class="labelClass"><b>Already Registered : </b></label><a href="studentLogin.php" ><b>&nbsp;&nbsp;Login</b></a>
                <a href="index.html">Home</a>

                </form>
            </div>
       </div>
       <footer class="text-center"><b><span class="labelClass">&copy;MAB 9.40</span></b></footer>
    </body>
</html>