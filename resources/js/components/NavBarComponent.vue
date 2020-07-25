<template>
    <div >
 
     <!-- Classic tabs -->
<div class="classic-tabs fixed-top unique-color-dark">
  
 <!--LOGO-->
<div class="container">
<div class="row d-flex justify-content-between">
<div class="col-xs-4 aling-self-center mt-1"><img  src="img/LOGO1.png" alt=""></div>
<div class="col-xs-8 align-self-center">

<!-- Search form -->
<form class="form-inline d-flex justify-content-center   mt-0">
  <i class="fas fa-search" aria-hidden="true"></i>
  <input id="search" class="form-control form-control-sm ml-3 w-75  mt-2 mb-2 rounded-pill" type="text" placeholder="¿Que buscas?"
    aria-label="Search">
</form>
<!-- Search form -->

</div>
</div>
</div>


<!--LOGO-->  
<ul class="nav special-color-dark rounded-0" id="myClassicTab" role="tablist">
  
  
  <li class="nav-item">
    <a class="nav-link  waves-light active show inicio font-weight-bold" id="profile-tab-classic" data-toggle="tab" href="#profile-classic"
      role="tab" aria-controls="profile-classic" aria-selected="true" v-on:click="state()" ><i class="fas fa-home pr-2"></i>Tienda</a>
  </li>
  <li class="nav-item">
    <a class="nav-link waves-light font-weight-bold" id="follow-tab-classic" data-toggle="tab" href="#follow-classic" role="tab"
      aria-controls="follow-classic" aria-selected="false"><i class="fas fa-star white-text mr-2"></i>Packs</a>
  </li>
  <li class="nav-item" id="cart">
    <a class="nav-link waves-light font-weight-bold " id="contact-tab-classic" data-toggle="tab" href="#contact-classic" role="tab"
      aria-controls="contact-classic" aria-selected="false"><span class="badge danger-color mr-2">{{counter}}</span><i  class="fas fa-shopping-cart pr-2"></i>Cesta</a>
  </li>
  
</ul>

 <!-- Image and text -->
<nav class="navbar light-green darken-4 primary-color">

</nav>

</div>
<!-- Classic tabs -->

<br>
<br>
<br>
<br>
<br>



<div class="container p-0">

<div class="tab-content  p-0" id="myClassicTabContent">
  <div class="tab-pane fade active show " id="profile-classic" role="tabpanel" aria-labelledby="profile-tab-classic" >
  
  <!--Navegacion Heredada-->
<div id="navegacion"  v-bind:class="{'d-none': state_display }">
  
  <listproduct-component @recibirid="identificador" > </listproduct-component>

</div>
<div id="producto" v-if="state_p">

<getproduct  :nombre="itemName" :categoria="itemCategoria" :idd="idd" @escucharhijo="variablehijo"></getproduct>

</div>
<!--Fin Navegacion Heredada-->

  </div>
  <div class="tab-pane fade " id="follow-classic" role="tabpanel" aria-labelledby="follow-tab-classic">
    <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut
      aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse
      quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
  </div>
  <div class="tab-pane fade cloudy-knoxville-gradient" id="contact-classic" role="tabpanel" aria-labelledby="contact-tab-classic">
           <div class="container p-0">
    <div class="row grey lighten-1 p-3 justify-content-between m-0">
          <div class="col-xs-6 align-self-center">
            <h4>Su Orden</h4></div>
          <div class="col-xs-6 "  style="font-size: 1.5rem;"> <h4 class="font-weight-bold" >Total:  <span class="badge badge-light total p-2" style="font-size: 1.5rem;" >C${{totalPagar | formato}}  </span></h4></div>
    </div>
 <div class="row fixed-bottom">
   <div class="col-sm-12">
     <div class="text-center">
  <a href="" class="btn btn-elegant waves-effect waves-light" data-toggle="modal" data-target="#modalLoginForm" v-if="totalPagar>0">Confirmar</a>
  
</div>
   </div>
 </div>


    
    <table class="table   table-striped " >
  <thead class="special-color-dark white-text">
    <tr class="font-weight-bold">
      
    
      <th scope="col font-weight-bold">ART</th>
      <th scope="col font-weight-bold">CANT.</th>      
      <th scope="col font-weight-bold">PRECIO/U</th>
      <th scope="col font-weight-bold">IMP.</th>
      <th scope="col font-weight-bold"></th>
      
    </tr>
  </thead>
  <tbody class="tabla">

    <cart v-for="(item, index) in articles" :key="item.id" :article="item"  @delete="deleteRow(index,item)" @update="update(index,item.cantidad)"></cart>
   
  </tbody>
  
</table>

  

  
    
    

    
    </div>
    <!--modal-->
    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">{{received}}</h4>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-if="stateModal" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="text-center">

         <div class="spinner-border text-success" role="status" v-if="spin">
  <span class="sr-only">Loading...</span>
</div>
        <h4 v-if="stateModal">¿Donde se entregará el pedido?</h4>
        <p v-if="errors" class="text-red">
          Todos los campos son requeridos!.
    
  </p>

      </div>
       
      <div class="modal-body mx-3" v-if="stateModal">
        <form v-on:submit.prevent="formdata()">
         
         <div class="md-form mb-5">
          <input type="text"  class="form-control validate" v-model="cliente.nombre">
          <label data-error="falta" data-success="correcto" >Su nombre</label>
        </div>

        <div class="md-form mb-4">
         
          <input type="number"  class="form-control validate" v-model="cliente.telefono">
          <label data-error="falta" data-success="correcto" >Télefono</label>
        </div>

         <div class="md-form mb-5">
         
          <input type="text"  class="form-control validate" v-model="cliente.direccion">
          <label data-error="falta" data-success="correcto" >Dirección</label>
        </div>

        <div class="modal-footer d-flex justify-content-center">
       <button type="submit" class="btn btn-success btn-rounded btn-sm my-0 waves-effect waves-light"  >Realizar Pedido</button>
       
      </div>

        
        </form>
        

        

        
        
      </div>

         
         
      
      
    </div>
  </div>
</div>


    <!--FinModal-->

   
    

  </div>
  
</div>
</div>    
   
</div> 
</template>
<script>
export default {
      data () {
    return {
      
      counter: 0,
      articles: [],
      stateModal: true,
      received: "DATOS DE ENTREGA",
      spin: false,
      state_n: true,
      state_p: false,
      state_display: false,      
      totalPagar: 0,
      idd: Number,
      itemName: "",
      itemCategoria: "",
      
      cliente: [
        {
          nombre: String,
          telefono: Number,
          direccion: String,
        }
        ],
      errors: false,
      isActive: false,
    
    }
  },

  methods:
  {
      variablehijo(item)
      {
         
       
       this.articles.push(item)
       
      
            
            var posicion;
            var cantidad = 0;
        
          for (let index = 0; index < this.articles.length; index++) {
                
                if(this.articles[index].id == item.id)
                {
                    cantidad = this.articles[index].cantidad;
                    console.log("cantidad devuelta"+cantidad)
                    this.articles.splice(index)
                    posicion = index;
                }           
         };

         this.articles.push(item)

          if(cantidad == 0)
          {
               var valor = parseInt(cantidad += 1);
               console.log(valor)
               this.articles[posicion].cantidad = valor;
               this.counter++
          }
          else
          {
            var numero = parseInt(cantidad +=1)
            this.articles[posicion].cantidad = numero;
            console.log(numero)
            this.counter++
            
 
          }
        
         

         this.totalPagar = 0
         
         this.articles.forEach(element => {
           
           this.totalPagar += element.cantidad * element.precio;
           
         });
         
         
       
       
         
     

          if(this.articles)
          ( function ( $ ) {
    'use strict';
    $.fn.addTempClass = function ( className, expire, callback ) {
        className || ( className = '' );
        expire || ( expire = 1500 );
        return this.each( function () {
            $( this ).addClass( className ).delay( expire ).queue( function () {
                $( this ).removeClass( className ).clearQueue();
                callback && callback();
            } );
        } );
    };
} ( jQuery ) );
          $('#cart').addTempClass( 'wow animated bounceIn', 1000 );
           
      },
      identificador(id, itemNombre, itemCate)
      {
      
      
      
      this.itemName = itemNombre;
      this.itemCategoria = itemCate;
      this.state_n = false;
      this.state_p = true;
      this.idd = id;
      
      //setTimeout(() => this.state_display = true  ,500)
      this.state_display = true;
      
      },
      state()
      {
        this.state_n = true;
        this.state_p = false; 
        this.state_display = false;
      },
      
      deleteRow(index,item)
      {
        
        this.totalPagar -= this.articles[index].cantidad * this.articles[index].precio;
        this.counter-= item.cantidad;
        this.articles.splice(index,1)
     
        
      },
      update(index, cantidad)
      { 
         

         
         console.log("desde update",this.articles[index].cantidad);
         console.log(cantidad+"enviado desde aca")
        
        this.articles[index].cantidad = parseInt(cantidad);
         this.totalPagar = 0;
     
         this.articles.forEach(element => {
           
         this.totalPagar += element.cantidad * element.precio;

         });
   
       
         
      },
      
      formdata()
      {  
        if (!this.cliente.nombre && !this.cliente.telefono && !this.cliente.direccion) {
        this.errors = true;
      }
      else{
            
            const clientee = [];
            clientee[0] = this.cliente.nombre;
            clientee[1] = this.cliente.telefono;
            clientee[2] = this.cliente.direccion;

            this.received = "un momento...";
            this.spin = true;
            
            setTimeout(() => axios
            .post('./store',{pr: this.articles, cl: clientee})
            .then((response) => this.received = response.data)
            .catch(error => console.log(error)), 4000)
            
           
            this.stateModal = false;

           setTimeout(() => {$("#modalLoginForm").modal('hide'); location.reload();} ,8000);
           
         
            

      }
         
      }

      

  },
  filters: {
  formato: function (value) {
     
     
    
  }
}
 
      
     
    
  
  
}
</script>