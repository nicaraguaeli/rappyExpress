<template>
 <!-- Main layout -->
  <main>
    <div class="container ">
        
        <div class="card">
          <div class="card-header grey lighten-2">
            Ingreso de categorias
          </div>
          <form ref="form" >
        <div class="row">
          <!--Col-->
           
              <div class="col-sm-6">
                    
                 <div class="p-2">
                       <div class="md-form ">
  <input type="text" id="nombre" class="form-control" v-model="product.nombre">
  <label for="nombre">Nombre</label>
</div>
                 </div>
                   
                       
                 

              </div>
          <!--Fin-col-->
          
          <!--col-->
            <div class="col-sm-6">
                    
                 <div class="p-2">
                       <div class="md-form input-group">
   <div class="input-group-prepend">
              <span class="input-group-text md-addon">C$</span>
            </div>
            <input v-model="product.precio" type="number" class="form-control pl-0 rounded-0" id="example-number-input" placeholder="Precio">
</div>
                 </div>
                   
                       
                 

              </div>
          <!--fin-col-->
         
            

             

               <div class="col-sm-6 align-self-center">
                    <div class="p-2 ">
                           <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
  </div>
  <div class="custom-file">
    <input ref="file" type="file" class="custom-file-input" id="inputGroupFile01"
      aria-describedby="inputGroupFileAddon01" accept="image/*" v-on:change="fileChange">
    <label class="custom-file-label" for="inputGroupFile01">Elegir imagen 400*400px</label>
  </div>
</div>
                    </div>
                  


              </div>
                <!--Col-->
           
              <div class="col-sm-6">
                    
                 <div class="p-2">
                       <div class="md-form ">
  <input type="text" id="presentacion" class="form-control" v-model="product.presentacion">
  <label for="presentacion">Presentacion</label>
</div>
                 </div>
                   
                       
                 

              </div>
          <!--Fin-col-->
          <div class="col">
            <img width="128px"  :src="url" class="rounded mx-auto d-block" alt="">
          </div>
          <!--col-->
          <!--fin-col-->
              <div class="col-md-12 form-group">
                <label class="ml-2 " for="">Seleccionar categoria</label>
                <select ref="optionSelected" class="form-control mb-2" >
          <option v-for="item in categories" :key="item.id" v-text="item.nombrec" :value="item.id" ></option>
    </select>
    
              </div>
              <div class="col-sm-12">
                    
                    <div class=" md-form mb-1">
                        <button :disabled="product.nombre == ''" type="button" class="btn btn-light" v-on:click.prevent="insert()">Agregar</button>
                       
                    </div>


              </div>
             
         
        </div>
        </form>



        


</div>
<div class="card mt-3">
  <div class="card-header grey lighten-2">
            Mis productos
          </div>
          <!--table-->
                <div class="row">
              <div class="col-sm-12">
                    <table class="table text-center table-responsive">
  <thead class="black white-text">
    <tr>
      <th scope="col">#</th>
      <th scope="col">IMG</th>
      <th scope="col">PRODUCTO</th>
      <th scope="col">CATEGORIA</th>
      <th scope="col">PRECIO</th>
      <th scope="col">PRESENTACION</th>
      <th scope="col">ACCION</th>
     
    </tr>
  </thead>
   <tbody>
   
    <tr v-for="(item, index) in products" :key="index">
      <th scope="row" v-text="index+1"></th>
      <td ><img width="64px" :src="item.imagen" :alt="item.nombrep"></td>
       <td v-text="item.nombrep"></td>
      <td v-text="item.nombrec"></td>
       <td v-text="'C$ '+item.precio"></td>
        <td v-text="item.presentacion"></td>
         
      <td><div class="dropdown">
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
</div></td>
      
    </tr>
   
  </tbody>
    
  
</table>


              </div>
             
          </div>
          <!--fin-table-->


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
        <h4 class="modal-title w-100" id="myModalLabel">Actualizar articulo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="reset">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="" @submit.prevent="update()" ref="formUpdate">
      <div class="modal-body">
          <!-- Name -->
        
        <div class="md-form">
        <input name="nombre" v-model="itemUpdate.nombre" type="text"  class="form-control mb-4" placeholder="Nombre">
        <label for="nombre" class="active">Nombre</label>
         </div>
          <div class="md-form">
            
        <input name="Presentacion" v-model="itemUpdate.presentacion" type="text"  class="form-control mb-4" placeholder="Presentacion">
        <label for="presentacion" class="active">Presentacion</label>
         </div>
          
                    
                 
                       <div class="md-form input-group">
   <div class="input-group-prepend">
              <span class="input-group-text md-addon">C$</span>
            </div>
            
            <input v-model="itemUpdate.precio" type="number" class="form-control pl-0 rounded-0"  placeholder="Precio">
            <label for="presentacion" class="active">Precio</label>
</div>
                   
                       
                 

            
      
    
    
       
       <select ref="optionSelected" class="form-control mb-4" >
      <option v-for="items in categories" :key="items.id" v-text="items.nombrec" :value="items.id" :selected="items.nombrec == itemUpdate.nombrec"></option>
    </select>
      <!--Fin-col-->
          <div class="col">
            <img width="128px"  :src="urlUpdate" class="rounded mx-auto d-block" alt="">
          </div>
          <!--col-->
     <div >
                    <div class="p-2 ">
                           <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
  </div>
  <div class="custom-file">
    <input ref="fileUpdate" type="file" class="custom-file-input" id="inputGroupFile02"
      aria-describedby="inputGroupFileAddon01" accept="image/*" v-on:change="fileChangeUpdate" >
    <label class="custom-file-label" for="inputGroupFile01">Elegir imagen 400*400px</label>
  </div>
</div>
                    </div>
                  


              </div>
    
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal" v-on:click="reset">Cancelar</button>
        <button type="submit" class="btn btn-primary btn-md" >Guardar Cambios</button>
        
      </div>
      </form>
     
    </div>
  </div>
</div>
<!-- Central Modal Small -->
          <!--FIN-MODAL-->
  

  </main>

</template>

<script>

export default {
    data ()
    {
        return{
            categories: {},
            product:[
                {nombre: String, precio: Number,categoria: Number, presentacion: String}
            ],
            products: [],
            itemUpdate:  {id: Number, nombre: String, nombrec: String, precio: Number,categoria: Number, presentacion: String, imagen: undefined},
            path: '',
            url: '',
            urlUpdate: '',
        }
    },
    
    mounted()
    {
         axios.get('./categoria').then(response => (this.categories = response.data))
         this.fillProduct()
        
    },
    methods:
    {
         insert()
         {
             
             if(this.checkForm())
             {

             let formData = new FormData();
             formData.append('nombre', this.product.nombre)
             formData.append('precio', this.product.precio)
             formData.append('presentacion', this.product.presentacion)
             formData.append('categoria', this.$refs.optionSelected.value)
             formData.append('file', this.$refs.file.files[0])

             axios.post('./producto',formData).then(response => (toastr.success(response.data), this.product = [], this.$refs.form.reset(),this.fillProduct(), this.url=null)).catch(error => (toastr.error("La imagen no cumple las medidas")))
             }
             else
             {
               toastr.error("Uno de los campos esta vacio")
             }


    
         },
          update(){
           
           
           
               if(this.itemUpdate.nombre && this.$refs.optionSelected.value && this.itemUpdate.precio && this.itemUpdate.presentacion)
            {
              let formdata = new FormData();
              formdata.append('nombre',this.itemUpdate.nombre)
              formdata.append('precio',this.itemUpdate.precio)
              formdata.append('presentacion',this.itemUpdate.presentacion)
              formdata.append('idcategoria',this.$refs.optionSelected.value)
              formdata.append('file',this.$refs.fileUpdate.files[0])
              formdata.append('_method','PUT')

              axios.post('./producto/'+this.itemUpdate.id,formdata)
              .then(response => (toastr.success(response.data), this.fillProduct(),this.$refs.formUpdate.reset()))
              .catch(error => (toastr.error('Algo salio mal')));

              $("#centralModalSm").modal('hide')       
       
            }     

           
        },
          updateState(item)
        {
              let formdata = new FormData();
              formdata.append('id',item.id)         
              formdata.append('_method','PUT')

              axios.post('./producto/'+0,formdata)
              .then(response => (toastr.success(response.data), this.fillProduct()))
              .catch(error => (toastr.error('Algo salio mal')));

              $("#centralModalSm").modal('hide')      
        },
         destroy(id)
        {   
          
          if(confirm('¿Estas Seguro?'))
          {
               axios.delete('./producto/'+id)
               .then(response => (toastr.info(response.data),this.fillProduct()))
              
          }
           
        },
         checkForm()
         {
           if(this.product.nombre && this.product.precio && this.product.presentacion && this.$refs.optionSelected.value)
           {
             return true
           }
           else
           {
            return false
           }   
                
               
          },
          reset: function()
          {
             this.$refs.formUpdate.reset()
          },
          fileChange: function(e)
          {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
          },
           fileChangeUpdate: function(e)
          {
            const file = e.target.files[0];
            this.urlUpdate = URL.createObjectURL(file);
          },
          fillProduct()
         {
            axios.get('./producto/').then(response => (this.products = response.data ))
         },
         alerta(item)
    {
      
      this.itemUpdate.nombre = item.nombrep
      this.itemUpdate.nombrec = item.nombrec
      this.itemUpdate.precio = item.precio
      this.itemUpdate.id = item.id
      this.urlUpdate = item.imagen
      this.itemUpdate.presentacion = item.presentacion
      this.itemUpdate.id = item.id
     
      $("#centralModalSm").modal('show')

    },
         
         },
         
         
          

         
    
  
    
    
}
</script>