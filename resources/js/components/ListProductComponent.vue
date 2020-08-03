<template>
    
    <div >

<!--GRUPOS-->
<ul class="nav nav-tabs grey lighten-4 mt-2" id="myTab" role="tablist">
      <li class="nav-item" v-for="(item, index) in info" :key="index">
    
    <a class="nav-link text-muted" v-bind:class="{active: index == 0}" id="home-tab" data-toggle="tab" :href="'#'+item.nombre" role="tab" aria-controls="home"
      aria-selected="true" v-text="item.nombre"></a>
  </li>
  
</ul>

<!--FIN-GRUPOS--> 

<!--CONTENT-TAB-->
<div class="tab-content bg-white" id="myTabContent" style="height: 70vh; overflow: scroll;">
  <div v-for="(item, index) in info" :key="index" class="tab-pane fade show " v-bind:class="{active: index == 0}" :id="item.nombre" role="tabpanel" aria-labelledby="home-tab" >
  
 <!-- Grid column -->
             
 
                <div class="row">
                     <div v-for="item2 in item.categories" :key="item2.id" class="   pr-md-2 mb-3 col-sm-4 ">

                <div :title="item2.nombre" class="card  wow bounceIn animated mr-3 cloudy-knoxville-gradient mask rgba-white-slight waves-effect waves-light"  :data-wow-delay="'0.'+(delay)+'s'" v-on:click="enviarid(item2.id,item.nombre,item2.nombre)" >
                  
                  <div class="card-body p-0">
                    <div class="d-flex">

                          <div class="view float-left mr-3 " style="min-width: 128px;">
                      <img :src="item2.imagen" class="img-responsive rounded-left " >
                      <a href="#!">
                        <div class=" rounded-left waves-effect waves-light"></div>
                      </a>
                    </div>
                    
                          <div class="pt-3 pr-3 align-self-center ">
                      <h6 class="font-weight-bold " style=" font-size: 1.3rem;" v-text="item2.nombre"></h6> 
                    </div>
                   
                    

                    </div>
                
                 
                     
                  </div>
                </div>

              </div>
                </div>
             
              <!-- Grid column -->
    
  </div>
 
</div>
<!--FIN-TAB-->
     
      
     
      
  
    
  
   
    

  
  
    </div>
    
  
 
</template>
<script>
export default {
    data () {
    return {
      info: Array,
      delay: 1,
      elemento: []
      
      
      
    }
  },
    mounted () {
    axios
      .get('./prueba')
      .then(response => (this.info =  response.data))
  },
  methods:
  {
    enviarid(itemID, itemNombre, itemCategoria)
    {
        this.$emit('recibirid',itemID, itemNombre, itemCategoria)
        ;
       
    },
    indice(val)
    {
     
    }
   
  }
  
}
</script>