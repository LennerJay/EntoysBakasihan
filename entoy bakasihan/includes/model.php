<?php 

    session_start();
    include "config.php";

    $method = $_POST['method'];
    if(function_exists($method)){
        call_user_func($method);
    }
    else{
        echo 'Function not exists';
    }

    function saveUser(){
        global $con;

        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $role = $_POST['role'];

        $location = "../profilepic/";
        $filename = '';
        if(isset($_FILES['file']['name'])){
            
            $finalfile = $location . $_FILES["file"]['name'];
            if(move_uploaded_file($_FILES['file']['tmp_name'],$finalfile))
            {
                $filename = $_FILES["file"]['name'];
            }
            else{
                $filename = 'backblue.gif';
            }
            
        }
        else{
            
        }
        
        $query = $con->prepare("call sp_saveUser(?,?,?,?,?)");
        $query->bind_param('sssis',$fullname,$username,$password,$role,$filename);
        $query->execute();
        $result = $query->get_result();
        $data = "";
        while($row = $result->fetch_array())
        {
            $data = $row[0];
        }
        echo $data;
        $query->close();
        $con->close();
    }

    function getUsers(){
        global $con;
        $query = $con->prepare("SELECT * FROM tbl_users");
        $query->execute();
        $result = $query->get_result();
        $data = array();
        while($row = $result->fetch_array())
        {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    function getUserById(){
        global $con;
        $userid = $_POST['userid'];
        $query = $con->prepare("SELECT * FROM tbl_users where userid = ?");
        $query->bind_param('i',$userid);
        $query->execute();
        $result = $query->get_result();
        $data = array();
        while($row = $result->fetch_array())
        {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    function deleteUser(){
        global $con;
        $userid = $_POST['userid'];
        $query = $con->prepare("DELETE FROM tbl_users where userid = ?");
        $query->bind_param('i',$userid);
        $query->execute();
        $query->close();
        $con->close();
    }

    function updateUser(){
        global $con;

        $fullname = $_POST['fullname'];
        $password = ($_POST['newpassword'] == '' ? '' : md5($_POST['newpassword']));
        $userid = $_POST['userid'];
        $role = $_POST['role'];
        $query = $con->prepare("call sp_updateUser(?,?,?,?)");
        $query->bind_param('issi',$userid,$fullname,$password,$role);
        $query->execute();
        echo 1;
        $query->close();
        $con->close();
    }

    function login(){
        global $con;

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query = $con->prepare("call sp_login(?,?)");
        $query->bind_param('ss',$username,$password);
        $query->execute();
        $result = $query->get_result();
        $ret = '';
        while($row = $result->fetch_array()){
            $ret = $row['ret'];
            if($ret == 1){
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['name'] = $row['fullname'];
                $_SESSION['role'] = $row['role'];
            }
        }

        echo $ret;
    }

      function register(){
        global $con;

        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middlename = $_POST['middlename'];
        $email = $_POST['email'];
        $mobile no = $_POST['mobile no'];
        $address = $_POST['address'];
        $password = md5($_POST['password']);

        $query = $con->prepare("call sp_register(?,?,?,?,?,?,?,?)");
        $query->bind_param('ssssssss',$username,$firstname,$lastname,$mobile no,$email,$address,$password);
        $query->execute();
        $result = $query->get_result();
        $ret = '';
        while($row = $result->fetch_array()){
            $ret = $row['ret'];
            if($ret == 1){
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['name'] = $row['firstname'];
                $_SESSION['name'] = $row['lastname'];
                $_SESSION['name'] = $row['middlename'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['mobile no'] = $row['mobile no'];
                $_SESSION['address'] = $row['address'];
                $_SESSION['role'] = $row['role'];
            }
        }

        echo $ret;
    }
?>