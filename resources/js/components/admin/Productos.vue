<template>
 <!-- Main layout -->
  <main>
    <div class="container-fluid">
       
       

       </div>
      <div class="card text-center mb-5 py-5">

        <div class="card-body">
         <div class="row">
           <div class="col-sm-6">
             <div> <h4 class="mb-4 dark-grey-text font-weight-bold"><strong>Agregar Producto</strong></h4>
</div>
           </div>
           <div class="col-sm-6">
                <router-link :to="{name: 'listaproductos'}" class="waves-effect">Lista de productos</router-link>
           </div>
         </div>

         
        <div class="form-row mb-3 ">
            <div class="col-md-6 md-form input-group mb-3">
                <input v-model="product.nombre" type="text"  class="form-control" placeholder="Nombre">
            </div>
            <div class="col-md-6 md-form input-group mb-3">
               
            <div class="input-group-prepend">
              <span class="input-group-text md-addon">C$</span>
            </div>
            <input v-model="product.precio" type="number" class="form-control pl-0 rounded-0" id="example-number-input" placeholder="Precio">
         
            </div>
        </div>

         <div class="form-row mb-3 ">
            <div class="col-md-6 md-form input-group">
               
            <div class="custom-file">
    <input  name="imagen" ref="file"  type="file" class="custom-file-input form-control" id="inputGroupFile02" 
      aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01">Seleccionar imagen 400*400px</label>
  </div>
            </div>
            
              <div class="col-md-6 md-form input-group mb-3">
                <input v-model="product.presentacion" type="text"  class="form-control" placeholder="Presentacion">
            </div>
           
        </div>

         <div class="form-row md-form select-group mb-3 ">
            <div class="col-md-6">
               <span>Categoria</span>
               <select  v-model="product.categoria" class="form-control mb-4" >
                 
                  <option v-for="item in categories" :key="item.id" v-text="item.nombrec" :value="item.id"></option>
                </select>
            </div>
            <div class="col-md-6 md-form">
              <button  type="button" class="btn btn-blue-grey waves-effect waves-light" v-on:click="insert()">Guardar</button>
            </div>
        </div>


          

        </div>

      </div>

      

    </div>
  </main>
  <!-- Main layout -->
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
            path: '',
        }
    },
    mounted()
    {
        axios.get('./categoria').then(response => (this.categories = response.data))
        
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
             formData.append('categoria', this.product.categoria)
             formData.append('file', this.$refs.file.files[0])

             axios.post('./producto',formData).then(response => (toastr.success(response.data), this.product = [], this.$refs.file.value = "")).catch(error => (console.log(error.data)))
             }
             else
             {
               toastr.error("Uno de los campos esta vacio")
             }


    
         },
         checkForm()
         {
           if(this.product.nombre && this.product.precio && this.product.presentacion && this.product.categoria)
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