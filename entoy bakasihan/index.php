<?php 
    session_start();  
    if(!isset($_SESSION['userid'])){
        header('location:login.php');
    }
    $role = $_SESSION['role'];
     include "includes/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
</head>
<body>
    <div id="app">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                Welcome <?php echo $_SESSION['name']; ?>
                <a href="logout.php">Logout</a>
            </div>
           <!--  <div class="col-md-6">
                <form @submit="saveUser" class="userform">
                    <input type="file" name="file" class="form-control" />
                    <input type="text" class="form-control" required placeholder="Fullname" name="fullname" /><br>
                    <input type="text" class="form-control" required placeholder="Username" name="username" /><br>
                    <input type="password" class="form-control" required placeholder="Password" name="password" /><br>
                    <select name="role" class="form-control" required>
                        <option selected disabled value="0">Select Role</option>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select><br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
            <div class="col-md-6">
                <table border="1" class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Date Inserted</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users">
                            <td><img :src="'profilepic/' + user.profilepic" class="img-fluid" /></td>
                            <td>{{ user.fullname }}</td>
                            <td>{{ user.username }}</td>
                            <td>{{ user.role == 1 ? 'Admin' : 'User' }}</td>
                            <td>{{ user.dateInserted }}</td>
                            <td>
                                if($role == 2): ?>
                                <button @click="deleteUser(user.userid)">Delete</button>
                                 endif ?>
                                <button @click="getUserById(user.userid)" data-bs-toggle="modal" data-bs-target="#myModal">Edit</button>
                            </td>
                        </tr>
                    <tbody>
                </table>
            </div>
        </div>
    
    
        

        
    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
           <!--  <div class="modal-header">
              <h4 class="modal-title">UPDATE USER</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div> -->
      
            <!-- Modal body -->
            <!-- <div class="modal-body">
                <form @submit="updateUser" novalidate class="userform">
                    <input type="text" v-model="fullname" class="form-control" required placeholder="Fullname" name="fullname" /><br>
                    <input type="password" v-model="newpassword" class="form-control" placeholder="New Password" name="newpassword" /><br>
                    <select name="role" v-model="role" class="form-control" required>
                        <option selected disabled value="0">Select Role</option>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select><br>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                </form>
            </div> -->
      
            <!-- Modal footer -->
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
      </div>

</div>  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/axios.js"></script>
    <script src="assets/js/vue.3.js"></script>
    <script src="assets/js/app.user.js"></script>
    </body>
</html>