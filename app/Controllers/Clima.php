<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;




class Clima extends BaseController
{
    use ResponseTrait;
    

    public function index()
    {
        return view('ubicaciones');
    }

    public function getUbicaciones(){
       
        $model = model('ClimaModel');
        $data['datos'] = $model->getUbicaciones();
        
        $response = response();

        $response->setStatusCode(Response::HTTP_OK);
        $response->setBody(json_encode($data));
        $response->setHeader('Content-Type', 'text/html');
        $response->noCache();

    
        $response->send();

       // return view('datos',$data);
    }

    public function getClimaByCP(){
        $model = model('ClimaModel');
        $data['datos'] = $model->getClimaByCP();
        return view('datos',$data);
    }

    public function getClimaByFechas(){
        $model = model('ClimaModel');
        $data['datos'] = $model->getClimaByFechas();
        return view('datos',$data);
    }

    public function formularioClima(){

        return view('formularioClima');
    }

    public function insertClima(){
        $response = response();

        $data = [
            'latitud' =>$_POST['latitud'],
            'longitud' =>'-39.309203',
            'ubicacion' =>$_POST['ubicacion'],
            'fecha' => date('Y-m-d'),
            'hora' => date('h:s'),
            'temperatura' =>"20",
            'humedad' =>"70",
            'altitud' =>'1200',
            'sensacionTermica'=>"24",
            'tipo'=>1,
            'CP' =>$_POST['CP']
        ];
        $model = model('ClimaModel');

        if($model->insertClima($data)){
            $data["error"] = false;
        }
        else{
            $data["error"] = "no se insertó";
        }
        
       
        $response->setStatusCode(Response::HTTP_OK);
        $response->setBody(json_encode($data));
        $response->setHeader('Content-Type', 'text/html');
        $response->noCache();

    
        $response->send();
    }
}