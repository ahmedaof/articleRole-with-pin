<template>
  <div>

<div class="container">
     
   
 <router-link 
  style="position: relative;
    top: 10px;
    right: 30px;
    font-size: 26px;
    font-weight:bold" 
    class="md-inset md-list-item" :to="{name:'createArticle'}">Add Articles</router-link>
     
    <md-field>
      <label>search</label>
      <md-input v-model="searchTerm"></md-input>
    </md-field>

    <div class="full-control">
    <div class="list" v-for="article in filtersearch" :key="article.id">
      <md-list md-expand-single="expandSingle" id="try">
        <md-list-item md-expand md-expanded.sync="expandNews">
          <span class="md-list-item-text">{{article.title}}</span>
          <md-list slot="md-expand">
          <div class="row">
            <div class="col s8 push-s4">
            <md-list-item class="md-inset">{{article.content}}</md-list-item>
            </div>
            </div>
             <div class="row">
            <div class="col s8 push-s4">
            <img :src="article.image_path">
            </div>
</div>
              <div class="row">
            <div class="col s8 push-s4">
          <router-link class="md-inset md-list-item btn" :to="{name:'editArticle',params:{id:article.id}}">Edit</router-link>
          <a @click="deleteArticle(article.id)" class="btn red"  style="cursor: pointer" >Delete</a>


                        
       <h1 >Comments</h1>
  <div v-for="comment in comments" :key="comment.id">
      <p v-if="comment.article_id==article.id">{{comment.comment}}</p>
      
      </div> 


</div>
</div>

          <!-- comment -->

 <form novalidate class="md-layout" @submit.prevent="addComment(article.id)" enctype="multipart/form-data">

    <md-field>
      <label> write your comment</label>
      <md-input v-model="form.comment"></md-input>
    </md-field>

  
         <md-card-actions>
          <md-button type="submit" class="md-primary">add Comment</md-button>
        </md-card-actions>
   
          </form>


          </md-list>
 
      
        </md-list-item>

       

     
      </md-list>
    </div>
  </div>  
</div>
</div>
</template>

<script>
export default{
  
     data:()=>({
  
       form:{
         comment:null,
         id:null,
       },
        articles:[],
        comments:[],
        users:[],
        searchTerm:''
      
    }),
    computed:{
      filtersearch(){
        return this.articles.filter(article=> {
          return article.title.match(this.searchTerm)
        })
      }
    },
   
    methods:{
  

      allarticles(){
          axios.get('/api/article')
          .then((res=>{this.articles=res.data.articles}))
          .catch()
      },
      
      allcomments(){
        
          axios.get('/api/article')
          .then((res=>{
            this.comments=res.data.comments}))
          .catch()
      },
         allusers(){
          axios.get('/api/article')
          .then((res=>{this.users=res.data.users}))
          .catch()
      },
      deleteArticle(id){
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
         alert('delet avilable for admins only');
         this.$router.push({name:'category'})
        }else{
        axios.delete('/api/article/'+id)
        .then(()=>{
             Toast.fire({
                  icon: 'success',
                  title: 'successfully deleted'
        });
          this.articles=this.articles.filter(article=>{
            return article.id!=id;
            
          })     
        })
        .catch(()=>{
           this.$router.push({name: 'article'})
        })
                         Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            
  
      }
            }
            )
            
            },
      addComment(id){
        axios.post('/api/comment'+id,this.form)
             .then((res)=>{
                   Toast.fire({
                  icon: 'success',
                  title: 'thanks for your comment'
        });
            
          this.comments.push(res.data);
          this.form.comment='';
            
          })     
        }
      
    },
    created(){
       this.allarticles();
       this.allcomments();
       this.allusers();
          if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
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
  img{
    max-width: 16%;
  }

  .control {
    min-width: 100%;
    display: flex;
    flex-direction: column;
    padding: 16px;
  }
</style>
