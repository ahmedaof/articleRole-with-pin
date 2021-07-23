
let login = require('./components/auth/login.vue').default;
let logout = require('./components/auth/logout.vue').default;
let register = require('./components/auth/register.vue').default;
let home = require('./components/home.vue').default;

let pin = require('./components/pin/pin.vue').default;
let pinedit = require('./components/pin/pinEdit.vue').default;

// articles

let article = require('./components/articles/index.vue').default;
let createArticle = require('./components/articles/create.vue').default;
let editArticle = require('./components/articles/edit.vue').default;
 
   //category

   let category = require('./components/categories/index.vue').default;
let createCategory = require('./components/categories/create.vue').default;
let editCategory = require('./components/categories/edit.vue').default;
let filteredArticle = require('./components/categories/filteredArticles.vue').default;
  

export const routes = [
  { path: '/', component: login, name:'/'},
  { path: '/logout', component: logout, name:'/logout'},
  { path: '/register', component: register, name:'register'},
  { path: '/home', component: filteredArticle, name:'home'},


  //articles

  {path:'/article',component:article,name:'article'},
  {path:'/create',component:createArticle,name:'createArticle'},
  {path:'/article/:id',component:editArticle,name:'editArticle'},
 

  //category

  {path:'/category',component:category,name:'category'},
  {path:'/createCategory',component:createCategory,name:'createCategory'},
  {path:'/category/:id',component:editCategory,name:'editCategory'},


  {path:'/filteredArticle',component:filteredArticle,name:'filteredArticle'},



  {path:'/pin',component:pin,name:'pin'}, 
  {path:'/pinedit',component:pinedit,name:'pinedit'}, 
]