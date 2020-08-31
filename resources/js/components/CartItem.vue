<template>
    <div  class="mb-3  ">
                <div  >

                       <div :title="article.nombre" class="card   cloudy-knoxville-gradient mask rgba-white-slight waves-effect waves-light"  >
                  
                  <div class="card-body p-0">
                     <div class="row">
                          <!--Col-->
                          <div class=" col-4">

                             <div class="view float-left  " style="width: 128px;">
                      <img  :src="article.imagen" class="img-fluid rounded-left " >
                    </div>
                        
                          </div>
                         <!--Fin-->

                         <!--Col-->
                         <div class=" col-5 pl-3">
                                     <div class="pt-3   ">
                      <p class="font-weight-bold pl-1 m-0"  v-text="article.nombre"></p>
                      <div class="pl-1">
                        <small>Precio/u. C$ {{article.precio | formato}}</small> 
                      </div>
                       <div class="pl-1">
                         <small>Importe. C$ {{article.cantidad * article.precio | formato}}</small> 
                       </div>
                   
                      
                    <div class="btn-group">

      <button class="btn btn-blue-grey waves-effect waves-light p-1  pr-3 pl-3" type="button" v-on:click="article.cantidad--,update() ">-</button>
      <button disabled class="btn btn-dark-green p-1 pl-3 pr-3" type="button"   >{{article.cantidad}}</button>
      <button class="btn btn-blue-grey  waves-effect waves-light p-1 pr-3 pl-3 " type="button" v-on:click="article.cantidad++,update()" >+</button>
          </div>
                    
                    
                    
                    </div>
                    </div>
                      <!--Fin-->
                     <!--Col-->
                         <div class=" col-3 align-self-center">
                                     <div class="pt-3 pr-3  ">
                      <button type="button" class="btn btn-danger btn-rounded btn-sm my-0 waves-effect waves-light" v-on:click="deleteRow()"><i class="mdb-icon-copy fas fa-times"></i></button>
                    </div>
                         </div>
                    <!--Fin-->
                         </div>
                  

                    
                        
                   
                
                    
                     
                  </div>
                </div>

              </div>
                </div>
</template>
<script>
export default {
    props:
    {
        article: {}
    },
    methods:
    {
        deleteRow()
    {
        this.$emit('delete')
    },
      update()
{
    
  if(this.$props.article.cantidad >= 1)
  {
       this.$emit("update")
  }
  else
  {
    this.$props.article.cantidad = 1
  }  
  
 
 
},
    
    },
    filters: {
  formato: function (value) {
     
     
      return (parseFloat(value).toFixed(2));
  },
    
    
    }
}
</script>