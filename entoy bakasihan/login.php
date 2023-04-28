<?php 
    session_start();  
    if(isset($_SESSION['userid'])){
        header('location:index.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/login.css">
  <title>Form</title>
</head>
<style>
  body
  {
    background-color: black;
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
  .overlay {
    background-color: var(--skyblue);
    background: url(bakasi.jpg);
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    height: 100%;
    left: -100%;
    position: relative;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
    width: 200%;
}
</style>
<body>
   <div class="container right-panel-active">
    <!-- Sign Up -->
    <div class="container__form container--signup" >
      <form class="form" id="form1">
        <h2 class="form__title">Sign Up</h2>
        <input type="text" name="user" id="user" placeholder="Username" class="input" />
        <input type="password" name="pass" id="pass" placeholder="Password" class="input" />
        <input type="text" name="fname" id="fname" placeholder="First Name" class="input" />
        <input type="text" name="lname" id="lname" placeholder="Last Name" class="input" />
        <input type="text" name="mname" id="mname" placeholder="Middle Name" class="input" />
        <input type="text" name="address" id="address" placeholder="Address" class="input" />
        <input type="text" name="mobile_no" id="mobile_no" placeholder="Mobile No." class="input" />
        <input type="email" name="email" id="email" placeholder="Email" class="input" />
        <button class="btn" id="btn-reg">Sign Up</button>
      </form>
    </div>
  
    <!-- Sign In -->
    <div class="container__form container--signin" id="login-app">
         <form @submit="login($event)"  class="form" id="form2">
        <h2 class="form__title">Sign In</h2>
        <input type="text" name="username" id="username" placeholder="Username" class="input" />
        <input type="password" name="password" id="password" placeholder="Password" class="input" />
        <button class="btn" id="btn-login" type="submit" value="Login"> Sign In</button>
      </form>
    </div>
  
    <!-- Overlay -->
    <div class="container__overlay">
      <div class="overlay">
        <div class="overlay__panel overlay--left">
          <button class="btn" id="signIn">Sign In</button>
        </div>
        <div class="overlay__panel overlay--right">
          <button class="btn" id="signUp">Sign Up</button>
        </div>
      </div>
    </div>
  </div>
<script src="assets/js/form.js"></script>
<script src="assets/js/axios.js"></script>
<script src="assets/js/vue.3.js"></script>
<script>

const { createApp } = Vue;

createApp({
    methods:{
        login:function(e){
            e.preventDefault();

            const data = new FormData(e.currentTarget);
            data.append("method","login");
            axios.post('includes/model.php',data)
            .then(function(r){
                //alert(r.data);
                if(r.data == 1){
                    alert(r.data);
                    window.location.href ="index.php";
                }
                else if(r.data == 2){
                    alert("Account is locked");
                }
                else{
                    alert("Username or password is incorrect");
                }
            })
        }
    },
    mounted:function(){
    }
}).mount('#login-app');

</script>
</html>