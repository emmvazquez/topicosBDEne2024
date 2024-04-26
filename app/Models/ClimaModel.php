<?php

namespace App\Models;

use CodeIgniter\Model;

class ClimaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'clima';
    protected $primaryKey       = 'idClima';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['latitud','logitud','ubicacion','fecha',
                                    'hora','temperatura','humedad','altitud',
                                    'sensacionTermica','tipo','CP'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getUbicaciones(){
    $db      = db_connect();
        $builder = $db->table('clima')
                    ->select('ubicacion')
                    ->groupBy('ubicacion');

        $query = $builder->get();
        return $query->getResult();
    }

    //SELECT latitud, longitud, fecha, hora, temperatura, 
     //       humedad FROM `clima` where CP = 5
    public function getClimaByCP(){
        $request = request();
        $cp = $request->getGet('cp');
        $db = db_connect();
        $sql = $db->table('clima')
                ->select('latitud', 'longitud', 
                'fecha', 'hora', 'temperatura')
                ->where('CP',$cp);
        $query = $sql->get();
        return $query->getResult();
    }

    public function getClimaByFechas(){
        $request = request();
        $fechaInicial = $request->getGet('fechaInicial');
        $fechaFinal = $request->getGet('fechaFinal');
        
        $db = db_connect();
        $sql = $db->table('clima')
                ->select('latitud', 'longitud', 
                'fecha', 'hora', 'temperatura')
                ->where('fecha>=',$fechaInicial)
                ->Where('fecha<=',$fechaFinal);
        $query = $sql->get();
        return $query->getResult();
    }

    public function insertClima($data){ 
        $this->insert($data);
        return true;
    }
}
