<template>
                     <form v-on:submit.prevent="submit" v-if="!state_user.id" >
                    

                      <!-- Material form login -->
<div class="card p-2 " style="height: calc(100vh - 180px); overflow: scroll;">

  <h5 class="card-header green accent-4 white-text text-center py-4">
    <strong>Ingresa tus credenciales</strong>
  </h5>

  <!--Card content-->
  <div class="card-body px-lg-5 pt-0">

   

      <!-- Email -->
      <div class="md-form">
        <input type="email" id="materialLoginFormEmail" class="form-control" v-model="email">
        <label for="materialLoginFormEmail">E-mail</label>
      </div>

      <!-- Password -->
      <div class="md-form">
        <input type="password" id="materialLoginFormPassword" class="form-control" v-model="password">
        <label for="materialLoginFormPassword">Contraseña</label>
      </div>

      <div class="d-flex justify-content-around">
        <div>
         
        </div>
        <div>
          <!-- Forgot password -->
          <a href="">Perdiste tu clave?</a>
        </div>
      </div>

      <!-- Sign in button -->
      <button class="btn btn-outline-success btn-rounded btn-block my-4 waves-effect z-depth-0"  type="submit">Acceder</button>

      <!-- Register -->
      <p>No tienes cuenta?
        <a href="">Registrate</a>
      </p>

      

    

  </div>

</div>
<!-- Material form login -->
                    </form>
          
          <!--PERFIL-->
          <div v-else>
              <div class="card " style="height: calc(100vh - 180px); overflow: scroll;">
                  <div class="card-header text-center">
                      Información sobre mi perfil
                  </div>
                <div class="card-body">

                    <!-- name -->
            <div class="md-form">
                <input type="text" :readonly="edit" id="" class="form-control" v-model="state_user.name">
                <label class="active">Nombre</label>
            </div>
         <!--end-name-->

         <!-- name -->
            <div class="md-form">
                <input type="text" :readonly="edit" id="" class="form-control" v-model="state_user.email">
                <label class="active">E-mail</label>
            </div>
         <!--end-name-->

          <!-- numero -->
            <div class="md-form">
                <input type="number" maxlength="8" :readonly="edit" id="" v-model="state_user.number" class="form-control" >
                <label class="active">Número</label>
            </div>
         <!--end-numero-->
          <!-- direccion -->
            <div class="md-form">
                <input type="text"  :readonly="edit" id="" v-model="state_user.address" class="form-control" >
                <label class="active">Dirección</label>
            </div>
         <!--end-direccion-->

           <!-- direccion -->
            <div class="md-form">
                <input type="text"  :readonly="edit" id="" v-model="state_user.address_alt" class="form-control" >
                <label class="active">Dirección 2 (OPCIONAL)</label>
            </div>
         <!--end-direccion-->

         <!--edit-->
         <div class="row">
<div class="col-sm-12 text-center">
  <button v-if="edit"  class="btn btn-outline-info btn-rounded waves-effect" v-on:click="fieldEdit()"><i class="fas fa-edit pr-2"
        aria-hidden="true" ></i>Editar información</button>
        <div v-else class="wow animated slideInUp">
            <div class="row">
                <div class="col-6"><button  class="btn btn-outline-info btn-rounded waves-effect " v-on:click="cancel()">Cancelar</button></div>
                <div class="col-6"> <button  class="btn btn-outline-success btn-rounded waves-effect " v-on:click="update()">Guardar</button></div>
            </div>

        </div>
       
       
       
</div>
    
     

  </div>
         <!--fin-edit-->

                </div>
            

              </div>
          </div>
        
          <!--END-->

</template>
<script>
export default {
    data()
    {
      return{
          name: "",
          email: "",
          password: "",
          edit: true,
         

        }   

    },
    props:
    {
      state_user: {},
    },

    methods:
     {
     submit: function()
        {
            let formdata = new FormData();
           
            formdata.append('email',this.email)
            formdata.append('password',this.password)
            
            axios.get('./sanctum/csrf-cookie').then(response => {
            // Login...
            axios.post('./login',formdata).then(response=>(console.log(response)))
                      

            });
        },
        fieldEdit()
        {
            
            this.edit = false
        },
        cancel()
        {
            this.edit = true

        },
        update()
        {
            let formdata = new FormData();
           
            formdata.append('email',this.$props.state_user.email)
            formdata.append('name',this.$props.state_user.name)
            formdata.append('number',this.$props.state_user.number)
            formdata.append('addres',this.$props.state_user.address)
            formdata.append('address_alt',this.$props.state_user.addres_alt)
            formdata.append('_method','PUT')

            axios.post('./user/'+this.$props.state_user.id,formdata).then(response => (toastr.success(response.data), this.edit = true))

                
        }
       
     }
    
}

</script>