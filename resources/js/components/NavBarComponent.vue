<template>
    <div class="container p-0">
 
     <!-- Classic tabs -->
<div class="classic-tabs  bg-white wow animated faster" v-show="tabs" v-bind:class="[tabs ? 'slideInDown' : 'fadeOut']">
  
 <!--LOGO-->
<div class="container">
<div class="row  justify-content-between">
<div class="col-md-4 align-self-center "><p class="h6 ml-3 green-text mt-2">RAPPY EXPRESS </p></div>

</div>
</div>


<!--LOGO-->  
<ul class="nav bg-white rounded-0 " id="myClassicTab" role="tablist">
  
  
  <li class="nav-item">
    <router-link :to="{name: 'home'}" class="nav-link  waves-light active show inicio font-weight-bold p-2 pl-3 pr-3 text-black-50"  aria-selected="true" data-toggle="tab" role="tab"  ><i style="font-size: 1.3rem;" class="fas fa-home pr-2 nav-item-color"></i></router-link>
  </li>
  <li class="nav-item">
    <a class="nav-link waves-light font-weight-bold p-2 pl-3 pr-3 text-black-50" id="follow-tab-classic " data-toggle="tab"  role="tab"
      aria-controls="follow-classic" aria-selected="false"><i style="font-size: 1.3rem;" class="fas fa-star  mr-2 nav-item-color"></i></a>
  </li>
   <li  class="nav-item cart-item" id="cart">
    <router-link   :to="{name: 'order'}" class="nav-link waves-light font-weight-bold p-2 pl-3 pr-3 text-black-50"  data-toggle="tab" role="tab" aria-selected="false"><span class="badge danger-color mr-2">{{counter}}</span><i style="font-size: 1.3rem;"  class="fas fa-shopping-cart pr-2 nav-item-color"></i></router-link>
   
  </li>
 
  <li class="nav-item" >
    <router-link :to="{name: 'login'}" class="nav-link waves-light font-weight-bold p-2 pl-3 pr-3 text-black-50" id="user-tab-classic" data-toggle="tab"  role="tab"
      aria-controls="user-classic" aria-selected="false"><i class="fas fa-user mr-2 nav-item-color" style="font-size: 1.3rem;"></i></router-link>
  </li>
  <li class="nav-item" >
    <a v-on:click="state()" class="nav-link waves-light font-weight-bold p-2 pl-3 pr-3 text-black-50" id="contact-tab-classic" data-toggle="tab"  role="tab"
      aria-controls="contact-classic" aria-selected="false"><i class="fas fa-info-circle mr-2 nav-item-color" style="font-size: 1.3rem;"></i></a>
  </li>
  
  
</ul>

 <!-- Image and text -->
<nav class="navbar nav-border   green accent-4 ">

</nav>

</div>
<!-- Classic tabs -->




<router-view :counter="counter" :articles="articles" :user="userAuth" @cartItem="addItem" ></router-view>


   
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
    mounted()
    {
      if(this.$props.user)
      {
        this.userAuth = this.$props.user
      }
      
     
    if (localStorage.counter) {
      this.counter = localStorage.counter;
    }

    if (localStorage.getItem('items')) {
      try {
        this.articles = JSON.parse(localStorage.getItem('items'));
      } catch(e) {
        localStorage.removeItem('items');
      }
    }
      
    },
  
    data () {
    return {
      
      counter: 0,
      articles: [],     
      
      stateModal: true,
      received: "",
      spin: false,
      tabs: true,    
      errors: false,
      isActive: false,
      userAuth: {id:"",name:"",email:"",number:"",address:"",address_alt:""},
      name: ""
      
    
    }
  },
  props:
  {
    user: {},
    
  },

  methods:
  {
      addItem(item)
      {
         
       
       if(!this.articles.find(e => e.id == item.id))
       {
           this.articles.push(item)
           this.counter++         
           audioElement.currentTime = 0;
           audioElement.play()
           
       }
  
        $('#cart').addTempClass( 'wow animated bounceIn', 1000 );
           
      },
     

      
      username(item)
      {
        this.userAuth = item
      },
       
  },
 watch: {
    
    counter(items) {
      localStorage.counter = items;
    },
    articles()
    {
      const parsed = JSON.stringify(this.articles);
      localStorage.setItem('items', parsed);
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

.nav-item-color
{
  color: #37474F;
}
.nav-border
{
  border-radius: 10px 10px 0 0;
}
.card-background
{
  &:before
  {
    background: #11998e;  /* fallback for old browsers */
background: -webkit-linear-gradient(to top, #38ef7d, #11998e);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to top, #38ef7d, #11998e); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    width: 100%;
    height: 100%;
    content: "";
    position: absolute;
    overflow: hidden;
  }
}
 
</style>