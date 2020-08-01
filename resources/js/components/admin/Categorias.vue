<template>
<div class="container">
       
        <div class="row">
              <div class="col-sm-12">
                    
                    <div class="md-form input-group mb-3">
                        <input  v-model="item.nombre" type="text" class="form-control" placeholder="Agregar nueva categoria" aria-label="Agregar Categoria"
                        aria-describedby="MaterialButton-addon2">
                       
                    </div>


              </div>
              <div class="col-sm-12 mb-2 mt-2">
                  <form action=""> 
                  <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
  </div>
  <div class="custom-file">
    <input ref="file"  type="file" class="custom-file-input" id="inputGroupFile01"
      aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01">Seleccionar imagen</label>
  </div>
</div>
 
                        <button class="btn btn-md btn-secondary m-0 px-3 w-100 pb-2" type="button" v-on:click.prevent="insert()" id="MaterialButton-addon2">AGREGAR</button>
                         </form>
                </div>
         
        </div>
          <div class="row">
              <div class="col-sm-12">
                    <table class="table text-center">
  <thead class="black white-text">
    <tr>
      <th scope="col">#</th>
      <th scope="col">IMAGEN</th>
      <th scope="col">CATEGORIA</th>
      <th scope="col">GRUPO</th>
      <th scope="col">EDITAR</th>
      <th scope="col">ELIMINAR</th>
    </tr>
  </thead>
  <tbody>
   
    <tr v-for="item in categorias" :key="item.id">
      <th scope="row" v-text="item.id"></th>
      <td > <img :src="item.imagen" :alt="item.nombrec"></td>
      <td v-text="item.nombrec"></td>
      <td v-text="item.nombreg"></td>
     
      <td><button type="button"  class="btn btn-warning btn-large btn-rounded waves-effect waves-light" v-on:click="alerta(item)"><i class="waves-effect mdb-icon-copy fas fa-edit pr-2 pt-1" aria-hidden="true"></i></button></td>
      <td><button type="button" class="btn btn-danger btn-large btn-rounded waves-effect waves-light" v-on:click.prevent="destroy(item.id)"><i class="waves-effect mdb-icon-copy fas fa-trash pr-2 pt-1" aria-hidden="true"></i></button></td>
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
        <h4 class="modal-title w-100" id="myModalLabel">Actualizar Categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="" @submit.prevent="update()">
      <div class="modal-body">
          <!-- Name -->
         
    <input name="nombre" v-model="item.nombre" type="text" id="defaultSubscriptionFormPassword" class="form-control mb-4" placeholder="Nombre">
    
    <select ref="optionSelected" class="form-control mb-4" >
      <option v-for="items in groups" :key="items.id" v-text="items.nombre" :value="items.id" :selected="items.nombre == item.nombreg"></option>
    </select>
    <img :src="item.imagen" >
    <div class="custom-file">
    <input  name="imagen" ref="fileUpdate"  type="file" class="custom-file-input" id="inputGroupFile02" 
      aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01">Seleccionar imagen 128*128px</label>
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

          <!-- Side Modal Top Right -->

<!-- Button trigger modal -->


<!-- To change the direction of the modal animation change .right class -->
<div class="modal fade right" id="sideModalTR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side modal-top-right" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Estado</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p v-text="status"></p>
      </div>
      
    </div>
  </div>
</div>
<!-- Side Modal Top Right -->
  </div>
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
            categorias: {},
            groups: {},
            item: {id: Number, nombre: String, nombreg: String, imagen: null},
            status: "",
        
            

        }
    },
    methods:
    {
        destroy(id)
        {   
          
          if(confirm('¿Estas Seguro?'))
          {
               axios.delete('/deliveryApp/public/categoria/'+id)
               .then(response => (this.status = response.data,           
                $('#sideModalTR').modal('show'),this.llenar()))
              
          }
           
        },
        update(){
           
           
           let formData = new FormData()
           formData.append("nombre", this.item.nombre)
           formData.append("file", this.$refs.fileUpdate.files[0])
           formData.append("group_id",this.$refs.optionSelected.value)
           formData.append('_method', 'PUT');
          
           
          

          axios.post('http://localhost/deliveryApp/public/categoria/'+this.item.id, formData, { // <== use axios.post
         
         headers: {
        'Content-Type': 'multipart/form-data; }'
      }                   // <== add this field
    })
    .then(response => (this.status = response.data,$('#sideModalTR').modal('show'),this.llenar() ) )
    .catch(function (error) {
         console.log(error);            
    });
       
    $("#centralModalSm").modal('hide')   
    
               
               
         
               
           
          

           
        },
        insert()
        {
            let formData = new FormData();
            formData.append('file',this.$refs.file.files[0])
            formData.append('nombre',this.nombre)
            formData.append('_method','post')

            axios.post( 'http://localhost/deliveryApp/public/categoria/',formData,
  {
    headers: {
        'Content-Type': 'multipart/form-data'
    }
  }
).then(response => (console.log(response.data)))
.catch(function(){
  console.log('FAILURE!!');
});


        },
        
        alerta(item)
    {
      
      this.item.nombre = item.nombrec
      this.item.nombreg = item.nombreg
      this.item.imagen = item.imagen
      this.item.id = item.id

      console.log(this.item)
      $("#centralModalSm").modal('show')

    },
        llenar()
        {
          
          try {
             
            
            
            axios.get('/deliveryApp/public/groups').then(response => (this.groups = response.data));
            const response =  axios.get('/deliveryApp/public/categoria').then(response => (this.categorias = response.data));
            
           
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