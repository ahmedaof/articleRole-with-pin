<template>
  <div class="container">

   <h1>filter articles</h1>


       <md-field>
    <label for="category">Category</label>
    <md-select name="id" class="list" id="id" v-model="form.id">
        
        <md-option :value="category.id" v-for="category in categories" :key="category.id">{{category.title}}</md-option>
     
    </md-select>
    <span class="md-error">The Category is required</span>
    </md-field>

        <a id="search" class="btn" name="search" @click="allArticles(form.id)"> Search</a>


        <div class="row d-none" id="roll-generate">
 	<div class="col-md-12">
 		<table class="table table-bordered table-striped" style="width: 100%">
 			<thead>
 				<tr>
 					
 					<th>title </th>
 					<th>content  </th>
 					
 				 </tr> 				
 			</thead>
 			<tbody id="roll-generate-tr" v-for="article in articles" :key="article.id">
 				
 				<td>{{article.title}}</td>
 				<td>{{article.content}}</td>
 			</tbody>
 			
 		</table>
 		
 	</div>
 	
 </div>

  <div class="row d-none" id="generate">
   
   <h1>no Articles in this category</h1>

  </div>

</div>
</template>

<script>
export default{
 
     data:()=>({
          form:{
           id:null,
          },
        categories:[],
        articles:[],
      
    }),
  
   
    methods:{
  

      allcategories(){
          axios.get('/api/category')
          .then(({data})=>{
            this.categories=data.categories;
          })
               .catch((err) => {
                console.log(err);
               })
      },

      
          allArticles(id){
          axios.get('/api/category')
          .then(({data})=>{
            this.articles=data.articles.filter(article=>{
                    if(article.category_id){
           $('#roll-generate').removeClass('d-none');
          }else{
             $('#generate').removeClass('d-none');
          }
                return article.category_id==id;

                
            });
      })
          }
    },
    created(){
         if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
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
