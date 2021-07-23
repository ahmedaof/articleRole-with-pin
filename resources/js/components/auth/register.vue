<template>
 <div class="container">
   <form class="form" @submit.prevent="signup">
    <div class="row col s6">
    <div class="input-field col s12">
      <input type="text" class="validate" id="name" v-model="form.name">
      <label for="name" class="active">name</label>
    </div>
  </div>

  <div class="row col s6">
    <div class="input-field col s12">
      <input id="Email" type="email" class="validate" v-model="form.email">
      <label class="active" for="Email">Email</label>
    </div>
  </div>
  
  
    <div class="row col s6">
    <div class="input-field col s12">
        <div class="input-field col s12 m6">
          <select class="browser-default" id="Role" name="Role" v-model="form.Role">
      <option value="admin">admin</option>
      <option value="user">user</option>
  
    </select>
    </div>
      <label for="name" class="active">role</label>
    </div>
  </div>
 

   <div class="row col s6">
     <div class="input-field col s12">
       <input type="password" class="form-control" id="exampleInputPassword" v-model="form.password">
       <label for="password" class="active">Password</label>
     </div>
   </div>
   
  <button type="submit" class="btn btn-primary">submit</button><br>
  </form>
  <a href="/" type="text"> already have account</a>
</div>
</template>

<script type="text/javascript">
export default{
created(){
if(User.loggedIn()){
  this.$router.push({name:'home'})
}
},

data(){
return{
  form:{
    email:null,
    name:null,
    password:null,
   
    Role:null,
  }
}
},
methods:{
  signup(){
    axios.post('/api/auth/signup',this.form)
    .then(res=>{
      console.log(res)
      User.responseAfterLogin(res);
        Toast.fire({
                  icon: 'success',
                  title: 'Signed in successfully'
        });
      window.location.href = '/pin'
    })
    .catch(
          Toast.fire({
                icon: 'warning',
                title: 'email or password invalid'
    })
    )
  }
}
}
</script>


<style>

select{
  background-color: #f8fafc;
}

</style>
