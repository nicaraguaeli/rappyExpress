<template>

<div>
   <div  class="card card-signup z-depth-1 wow animated slideInRight faster" style="height: calc(100vh - 80px)" >

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
                <label for="confirmar contraseña" class="">confirmar contraseña <i v-if="data.password == data.password_confirmation" class="fas fa-check text-success "></i><i v-else class="fas fa-times text-danger"></i></label>
              </div>

              <div class="card-foter text-right">
                <button type="button" class="btn btn-outline-success btn-sm waves-effect waves-light" style="width: 140px;" v-on:click.prevent="insert()">Registrarse</button>
               
              </div>

            </div>

          </div>
           
        


       



</div>
</template>
<script>
export default {
    mounted()
    {
      if(this.$props.user)
      {
        this.$router.push('perfil')
      }

    },
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
            

            
            
            
            // Login...
            axios.post('./register',formdata).then(response=>(this.validator(response.status))).catch(error => (toastr.error('Ups! No hemos podido procesar tu solicitud!')))
                      

                         
          
        },
       
        validator(value)
        {
            const valor = parseInt(value)
            if(valor == 201)
            {
                
                axios.get('./user').then(response=>(this.$parent.user = response.data, this.emitir())).catch(error => (console.log(error)))
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