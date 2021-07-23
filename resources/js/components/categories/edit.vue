<template>
  <div>
          <form novalidate class="md-layout" @submit.prevent="categoryUpdate" enctype="multipart/form-data">
    <md-field>
      <label>title</label>
      <md-input v-model="form.title"></md-input>
    </md-field>
         <md-card-actions>
          <md-button type="submit" class="md-primary">Update Category</md-button>
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
                  title: 'admins only edit categories'
        });
        this.$router.push({name: 'category'});
      }
            let id = this.$route.params.id;
            axios.get('/api/category/'+id)
            .then(({data})=>(this.form=data))
            .catch(err=>console.log(err))
    },
    methods:{     
           categoryUpdate(){
                let id = this.$route.params.id
                    axios.patch('/api/category/'+id,this.form)
            .then(res=>{
                 Toast.fire({
                  icon: 'success',
                  title: 'successfully edited article'
        });
                this.$router.push({name:'category'})
            })
            .catch(err=>console.log(err))
           }
      
    }
  }
</script>