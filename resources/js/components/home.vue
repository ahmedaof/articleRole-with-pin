<template>
<div class="container">





  
    <h1>home</h1>
 
   <br>
    


</div>
</template>

<script type="text/javascript">
export default{
created(){
if(!User.loggedIn()){
  this.$router.push({name:'/'});
  
}
}
}
</script>