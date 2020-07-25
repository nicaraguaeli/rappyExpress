<template>
   
        <tr >
        
        <td class="text-uppercase">{{article.nombre }} | {{article.marca }} | {{article.presentacion }}</td>
        <td><input @input="update()"   class="form-control" type="number" min="1" v-model="article.cantidad"></td>
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
     
     
     return value
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
    
    
    this.$emit("update")
 
}
 
},

    
}
</script>