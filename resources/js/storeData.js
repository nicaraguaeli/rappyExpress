export default {

	state: {

      
       auth: false,
       user: {},

	},

	getters: {

       getUserGetter(state){ //take parameter state

          return state.user
       },
       getAuth(state){ //take parameter state

              return state.auth
           }
	},

	actions: {
      async login({dispatch},credentials){
            
            axios.get("sanctum/csrf-cookie").then(response =>{
              axios.post("api/login",credentials).then(response =>(console.log(response)));

            });
            
               return dispatch("getUser")
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
         
       }
	}
}