<template>
<!-- Main layout -->
  <main>
    <div class="container-fluid">
        
        <div class="card">
          <div class="card-header grey lighten-2">
            Ingreso de categorias
          </div>
          <form ref="form" >
        <div class="row">
        
         
         
              <div class="col-sm-6">
                    
                 <div class="p-2">
                       <div class="md-form ">
  <input type="text" id="nombre" class="form-control" v-model="item.nombre">
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
              <div class="col-md-12 form-group">
                <label class="ml-2 " for="">Seleccionar grupo</label>
                <select ref="optionSelected" class="form-control mb-2" >
          <option v-for="items in groups" :key="items.id" v-text="items.nombre" :value="items.id" ></option>
    </select>
    
              </div>
              <div class="col-sm-12">
                    
                    <div class=" md-form mb-1">
                        <button :disabled="item.nombre == ''" type="button" class="btn btn-light" v-on:click.prevent="insert()">Agregar</button>
                       
                    </div>


              </div>
             
         
        </div>
        </form>
          <div class="row">
              <div class="col-sm-12">
                    <table class="table text-center">
  <thead class="black white-text">
    <tr>
      <th scope="col">#</th>
      <th scope="col">IMAGEN</th>
      <th scope="col">CATEGORIA</th>
      <th scope="col">GRUPO</th>
      <th scope="col">MOSTRAR</th>
      <th scope="col">EDITAR</th>
      <th scope="col">ELIMINAR</th>
    </tr>
  </thead>
  <tbody>
   
    <tr v-for="(item, index) in categorias" :key="index">
      <th scope="row" v-text="index+1"></th>
      <td ><img :src="item.imagen" :alt="item.nombre"></td>    
      <td v-text="item.nombrec"></td>
      <td v-text="item.nombreg"></td>
      <td><!-- Material switch -->
<div class="switch">
  <label>
    
    <input  type="checkbox" :checked="item.estado == 1" v-on:change="updateState(item)">
    <span class="lever"></span> 
  </label>
</div></td>
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
        <h4 class="modal-title w-100" id="myModalLabel">Actualizar categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="" @submit.prevent="update()" ref="formUpdate">
      <div class="modal-body">
          <!-- Name -->
      
        <input name="nombre" v-model="item.nombre" type="text" id="defaultSubscriptionFormPassword" class="form-control mb-4" placeholder="Nombre">
      
    
    
       
       <select ref="optionSelected" class="form-control mb-4" >
      <option v-for="items in groups" :key="items.id" v-text="items.nombre" :value="items.id" :selected="items.nombre == item.nombreg"></option>
    </select>
     
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
            categorias: {},
            groups: {},
            item: {id: Number, nombre: "", nombreg: String, imagen: null},
            status: "",
        
            

        }
    },
    methods:
    {
       insert()
        {
            if(this.item.nombre && this.$refs.file.files[0] && this.$refs.optionSelected.value)
            {
              
              let formdata = new FormData();
              formdata.append('nombre',this.item.nombre)
              formdata.append('idgrupo',this.$refs.optionSelected.value)
              formdata.append('file',this.$refs.file.files[0])

              axios.post('./categoria',formdata)
              .then(response => (toastr.success(response.data),this.$refs.form.reset(),this.llenar()))
              .catch(error => (toastr.error('La imagen no cumple con las medidas')));

            }
           
        },
        update(){
           
           
           
               if(this.item.nombre && this.$refs.optionSelected.value)
            {
              let formdata = new FormData();
              formdata.append('nombre',this.item.nombre)
              formdata.append('idgrupo',this.$refs.optionSelected.value)
              formdata.append('file',this.$refs.fileUpdate.files[0])
              formdata.append('_method','PUT')

              axios.post('./categoria/'+this.item.id,formdata)
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

              axios.post('./categoria/'+0,formdata)
              .then(response => (toastr.success(response.data), this.llenar()))
              .catch(error => (toastr.error('Algo salio mal')));

              $("#centralModalSm").modal('hide')      
        },
        
        destroy(id)
        {   
          
          if(confirm('¿Estas Seguro?'))
          {
               axios.delete('./categoria/'+id)
               .then(response => (response = (toastr.info(response.data)),this.llenar(),this.llenar()))
              
          }
           
        },
       
        
        alerta(item)
    {
      
      this.item.nombre = item.nombrec
      this.item.nombreg = item.nombreg
      this.item.imagen = item.imagen
      this.item.id = item.id

     
      $("#centralModalSm").modal('show')

    },
        llenar()
        {
          
            
            
            
            axios.get('./groups').then(response => (this.groups = response.data));

            axios.get('./categoria').then(response => (this.categorias = response.data));
            
           
        

    },
    }
    
    
}
</script>