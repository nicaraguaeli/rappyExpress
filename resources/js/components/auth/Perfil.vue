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

               <div class="classic-tabs">

              <!-- Nav tabs -->
              <div class="tabs-wrapper">
                <ul class="nav tabs grey lighten-2" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link waves-light waves-effect waves-light active black-text" data-toggle="tab" href="#panel36" role="tab" aria-selected="true">Perfil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link waves-light waves-effect waves-light black-text" data-toggle="tab" href="#panel37" role="tab" aria-selected="false">Pedidos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link waves-light waves-effect waves-light black-text" data-toggle="tab" href="#panel38" role="tab" aria-selected="false">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link waves-light waves-effect waves-light black-text" data-toggle="tab" href="#panel39" role="tab" aria-selected="false">Be
                      awesome</a>
                  </li>
                </ul>
              </div>

              </div>


           <div v-if="modalstate" class=" bg-warning font-weight-bold text-center "><p class="  mt-1 p-3 wow animated shake">¡AGREGA UNA DIRECCIÓN!</p></div>
              <div class="card wow animated fadeIn faster" style="height: calc(100vh - 80px); overflow: scroll;">
                  <div class="card-header text-center">
                     Datos Generales
                  </div>
                <div class="card-body">

                    <!-- name -->
            <div class="md-form" >
                <input type="text" :readonly="edit" id="" class="form-control" v-model="getUser.name">
                <label class="active">Nombre</label>
            </div>
         <!--end-name-->

         <!-- name -->
            <div class="md-form">
                <input type="email" :readonly="edit"  class="form-control validate" v-model="getUser.email">
                <label class="active">E-mail</label>
            </div>
         <!--end-name-->

          <!-- numero -->
            <div class="md-form">
                <input type="number" maxlength="8" :readonly="edit"  v-model.number="getUser.number" class="form-control"  >
                <label class="active">Número</label>
            </div>
         <!--end-numero-->
          <!-- direccion -->
            <div class="md-form">
                <input type="text"  :readonly="edit"  v-model="getUser.address" class="form-control" >
                <label class="active">Dirección</label>
            </div>
         <!--end-direccion-->

           <!-- direccion -->
            <div class="md-form">
                <input type="text"  :readonly="edit"  v-model="getUser.address_alt" class="form-control" >
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
     if(!this.$store.getters.getUserGetter)
     {
      this.$store.dispatch("getUser");
     }
  },

    data()
    {
      return{
          
          edit: true,
          modalstate: false,
          user: {},
         

    }
  
    },
    computed: {
        getAuth()
        {
          return this.$store.getters.getAuth
        },
         getUser()
        {
          return this.$store.getters.getUserGetter
        },
   
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
            
            
            let formdata = new FormData();
           
            formdata.append('email',this.getUser.email)
            formdata.append('name',this.getUser.name)
            formdata.append('number',this.getUser.number)
            formdata.append('address',this.getUser.address)
            formdata.append('address_alt',this.getUser.address_alt)
            formdata.append('_method','PUT')
            axios.post('user/'+this.getUser.id,formdata)
            .then(response => {
                 if(response.status == 200)
          {
             this.$toasted.show("Perfil actualizado", { 
                  theme: "outline", 
                  position: "bottom-center", 
                  duration : 2000
                });
             
             this.$store.dispatch('getUser')   
          }
            })
            .catch(error => {
             
            
            if(typeof error.response.data.number )
            {
              
            this.$toasted.show(error.response.data.number, { 
            theme: "bubble", 
            position: "bottom-center", 
            duration : 2000
          })
               

            }
            if(typeof error.response.data.email )
            {
            
            this.$toasted.show(error.response.data.email, { 
            theme: "bubble", 
            position: "bottom-center", 
            duration : 2000
          })

            }
            if(typeof error.response.data.name )
            {
            this.$toasted.show(error.response.data.name, { 
            theme: "bubble", 
            position: "bottom-center", 
            duration : 2000
          })

            }
           
                
            })
        
        },
        back()
{
  this.$router.back()
}
       
     }
    
}

</script>