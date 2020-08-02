<template>
    <div>
          
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <!-- Editable table -->
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Lista de productos</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Nombre</th>
            <th class="text-center">Precio</th>
            <th class="text-center">Presentacion</th>
           
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in product" :key="item.id">
            <td  class="pt-3-half" contenteditable="true" v-text="item.nombre"></td>
            <td  class="pt-3-half" contenteditable="true" v-text="item.precio"></td> 
            <td  class="pt-3-half" contenteditable="true" v-text="item.presentacion"></td>                  
            <td>
              <span class="table-remove"><button type="button"
                  class="btn btn-danger btn-rounded btn-sm my-0" v-on:click="destroy(item.id)">Eliminar</button></span>
            </td>
          </tr>
          <!-- This is our clonable table line -->
          
        
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Editable table -->
                  </div>
              </div>
          </div>

    </div>
</template>
<script>
export default {
        data()
        {
            return {
                product: {}
            }
        },
        mounted()
        {
            this.fill()
        },
        methods:
        {
            destroy(id)
            {
                if(confirm('¿Estas Seguro?'))
          {
                axios.delete('./producto/'+id)
               .then(response => (          
                toastr.success(response.data),this.fill()))
              
          }
            },
            fill()
            {   
                axios.get('./producto').then(response => (this.product = response.data ))
            }
        }
        
}
</script>