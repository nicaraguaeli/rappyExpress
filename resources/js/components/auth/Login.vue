<template>
    
     <div v-if="!user.id">
         <div  class="card wow slideInLeft animated faster" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; height: calc(100vh - 80px" >
                <div class="card-body">

                  <!--Header-->
                  <div class=" text-center mt-3">
                    <h3 class="text-gray"><i class="fas fa-user mt-2 mb-2" style="font-size: 3rem; color: #00c853; "></i> Inicia session:</h3>
                  </div>

                  <!--Body-->
                  
                  <div class="md-form">
                    <i class="fas fa-envelope prefix white-text"></i>
                    <input type="email" id="orangeForm-email" class="form-control" v-model="email" >
                    <label for="orangeForm-email" class="">Correo electronico</label>
                  </div>

                  <div class="md-form">
                    <i class="fas fa-lock prefix white-text"></i>
                    <input type="password" id="orangeForm-pass" class="form-control" v-model="password">
                    <label for="orangeForm-pass" class="">Contraseña</label>
                  </div>

                  <div class="text-center">
                    <button :disabled="!email && !password" class="btn dusty-grass-gradient btn-lg waves-effect waves-light" v-on:click.prevent="login">Entrar</button>
                    <hr>
                   
                    
                    
                   
                 
                
                  
                  </div>

                </div>
                 
              </div>

                <div class="modal fade" id="centralModalSuccessDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-notify modal-success" role="document">
            <!-- Content -->
            <div class="modal-content">
              <!-- Header -->
              <div class="modal-header">
                <p class="heading lead">Hola de nuevo!</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="white-text">×</span>
                </button>
              </div>

              <!-- Body -->
              <div class="modal-body">
                <div class="text-center">
                  <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
                  <p>Has iniciado sesion correctamente!.
                  </p>
                </div>
              </div>

              <!-- Footer -->
              <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-success waves-effect waves-light close"  data-dismiss="modal" aria-label="Close">Entendido </a>
              
              </div>
            </div>
            <!-- Content -->
          </div>
        </div>


     </div>
   
</template>
<script>
export default {
    data()
    {
        return{
        
            email: "",
            password: "",
            
            
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
           
            formdata.append('email',this.email)
            formdata.append('password',this.password)
            if(this.email && this.password)
            {
            axios.get('./sanctum/csrf-cookie').then(response => {
            // Login...
            axios.post('./login',formdata).then(response=>(this.validator(response.status))).catch(error=> (toastr.error('Ups! No hemos podido procesar tu solicitud asegurate que las credenciales sean las correctas.')))
 
            });
            }
            else
            {
                toastr.info("Ambos campos son obligatorios")
            }

        },
        validator(value)
        {
            const valor = parseInt(value)
           
             if(valor == 204)
            {
                
                axios.get('./user').then(response=>(this.$$refs.user = response.data, this.emitir())).catch(error => (console.log(error)))
                $('#centralModalSuccessDemo').modal('show')
            }
           
        },
        emitir()
        {
        this.$emit('username',this.$refs.user)
        
        console.log('emitido')
        }
    }
    
}
</script>