<?php

namespace App\Controllers;

use App\Models\EncuestaModel;
use App\Models\RespuestasModel;

class EncuestaController extends BaseController
{
    public function index()
    {
        $encuestaModel = new EncuestaModel();
        $respuestasModel = new RespuestasModel();

        // Lista de IDs de preguntas
        $ids = [1777, 1778, 1779, 1780, 1781, 1782, 1783, 1784, 1789, 1790, 1791, 1792, 1793, 1794, 1795, 1796, 1797, 1798, 2310, 2311];

        // Obtener las preguntas activas
        $preguntas = $encuestaModel->whereIn('cve_pregunta', $ids)
                                   ->where('activo', 1)
                                   ->findAll();

        // Obtener las respuestas activas y asociarlas a las preguntas correspondientes
        $data['preguntas'] = [];
        foreach ($preguntas as $pregunta) {
            $respuestas = $respuestasModel->where('cve_pregunta', $pregunta['cve_pregunta'])
                                          ->where('activo', 1)
                                          ->findAll();
            $pregunta['respuestas'] = $respuestas;
            // Asegurarse de que la clave 'abierta' esté presente
            if (!isset($pregunta['abierta'])) {
                $pregunta['abierta'] = 0; // O cualquier valor por defecto que tenga sentido
            }
            $data['preguntas'][] = $pregunta;
        }

        //guardar preguntas en la base de datos
        

        // Cargar la vista con los datos
        return view('encuesta/jefeinmediato', $data);
    }
}
