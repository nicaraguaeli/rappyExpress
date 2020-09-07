<template>

<div>
  <div class="grey special-color-dark  wow animated slideInUp faster " style="height: 3rem;" >
             <div  class="d-flex p-2  "  style="height: 3rem;" >
             <div class="col-4 col-md-4 align-self-center" ><a data-toggle="tab" role="tab" href="#product_list" v-on:click="back()"><i class="fas fa-arrow-left text-white"></i><span class="text-white ml-1">Atras</span></a></div>
             <div class="col-5 col-md-4 align-self-center text-white font-weight-bold">Registro</div>
             <div  class="col-3 col-md-4 align-self-center">
            
             </div>
           
           </div>
          
           </div>
<div class="card wow animated fadeIn faster">

  

            <!--Card content -->
            <div class="card-body">

              <!-- Register form -->
              <form @submit.prevent="insert()" class="p-5">
                <div class="text-center">
                    <i class="fas fa-user-circle btn-login" style="font-size: 3rem; color: #00c853; "></i>
              <h3 class="card-title my-2">Crea tu cuenta</h3>
              <p class="slogan">Es Fácil!</p>
                </div>
                

                <div class="md-form">
                  <i class="fas fa-user prefix grey-text"></i>
                  <input type="text" id="orangeForm-name" class="form-control" v-model="data.name">
                  <label for="orangeForm-name" class="" >Tu nombre</label>
                </div>
                <div class="md-form">
                  <i class="fas fa-envelope prefix grey-text"></i>
                  <input type="text" id="orangeForm-email" class="form-control" v-model="data.email">
                  <label for="orangeForm-email" class="">Tu correo</label>
                </div>

                 <div class="md-form">
                 <i class="fas fa-phone-alt prefix grey-text"></i>
                  <input type="text" id="orangeForm-number" class="form-control"  v-model="data.number">
                  <label for="orangeForm-number" class="">Número telefónico</label>
                </div>

                <div class="md-form">
                  <i class="fas fa-lock prefix grey-text"></i>
                  <input type="password" id="orangeForm-pass" class="form-control" v-model="data.password">
                  <label for="orangeForm-pass" class="">Contraseña</label>
                </div>
                <div class="md-form">
                  <i class="fas fa-lock prefix grey-text"></i>
                  <input type="password" id="orangeForm-pass-confirm" class="form-control" v-model="data.password_confirmation">
                  <label for="orangeForm-pass-confirm" class="">Confirmar contraseña</label>
                </div>


                <div class="text-center mt-4">
                   <button  class=" btn dusty-grass-gradient btn-lg waves-effect waves-light ">Registrarse</button>
                </div>

              </form>
              <!-- Register form -->

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
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                number: "",
            },
          
            
        }
    },
    props:
    {
          user: {},
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
            

            axios.get('sanctum/csrf-cookie').then(response => {
            
             // Register...
            axios.post('api/register',formdata)
            .then(response=>{
              this.$toasted.show("Bienvenido a rappyexpress :)", { 
                  theme: "outline", 
                  position: "bottom-center", 
                  duration : 2000
                });
             
             this.$router.push('perfil') 
            })
            .catch(error => {
             
            
            if(error.response.data.errors.number)
            {
               $('.btn-login').addTempClass( 'wow animated shake', 1000 );
              
            this.$toasted.show(error.response.data.errors.number, { 
            theme: "bubble", 
            position: "bottom-center", 
            duration : 2000
          })
               

            }
            if(error.response.data.errors.email)
            {
               $('.btn-login').addTempClass( 'wow animated shake', 1000 );
            
            this.$toasted.show(error.response.data.errors.email, { 
            theme: "bubble", 
            position: "bottom-center", 
            duration : 2000
          })

            }
            if(error.response.data.errors.name)
            {
               $('.btn-login').addTempClass( 'wow animated shake', 1000 );
            this.$toasted.show(error.response.data.errors.name, { 
            theme: "bubble", 
            position: "bottom-center", 
            duration : 2000
          })

            }

             if(error.response.data.errors.password)
            {
               $('.btn-login').addTempClass( 'wow animated shake', 1000 );
            this.$toasted.show(error.response.data.errors.password, { 
            theme: "bubble", 
            position: "bottom-center", 
            duration : 2000
          })

            }
         
               
            })
 
            });
            
            
           
                      
            
                         
          
        
        },
       
        validator(value)
        {
            const valor = parseInt(value)
            if(valor == 201)
            {
                
                axios.get('/user').then(response=>(this.$parent.user = response.data, this.emitir())).catch(error => (console.log(error)))
            }
             if(valor == 204)
            {
                
               // axios.get('./user').then(response=>(this.$parent.user = response.data, this.emitir())).catch(error => (console.log(error)))
            }
           
        },
        emitir()
        {
        this.$router.push('perfil')
        console.log('emitido')
        }
    }
    
    
}
</script>