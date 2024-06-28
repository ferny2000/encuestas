<?php

namespace App\Models;

use CodeIgniter\Model;

class EncuestaModel extends Model
{
    protected $table = 'pregunta';
    protected $primaryKey = 'cve_pregunta';
    protected $allowedFields = ['cve_pregunta', 'pregunta', 'tipo_pregunta', 'activo'];

    public function getPreguntasByIds($ids)
    {
        return $this->whereIn('cve_pregunta', $ids)->findAll();
    }
}
class RespuestasModel extends Model
{
    protected $table = 'respuesta';
    protected $primaryKey = 'cve_respuesta';
    protected $allowedFields = ['cve_respuesta', 'cve_pregunta', 'respuesta', 'abierta', 'activo'];

    public function getRespuestasByPreguntaIds($preguntaIds)
    {
        return $this->where('activo', 1)
                    ->whereIn('cve_pregunta', $preguntaIds)
                    ->findAll();
    }
}
class GuardarRespuestaModel extends Model
{
    protected $table = 'pregunta_respuesta';
    protected $allowedFields = ['cve_respuesta', 'cve_pregunta', 'cve_encuestado'];
    
    // Definimos que no hay clave primaria única, ya que es una tabla de relaciones
    protected $useAutoIncrement = false;
    protected $primaryKey = ''; 
}
class GuardarRespuestaAbiertaModel extends Model
{
    protected $table = 'pregunta_respuesta_abierta';
    protected $allowedFields = ['cve_respuesta', 'cve_pregunta', 'cve_encuestado', 'comentario'];
    
    // Definimos que no hay clave primaria única, ya que es una tabla de relaciones
    protected $useAutoIncrement = false;
    protected $primaryKey = '';
}