<template>

<div>
   <div v-if="!user.id" class="card card-signup z-depth-1" style="height: calc(100vh - 80px)" >

            <div class="card-body text-center">

            <i class="fas fa-user-circle" style="font-size: 3rem; color: #00c853; "></i>
              <h3 class="card-title my-2">Crea tu cuenta</h3>
              <p class="slogan">Es Fácil!</p>

              <div class="md-form md-outline">
                <input type="text"  class="form-control" v-model="data.name">
                <label for="Nombre completo" class="">Nombre completo</label>
              </div>

              <div class="md-form md-outline">
                <input type="email"  class="form-control" v-model="data.email">
                <label for="email" class="">E-mail</label>
              </div>

              <div class="md-form md-outline">
                <input type="number"  class="form-control" v-model="data.number">
                <label for="telefono" class="">Telefono</label>
              </div>

              <div class="md-form md-outline">
                <input type="password"  class="form-control" v-model="data.password">
                <label for="contraseña" class="">Contraseña</label>
              </div>

              <div class="md-form md-outline">
                <input type="password"  class="form-control" v-model="data.password_confirmation">
                <label for="confirmar contraseña" class="">confirmar contraseña</label>
              </div>

              <div class="card-foter text-right">
                <button type="button" class="btn btn-outline-success btn-sm waves-effect waves-light" style="width: 140px;" v-on:click.prevent="insert()">Registrarse</button>
               
              </div>

            </div>

          </div>
           
         <div class="modal fade" id="centralModalSuccessDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-notify modal-success" role="document">
            <!-- Content -->
            <div class="modal-content">
              <!-- Header -->
              <div class="modal-header">
                <p class="heading lead">Registrado!</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="white-text">×</span>
                </button>
              </div>

              <!-- Body -->
              <div class="modal-body">
                <div class="text-center">
                  <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
                  <p>Has sido registrado en nuestro sistema, ya puedes realizar tus pedidos desde la comodidad de tu hogar, estaremos muy atentos a tu solicitud.
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

<div class="card wow fadeIn animated" data-wow-delay="0.3s" style="visibility: visible; animation-name: fadeIn; animation-delay: 0.3s; height: calc(100vh - 80px" >
                <div class="card-body">

                  <!--Header-->
                  <div class=" text-center mt-3">
                    <h3 class="text-gray"><i class="fas fa-user mt-2 mb-2" style="font-size: 3rem; color: #00c853; "></i> Inicia session:</h3>
                  </div>

                  <!--Body-->
                  
                  <div class="md-form">
                    <i class="fas fa-envelope prefix white-text"></i>
                    <input type="email" id="orangeForm-email" class="form-control" v-model="email">
                    <label for="orangeForm-email" class="">email</label>
                  </div>

                  <div class="md-form">
                    <i class="fas fa-lock prefix white-text"></i>
                    <input type="password" id="orangeForm-pass" class="form-control" v-model="password">
                    <label for="orangeForm-pass" class="">Contraseña</label>
                  </div>

                  <div class="text-center">
                    <button class="btn dusty-grass-gradient btn-lg waves-effect waves-light" v-on:click.prevent="login">Entrar</button>
                    <hr>
                  
                  </div>

                </div>
              </div>


</div>
</template>
<script>
export default {
    
    data()
    {
        return{
            data:{
                name: "Eli Jose",
                email: "123@gmail.com",
                password: "123456789",
                password_confirmation: "123456789",
                number: 83218727,
            },
            email: "",
            password: "",
            
        }
    },
    props:
    {
          user: [],
    },

    methods:
    {
        insert()
        {
            let formdata = new FormData();
            formdata.append('name',this.data.name)
            formdata.append('email',this.data.email)
            formdata.append('password',this.data.password)
            formdata.append('password_confirmation',this.data.password_confirmation)
            formdata.append('number',this.data.number)
            

            
            
            axios.get('./sanctum/csrf-cookie').then(response => {
            // Login...
            axios.post('./register',formdata).then(response=>(this.validator(response.status))).catch(error => (console.log(error)))
                      

            });                   
          
        },
        login: function()
        {
            let formdata = new FormData();
           
            formdata.append('email',this.email)
            formdata.append('password',this.password)
            
            axios.get('./sanctum/csrf-cookie').then(response => {
            // Login...
            axios.post('./login',formdata).then(response=>(this.validator(response.status)))
                      

            });

        },
        validator(value)
        {
            const valor = parseInt(value)
            if(valor == 201)
            {
                $('#centralModalSuccessDemo').modal('show')
                axios.get('./user').then(response=>(this.$props.user = response.data, this.emitir())).catch(error => (console.log(error)))
            }
             if(valor == 204)
            {
                
                axios.get('./user').then(response=>(this.$props.user = response.data, this.emitir())).catch(error => (console.log(error)))
            }
           
        },
        emitir()
        {
        this.$emit('user',this.$refs.user)
        console.log('emitido')
        }
    }
    
    
}
</script>