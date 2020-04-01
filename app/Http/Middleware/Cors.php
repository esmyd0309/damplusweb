<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $handle = $next($request);

    if(method_exists($handle, 'header'))
    {
        $handle->header('Access-Control-Allow-Origin' , 'http://damplus.estudiojuridicomedina.com/')
               ->header('Access-Control-Allow-Methods', '*')
               ->header('Access-Control-Allow-Headers', '*');
    }

      return $handle;
        return $next($request)
        /*->header('Access-Control-Allow-Origin','*')
        ->header('Access-Control-Allow-Methods','*')    
        ->header('Access-Control-Allow-Headers','*');*/
        //Url a la que se le dará acceso en las peticiones
      ->header("Access-Control-Allow-Origin", "http://damplus.estudiojuridicomedina.com/")
      //Métodos que a los que se da acceso
      ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE")
      //Headers de la petición
      ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization"); 
    }
}