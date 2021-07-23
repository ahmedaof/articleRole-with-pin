<template>
  <div class="container">

<router-link 
  style="position: relative;
    top: 10px;
    right: 30px;
    font-size: 26px;
    font-weight:bold" 
    class="md-inset md-list-item" :to="{name:'createCategory'}">Add categories</router-link>
     

    <md-field>
      <label>search</label>
      <md-input v-model="searchTerm"></md-input>
    </md-field>


    <div class="full-control">
    <div class="list" v-for="category in filtersearch" :key="category.id">
      <div class="row">
            <div class="col s6">
 
          <h1 class="md-list-item-text">{{category.title}}</h1> 
  </div>
              <router-link class=" btn" :to="{name:'editCategory',params:{id:category.id}}">Edit</router-link><br>
          <a  @click="deleteCategory(category.id)" class="btn"  style="cursor: pointer" >Delete</a>
        
          
            </div>
    </div>
  </div>  
</div>
</template>

<script>
export default{
    created(){
     if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },
     data:()=>({
  
        categories:[],
        searchTerm:''
      
    }),
    computed:{
      filtersearch(){
        return this.categories.filter(category=> {
          return category.title.match(this.searchTerm)
        })
      }
    },
   
    methods:{
  

      allcategories(){
          axios.get('/api/category')
          .then(({data})=>{this.categories=data.categories,console.log(this.categories)})
               .catch((err) => {
                console.log(err);
               })
      },
      deleteCategory(id){

      Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
        if(User.Role()=='user'){
        Toast.fire({
                  icon: 'warn',
                  title: 'delet available for admin only'
        });
         this.$router.push({name:'category'})
        }else{
        axios.delete('/api/category/'+id)
        .then(() => {
             Toast.fire({
                  icon: 'success',
                  title: 'successfully deleted'
        });
                this.categories = this.categories.filter(category => {
                  return category.id != id
                })
               })
               .catch(() => {
            
               })
                        Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            
  
      }
      }
            )}
            },
    created(){
       this.allcategories();
    }
}
</script>

<style lang="scss" scoped>
  $list-width: 320px;

  .full-control {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap-reverse;
  }

  .list {
    width: 100%;
  }

  .full-control > .md-list {
    width: $list-width;
    max-width: 100%;
    height: 400px;
    display: inline-block;
    overflow: auto;
    border: 1px solid rgba(#000, .12);
    vertical-align: top;
  }

  .control {
    min-width: 100%;
    display: flex;
    flex-direction: column;
    padding: 16px;
  }
</style>
