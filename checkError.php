<?php
function test_input(&$nameErr,&$usnErr,&$emailErr,&$passwordErr,&$phoneErr,&$cgpaErr)
{
    $i=0;
    
    if(empty($_POST['password'])){
        $passwordErr.="*password required";
        $i=-1;
    }
   if(empty($_POST['cgpa'])){
        $cgpaErr.="*cgpa required";
        $i=-1;
    }
    
    if(empty($_POST['name'])){
        $nameErr.="*Name required";
        $i=-1;
    }
    else if(!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])){
        $i=-1;
        $nameErr.="*Only characters and white-spaces allowed";
    }
    
    if(empty($_POST['usn'])){
        $usnErr.="*USN required";
        $i=-1;
    }
    else if(!preg_match("/^1[Ss][iI]1[0-7][cCiIeEmMtTbB][cCiIeEmMtTbBsS][0-9][0-9][0-9]$/",$_POST['usn'])){
        $usnErr.="*Invalid USN";
        $i=-1;
    }
    
     if(empty($_POST['phone'])){
        $phoneErr.="*Phone number required";
         $i=-1;
     }
    else if(!preg_match("/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/",$_POST['phone']) or intval($_POST['phone'])<=1000000000){
        $phoneErr.="*Invalid phone number";
        $i=-1;
    }
    
    
    if(empty($_POST['email'])){
        $emailErr.="*Email Id required";
        $i=-1;
    }else if(!preg_match("/^[a-z][0-9a-z.]*@[a-z][a-z]*\.com$/",$_POST['email'])){
        $emailErr.="*Invalid Email Id";
        $i=-1;
    }
    
  
    
    return $i;
    
}
?>