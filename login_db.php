<?php
    session_start();
    require_once 'connection/pdo.php';
    
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email)){
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: index.php");
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: index.php");
        }else if(empty($password)){
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: index.php");
        }else if(strlen($_POST['password']) > 100 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องอยู่ระว่าง 5 - 20 ตัวอักษร';
            header("location: index.php");
        }else {
            try{

                $check_data = $conn->prepare("SELECT * FROM user_tb WHERE email = :email AND status = '0'");
                $check_data->bindParam(":email",$email);
                $check_data->execute();
                $row=$check_data->fetch(PDO::FETCH_ASSOC);

                if($check_data->rowCount() > 0) {
                    if ($email==$row['email']) {
                        if ($password == $row['password']) {
                            if ($row['user_type'] == '1'){
                                $_SESSION['admin_login'] = $row['user_id'];
                                header("location: admin/index.php");
                            } else {
                                $_SESSION['user_login'] = $row['user_id'];
                                $_SESSION['username'] = $row['username'];
                                header("location: index.php");
                            }
                        } else {
                            $_SESSION['error'] ='รหัสผ่านผิด';
                            header("location: index.php ");
                        }
                    }else {
                        $_SESSION['error']='อีเมลผิด';
                        header("location: index.php ");
                    }
                } else{
                    $_SESSION['error']="ไม่มีข้อมูลในระบบ";
                    header("location: index.php");
                }

            } catch(PDOException $e){
            echo $e->getMessage();
            }
        }
    }
    
?>
