class AppStorage{

 storeToken(token){
 	localStorage.setItem('token',token);
 }

 storeUser(user){
 	localStorage.setItem('user',user);
 }
 storeRole(Role){
	localStorage.setItem('Role',Role);
}

 store(token,user,Role){
 	this.storeToken(token)
 	this.storeUser(user)
	 this.storeRole(Role)
  }

  clear(){
  	localStorage.removeItem('token')
  	localStorage.removeItem('user')
  	localStorage.removeItem('Role')
  }

  getToken(){
  	localStorage.getItem(token);
  }

   getUser(){
  	localStorage.getItem(user);
  }

  getRole(){
	localStorage.getItem(Role);
}



}

export default AppStorage = new AppStorage();