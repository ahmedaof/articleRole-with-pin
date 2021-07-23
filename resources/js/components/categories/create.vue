<template>
  <div>
          <form novalidate class="md-layout" @submit.prevent="addCategory" enctype="multipart/form-data">
    <md-field>
      <label>title</label>
      <md-input v-model="form.title"></md-input>
    </md-field>
  
         <md-card-actions>
          <md-button type="submit" class="md-primary">add Category</md-button>
        </md-card-actions>
  
          </form>
  </div>
</template>

  

<script>
  export default {
    name: 'TextFields',
    data(){
      return{
        form:{
            title:null,
 
        }
      }
  
    },
    created(){
    if (User.Role()=='user') {
          Toast.fire({
                  icon: 'alert',
                  title: 'admins only create categories'
        });
        this.$router.push({name: 'category'});
      }
    },
    methods:{
  


        addCategory(){
           console.log(this.form);
            axios.post('/api/category/',this.form)
            .then(res=>{
             
                Toast.fire({
                  icon: 'success',
                  title: 'successfully create article'
        });
                this.$router.push({name:'category'})
            })
            .catch()
        }
    }
  }
</script>