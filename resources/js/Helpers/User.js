import Token from './Token'
import AppStorage from './AppStorage'


class User{

 responseAfterLogin(res){
 	const access_token = res.data.access_token
 	const username = res.data.name
 	const Role = res.data.Role
 	if (Token.isValid(access_token)) {
 		AppStorage.store(access_token,username,Role)
 	}
 }
 

  hasToken(){
  	const storeToken = localStorage.getItem('token');
  	if (storeToken) {
  		return Token.isValid(storeToken)? true : false
  	}
  	false
  }

  loggedIn(){
  	return this.hasToken()
  }

  name(){
  	if (this.loggedIn()) {
  		return localStorage.getItem('user');
  	}
  }

  Role(){
	if (this.loggedIn()) {
		return localStorage.getItem('Role');
	} 
  }


	id(){
	  	if (this.loggedIn()) {
	  		const payload = Token.payload(localStorage.getItem('token'));
	  		return payload.sub
	  	}
	  	return false
	  }

 
 
}

export default User = new User()