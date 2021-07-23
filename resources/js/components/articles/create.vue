<template>
  <div class="container">
    
          <form novalidate class="md-layout" @submit.prevent="addArticle" enctype="multipart/form-data">
    <md-field>
      <label>title</label>
      <md-input v-model="form.title"></md-input>
    </md-field>
     <md-field>
      <label>content</label>
      <md-input v-model="form.content"></md-input>
    </md-field>
      <md-field>
    <label for="category">Category</label>
    <md-select name="category" class="list" id="category" v-model="form.category_name">
        
        <md-option :value="category.id" v-for="category in categories" :key="category.id">{{category.title}}</md-option>
     
    </md-select>
    <span class="md-error">The Category is required</span>
    </md-field>

    <md-field>
      <label>the image of articles</label>
      <md-file name="file"  @change="onFileSelected" accept="image/*" />
 </md-field>

  <div class="col-md-6">
        <img :src="form.image" style="height: 40px; width: 40px;">
            </div>    

  
         <md-card-actions>
          <md-button type="submit" class="md-primary">add Article</md-button>
        </md-card-actions>
  
          </form>
  </div>
</template>



<script>
  export default {
    name: 'TextFields',
     
    data:()=>({
      
         categories:[],
        form:{
     title:null,
 
    content:null,
    category_name:null,
    image:null,
        }
      }),
    created(){
     if (User.Role()=='user') {
          Toast.fire({
                  icon: 'alert',
                  title: 'admins only create articles'
        });
        this.$router.push({name: 'article'});
      }
      axios.get('/api/article/')
      .then(({data})=>{this.categories=data.categories,console.log(this.categories)})
      .catch()
    },
    methods:{
        onFileSelected(event){
            let file = event.target.files[0];
            let reader= new FileReader();
            reader.onload=event=>{
                this.form.image = event.target.result
            };

            reader.readAsDataURL(file);
        },

  
        addArticle(){
         
            axios.post('/api/article/',this.form)
            .then(res=>{
                 Toast.fire({
                  icon: 'success',
                  title: 'successfully added article'
        });
             
                this.$router.push({name:'article'})
            })
            .catch()
        }
    }
  }
</script>