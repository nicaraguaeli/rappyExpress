<template>

          
          <!--PERFIL-->
          <div>
             <div class="grey special-color-dark  wow animated slideInUp faster " style="height: 3rem;" >
             <div class="d-flex p-2  "  style="height: 3rem;" >
             <div class="col-4 col-md-4 align-self-center" ><a data-toggle="tab" role="tab" href="#product_list" v-on:click="back()"><i class="fas fa-arrow-left text-white"></i><span class="text-white ml-1">Atras</span></a></div>
             <div class="col-5 col-md-4 align-self-center text-white font-weight-bold">Perfil</div>
             <div  class="col-3 col-md-4 align-self-center">
            
             </div>
           
           </div>
          
           </div>
           <div v-if="modalstate" class=" bg-warning font-weight-bold text-center "><p class="  mt-1 p-3 wow animated shake">¡AGREGA UNA DIRECCIÓN!</p></div>
              <div class="card wow animated fadeIn faster" style="height: calc(100vh - 80px); overflow: scroll;">
                  <div class="card-header text-center">
                     Datos Generales
                  </div>
                <div class="card-body">

                    <!-- name -->
            <div class="md-form">
                <input type="text" :readonly="edit" id="" class="form-control" v-model="userAuth.name">
                <label class="active">Nombre</label>
            </div>
         <!--end-name-->

         <!-- name -->
            <div class="md-form">
                <input type="email" :readonly="edit"  class="form-control validate" v-model="userAuth.email">
                <label class="active">E-mail</label>
            </div>
         <!--end-name-->

          <!-- numero -->
            <div class="md-form">
                <input type="number" maxlength="8" :readonly="edit"  v-model.number="userAuth.number" class="form-control"  >
                <label class="active">Número</label>
            </div>
         <!--end-numero-->
          <!-- direccion -->
            <div class="md-form">
                <input type="text"  :readonly="edit"  v-model="userAuth.address" class="form-control" >
                <label class="active">Dirección</label>
            </div>
         <!--end-direccion-->

           <!-- direccion -->
            <div class="md-form">
                <input type="text"  :readonly="edit"  v-model="userAuth.address_alt" class="form-control" >
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
   mounted()
   {
     if(this.$props.user.id)
     {   
         this.userAuth = this.$props.user

         if(!this.userAuth.address)
         {
            this.modalstate = true
           
         }
         
     }
     else
     {
       //this.$router.push('login')
     }
    
    
   },
    data()
    {
      return{
          userAuth: {},
          edit: true,
          modalstate: false,
          
         

    }
  
    },
    props:
    {
      user: {}
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
           
            formdata.append('email',this.userAuth.email)
            formdata.append('name',this.userAuth.name)
            formdata.append('number',this.userAuth.number)
            formdata.append('address',this.userAuth.address)
            formdata.append('address_alt',this.userAuth.address_alt)
            formdata.append('_method','PUT')

            axios.post('./user/'+this.userAuth.id,formdata).then(response => (this.errors(response.data))).catch(error => (toastr.warning(error)))

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
              this.$emit('userAuthUpdate');
              this.edit = true
            }
        },
        validation()
        {
          if(String(this.userAuth.number).length == 8 && this.userAuth.name && this.userAuth.email)
          {
              return true
          }
          else
          {
            return false
          }
            
        },
        back()
{
  this.$router.back()
}
       
     }
    
}

</script>