<template>
 <div class="container">
   <br><br>
   <form class="form" @submit.prevent="login">
  <div class="row">
    <div class="input-field col s6">
      <input id="Email" type="email" class="validate" v-model="form.email">
      <label class="active" for="Email">Email</label>
    </div>
  </div>

   <div class="row">
     <div class="input-field col s6">
       <input type="password" class="validate" id="password" v-model="form.password">
       <label for="password" class="active">Password</label>
     </div>
   </div>
  <button type="submit" class="btn btn-primary">submit</button><br>
  </form>
   <a href="/register" type="text"> don't have account</a>
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
    password:null
  }
}
},
methods:{
  login(){
    axios.post('/api/auth/login',this.form)
    .then(res=>{
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
