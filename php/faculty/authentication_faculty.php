<?php   
session_start();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php   
        require('../connection.php');  
        $username = $_POST['email'];  
        $password = $_POST['pass'];  
        echo "<script> sessionStorage.setItem('username','$username'); 
        
                 sessionStorage.setItem('password','$password');
        </script>";
          
            //to prevent from mysqli injection  
            $username = stripcslashes($username);  
            $password = stripcslashes($password);  
            $username = mysqli_real_escape_string($con, $username);  
            $password = mysqli_real_escape_string($con, $password);  
          
            $sql = "select * from instructor where email = '$username' and pass = '$password'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
            if($count == 1){
                $_SESSION['loggedin']=true;
                $_SESSION['userid']='faculty';
                echo '<script>
                window.location.replace("../../html/faculty/");
                </script>';  
                exit;
            } 
            else 
                echo '<script>alert("Username and password does not match");setTimeout(()=>{window.location.replace("../../html/faculty/login_faculty.html");},700);</script>';  
    ?>  
    </body>
    </html>