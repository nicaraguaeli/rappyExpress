<template>
    <div >
       
         <nav aria-label="breadcrumb animated fadeIn fixed" class=" grey lighten-4 text-muted">
  <ol class="breadcrumb m-0 mt-2" style="background-color: transparent;">
    <li class="breadcrumb-item inicio " style="background-color: transparent;"><a  ><i class="fas fa-chevron-left mr-2"></i>
    <b>Atras</b>
    </a></li>
      <li class="breadcrumb-item active  text-muted" v-text="nombre"></li>
      <li class="breadcrumb-item  text-muted" v-text="categoria"></li>
  </ol>
</nav>






    <div class="container p-1 cloudy-knoxville-gradient   " >
      <div v-if="state" >
  
      <div class="row">
        <div class="col-6 col-md-3  ">
          <vue-content-loading :height="500">
           <rect x="0 " y="13" rx="4" ry="4" width="100%" height="500" />
            </vue-content-loading>
        </div>
         <div class="col-6 col-md-3 ">
          <vue-content-loading :height="500" >
           <rect x="0" y="13" rx="4" ry="4" width="100%" height="500" />
            </vue-content-loading>
        </div>
         <div class="col-6 col-md-3 ">
          <vue-content-loading :height="500" >
           <rect x="0" y="13" rx="4" ry="4" width="100%" height="500" />
            </vue-content-loading>
        </div>
         <div class="col-6 col-md-3 ">
          <vue-content-loading :height="500" >
           <rect x="0" y="13" rx="4" ry="4" width="100%" height="500" />
            </vue-content-loading>
        </div>
      </div>
     
    
   
</div>
    <div class="row animated fadeIn m-0  " id="myList">



<!-- Grid column -->
<div class="col-6 col-md-3 p-0 list-card " v-for="item in productos" :key="item.id" :title="item.nombre">

  <!-- Card -->
  <div class="card card-ecommerce mr-2 mb-2 wow fadeIn animated"  >

    <!-- Card image -->
    <div class="view overlay " >

      
      <vue-image-loader class="text-center">
      <img slot="image" :src="item.imagen" class="img-fluid " :alt="item.nombre"/>
      <img slot="preloader" src="img/spin.gif" class="img-fluid  "/>
      <div slot="error">error image</div>
      </vue-image-loader>
      <a>

        <div class="mask rgba-white-slight waves-effect waves-light"></div>

      </a>
<span class="badge badge-danger mb-2 p-2 rounded-lg" style="transform: translateY(-39px); position: absolute;" v-text="item.presentacion"></span>
    </div>
    
    <!-- Card image -->

    <!-- Card content -->
    <div class="card-body  special-color-dark  text-white d-flex flex-column  p-0 pt-2 rounded-lg">

      <!-- Category & Title -->
      <h6 class=" mb-1 ml-1  text-uppercase " v-text="item.nombre"> </h6> 

    <p class="mb-0 ml-1" style="font-size: 0.7rem;"> <span class="float-left " >C$ {{item.precio | formato}}  </span> </p>

      
      <!-- Card footer -->
     
       

        
        <div class="add product green p-1 text-center mask waves-effect waves-light rgba-white-slight rounded-sm" v-on:click="enviarpadre(item)">
          <a  class=" text-white "  >

              <i :class="'fas fa-shopping-cart mr-1'" ></i>Agregar

                      </a>

        </div>
         
         
          

        

     

    </div>
    <!-- Card content -->

  </div>
  <!-- Card -->

</div>
<!-- Grid column -->






</div>

</div>


    </div>
    
</template>

<script>

import VueContentLoading from 'vue-content-loading';

export default {
  components:
  {
     VueContentLoading,
  },
  data () {
    return {
      
      counter: 1,
      state: true,
      productos: Array,
    
     
      
      
      
    }
  },
  
  props: 
  {
    
    
    nombre: String,
    categoria: String,
    idd: Number,
    
    
    
    
  },
  
   
  methods:{
      
      enviarpadre: function(item)
      {
         
         
        
          this.$emit('escucharhijo',item)
          
          
      },
  },
  filters: {
  
  formato: function (value) {
    
    return (parseFloat(value).toFixed(2));
  }
},
mounted ()
{
 
  
  axios
      .get('./prueba/'+this.$props.idd)
      .then(response => (this.productos =  response.data, this.state = false) )
     
}
  
}
 
</script>