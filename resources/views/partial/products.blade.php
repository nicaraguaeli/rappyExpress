<nav aria-label="breadcrumb animated fadeIn ">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item inicio"><a class="inicio" ><i class="fas fa-chevron-left mr-2"></i>
    <b>Atras</b>
    </a></li>
    <li class="breadcrumb-item active uppercase">{{$param->nombre}}</li>
  </ol>
</nav>



<div class="container p-0">

<div class="row animated fadeIn" style="height: 70vh; overflow: scroll; ">


@foreach($datos as $dato)
<!-- Grid column -->
<div class="col-md-6">

  <!-- Card -->
  <div class="card card-ecommerce">

    <!-- Card image -->
    <div class="view overlay">

      <img src="{{asset('img/arrozfaisan.jpg')}}" class="img-fluid" alt="sample image">

      <a>

        <div class="mask rgba-white-slight waves-effect waves-light"></div>

      </a>

    </div>
    <!-- Card image -->

    <!-- Card content -->
    <div class="card-body">

      <!-- Category & Title -->
      <h5 class="card-title mb-1">

        <strong>

          <h3 class="dark-grey-text ">{{$dato->nombre}} | {{$dato->marca}} </h3>

        </strong>

      </h5>

      <span class="badge badge-danger mb-2 ">{{$dato->presentacion}}</span>

      
      <!-- Card footer -->
      <div class="card-footer pb-0">

        <div class="row mb-0">

          <span class="float-left ">

            <strong>C$ {{ number_format($dato->precio, 2) }}</strong>

          </span>

          <span class="float-right">

            <a  class="add" id="{{$dato->id}}">

              <i class="fas fa-shopping-cart ml-3 mr-2" ></i>Agregar

</a>

          </span>

        </div>

      </div>

    </div>
    <!-- Card content -->

  </div>
  <!-- Card -->

</div>
<!-- Grid column -->

@endforeach





</div>

</div>