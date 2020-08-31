<template>
<div style="height: calc(100vh - 80px )" class="bg-white">
   <div class="grey special-color-dark  wow animated slideInUp faster " style="height: 3rem;" >
           
           <div class="row p-2  ">
             <div class="col-4 col-md-4 align-self-center" ><a data-toggle="tab" role="tab" href="#product_list" v-on:click="back()"><i class="fas fa-chevron-left mr-2 text-white"></i><span class="text-white ml-1">atras</span></a></div>
             <div class="col-5 col-md-4 align-self-center text-white font-weight-bold">Su Orden</div>
             <div class="col-3"><span class="badge danger-color mr-2" v-text="counter"></span><i style="font-size: 1.3rem;"  class="fas fa-shopping-cart pr-2 text-white"></i></div>
           
           </div>
           </div>

        <div class=" wow animated fadeInLeft faster" v-if="counter > 0" >
    <div  class="row bg-white p-3 justify-content-between m-0">
          <div class="col-xs-6 align-self-center">
            <small class="text-muted">Envio gratis a partir de C$200</small>
            <h6 class="font-weight-bold" >Envio:  <span class="badge badge-light p-2" style="font-size: 1rem;"  v-if="amount < 200">C${{shipping}} </span>
            <span class="badge badge-light p-2" style="font-size: 1rem;"  v-else>C$0.00 </span></h6>
            </div>
          <div v-if="amount < 200" class="col-xs-6 align-self-end"  style="font-size: 1.5rem;"> <h4 class="font-weight-bold" >Total:  <span class="badge badge-light total p-2" style="font-size: 1.5rem;"   >C${{amount + shipping  | formato}}  </span></h4></div>
           <div v-else class="col-xs-6 align-self-end"  style="font-size: 1.5rem;"> <h4 class="font-weight-bold" >Total:  <span class="badge badge-light total p-2" style="font-size: 1.5rem;"  >C${{amount | formato}}  </span></h4></div>
    </div>
        </div>
        
        <div v-else>
          <h1 class="text-center">La cesta esta vacia.</h1>
          <hr>
        </div>

  
             <cartitem v-for="(item, index) in articles" :key="index" :article="item" @delete="deleteRow(index,item)" @update="update" ></cartitem>
             
   <div class="row fixed-bottom">
   <div class="col-sm-12">
     <div class="text-center">
  <router-link v-if="!user" :to="{name: 'login'}" class="btn btn-elegant waves-effect waves-light btn-confirm m-0"   > Inciciar sesion</router-link>
  <a  href="" class="btn btn-elegant waves-effect waves-light btn-confirm m-0" data-toggle="modal" data-target="#modalLoginForm" v-else-if="counter>0 " > Confirmar Pedido</a>
  
  
</div>
   </div>
   </div>
   <!--modal-->
    <div v-if="user" class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold"></h4>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="text-center">
          <p class="font-weight-bold"></p>
         <div class="spinner-border text-success" role="status" >
  <span class="sr-only">Loading...</span>
</div>
        
        <p class="text-red">
          Todos los campos son requeridos!.
    
  </p>

      </div>
       
      <div class="modal-body mx-3" >
        <div class="card card-signup z-depth-1">

            <div class="card-body text-center">

              <img src="img/LOGO1.png" class="logo">
              <h3 class="card-title my-2">Dirección de Entrega</h3>
              <p class="slogan" >¿Donde se entregará el pedido?</p>
         

               <div class="md-form md-outline">
               
                <select ref="optionSelected" class="form-control mb-2" >
                <label class="" for="">Selecciona una dirección</label>
          <option v-text="user.address" ></option>
    </select>
    
              </div>

              <div class="card-foter text-right">
                <button type="button" class="btn btn-outline-success btn-sm waves-effect waves-light" style="width: 140px;" v-on:click.prevent="formdata()">Enviar</button>
              </div>

            </div>

          </div>
        

        

        
        
      </div>

         
         
      
      
    </div>
  </div>
</div>


    <!--FinModal-->
   
</div>
 
</template>
<script>
import cartitem from "./CartItem"

export default { 
    mounted(){
        
       
       this.$props.articles.forEach(element => {
           
         this.amount += element.cantidad * element.precio;

         
           
         });
    },
    components:
    {
          cartitem,
    },
    data()
    {
        return { 
        
          quantity: 1,
          amount: 0,
          shipping: 30

        }
    },

    props:
    {
        articles: {},
        counter: 0,
        user: {}
       
        
    },
    filters: {
  formato: function (value) {
     
     
      return (parseFloat(value).toFixed(2));
  },

},
methods:
{
  deleteRow(index,item)
  {
    
    this.$props.articles.forEach(element => {
           
         this.amount  -= parseInt(element.cantidad) * parseInt(element.precio)
         this.$parent.counter -= parseInt(element.cantidad)
         this.articles.splice(index,1)

    });
    
   
  },
  update(index, cantidad)
      { 
   
         this.amount = 0;
         this.$parent.counter = 0;
        
         this.$props.articles.forEach(element => {
           
         this.amount  += parseInt(element.cantidad) * parseInt(element.precio)
         this.$parent.counter += parseInt(element.cantidad)

         });

         

        $('#cart').addTempClass( 'wow animated bounceIn', 1000 );
        audioElement.currentTime = 0;
        audioElement.play()
        
         
      },
      formdata()
      {  
        
  
            
            
            setTimeout(() => axios
            .post('./order',this.$props.articles)
            .then((response) => (console.log(response.data)))
            .catch(error => (this.received= "No a sido posible realizar el pedido!.")), 4000)
            
           
      

           //setTimeout(() => {$("#modalLoginForm").modal('hide');} ,8000);

      
         
      },

back()
{
  this.$router.back()
}
 
},


    
}
</script>
