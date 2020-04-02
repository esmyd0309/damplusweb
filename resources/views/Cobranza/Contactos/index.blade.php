@extends('layouts.app')

@section('title', 'Contactos | Cobranza')
@section('content')

<div class="container">
  <div class="col-md-12">
    <div class="alert alert-secondary" role="alert">
      <center> <small>BUSCAR CLIENTES COBRANZA</small> </center>
    </div>
    <div class="card card-primary">
      <div class="input-group">
        <input type="text" class="form-control" id="texto" placeholder="Ingrese la Cedula ó Apellidos ">
        <div class="input-group-append">
          <span class="input-group-text">Buscar</span>
        </div>
      </div>
      <div id="resultados" class="bg-light border">
      </div>
    </div>
  </div>
</div>



    
        
<script>
  window.addEventListener('load',function(){
      document.getElementById("texto").addEventListener("keyup", () => {
          if((document.getElementById("texto").value.length)>=0)
              fetch(`buscadorcobranza?texto=${document.getElementById("texto").value}`,{ method:'get' })
              .then(response  =>  response.text() )
              .then(html      =>  {   document.getElementById("resultados").innerHTML = html  })
          else
              document.getElementById("resultados").innerHTML = "No encotrado";
      })
  });  
</script>

<script>
  window.onload = function(){
    var contenedor = document.getElementById('contenedor_carga');
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity = 0;
  }
</script>
@endsection
