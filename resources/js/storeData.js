import { Store } from "vuex";

export default {

	state: {

      
       auth: false,
       user: {},
       validation: ""

	},

	getters: {

       getUserGetter(state){ //take parameter state

          return state.user
       },
       getAuth(state){ //take parameter state

              return state.auth
           },
       getValidation(state){ //take parameter state

              return state.validation
           }    
	},

	actions: {
      async login({commit,dispatch},credentials){
            
              axios.get("sanctum/csrf-cookie").then(response =>{
              axios.post("api/login",credentials)
              .then(response => {
                     
                            commit("SET_VALIDATION",response.status)
                          
              })
              .catch(error => {
                     
                            commit("SET_VALIDATION",error.response.status)
                           
        
              });

            });
            
               
       },
       getUser({commit})
       {       
             
                     axios.get("api/user").then(res =>{commit("SET_USER",res.data)}).catch(()=>{commit("SET_USER",null)})
              
              
       }

	},

	mutations: {
       SET_USER(state,user) {
         state.user = user;
         state.auth = Boolean(user);
         
       },
       SET_VALIDATION(state,validation) {
              state.validation = validation;
              
              
            },
      

	}
}