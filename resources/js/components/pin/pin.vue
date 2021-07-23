<template>
    <div class="container">

        <div class="row">

            <h1>enter your pin number</h1>
   </div>
             <ul class="row wid">
                <li class="col s1"><input  v-model="val0" class="flow-text center-align inputs"  ref="val0"  type="password" maxlength="1"  /></li>
                <li class="col s1"><input v-model="val1" class="flow-text center-align inputs"  ref="val1" type="password" maxlength="1"   /></li>
                <li class="col s1"><input v-model="val2" class="flow-text center-align inputs" ref="val2" type="password"  maxlength="1"  /></li>
                <li class="col s1"><input v-model="val3" class="flow-text center-align inputs" ref="val3" type="password"  maxlength="1"  /></li>
          
        </ul>


            <div class="row widy">
      <button @click="get"  value="1"  class="col s1">1</button>
        <button @click="get"  value="2"  class="col s1">2</button>
        <button @click="get"  value="3"  class="col s1">3</button>
        <button  @click="get"  value="4"  class="col s1">4</button>
        <button @click="get"  value="5"  class="col s1">5</button>
    </div>

                <div class="row widy">
      <button @click="get"  value="6"  class="col s1">6</button>
      <button @click="get"  value="7"  class="col s1">7</button>
      <button @click="get"  value="8"  class="col s1">8</button>
      <button @click="get"  value="9"  class="col s1">9</button>
      <button @click="get"  value="0"  class="col s1">0</button>
    </div>


    
                <div class="row widy last">
      <button @click="clear"   class="col s2 ">Back</button>
      <button @click="onsubmit"   class="col s2 push-s6 btn-primary">Enter</button>
    </div>



    </div>
</template>

<script>



export default {
    data:()=>({
        pins:[],
      val0:'',
      val1:'',
      val2:'',
      val3:'',
     
    }),

    methods:{
        get(event){

if( this.val0.length==0){

  this.val0 = event.target.value;
    this.$refs.val1.focus();
}
else if( this.val1.length==0){

  this.val1 = event.target.value;
    this.$refs.val2.focus();
}
else if( this.val2.length==0){

  this.val2 = event.target.value;
    this.$refs.val3.focus();
}
else if( this.val3.length==0){

  this.val3 = event.target.value;
 
}else{
  console.log("all elemet inserted")
}
 },


 onsubmit(){
   let val = this.val0+this.val1+this.val2+this.val3;
         this.pins.forEach(pin => {  
              if(val=='0000' && pin.password!="0000"){
    axios.get('/api/pin/'+User.id())
    .then(res=> window.location.href = '/home')
    .catch(err=>console.log(err))   
            }   
        else if(User.id()==pin.user_id){
                if(pin.password==this.val0+this.val1+this.val2+this.val3){
             window.location.href = '/home'
                }else{
                    Toast.fire({
                  icon: 'alert',
                  title: 'pin not valid'
        });
                }
          
 
      
  
   }else{
       Toast.fire({
                  icon: 'alert',
                  title: 'pin not valid'
        });
       
   }
       
          })
        
 
  
      
 
 },
 clear(){
   this.val0='';
   this.val1='';
   this.val2='';
   this.val3='';
 }
    },


       created(){
     axios.get('api/pin')
        .then(({data})=>{this.pins=data})
     .catch()
    },

 beforeCreate: function() {
        document.body.className = 'local';
    }

}


</script>

<style scoped>
@media only screen and (min-width: 768px) {
      [class*="wid"] {
       max-width: 20%;
       position: relative;
       left: 450px;
     
       
 
}}
@media only screen and (min-width: 768px) {
      [class*="widy"] {
         max-width: 45%;
         position: relative;
         left: 330px;
         margin: 1px;
           background-color: red;
 
 
}}
@media only screen and (min-width: 768px) {
      [class*="last"] {
     
  padding: 26px;
  max-width:30%;
  margin: 1px;
    background-color: red;
 
}}
li.col.s1 {
   margin-right: -15px;
  
}
button.col.s1 {
    padding: 26px;
  max-width: 19%;
  margin: 1px;
    background-color: red;
      border: solid;
    border-width: thin;
        color: white;
}


input.flow-text{
    border: solid;
    border-width: thin;
        color: white;
        font-size: 46px;

}

button.col.s2 {
    margin: -26px;
    padding: 20px;
    background-color: red;
      border: solid;
    border-width: thin;
        color: white;
        
}




button.col.s2.push-s6.btn-primary {
    position: relative;
    left: 151px;
     background-color: #079a07;

}
</style>

