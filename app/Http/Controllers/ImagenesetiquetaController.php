<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Imagenesetiqueta;

class ImagenesetiquetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['listar', 'visualizar', 'filtrar']]);
    }

    public function listar(Request $request)
    {
        try {
            $queryresult = Imagenesetiqueta::get();
            $adj_imagenes = false;
            if ((isset($request['imagenes'])) && ($request['imagenes'] == 'true')) {
                $ImageneController = new ImageneController;
                $adj_imagenes = true;
                $adj_tamanhos = 'false';
                if ((isset($request['tamanhos'])) && ($request['tamanhos'] == 'true')) {
                    $adj_tamanhos = 'true';
                }
                $adj_etiquetas = 'false';
                if ((isset($request['etiquetas'])) && ($request['etiquetas'] == 'true')) {
                    $adj_etiquetas = 'true';
                }
                $adj_fotografos = 'false';
                if ((isset($request['fotografos'])) && ($request['fotografos'] == 'true')) {
                    $adj_fotografos = 'true';
                    $adj_soporte = 'false';
                    if ((isset($request['soporte'])) && ($request['soporte'] == 'true')) {
                        $adj_soporte = 'true';
                    }
                }
            }
            if ($adj_imagenes) {
                for ($r = 0; $r < count($queryresult); $r++) {
                    if ($adj_imagenes) {
                        $imagenes_id = $queryresult[$r]['imagenes_id'];
                        $params2 = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'id',
                                    'operador' => 'igual',
                                    'dato' => $imagenes_id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]['imagenes'] = $ImageneController->filtrarinterno($params2['comparaciones'], $params2['orden'], $adj_tamanhos, $adj_etiquetas, $adj_fotografos, $adj_soporte);
                    }
                }
            }
            return response()->json(['respuesta' => true, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function visualizar(Request $request, $id)
    {
        try {
            $queryresult = Imagenesetiqueta::where('id', $id)->get();
            $adj_imagenes = false;
            if ((isset($request['imagenes'])) && ($request['imagenes'] == 'true')) {
                $ImageneController = new ImageneController;
                $adj_imagenes = true;
                $adj_tamanhos = 'false';
                if ((isset($request['tamanhos'])) && ($request['tamanhos'] == 'true')) {
                    $adj_tamanhos = 'true';
                }
                $adj_etiquetas = 'false';
                if ((isset($request['etiquetas'])) && ($request['etiquetas'] == 'true')) {
                    $adj_etiquetas = 'true';
                }
                $adj_fotografos = 'false';
                if ((isset($request['fotografos'])) && ($request['fotografos'] == 'true')) {
                    $adj_fotografos = 'true';
                    $adj_soporte = 'false';
                    if ((isset($request['soporte'])) && ($request['soporte'] == 'true')) {
                        $adj_soporte = 'true';
                    }
                }
            }
            if ($adj_imagenes) {
                for ($r = 0; $r < count($queryresult); $r++) {
                    if ($adj_imagenes) {
                        $imagenes_id = $queryresult[$r]['imagenes_id'];
                        $params2 = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'id',
                                    'operador' => 'igual',
                                    'dato' => $imagenes_id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]['imagenes'] = $ImageneController->filtrarinterno($params2['comparaciones'], $params2['orden'], $adj_tamanhos, $adj_etiquetas, $adj_fotografos, $adj_soporte);
                    }
                }
            }
            return response()->json(['respuesta' => true, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function filtrar(Request $request)
    {
        $tabla = Imagenesetiqueta::tabla();
        $queryresult = DB::table($tabla);
        if ((isset($request['comparaciones'])) && (count($request['comparaciones']) > 0)) {
            $comparaciones = $request['comparaciones'];
            $campo = array();
            $operador = array();
            $dato = array();
            $dato2 = array();
            for ($com = 0; $com < count($comparaciones); $com++) {
                $campo[$com] = $comparaciones[$com]['campo'];
                switch ($comparaciones[$com]['operador']) {
                    case 'igual':
                        $operador[$com] = '=';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'mayor':
                        $operador[$com] = '>';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'menor':
                        $operador[$com] = '<';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'mayorigual':
                        $operador[$com] = '>=';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'menorigual':
                        $operador[$com] = '<=';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'distinto':
                        $operador[$com] = '<>';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'like':
                        $operador[$com] = 'like';
                        $dato[$com] = '%' . $comparaciones[$com]['dato'] . '%';
                        $dato2[$com] = '';
                        break;
                    case 'entre':
                        $operador[$com] = '[]';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = $comparaciones[$com]['dato2'];
                        break;
                }
                if ($operador[$com] == '[]') {
                    $queryresult = $queryresult->where($campo[$com], '>=', $dato[$com])->where($campo[$com], '<=', $dato2[$com]);
                } else {
                    $queryresult = $queryresult->where($campo[$com], $operador[$com], $dato[$com]);
                }
            }
        }
        if ((isset($request['orden'])) && (count($request['orden']) > 0)) {
            $orden = $request['orden'];
            for ($ord = 0; $ord < count($orden); $ord++) {
                $queryresult = $queryresult->orderBy($orden[$ord]['campo'], $orden[$ord]['direccion']);
            }
        }
        if ((isset($request['per_page'])) && ($request['per_page'] > 0)) {
            $per_page = $request['per_page'];
        } else {
            $per_page = env('REGISTROS_X_PAGINA');
        }
        try {
            $queryresult = $queryresult->paginate($per_page);
            $adj_imagenes = false;
            if ((isset($request['imagenes'])) && ($request['imagenes'] == 'true')) {
                $ImageneController = new ImageneController;
                $adj_imagenes = true;
                $adj_tamanhos = 'false';
                if ((isset($request['tamanhos'])) && ($request['tamanhos'] == 'true')) {
                    $adj_tamanhos = 'true';
                }
                $adj_etiquetas = 'false';
                if ((isset($request['etiquetas'])) && ($request['etiquetas'] == 'true')) {
                    $adj_etiquetas = 'true';
                }
                $adj_fotografos = 'false';
                if ((isset($request['fotografos'])) && ($request['fotografos'] == 'true')) {
                    $adj_fotografos = 'true';
                    $adj_soporte = 'false';
                    if ((isset($request['soporte'])) && ($request['soporte'] == 'true')) {
                        $adj_soporte = 'true';
                    }
                }
            }
            if ($adj_imagenes) {
                for ($r = 0; $r < count($queryresult); $r++) {
                    if ($adj_imagenes) {
                        $imagenes_id = $queryresult[$r]->imagenes_id;
                        $params2 = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'id',
                                    'operador' => 'igual',
                                    'dato' => $imagenes_id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]->imagenes = $ImageneController->filtrarinterno($params2['comparaciones'], $params2['orden'], $adj_tamanhos, $adj_etiquetas, $adj_fotografos, $adj_soporte);
                    }
                }
            }
            return response()->json(['respuesta' => true, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function filtrarinterno($comparaciones = array(), $orden = array(), $imagenes = 'false', $tamanhos = 'false', $etiquetas = 'false', $fotografos = 'false', $soporte = 'false')
    {
        $tabla = Imagenesetiqueta::tabla();
        $queryresult = DB::table($tabla);
        if (count($comparaciones) > 0) {
            $campo = array();
            $operador = array();
            $dato = array();
            $dato2 = array();
            for ($com = 0; $com < count($comparaciones); $com++) {
                $campo[$com] = $comparaciones[$com]['campo'];
                switch ($comparaciones[$com]['operador']) {
                    case 'igual':
                        $operador[$com] = '=';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'mayor':
                        $operador[$com] = '>';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'menor':
                        $operador[$com] = '<';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'mayorigual':
                        $operador[$com] = '>=';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'menorigual':
                        $operador[$com] = '<=';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'distinto':
                        $operador[$com] = '<>';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = '';
                        break;
                    case 'like':
                        $operador[$com] = 'like';
                        $dato[$com] = '%' . $comparaciones[$com]['dato'] . '%';
                        $dato2[$com] = '';
                        break;
                    case 'entre':
                        $operador[$com] = '[]';
                        $dato[$com] = $comparaciones[$com]['dato'];
                        $dato2[$com] = $comparaciones[$com]['dato2'];
                        break;
                }
                if ($operador[$com] == '[]') {
                    $queryresult = $queryresult->where($campo[$com], '>=', $dato[$com])->where($campo[$com], '<=', $dato2[$com]);
                } else {
                    $queryresult = $queryresult->where($campo[$com], $operador[$com], $dato[$com]);
                }
            }
        }
        if (count($orden) > 0) {
            for ($ord = 0; $ord < count($orden); $ord++) {
                $queryresult = $queryresult->orderBy($orden[$ord]['campo'], $orden[$ord]['direccion']);
            }
        }
        try {
            $queryresult = $queryresult->get();
            $adj_imagenes = false;
            if ($imagenes == 'true') {
                $ImageneController = new ImageneController;
                $adj_imagenes = true;
                $adj_tamanhos = 'false';
                if ($tamanhos == 'true') {
                    $adj_tamanhos = 'true';
                }
                $adj_etiquetas = 'false';
                if ($etiquetas == 'true') {
                    $adj_etiquetas = 'true';
                }
                $adj_fotografos = 'false';
                if ($fotografos == 'true') {
                    $adj_fotografos = 'true';
                    $adj_soporte = 'false';
                    if ($soporte == 'true') {
                        $adj_soporte = 'true';
                    }
                }
            }
            if ($adj_imagenes) {
                for ($r = 0; $r < count($queryresult); $r++) {
                    if ($adj_imagenes) {
                        $imagenes_id = $queryresult[$r]->imagenes_id;
                        $params2 = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'id',
                                    'operador' => 'igual',
                                    'dato' => $imagenes_id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]->imagenes = $ImageneController->filtrarinterno($params2['comparaciones'], $params2['orden'], $adj_tamanhos, $adj_etiquetas, $adj_fotografos, $adj_soporte);
                    }
                }
            }
            return $queryresult;
        } catch (QueryException $e) {
            return $e->errorInfo;
        }
    }

    public function almacenar(Request $request)
    {
        try {
            $queryresult = Imagenesetiqueta::create(
                [
                    'imagenes_id' => $request['imagenes_id'],
                    'etiquetas_id' => $request['etiquetas_id']
                ]
            );
            return response()->json(['respuesta' => true, 'resultado' => $queryresult->id]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function actualizar(Request $request, $id)
    {
        try {
            $queryresult = Imagenesetiqueta::where('id', $id)
                ->update(
                    [
                        'imagenes_id' => $request['imagenes_id'],
                        'etiquetas_id' => $request['etiquetas_id']
                    ]
                );
            return response()->json(['respuesta' => true, 'resultado' => $queryresult->id]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function eliminar(Request $request, $id)
    {
        try {
            Imagenesetiqueta::where('id', $id)
                ->delete();
            return response()->json(['respuesta' => true]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function campos()
    {
        return Imagenesetiqueta::campos();
    }

    public function estructura()
    {
        $tabla = Imagenesetiqueta::tabla();
        $campos = Imagenesetiqueta::campos();
        $resultado = array();
        for ($i = 0; $i < count($campos); $i++) {
            array_push($resultado, DB::select(DB::raw('SHOW COLUMNS FROM ' . $tabla . ' WHERE field = "' . $campos[$i] . '"')));
        }
        return $resultado;
    }

}