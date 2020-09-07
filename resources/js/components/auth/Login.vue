<template>


           
  
     <div>
        <div class="grey special-color-dark  wow animated slideInUp faster " style="height: 3rem;" >
             <div  class="d-flex p-2  "  style="height: 3rem;" >
             <div class="col-4 col-md-4 align-self-center" ><a data-toggle="tab" role="tab" href="#product_list" v-on:click="back()"><i class="fas fa-arrow-left text-white"></i><span class="text-white ml-1">Atras</span></a></div>
             <div class="col-5 col-md-4 align-self-center text-white font-weight-bold">Login</div>
             <div  class="col-3 col-md-4 align-self-center">
            
             </div>
           
           </div>
          
           </div>

           <!--Login-->
           <div class="card" style="height: calc(100vh - 80px)">

            <!--Card content -->
            <div class="card-body">

              <!-- Login form -->
              <form v-on:submit.prevent="login">
                <div class=" text-center mt-3">
                    <h3 class="text-gray"><i class="fas fa-user mt-2 mb-2" style="font-size: 3rem; color: #00c853; "></i> Inicia session: </h3>
                   
                  </div>

                <div class="md-form">
                  <i class="fas fa-envelope prefix grey-text"></i>
                  <input type="text" id="defaultForm-email" class="form-control" v-model="credencial.email">
                  <label for="defaultForm-email" class="">Correo electrónico</label>
                </div>

                <div class="md-form">
                  <i class="fas fa-lock prefix grey-text"></i>
                  <input type="password" id="defaultForm-pass" class="form-control" v-model="credencial.password">
                  <label for="defaultForm-pass" class="">Contraseña</label>
                </div>

                <div class="text-center mt-4">
                 <button  class=" btn dusty-grass-gradient btn-lg waves-effect waves-light">Entrar</button>
                </div>
              </form>

               <div class="text-center mt-4">
               <router-link :to="{name: 'register' }"  class="  waves-effect waves-light">No tienes una cuenta?</router-link>
                </div>
              
              <!-- Login form -->

            </div>

          </div>
           <!--EndLogin-->
            
      

          

        
     </div>
   
</template>
<script>


export default {
  

  data()
  {
      return{
        modalstate: false,
        credencial:{email:"",password:""}
        
      }
  },
computed: {
        getAuth()
        {
          return this.$store.getters.getAuth
        },
          getValidation()
        {
          return this.$store.getters.getValidation
        },
      },
  
  

   props:
    {
      user: {},
      
    },
   
    methods:
    {
        login: function()
        {
           
            

            if(this.credencial.email  && this.credencial.password )
            {

                
             this.$store.dispatch("login", this.credencial)

             setTimeout(() =>(
            
                this.validator()
          

             ),500)
               
              
            
            }
            else
            {
                 $('.btn-login').addTempClass( 'wow animated shake', 1000 );
                 let toast = this.$toasted.show("Ambos campos son requeridos !!", { 
                  theme: "outline", 
                  position: "bottom-center", 
                  duration : 2000
                });
            }
          
          

        },
        validator()
        {
           if(this.getValidation == 422)
           {
            
            this.$toasted.show("Estas credenciales no coinciden con nuestros registros", { 
            theme: "bubble", 
            position: "bottom-center", 
            duration : 2000
          })
          }

          if(this.getValidation == 204)
          {
             this.$toasted.show("Has iniciado sesión", { 
                  theme: "outline", 
                  position: "bottom-center", 
                  duration : 2000
                });
             
             this.$router.push('perfil')   
          }
        
           
        },
       
        
      
        back()
        {
          this.$router.back()
        }
    }
    
}
</script>