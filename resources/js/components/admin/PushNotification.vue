<template>
     <li class="nav-item dropdown notifications-nav">
          <a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="badge red">{{orders.length}}</span> <i class="fas fa-bell"></i>
            <span class="d-none d-md-inline-block">Notificaciones</span>
          </a>
          <div v-for="item in orders" :key="item.id" class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">
              <i class="far fa-money-bill-alt mr-2" aria-hidden="true"></i>
              <span>Tienes una nueva orden</span>
              <span class="float-right"><i class="far fa-clock" aria-hidden="true"></i> {{item.created_at}}</span>
            </a>
          
          </div>
        </li>
</template>

<script>

export default {
    data()
    {
         return{
          orders: [],
            
         }
    },
    mounted()
    {
        this.fill()

        var pusher = new Pusher('0ac716eab39006bb084d', {
       cluster: 'us2'
    })
    
    var channel = pusher.subscribe('my-channel')

    
    channel.bind('my-event', (response => (this.orders = [],  this.fill() ) ))
     
    
     
    },
    methods:
    {
      fill()
      {
          axios.get('./order').then(response => (this.orders = response.data))
      }
    }
    
}
</script>