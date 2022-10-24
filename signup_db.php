<?php
    
    session_start();
    require_once 'connection/pdo.php';

    if(isset($_POST['signup'])){
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $user_type = '2';
        $status = '0';

        if(empty($username)){
            $_SESSION['error'] = 'กรุณากรอกUsername';
            header("location: register.php");
        }else if(empty($firstname)){
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: register.php");
        }else if(empty($lastname)){
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header("location: register.php");
        }else if(empty($email)){
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: register.php");
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: register.php");
        }else if(empty($password)){
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: register.php");
        }else if(strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องอยู่ระว่าง 5 - 20 ตัวอักษร';
            header("location: register.php");
        }else if(empty($c_password)){
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: register.php");
        }else if($password != $c_password){
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: register.php");
        }else{
            try{

                $check_email = $conn->prepare("SELECT email FROM user_tb WHERE email = :email");
                $check_email->bindParam(":email",$email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if($row['email'] == $email) {
                    $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระแบบแล้ว <a href='register.php' class='alert-link'>คลิ๊กที่นี่</a>เพื่อเข้าสู่ระบบ";
                    header("location: register.php");
                } else if(!isset($_SESSION['error'])){
                    $stmt = $conn->prepare("INSERT INTO user_tb(username, password,firstname, lastname, email,user_type,status)
                                            VALUES(:username,:password,:firstname, :lastname, :email,:user_type,:status)");
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":password", $password);
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":status", $status);
                    $stmt->bindParam(":user_type", $user_type);
                    $stmt->execute();
                    $_SESSION['success']="สมัครสมาชิกเรียบร้อยแล้ว <a href='index.php' class='alert-link'>กลับสู่หน้าหลัก</a>เพื่อเข้าสู่ระบบ";
                    header ("location: register.php");
                } else{
                    $_SESSION['error']="มีบางอย่างผิดผลาด";
                    header ("location: register.php");
                }

            } catch(PDOException $e){
            echo $e->getMessage();
            }
        }

    }

?>