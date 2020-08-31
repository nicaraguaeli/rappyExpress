<template>

          
          <!--PERFIL-->
          <div>
              <div class="card wow animated fadeIn faster" style="height: calc(100vh - 80px); overflow: scroll;">
                  <div class="card-header text-center">
                      Información sobre mi perfil
                  </div>
                <div class="card-body">

                    <!-- name -->
            <div class="md-form">
                <input type="text" :readonly="edit" id="" class="form-control" v-model="user.name">
                <label class="active">Nombre</label>
            </div>
         <!--end-name-->

         <!-- name -->
            <div class="md-form">
                <input type="email" :readonly="edit"  class="form-control validate" v-model="user.email">
                <label class="active">E-mail</label>
            </div>
         <!--end-name-->

          <!-- numero -->
            <div class="md-form">
                <input type="number" maxlength="8" :readonly="edit"  v-model.number="user.number" class="form-control"  >
                <label class="active">Número</label>
            </div>
         <!--end-numero-->
          <!-- direccion -->
            <div class="md-form">
                <input type="text"  :readonly="edit"  v-model="user.address" class="form-control" >
                <label class="active">Dirección</label>
            </div>
         <!--end-direccion-->

           <!-- direccion -->
            <div class="md-form">
                <input type="text"  :readonly="edit"  v-model="user.address_alt" class="form-control" >
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
               <successModal :title="'Hola!'" :text="'Agrega una o dos direcciones frecuentes. donde se entregaran los pedidos.'" :modalstate="modalstate"></successModal>
          </div>
        
          <!--END-->

</template>
<script>
import successModal from "../css/SuccessModal"
export default {
   mounted()
   {
     if(!this.user.address)
     {
         this.modalstate = true
     }
    
     axios.get('./user').then(response=> (this.user = response.data)).catch(error => (console.log(error)))
   },
    data()
    {
      return{
          user: {},
          edit: true,
          modalstate: false,
          
         

    }   

    },
     components:
    {
        successModal,
    },
    methods:
     {
     
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
            if(this.validation())
            {
            
            let formdata = new FormData();
           
            formdata.append('email',this.user.email)
            formdata.append('name',this.user.name)
            formdata.append('number',this.user.number)
            formdata.append('address',this.user.address)
            formdata.append('address_alt',this.user.address_alt)
            formdata.append('_method','PUT')

            axios.post('./user/'+this.user.id,formdata).then(response => (this.errors(response.data))).catch(error => (toastr.warning(error)))

            }
            else
            {
              toastr.info("Existe un problema en uno de los campos")
            }
            
                
        },
        errors(response)
        {
            if(response.errorInfo)
            {
              if(response.errorInfo[1] == 1062)
              toastr.warning("El correo o número no esta disponible!")
              if(response.errorInfo[1] == 1048)
              toastr.warning("No se puede procesar, todos los campos son obligatorios!")
            }
            else
            {
              toastr.success(response)
              this.$emit('userUpdate');
              this.edit = true
            }
        },
        validation()
        {
          if(String(this.user.number).length == 8 && this.user.name && this.user.email)
          {
              return true
          }
          else
          {
            return false
          }
            
        }
       
     }
    
}

</script>