<?php
namespace App\Service;

use App\Modelo\Imagen;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__."/../../");
$dotenv->load();



define("URL", $_ENV['URL_BASE'].$_ENV['API_KEY'].$_ENV['FILTRO']);
define("IMG", $_ENV['URL_IMG']);


class ApiService{
    public function getFotos() :array{
        $fotos=[];
        $datos = file_get_contents(URL);
        $datosJson=json_decode($datos);
        $datosFotos=$datosJson->hits; //Lo de hits hay que mirarlo con json


        foreach($datosFotos as $objetoFoto){
            $fotos[] = (new Imagen)
            ->setImagen($objetoFoto->webformatURL)
            ->setAutor($objetoFoto->user)
            ->setLikes($objetoFoto->likes);
        }

        return $fotos;

    }
}