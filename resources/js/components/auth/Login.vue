<template>
    
  
     <div>
        <div class="grey special-color-dark  wow animated slideInUp faster " style="height: 3rem;" >
             <div class="d-flex p-2  "  style="height: 3rem;" >
             <div class="col-4 col-md-4 align-self-center" ><a data-toggle="tab" role="tab" href="#product_list" v-on:click="back()"><i class="fas fa-arrow-left text-white"></i><span class="text-white ml-1">Atras</span></a></div>
             <div class="col-5 col-md-4 align-self-center text-white font-weight-bold">Login</div>
             <div  class="col-3 col-md-4 align-self-center">
            
             </div>
           
           </div>
          
           </div>
         <div  class="card wow slideInLeft animated faster" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; height: calc(100vh - 80px" >
                <div class="card-body">
                  
                  <!--Header-->
                  <div class=" text-center mt-3">
                    <h3 class="text-gray"><i class="fas fa-user mt-2 mb-2" style="font-size: 3rem; color: #00c853; "></i> Inicia session:</h3>
                   
                  </div>

                  <!--Body-->
                  <form v-on:submit.prevent="login">
                    <div class="md-form">
                <i class="fas fa-envelope prefix active"></i>
                <input type="email" id="form6" class="form-control validate " ref="email">
                <label for="form6" data-error="correo no valido" data-success="bien" class="active">Correo electrónico</label>
              </div>
                 

                  <div class="md-form">
                <i class="fas fa-lock prefix"></i>
                <input type="password" id="form7" class="form-control validate" ref="password">
                <label for="form7" data-error="falta" data-success="bien" class="">Contraseña</label>
              </div>

                  <div class="text-center btn-login">
                    <button  class=" btn dusty-grass-gradient btn-lg waves-effect waves-light">Entrar</button>
                    <hr>
               
                  </div>
                   <div class="text-center">
                    <router-link :to="{name: 'register' }"  class="  waves-effect waves-light">No tienes una cuenta?</router-link>
                    <hr>
               
                  </div>
                  
                  </form>

                </div>
                 
              </div>

          

        
     </div>
   
</template>
<script>


export default {
  mounted()
  {
     if(this.$props.user.id)
     {
       this.$router.push('perfil')
     }

  },
  data()
  {
      return{
        modalstate: false,
        
      }
  },
  

   props:
    {
      user: {},
      
    },
   
    methods:
    {
        login: function()
        {
            let formdata = new FormData();
           
            formdata.append('email',this.$refs.email.value)
            formdata.append('password',this.$refs.password.value)

            if(this.$refs.email.value  && this.$refs.password.value )
            {

            axios.get('/sanctum/csrf-cookie').then(response => {
            // Login...
            axios.post('/login',formdata).then(response=>(this.validator(response.status))).catch(error=> (toastr.error('Ups! No hemos podido procesar tu solicitud asegurate que las credenciales sean las correctas.')))
            
            });

            }
            else
            {
                 $('.btn-login').addTempClass( 'wow animated shake', 1000 );
            }
          
          

        },
        validator(value)
        {
            const valor = parseInt(value)
           
             if(valor == 204)
            {
                
                axios.get('/user').then(response=>(this.$parent.user = response.data, this.emitir())).catch(error => (console.log(error)))
                
                this.modalstate = true
            }
           
        },
       
        emitir()
        { 
          
          this.$router.push('perfil') 
        //this.$emit('username',this.$refs.user)
      
        
        },
        back()
        {
          this.$router.back()
        }
    }
    
}
</script>