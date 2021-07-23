<template>
    
</template>

<script>
export default{
    created(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        localStorage.removeItem('Role')
 
          this.$router.push({name:'home'})
   
    }
}
</script>
