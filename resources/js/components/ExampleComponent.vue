<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Componente de Ejemplo</div>

                    <div class="card-body">
                        Y soy un componente de ejemplo
                    </div>
            <ul>
                <li v-for="item in items" :key="item.message">
                     {{item.message}}
                </li>
            </ul>
        
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
  
   export default {
       
       

       mounted() {
            console.log('Component mounted.')
        },
        data: function () {
    return {
      items: [
          {message: 'hola'},
          {message: 'Como estas'}
      ]
    }
        
    }
   }
</script>
