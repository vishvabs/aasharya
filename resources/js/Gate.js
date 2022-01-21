export default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.is_admin === 1;
    }

    isUser(){
        return this.user.is_admin === 0;
    }
    
    isAdminOrUser(){
        if(this.user.is_admin === 1 || this.user.is_admin === 0){
            return true;
        }
    }
}
