<template>
   
        <tr >
        
        <td class="text-uppercase">{{article.nombre }}  {{article.presentacion }}</td>
        <td>
          <div class="btn-group">

      <button class="btn btn-blue-grey waves-effect waves-light p-1 pl-3 pr-3" type="button" v-on:click="article.cantidad--,update() ">-</button>
      <button disabled class="btn btn-dark-green p-1 pl-3 pr-3" type="button"   >{{article.cantidad}}</button>
      <button class="btn btn-blue-grey  waves-effect waves-light p-1 pl-3 pr-3" type="button" v-on:click="article.cantidad++,update()" >+</button>
          </div>
      
</td>
        <td>C$ {{article.precio | formato}} </td>
        <td>C$ {{article.cantidad * article.precio | formato}}</td>
        <td><span ><button type="button" class="btn btn-danger btn-rounded btn-sm my-0 waves-effect waves-light" v-on:click="deleteRow()"><i class="mdb-icon-copy fas fa-times"></i></button></span></td>
        
        </tr>
    
</template>
<script>
export default { 
    data()
    {
        return { 
        
          cantidad: 1,

        }
    },

    props:
    {
        article: {},
       
        
    },
    filters: {
  formato: function (value) {
     
     
      return (parseFloat(value).toFixed(2));
  },

},
methods:
{
  deleteRow()
  {
    this.$emit('delete')
  },
  update()
{
    
  if(this.$props.article.cantidad >= 1)
  {
       this.$emit("update")
  }
  else
  {
    this.$props.article.cantidad = 1
  }  
  
    
    
 
},
 
},


    
}
</script>