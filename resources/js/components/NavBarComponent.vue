<template>
    <div >
 
     <!-- Classic tabs -->
<div class="classic-tabs  bg-white wow animated" v-show="tabs" v-bind:class="[tabs ? 'fadeIn' : 'fadeOut']">
  
 <!--LOGO-->
<div class="container">
<div class="row d-flex justify-content-between">
<div class="col-xs-4 align-self-center "><p class="h6 ml-3 green-text mt-2">RAPPY EXPRESS</p></div>

</div>
</div>


<!--LOGO-->  
<ul class="nav bg-white rounded-0 " id="myClassicTab" role="tablist">
  
  
  <li class="nav-item">
    <a class="nav-link  waves-light active show inicio font-weight-bold p-2 pl-3 pr-3 text-black-50" id="profile-tab-classic" data-toggle="tab" href="#profile-classic"
      role="tab" aria-controls="profile-classic" aria-selected="true" v-on:click="state()" ><i style="font-size: 1.3rem;" class="fas fa-home pr-2 text-black-50"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link waves-light font-weight-bold p-2 pl-3 pr-3 text-black-50" id="follow-tab-classic " data-toggle="tab" href="#follow-classic" role="tab"
      aria-controls="follow-classic" aria-selected="false"><i style="font-size: 1.3rem;" class="fas fa-star  mr-2 text-black-50"></i></a>
  </li>
 
  <li class="nav-item" id="cart">
    <a v-on:click="state()" class="nav-link waves-light font-weight-bold p-2 pl-3 pr-3 text-black-50" id="contact-tab-classic" data-toggle="tab" href="#contact-classic" role="tab"
      aria-controls="contact-classic" aria-selected="false"><i class="fas fa-user mr-2 text-black-50" style="font-size: 1.3rem;"></i></a>
  </li>
  <li class="nav-item" id="cart">
    <a v-on:click="state()" class="nav-link waves-light font-weight-bold p-2 pl-3 pr-3 text-black-50" id="contact-tab-classic" data-toggle="tab" href="#contact-classic" role="tab"
      aria-controls="contact-classic" aria-selected="false"><i class="fas fa-info-circle mr-2 text-black-50" style="font-size: 1.3rem;"></i></a>
  </li>
   <li class="nav-item" id="cart">
    <a v-on:click="state(false)"  class="nav-link waves-light font-weight-bold p-2 pl-3 pr-3 text-black-50" id="contact-tab-classic" data-toggle="tab" href="#contact-classic" role="tab"
      aria-controls="contact-classic" aria-selected="false"><span class="badge danger-color mr-2">{{counter}}</span><i style="font-size: 1.3rem;"  class="fas fa-shopping-cart pr-2 text-black-50"></i></a>
  </li>
  
</ul>

 <!-- Image and text -->
<nav class="navbar   green accent-4 ">

</nav>

</div>
<!-- Classic tabs -->



<div class="container p-0">

<div class="tab-content  p-0" id="myClassicTabContent">
  <div class="tab-pane fade active show " id="profile-classic" role="tabpanel" aria-labelledby="profile-tab-classic" >
  
  <!--Navegacion Heredada-->
<div id="navegacion"  v-bind:class="{'d-none': displayList }">
  
  <listproduct-component @recibirid="identificador" > </listproduct-component>

</div>

<div id="search-container">
  <div id="producto" v-if="displayArt">
<div class="grey special-color-dark fixed-top " style="height: 3rem;" >
           <div class="row p-2">
             <div class="col-1 col-md-4 align-self-center" v-on:click="closeBreadcum()"><i class="fas fa-chevron-left mr-2 text-white"></i></div>
             <div class="col-4 col-md-4 align-self-center text-white font-weight-bold" v-on:click="closeBreadcum()">{{itemCategoria}}</div>
            <div class="col-7 col-md-4"><!-- Search form -->
<form class="form-inline d-flex justify-content-center   mt-0" >
 
  <input id="search" class="form-control form-control-sm ml-3 w-75   rounded-pill" type="text" placeholder="¿Que buscas?"
    aria-label="Search">
</form>
<!-- Search form --></div>
           </div>
           </div>    
<getproduct  :nombre="itemName" :categoria="itemCategoria" :idd="idd" @escucharhijo="variablehijo" ></getproduct>

</div>
</div>

<!--Fin Navegacion Heredada-->

  </div>
  <div class="tab-pane fade " id="follow-classic" role="tabpanel" aria-labelledby="follow-tab-classic">
    <p class="mt-1">Trabajando</p>
  </div>
  <div class="tab-pane fade bg-white" id="contact-classic" role="tabpanel" aria-labelledby="contact-tab-classic" >
    
    <div v-if="displayCart">
         <div class="grey special-color-dark fixed-top " style="height: 3rem;" >
           <div class="row p-2">
             <div class="col-1 col-md-4 align-self-center" v-on:click="closeBreadcum()"><i class="fas fa-chevron-left mr-2 text-white"></i></div>
             <div class="col-7 col-md-4 align-self-center text-white font-weight-bold" v-on:click="closeBreadcum()">Su Orden</div>
             <div class="col-4"><span class="badge danger-color mr-2" v-text="counter"></span><i style="font-size: 1.3rem;"  class="fas fa-shopping-cart pr-2 text-white"></i></div>
           
           </div>
           </div>

             <div class="p-2 mt-5 wow animated slideInLeft" v-if="totalPagar > 0">
    <div  class="row bg-white p-3 justify-content-between m-0">
          <div class="col-xs-6 align-self-center">
            <small class="text-muted">Envio gratis a partir de C$200</small>
            <h6 class="font-weight-bold" >Envio:  <span class="badge badge-light p-2" style="font-size: 1rem;"  v-if="totalPagar < 200">C${{envio}} </span>
            <span class="badge badge-light p-2" style="font-size: 1rem;"  v-else>C$0.00 </span></h6>
            </div>
          <div v-if="totalPagar < 200" class="col-xs-6 align-self-end"  style="font-size: 1.5rem;"> <h4 class="font-weight-bold" >Total:  <span class="badge badge-light total p-2" style="font-size: 1.5rem;"   >C${{totalPagar + envio | formato}}  </span></h4></div>
           <div v-else class="col-xs-6 align-self-end"  style="font-size: 1.5rem;"> <h4 class="font-weight-bold" >Total:  <span class="badge badge-light total p-2" style="font-size: 1.5rem;"  >C${{totalPagar  | formato}}  </span></h4></div>
    </div>
    


  <div style="height: calc(100vh - 180px); overflow: scroll;" class="pb-5" >
    <cart v-for="(item, index) in articles" :key="index" :article="item"   @delete="deleteRow(index,item)" @update="update(index,item.cantidad)"></cart>
  </div>

    </div>
    <div v-else class="align-middle vh-100">
         <p class="mt-5 h1-responsive text-center">Tu cesta esta vacia, Pide ahora!</p>
          <p class="mt-3 text-center">Tus envios gratis a partir de compras mayores a C$200</p>
    </div>  
     <div class="row fixed-bottom">
   <div class="col-sm-12">
     <div class="text-center">
  <a href="" class="btn btn-elegant waves-effect waves-light btn-confirm m-0" data-toggle="modal" data-target="#modalLoginForm" v-if="totalPagar>0" > Confirmar Pedido</a>
  
</div>
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
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-if="stateModal" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="text-center">
          <p class="font-weight-bold">{{received}}</p>
         <div class="spinner-border text-success" role="status" v-if="spin">
  <span class="sr-only">Loading...</span>
</div>
        
        <p v-if="errors" class="text-red">
          Todos los campos son requeridos!.
    
  </p>

      </div>
       
      <div class="modal-body mx-3" v-if="stateModal">
        <div class="card card-signup z-depth-1">

            <div class="card-body text-center">

              <img src="img/LOGO1.png" class="logo">
              <h3 class="card-title my-2">Datos de Entrega</h3>
              <p class="slogan" v-if="stateModal">¿Donde se entregará el pedido?</p>

              <div class="md-form md-outline">
                <input type="text" id="username" class="form-control" v-model="nombre">
                <label for="username" class="" >Nombre</label>
              </div>

              <div class="md-form md-outline">
                <input type="number" id="number" class="form-control" v-model="telefono">
                <label for="number" class="">Telefono</label>
              </div>

              <div class="md-form md-outline">
                <input type="text" id="addres" class="form-control" v-model="direccion">
                <label for="addres" class="">Dirección</label>
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
  
</div>
</div> 
   
   <!--<div class="fixed-action-btn" style="bottom: 45px; right: 24px;" >
    <a class="btn-floating btn-lg green accent-4 waves-effect waves-light">
      <i class="fas fa-pencil-alt"></i>
    </a>

    <ul class="list-unstyled">
      <li><a class="btn-floating green waves-effect waves-light"><i class="fas fa-star"></i></a></li>
      <li><a class="btn-floating yellow darken-1 waves-effect waves-light"><i class="fas fa-user"></i></a></li>
      <li><a class="btn-floating green waves-effect waves-light"><i class="fas fa-envelope"></i></a></li>
      <li><a v-on:click="state()" class="btn-floating green waves-effect waves-light" id="contact-tab-classic" data-toggle="tab" href="#contact-classic" role="tab"
      aria-controls="contact-classic" aria-selected="false"><i   class="fas fa-shopping-cart "></i></a></li>
    </ul>
  </div>-->
</div> 
</template>
<script>
var audioElement = document.createElement('audio');
audioElement.setAttribute('src', 'https://notificationsounds.com/soundfiles/d86ea612dec96096c5e0fcc8dd42ab6d/file-sounds-1144-me-too.mp3');


export default {
      


      data () {
    return {
      
      counter: 0,
      articles: [],
      envio: 30,
      stateModal: true,
      received: "",
      spin: false,
      state_n: true,
      displayArt: false,
      displayCart: false,
      displayList: false,      
      totalPagar: 0,
      idd: Number,
      itemName: "",
      itemCategoria: "",
      buscador: false,
      nombre: "",
      telefono: "",
      direccion: "",
      tabs: true,
      
      errors: false,
      isActive: false,
    
    }
  },

  methods:
  {
      variablehijo(item)
      {
         
       
       if(!this.articles.find(e => e.id == item.id))
       {
           this.articles.push(item)
           this.counter++         
           audioElement.currentTime = 0;
           audioElement.play()
       }
     

  

         this.totalPagar = 0         
         this.articles.forEach(element => {
           
         this.totalPagar += element.cantidad * element.precio;

        
           
         });
        
        //Comprobando el costo de envio 
        //this.sendState();
        
        
       
          
        $('#cart').addTempClass( 'wow animated bounceIn', 1000 );
           
      },
      identificador(id, itemNombre, itemCate)
      {
      
      
      
      this.itemName = itemNombre;
      this.itemCategoria = itemCate;
      this.state_n = false;
      this.displayArt = true;
      this.idd = id;
      this.buscador= true;
      this.tabs = false;
      
      //setTimeout(() => this.displayList = true  ,500)
      this.displayList = true;
      
      },
      state(valor)
      { 
        if(valor == false)
        {
          this.tabs = valor;
          this.displayCart = true;
        }
        else
        {
        this.state_n = true;
        this.displayArt = false; 
        this.displayCart=false
        this.displayList = false;
        this.buscador= false;

        }
      
      },
      
      deleteRow(index,item)
      {
        
        this.totalPagar -= this.articles[index].cantidad * this.articles[index].precio;
        this.counter-= item.cantidad;
        this.articles.splice(index,1)
     
        
      },
      update(index, cantidad)
      { 
         

         
        
        
         this.articles[index].cantidad = parseInt(cantidad);
         this.totalPagar = 0;
         this.counter = 0;
        
         this.articles.forEach(element => {
           
         this.totalPagar += element.cantidad * element.precio;
         this.counter += parseInt(element.cantidad)

         });

         

        $('#cart').addTempClass( 'wow animated bounceIn', 1000 );
        audioElement.currentTime = 0;
        audioElement.play()
        
         
      },
      
      formdata()
      {  
        if (!this.nombre && !this.telefono && !this.direccion) {
        this.errors = true;
      }
      else{
            
            
           

            this.received = "un momento...";
            this.spin = true;
            
            setTimeout(() => axios
            .post('./order',this.$data)
            .then((response) => (this.received = response.data))
            .catch(error => (this.received= "No a sido posible realizar el pedido!.")), 4000)
            
           
            this.stateModal = false;

           setTimeout(() => {$("#modalLoginForm").modal('hide'); location.reload();} ,8000);
           
         
            

      }
         
      },
     
      closeBreadcum()
      {
        this.tabs = true
        this.state()
        


      }
     
     

      

  },
  filters: {
  formato: function (value) {
     
     
     return (parseFloat(value).toFixed(2));
  }
}
 
      
     
    
  
  
}
</script>
<style  lang="scss">

.btn-confirm
{
border-radius: 1rem 1rem 0 0px;
@media only screen and (max-width: 600px) {
  
    width: 100% !important;
  
}

}
#myClassicTab
{
  @media only screen and (max-width: 600px) {
  
   justify-content: space-evenly;
  
}
}
 
</style>