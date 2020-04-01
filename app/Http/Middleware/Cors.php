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
               ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
               ->header('Access-Control-Allow-Headers', '*');
    }

      return $handle;
        return $next($request)
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    }
}