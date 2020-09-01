<template>
   <div >
     <div class="grey special-color-dark  animated wow slideInUp faster" style="height: 3rem;" >
           <div class="d-flex p-2">
             <div class="col-3 col-md-4 align-self-center" ><router-link :to="{name: 'home'}" ><i class="fas fa-chevron-left mr-2 text-white"></i><span class="text-white ml-1">atras</span></router-link>
             </div>
             <div class="col-4 col-md-4 align-self-center text-white font-weight-bold" >Pend        
             </div>
            <div class="col-5 col-md-4"><!-- Search form -->
<form class="form-inline d-flex justify-content-center   mt-0" >
 
  <input id="search" class="form-control form-control-sm ml-3 w-75   rounded-pill" type="text" placeholder="¿Que buscas?"
    aria-label="Search">
</form>
<!-- Search form -->
</div>
           </div> 
     </div>    
     
       <div class="wow animated slideInLeft faster " >

    <div class=" cloudy-knoxville-gradient " >
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
    <div class="row animated fadeIn m-0  " id="myList" style="height: calc(100vh - 80px); overflow: scroll; pb-5" >



<!-- Grid column -->
<div class="col-6 col-md-3 p-0 list-card " v-for="item in productos" :key="item.id" :title="item.nombre">

  <!-- Card -->
  <div class="card card-ecommerce  p-2 wow fadeIn animated"  style="box-shadow: none !important;">

    <!-- Card image -->
    <div class="view overlay " >

      
      <vue-image-loader class="text-center">
      <img slot="image" :src="item.imagen" class="img-fluid " :alt="item.nombre"/>
      <img slot="preloader" src="img/DualRing.gif" class="img-fluid  "/>
      <div slot="error"> <img  src="img/placeholder.jpg" class="img-fluid  "/></div>
      </vue-image-loader>
      <a>

        <div class="mask rgba-white-slight waves-effect waves-light"></div>

      </a>
<span class="badge badge-danger mb-2 p-2 rounded-lg" style="transform: translateY(-39px); position: absolute;" v-text="item.presentacion"></span>
    </div>
    
    <!-- Card image -->

    <!-- Card content -->
    <hr class="m-0">
    <div class="card-body    text-black d-flex flex-column  p-0 pt-2 rounded-lg">

      <!-- Category & Title -->
      <h6 class=" mb-1 ml-1  text-uppercase " v-text="item.nombre"> </h6> 

    <p class="mb-0 ml-1" style="font-size: 0.7rem;"> <span class="float-left " >C$ {{item.precio | formato}}  </span> </p>

      
      <!-- Card footer -->
     
       

        
        <div class="add product green accent-4 p-1 text-center mask waves-effect waves-light rgba-white-slight rounded-sm" v-on:click="enviarpadre(item)">
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
  
  
  
   
  methods:{
      
      enviarpadre: function(item)
      {
         
         
        
          this.$emit('cartItem',item)
          
          
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
      .get('./prueba/'+this.$route.params.id)
      .then(response => (this.productos =  response.data, this.state = false) )
     
}
  
}
 
</script>