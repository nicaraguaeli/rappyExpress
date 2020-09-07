<template>
    
    <div class="container p-0 wow animated fadeInLeft">

<!--GRUPOS-->
<ul class="nav nav-tabs grey lighten-4   " id="myTab" role="tablist">
      <li class="nav-item" v-for="(item, index) in items" :key="index">
    
    <a class="nav-link green-text font-weight-bold" v-bind:class="{active: index == 0}" id="home-tab" data-toggle="tab" :href="'#'+item.nombre" role="tab" aria-controls="home"
      aria-selected="true" v-text="item.nombre"></a>
  </li>
  
</ul>

<!--FIN-GRUPOS--> 

 



<!--CONTENT-TAB-->
<div class="tab-content bg-white" id="myTabContent"  style="height: calc(100vh - 80px); overflow: scroll;">
  
 <div class="row" v-if="state">
        <div class="pr-md-2 mb-3 col-sm-4 ">
          <vue-content-loading :height="180">
           <rect x="0 " y="13" rx="10" ry="10" width="100%" height="180" />
            </vue-content-loading>
        </div>
        <div class="pr-md-2 mb-3 col-sm-4 ">
          <vue-content-loading :height="180">
           <rect x="0 " y="13" rx="10" ry="10" width="100%" height="180" />
            </vue-content-loading>
        </div>
        <div class="pr-md-2 mb-3 col-sm-4 ">
          <vue-content-loading :height="180">
           <rect x="0 " y="13" rx="10" ry="10" width="100%" height="180" />
            </vue-content-loading>
        </div>
    </div>     
  

  <div v-for="(item, index) in items" :key="index" class="tab-pane fade show " v-bind:class="{active: index == 0}" :id="item.nombre" role="tabpanel" aria-labelledby="home-tab" >
  
 <!-- Grid column -->
    
   
                <div class="row">
                     <div v-for="item2 in item.categories" :key="item2.id" class="   pr-md-2 mb-3 col-sm-4 ">
                <router-link :to="{name: 'items',params:{id: item2.id}}" class="black-text" >
                <div :title="item2.nombre" class="card  mr-3 cloudy-knoxville-gradient mask rgba-white-slight waves-effect waves-light"  :data-wow-delay="'0.'+(delay)+'s'"  >
                  
                  <div class="card-body p-0">
                    <div class="d-flex">

                          <div class="view float-left mr-3 " style="min-width: 128px;">
                      <img :src="item2.imagen" class="img-responsive  " style="border-radius: 1rem 0 0 1rem;">
                      <a href="#!">
                        <div class=" rounded-left waves-effect waves-light"></div>
                      </a>
                    </div>
                    
                          <div class="pt-3 pr-3 align-self-center ">
                      <h6 class="font-weight-bold " style=" font-size: 1rem;" v-text="item2.nombre"></h6> 
                    </div>
                   
                    

                    </div>
                
                 
                     
                  </div>
                </div>
                </router-link>

              </div>
                </div>
             
              <!-- Grid column -->
    
  </div>
 
</div>
<!--FIN-TAB-->
     
      
     
      
  
    
  
   
    

  
  
    </div>
    
  
 
</template>
<script>
import VueContentLoading from 'vue-content-loading';
export default {
   
     mounted () {

       if (localStorage.getItem('items')) {
      try {
        this.state = false
        this.items = JSON.parse(localStorage.getItem('items'));
      } catch(e) {
        localStorage.removeItem('items');
      }
    }
    else
    {
      axios
      .get('./categories/list')
      .then(response => {
        if(response.status == 200 )
        {
          this.state = false
          this.items = response.data
        }
      })
      .catch(error => (console.log(error.response)))
    }

    
   

  },
    components:
  {
     VueContentLoading,
  },
    data () {
    return {
      items: Array,
      state: true,
      delay: 1,
      elemento: []
      
      
      
    }
  },
  created()
  {
    setInterval(() => {
     
     axios
      .get('./categories/list')
      .then(response => {
        if(response.status == 200 )
        {
          
          this.items = response.data

        }
      })
      .catch(error => (console.log(error.response)))

    },10000)
  },
  
  watch: {
    
    items()
    {
      const parsed = JSON.stringify(this.items);
      localStorage.setItem('items', parsed);
    }
  }

 
}
</script>

<style lang="scss" scoped>
  
  .card
  {
    border-radius: 1rem 0 0 1rem; 
    border-bottom: 1px solid #00c853!important;
    
  }
</style>