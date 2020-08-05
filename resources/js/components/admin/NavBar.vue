<template>
   <div>
          <!-- Main Navigation -->
  <header>

    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav sn-bg-4 fixed">
      <ul class="custom-scrollbar">

        <!-- Logo -->
        <li class="logo-sn waves-effect py-3">
          <div class="text-center">
            <a href="#" class="pl-0"><img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png"></a>
          </div>
        </li>

        <!-- Search Form -->
        <li>
          <form class="search-form" role="search">
            <div class="md-form mt-0 waves-light">
              <input type="text" class="form-control py-2" placeholder="Search">
            </div>
          </form>
        </li>

        <!-- Side navigation links -->
        <li>
          <ul class="collapsible collapsible-accordion">

            <li>
              <a class="collapsible-header waves-effect arrow-r">
                <i class="w-fa fas fa-tachometer-alt"></i>Categorias/grupos<i class="fas fa-angle-down rotate-icon"></i>
              </a>
              <div class="collapsible-body">
                <ul>
                  <li>
                    <router-link :to="{name: 'grupos'}" class="waves-effect">Grupos Alimentos</router-link></li>
                  <li>
                    <router-link :to="{name: 'categorias'}" class="waves-effect">Categorias</router-link>
                  </li>
                  
                  
                </ul>
              </div>
            </li>
            
             <li>
              <a class="collapsible-header waves-effect arrow-r">
                <i class="w-fa fas fa-tachometer-alt"></i>Productos<i class="fas fa-angle-down rotate-icon"></i>
              </a>
              <div class="collapsible-body">
                <ul>
                  <li>
                    <router-link to="/productos" class="waves-effect">Productos</router-link></li>
                    <li>
                    <router-link :to="{name: 'listaproductos'}" class="waves-effect">Lista</router-link>
                  </li>
                  
                 
                </ul>
              </div>
            </li>
           
  

      

          

          </ul>
        </li>
        <!-- Side navigation links -->

      </ul>
      <div class="sidenav-bg mask-strong"></div>
    </div>
    <!-- Sidebar navigation -->

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">

      <!-- SideNav slide-out button -->
      <div class="float-left">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
      </div>

      <!-- Breadcrumb -->
      <div class="breadcrumb-dn mr-auto">
        <p>Alerts</p>
      </div>

      <!-- Navbar links -->
      
      <ul class="nav navbar-nav nav-flex-icons ml-auto">

        <!-- Dropdown -->
         <push-notification></push-notification>
           
       
       
        <li class="nav-item">
          <a class="nav-link waves-effect"><i class="fas fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect"><i class="far fa-comments"></i> <span class="clearfix d-none d-sm-inline-block">Support</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Profile</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Log Out</a>
            <a class="dropdown-item" href="#">My account</a>
          </div>
        </li>

      </ul>
      <!-- Navbar links -->

    </nav>
    <!-- Navbar -->

  </header>
  <!-- Main Navigation -->

  
   </div>
</template>
<script>
export default {
    
    
}
</script>