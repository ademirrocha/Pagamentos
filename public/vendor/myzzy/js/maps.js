


function MapsRotas(argument) {
    
    var form_url = 'http://payments-mizzy.herokuapp.com/public/api/rotas-maps-autocomplete';

    $.ajax({
        type: "GET",
        url: form_url,
        data: '',
                        
        success: function( data ){
          
               $('#map2').html(data);
             
        }
    });

    return true;
}