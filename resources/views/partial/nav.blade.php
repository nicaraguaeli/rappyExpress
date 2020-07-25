  <!-- Classic tabs -->
<div class="classic-tabs fixed-top grey lighten-2">
 <!--LOGO-->
<div class="container">
<div class="row d-flex justify-content-between">
<div class="col-xs-4 aling-self-center mt-1"><img  src="{{asset('img/LOGO1.png')}}" alt=""></div>
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
<ul class="nav green darken-3 rounded-0" id="myClassicTab" role="tablist">
  
  
  <li class="nav-item">
    <a class="nav-link  waves-light active show inicio font-weight-bold" id="profile-tab-classic" data-toggle="tab" href="#profile-classic"
      role="tab" aria-controls="profile-classic" aria-selected="true"><i class="fas fa-home pr-2"></i>Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link waves-light font-weight-bold" id="follow-tab-classic" data-toggle="tab" href="#follow-classic" role="tab"
      aria-controls="follow-classic" aria-selected="false"><i class="fas fa-star white-text mr-2"></i>Packs</a>
  </li>
  <li class="nav-item " id="cart">
    <a class="nav-link waves-light font-weight-bold " id="contact-tab-classic" data-toggle="tab" href="#contact-classic" role="tab"
      aria-controls="contact-classic" aria-selected="false"><span class="badge danger-color mr-2 count">0</span><i class="fas fa-shopping-cart pr-2"></i>Cesta</a>
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
  <div id="navegacion">
  
 @include('partial.abc')

</div>
<div id="producto">


</div>
<!--Fin Navegacion Heredada-->
  </div>
  <div class="tab-pane fade " id="follow-classic" role="tabpanel" aria-labelledby="follow-tab-classic">
    <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut
      aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse
      quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
  </div>
  <div class="tab-pane fade" id="contact-classic" role="tabpanel" aria-labelledby="contact-tab-classic">
   
    
    <div class="container p-0">
    <div class="row grey lighten-1 p-3 justify-content-between m-0">
          <div class="col-xs-6"><h3>Su Orden</h3></div>
          <div class="col-xs-6" class="font-weight-bold" style="font-size: 1.5rem;"> Total:  <span class="badge badge-light total">C$ 0</span></div>
    </div>



    <div style="height: 60vh; overflow: scroll;">
    <table class="table   table-striped " >
  <thead class="green black-text">
    <tr>
      
      <th>Img</th>
      <th scope="col">Articulo</th>
      <th scope="col">Precio</th>
      <th scope="col">Acción</th>
      
    </tr>
  </thead>
  <tbody class="tabla">
    
   
  </tbody>
  
</table>

    </div>

    <div class="text-center">
    <button class="btn btn-success btn-rounded btn-sm my-0 waves-effect waves-light">Realizar Pedido</button>
    </div>
    
    </div>
    

  </div>
  
</div>
</div>

