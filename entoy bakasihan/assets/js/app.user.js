const { createApp } = Vue;
createApp({
    data(){
        return{
            firstname:'',
            lastname:'',
            middlename:'',
            email:'',
            mobile no:'',
            adddress:'',
            username:'',
            password:'',
            role:'',
            users:[],
            userid:0
        }
    },
    methods:{
        saveUser:function(e){
            e.preventDefault();
            var form = e.currentTarget;

            const vue = this;
            var data = new FormData(form);
            data.append("method","saveUser");
            
            axios.post('includes/model.php',data)
            .then(function(r){
                if(r.data == 0){
                    alert('User successfully saved');
                    vue.getUsers();
                    document.querySelector(".userform").reset();
                }
                else if(r.data == 1){
                    alert('User already exists');
                }
                else{
                    alert("Error saving user");
                }
            });
            
        },
        getUsers:function(){
            var data = new FormData();
            const vue = this;
            data.append('method','getUsers');
            axios.post('includes/model.php',data)
            .then(function(r){
                vue.users = [];
                for(var v of r.data){
                    vue.users.push({
                        firstname: v.firstname,
                        lastname: v.lastname,
                        middlename: v.middlename,
                        mobile no: v.fullname,
                        fullname: v.fullname,
                        username: v.username,
                        role: v.role,
                        dateInserted: v.dateInserted,
                        userid: v.userid
                    })
                }
                // r.data.forEach(function(v){
                    
                // })
            })
        },
        deleteUser:function(userid){
            if(confirm("Are you sure you want to delete this user?")){
                var data = new FormData();
                const vue = this;
                data.append("method","deleteUser");
                data.append("userid",userid);
                axios.post('includes/model.php',data)
                .then(function(r){
                    vue.getUsers();
                })
            }
        },
        getUserById:function(userid){
            var data = new FormData();
            const vue = this;
            data.append('method','getUserById');
            data.append("userid",userid);
            axios.post('includes/model.php',data)
            .then(function(r){
                console.log(r.data);
                for(var v of r.data){
                   vue.firstname: v.firstname,
                     vue.lastname: v.lastname,
                     vue.middlename: v.middlename,
                     vue.mobile no: v.fullname,
                      vue.fullname: v.fullname,
                     vue.username: v.username,
                      vue.role: v.role,
                       vue.dateInserted: v.dateInserted,
                       vue. userid: v.userid
                }
                // r.data.forEach(function(v){
                    
                // })
            })
        },
        updateUser:function(e){
            e.preventDefault();
            var form = e.currentTarget;

            const vue = this;
            var data = new FormData(form);
            data.append("method","updateUser");
            data.append("userid",this.userid);
            axios.post('includes/model.php',data)
            .then(function(r){
                if(r.data == 1){
                    alert('User successfully updated');
                    vue.getUsers();
                    document.querySelector(".userform").reset();
                }
                
            });
            
        },
    },
    created:function(){
        this.getUsers();
    }
}).mount('#app')