<template>
<!-- Main layout -->
  <main>
    <div class="container">
        
        <div class="card">
          <div class="card-header grey lighten-2">
            Ingreso de grupos
          </div>
          <form ref="form" >
        <div class="row">
        
         
         
              <div class="col-sm-6">
                    
                 <div class="p-2">
                       <div class="md-form ">
  <input type="text" id="nombre" class="form-control" v-model="nombre">
  <label for="nombre">Nombre</label>
</div>
                 </div>
                   
                       
                 

              </div>

               <div class="col-sm-6 align-self-center">
                    <div class="p-2 ">
                           <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
  </div>
  <div class="custom-file">
    <input ref="file" type="file" class="custom-file-input" id="inputGroupFile01"
      aria-describedby="inputGroupFileAddon01" accept="image/*" v-on:change="change()">
    <label class="custom-file-label" for="inputGroupFile01">Elegir imagen 128*128px</label>
  </div>
</div>
                    </div>
                  


              </div>
              <div class="col-sm-12">
                    
                    <div class=" md-form mb-1">
                        <button :disabled="nombre == ''" type="button" class="btn btn-light" v-on:click.prevent="insert()">Agregar</button>
                       
                    </div>


              </div>
             
         
        </div>
        </form>
          <div class="row">
              <div class="col-sm-12">
                    <table class="table text-center table-responsive">
  <thead class="black white-text">
    <tr>
      <th scope="col">#</th>
      <th scope="col">IMAGEN</th>
      <th scope="col">GRUPO</th>
      <th scope="col">ACCION</th>
     
    </tr>
  </thead>
  <tbody>
   
    <tr v-for="(item, index) in grupos" :key="index">
      <th scope="row" v-text="index+1"></th>
      <td ><img :src="item.imagen" :alt="item.nombre"></td>
      <td v-text="item.nombre"></td>
      <td>
        <div class="dropdown">
  <button class="btn btn-sm  dropdown-toggle" type="button" id="dropdownMenuMenu" data-toggle="dropdown"
    aria-haspopup="true" aria-expanded="false">
    ...
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuMenu">
   <!-- Material switch -->
<div class="switch">
  <label>
    
    <input  type="checkbox" :checked="item.estado == 1" v-on:change="updateState(item)">
    <span class="lever"></span> 
  </label>
</div>
   <button type="button"  class="btn btn-warning btn-sm btn-rounded waves-effect waves-light" v-on:click="alerta(item)"><i class="waves-effect mdb-icon-copy fas fa-edit pr-2 pt-1" aria-hidden="true"></i></button>
 <button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light" v-on:click.prevent="destroy(item.id)"><i class="waves-effect mdb-icon-copy fas fa-trash pr-2 pt-1" aria-hidden="true"></i></button>
  </div>
</div>
        
       </td>
     
    </tr>
   
  </tbody>
    
  
</table>
              </div>
             
          </div>


          <!--MODAL-->
         

<!-- Central Modal Small -->
<div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-lg" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Actualizar Grupo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="" @submit.prevent="update()" ref="formUpdate">
      <div class="modal-body">
          <!-- Name -->
         
    <input name="nombre" v-model="item.nombre" type="text" id="defaultSubscriptionFormPassword" class="form-control mb-4" placeholder="Nombre">
     <div >
                    <div class="p-2 ">
                           <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
  </div>
  <div class="custom-file">
    <input ref="fileUpdate" type="file" class="custom-file-input" id="inputGroupFile02"
      aria-describedby="inputGroupFileAddon01" accept="image/*" >
    <label class="custom-file-label" for="inputGroupFile01">Elegir imagen 128*128px</label>
  </div>
</div>
                    </div>
                  


              </div>
    
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal" v-on:click.prevent="item.image = null">Cancelar</button>
        <button type="submit" class="btn btn-primary btn-md" >Guardar Cambios</button>
        
      </div>
      </form>
     
    </div>
  </div>
</div>
<!-- Central Modal Small -->
          <!--FIN-MODAL-->

        


</div>
  </div>

  </main>
</template>

<script>
export default {
    mounted()
    {
        this.llenar()
      
    },
    data ()
    {
        return {
            grupos: {},
            nombre: '',
            file: false,
            item: {id: Number, nombre: String},
            status: "",
            switchValue: true,
        
            
        }
    },
    methods:
    {
       insert()
        {
            if(this.nombre && this.$refs.file.files[0])
            {
              
              let formdata = new FormData();
              formdata.append('nombre',this.nombre)
              formdata.append('file',this.$refs.file.files[0])

              axios.post('./groups',formdata)
              .then(response => (toastr.success(response.data),this.$refs.form.reset(),this.llenar()))
              .catch(error => (toastr.error('La imagen no cumple con las medidas')));

            }
           
        },
                update(){
           
           
           
               if(this.item.nombre)
            {
              let formdata = new FormData();
              formdata.append('nombre',this.item.nombre)
              formdata.append('file',this.$refs.fileUpdate.files[0])
              formdata.append('_method','PUT')

              axios.post('./groups/'+this.item.id,formdata)
              .then(response => (toastr.success(response.data), this.llenar(),this.$refs.formUpdate.reset()))
              .catch(error => (toastr.error('Algo salio mal')));

              $("#centralModalSm").modal('hide')       
    
    
            }     

           
        },
        updateState(item)
        {
              let formdata = new FormData();
              formdata.append('id',item.id)         
              formdata.append('_method','PUT')

              axios.post('./groups/'+0,formdata)
              .then(response => (toastr.success(response.data), this.llenar()))
              .catch(error => (toastr.error('Algo salio mal')));

              $("#centralModalSm").modal('hide')      
        },
        
        destroy(id)
        {   
          
          if(confirm('¿Estas Seguro?'))
          {
               axios.delete('./groups/'+id)
               .then(response => (toastr.info(response.data),this.llenar()))
              
          }
           
        },
      
        
      alerta(item)
    {
      
      this.item.nombre = item.nombre
      
      this.item.id = item.id

     
      $("#centralModalSm").modal('show')

    },
        llenar()
        {
          
          try {
             
            const response =  axios.get("./groups").then(response => (this.grupos = response.data));
           
        } catch (error) {
            
            if (error.response) {
        /*
         * The request was made and the server responded with a
         * status code that falls out of the range of 2xx
         */
        console.log(error.response.data);
        console.log(error.response.status);
        console.log(error.response.headers);
    } else if (error.request) {
        /*
         * The request was made but no response was received, `error.request`
         * is an instance of XMLHttpRequest in the browser and an instance
         * of http.ClientRequest in Node.js
         */
        console.log(error.request);
    } else {
        // Something happened in setting up the request and triggered an Error
        console.log('Error', error.message);
    }
    console.log(error);
        }
        }

    },
    
    
}
</script>