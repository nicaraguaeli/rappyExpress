<template >
<div  class="bg-white">
   <div class="grey special-color-dark  wow animated slideInUp faster " style="height: 3rem;" >
             <div class="d-flex p-2  "  style="height: 3rem;" >
             <div class="col-4 col-md-4 align-self-center" ><a data-toggle="tab" role="tab" href="#product_list" v-on:click="back()"><i class="fas fa-arrow-left text-white"></i><span class="text-white ml-1">Atras</span></a></div>
             <div class="col-5 col-md-4 align-self-center text-white font-weight-bold">Su orden</div>
             <div v-if="counter > 0" class="col-3 col-md-4 align-self-center"><span v-if="amount < 200" class="badge success-color mr-2 black-text" v-text="'Envio: C$'+shipping"></span>
             <span v-if="amount > 200" class="badge success-color mr-2 black-text" v-text="'Envio: C$0.00'"></span>
             </div>
           
           </div>
          
           </div>
  
        <div class=" wow animated fadeInLeft faster" v-if="counter > 0" >
    <div  class="row bg-white p-3 justify-content-between m-0">
          <div class="col-xs-4 align-self-center">
            <small class="text-muted">Envio gratis a partir de C$200</small>
           
            </div>
          <div v-if="amount < 200" class="col-xs-6 align-self-end"  style="font-size: 1.5rem;"> <h5 class="font-weight-bold" >Total:  <span class="badge badge-light total p-2" style="font-size: 1rem;"   >C${{amount + shipping  | formato}}  </span></h5></div>
           <div v-else class="col-xs-8 align-self-end"  style="font-size: 1.5rem;"> <h5 class="font-weight-bold" >Total:  <span class="badge badge-light total p-2" style="font-size: 1rem;"  >C${{amount | formato}}  </span></h5></div>
    </div>
        </div>
        
        <div v-else>
          <h1 class="text-center">La cesta esta vacia.</h1>
          {{this.$store.getters.getAuth}}
          <hr>
        </div>

                  <div style="height: calc(100vh - 180px); overflow: scroll; " class="mb-5">
                   <cartitem v-for="(item, index) in articles" :key="index" :article="item" @delete="deleteRow(index,item)" @update="update" ></cartitem>
                  </div>
             
          
             
   <div class="row fixed-bottom">
   <div class="col-sm-12">
     <div class="text-center">
  <router-link v-if="this.$store.getters.getAuth == false" :to="{name: 'login'}" class="btn btn-elegant waves-effect waves-light btn-confirm m-0"   > Iniciar sesion</router-link>
   <a v-if="this.$store.getters.getAuth == true"  href="#" class="btn btn-elegant waves-effect waves-light btn-confirm m-0" v-on:click="confirm()"> Confirmar Pedido</a>
  
  
  
</div>
   </div>
   </div>
   <!--modal-->
    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold"></h4>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="text-center" v-if="spin">
          <p class="font-weight-bold"></p>
         <div class="spinner-border text-success" role="status" >
  <span class="sr-only">Loading...</span>
</div>
        

      </div>
       
      <div class="modal-body mx-3" >
        <div class="card card-signup z-depth-1" v-if="!modal">

            <div class="card-body text-center">

              <img src="img/LOGO1.png" class="logo">
              <h3 class="card-title my-2">Dirección de Entrega</h3>
              <p class="slogan" >¿Donde se entregará el pedido?</p>
         

               <div class="md-form md-outline">
               
                <select ref="optionSelected" class="form-control mb-2" >
                <label class="" for="">Selecciona una dirección</label>
                <option v-if="this.$store.getters.getAuth == true"  v-text="this.$store.getters.getUserGetter.address"></option>
                
               
    </select>
    
              </div>

              <div class="card-foter text-right">
                <button type="button" class="btn btn-outline-success btn-sm waves-effect waves-light" style="width: 140px;" v-on:click.prevent="formdata()">Enviar</button>
              </div>

            </div>

          </div>
        
   <!-- Content -->
            <div class="modal-content" v-if="modal">
              <!-- Header -->
              <div class="modal-header ">
                <p class="heading lead " >Su pedido a sido enviado!.</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="white-text">×</span>
                </button>
              </div>

              <!-- Body -->
              <div class="modal-body">
                <div class="text-center">
                  <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
                  <p >
                    Le atenderemos en menos que canta un gallo!.
                  </p>
                </div>
              </div>

              <!-- Footer -->
              <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-success waves-effect waves-light close"  data-dismiss="modal" aria-label="Close">Entendido </a>
              
              </div>
            </div>
            <!-- Content -->
        

        
        
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
        
       
         this.articles.forEach(element => {
           
         this.amount += element.cantidad * element.precio;   
         });
        
        // this.$store.dispatch('getUser')
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
          shipping: 30,
          request: {address: "" ,article: this.articles},
          spin: false,
          modal: false,
          
          

        }
    },

    props:
    {
        articles: {},
        counter: 0,
    
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
        
        
         this.amount = 0;
         this.$parent.counter = 0;
         this.articles.splice(index,1)

         this.articles.forEach(element => {
           
         this.amount += parseInt(element.cantidad) * parseInt(element.precio)
         this.$parent.counter += parseInt(element.cantidad)
        
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
        
            this.spin = true
            this.request.address = this.$refs.optionSelected.value
            
            
             setTimeout(() => axios
            .post('/order',this.request)
            .then((response) => (console.log(response.data),this.reset()))
            .catch(error => (toastr.error("No a sido posible realizar el pedido!."))), 4000)

           //setTimeout(() => {$("#modalLoginForm").modal('hide');} ,8000);
         
      },
      reset()
      {
        this.spin = false
        this.$parent.articles.splice(0)
        this.$parent.counter = 0
        this.amount = 0
        this.modal = true
        setTimeout(() => {
          $("#modalLoginForm").modal('hide');
          this.$router.push('/')
          } ,5000);
      },
      confirm()
      {
         const address = JSON.stringify(this.$store.getters.getUserGetter.address)
        
         if(!this.counter > 0)
          {
            this.$toasted.show("Debe haber al menos un artículo en la cesta", { 
            theme: "bubble", 
            position: "bottom-center", 
            duration : 2000
          })
          }
           
         
           if( address == null)
          {
            this.$toasted.show("No tienes direcciones, agregalas en tu perfil", { 
            theme: "bubble", 
            position: "bottom-center", 
            duration : 2000

          })
          }
          console.log(address)
          if(this.counter > 0 && address != null)
          {
            $("#modalLoginForm").modal('show')
          }

        

      },

back()
{
  this.$router.back()
}
 
},


    
}
</script>
