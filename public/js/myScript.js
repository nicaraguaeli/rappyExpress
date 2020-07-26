var audioElement = document.createElement('audio');

$('#navegacion').on('click','li.product',function()
{
  audioPlay('https://notificationsounds.com/soundfiles/d07e70efcfab08731a97e7b91be644de/file-sounds-1049-knob.mp3');
  
  
   




});


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



$('body').on('click','a.add',function()
{
   
  audioPlay('https://notificationsounds.com/soundfiles/d86ea612dec96096c5e0fcc8dd42ab6d/file-sounds-1144-me-too.mp3');
 
  
});
 
   
 


$('#search').on('keyup',function()
{

var value = $(this).val().toLowerCase();
$("#myList .list-card").filter(function() {
$(this).toggle(
  
  //$(this).text().toLowerCase().indexOf(value) > -1
   $(this).attr('title').toLowerCase().indexOf(value) > -1
  
  );
  

});


});

function audioPlay(src)
{
  audioElement.setAttribute('src', src);
  audioElement.currentTime = 0;
  audioElement.play();
}

/*$('body').on('click','button.quitar',function(){

  var precio = $(this).attr('id');
  total-= precio;
  $('.total').empty().append('C$ '+total);
  $(this).parent().parent().parent().remove();
  cart--;
  $('.count').empty().append(cart);
});
*/