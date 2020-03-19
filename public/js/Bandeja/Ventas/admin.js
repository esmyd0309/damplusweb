
$(document).ready(function(){
    
  

    var grupo = $("#grupo");


    var route = "http://192.168.1.105/ventasgrupo";
    $.get(route, function(res){
       
        $(res).each(function (index,value){
            var agendados = value.agendados;
         
            agendados.forEach(function (elemento, indice, array) {
          
            grupo.append("<div class='col-3'><div class='card border-success mb-3' style='max-width: 18rem;'><div class='card-header border-success bg-primary'>"+ elemento.users +"&nbsp;&nbsp;"+elemento.cantidad+"</div><div class='card-body text-success'><h5 class='card-title'></h5><p class='card-text'></p></div><div class='card-footer bg-transparent border-success'></div></div></div>");
            
        });
        });

    });

  
});