<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Fotografo;

class FotografoController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['listar', 'visualizar', 'filtrar']]);
    }

    public function listar(Request $request)
    {
        try {
            $queryresult = Fotografo::get();
            $adj_soporte = false;
            if ((isset($request['soporte'])) && ($request['soporte'] == 'true')) {
                $SoporteController = new SoporteController;
                $adj_soporte = true;
            }
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
                }
            }
            if ($adj_soporte || $adj_imagenes) {
                for ($r = 0; $r < count($queryresult); $r++) {
                    if ($adj_soporte) {
                        $soportes_id = $queryresult[$r]['soportes_id'];
                        $params = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'id',
                                    'operador' => 'igual',
                                    'dato' => $soportes_id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]['soporte'] = $SoporteController->filtrarinterno($params['comparaciones'], $params['orden']);
                    }
                    if ($adj_imagenes) {
                        $id = $queryresult[$r]['id'];
                        $params2 = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'fotografos_id',
                                    'operador' => 'igual',
                                    'dato' => $id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]['imagenes'] = $ImageneController->filtrarinterno($params2['comparaciones'], $params2['orden'], $adj_tamanhos, $adj_etiquetas, $adj_fotografos);
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
            $queryresult = Fotografo::where('id', $id)->get();
            $adj_soporte = false;
            if ((isset($request['soporte'])) && ($request['soporte'] == 'true')) {
                $SoporteController = new SoporteController;
                $adj_soporte = true;
            }
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
                }
            }
            if ($adj_soporte || $adj_imagenes) {
                for ($r = 0; $r < count($queryresult); $r++) {
                    if ($adj_soporte) {
                        $soportes_id = $queryresult[$r]['soportes_id'];
                        $params = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'id',
                                    'operador' => 'igual',
                                    'dato' => $soportes_id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]['soporte'] = $SoporteController->filtrarinterno($params['comparaciones'], $params['orden']);
                    }
                    if ($adj_imagenes) {
                        $id = $queryresult[$r]['id'];
                        $params2 = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'fotografos_id',
                                    'operador' => 'igual',
                                    'dato' => $id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]['imagenes'] = $ImageneController->filtrarinterno($params2['comparaciones'], $params2['orden'], $adj_tamanhos, $adj_etiquetas, $adj_fotografos);
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
        $tabla = Fotografo::tabla();
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
            $adj_soporte = false;
            if ((isset($request['soporte'])) && ($request['soporte'] == 'true')) {
                $SoporteController = new SoporteController;
                $adj_soporte = true;
            }
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
                }
            }
            if ($adj_soporte || $adj_imagenes) {
                for ($r = 0; $r < count($queryresult); $r++) {
                    if ($adj_soporte) {
                        $soportes_id = $queryresult[$r]->soportes_id;
                        $params = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'id',
                                    'operador' => 'igual',
                                    'dato' => $soportes_id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]->soporte = $SoporteController->filtrarinterno($params['comparaciones'], $params['orden']);
                    }
                    if ($adj_imagenes) {
                        $id = $queryresult[$r]->id;
                        $params2 = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'fotografos_id',
                                    'operador' => 'igual',
                                    'dato' => $id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]->imagenes = $ImageneController->filtrarinterno($params2['comparaciones'], $params2['orden'], $adj_tamanhos, $adj_etiquetas, $adj_fotografos);
                    }
                }
            }
            return response()->json(['respuesta' => true, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function filtrarinterno($comparaciones = array(), $orden = array(), $soporte = 'false', $imagenes = 'false', $tamanhos = 'false', $etiquetas = 'false', $fotografos = 'false')
    {
        $tabla = Fotografo::tabla();
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
            $adj_soporte = false;
            if ($soporte == 'true') {
                $SoporteController = new SoporteController;
                $adj_soporte = true;
            }
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
                }
            }
            if ($adj_soporte || $adj_imagenes) {
                for ($r = 0; $r < count($queryresult); $r++) {
                    if ($adj_soporte) {
                        $soportes_id = $queryresult[$r]->soportes_id;
                        $params = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'id',
                                    'operador' => 'igual',
                                    'dato' => $soportes_id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]->soporte = $SoporteController->filtrarinterno($params['comparaciones'], $params['orden']);
                    }
                    if ($adj_imagenes) {
                        $id = $queryresult[$r]->id;
                        $params2 = array(
                            'comparaciones' => array(
                                array(
                                    'campo' => 'fotografos_id',
                                    'operador' => 'igual',
                                    'dato' => $id
                                )
                            ),
                            'orden' => array()
                        );
                        $queryresult[$r]->imagenes = $ImageneController->filtrarinterno($params2['comparaciones'], $params2['orden'], $adj_tamanhos, $adj_etiquetas, $adj_fotografos);
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
        if ((isset($request['ruta'])) && (strlen($request['ruta']) > 0)) {
            $ruta = $request['ruta'];
        } else {
            $ruta = env('UPLOAD_TEMPDEFAULT');
        }
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $archivo = $request->file('file')->getClientOriginalName();
                $extension = $request->file('file')->getClientOriginalExtension();
                $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                shuffle($chars);
                while (file_exists($ruta . '/' . $archivo)) {
                    $random = $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)];
                    $archivo = str_replace('.' . $extension, '_' . $random . '.' . $extension, $archivo);
                }
                if ($request->file('file')->move($ruta, $archivo)) {
                    (strpos($_SERVER['HTTP_HOST'], 'localhost') === false) ? $urlprefix = 'https://' . $_SERVER['HTTP_HOST'] . '/apifie' : $urlprefix = 'http://' . $_SERVER['HTTP_HOST'];
                    $rutaarchivo = $urlprefix . '/' . $ruta . '/' . $archivo;
                    try {
                        $queryresult = Fotografo::create(
                            [
                                'nombre' => $request['nombre'],
                                'biografia' => $request['biografia'],
                                'imagen' => $rutaarchivo,
                                'soportes_id' => $request['soportes_id']
                            ]
                        );
                        return response()->json(['respuesta' => true, 'resultado' => $queryresult->id]);
                    } catch (QueryException $e) {
                        return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
                    }
                } else {
                    return response()->json(['respuesta' => false, 'resultado' => 'No se pudo cargar el archivo']);
                }
            } else {
                return response()->json([
                    'respuesta' => false,
                    'resultado' => 'Archivo no válido']);
            }
        } else {
            return response()->json(['respuesta' => false, 'resultado' => 'No se encontró un archivo']);
        }
    }

    public function actualizar(Request $request, $id)
    {
        $continuar = false;
        if ((isset($request['ruta'])) && (strlen($request['ruta']) > 0)) {
            $ruta = $request['ruta'];
        } else {
            $ruta = env('UPLOAD_TEMPDEFAULT');
        }
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $archivo = $request->file('file')->getClientOriginalName();
                $extension = $request->file('file')->getClientOriginalExtension();
                $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                shuffle($chars);
                while (file_exists($ruta . '/' . $archivo)) {
                    $random = $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)] . $chars[rand(0, 35)];
                    $archivo = str_replace('.' . $extension, '_' . $random . '.' . $extension, $archivo);
                }
                if ($request->file('file')->move($ruta, $archivo)) {
                    (strpos($_SERVER['HTTP_HOST'], 'localhost') === false) ? $urlprefix = 'https://' . $_SERVER['HTTP_HOST'] . '/apifie' : $urlprefix = 'http://' . $_SERVER['HTTP_HOST'];
                    $rutaarchivo = $urlprefix . '/' . $ruta . '/' . $archivo;
                    $continuar = true;
                } else {
                    $rutaarchivo = '';
                    $continuar = false;
                }
            } else {
                return response()->json([
                    'respuesta' => false,
                    'resultado' => 'Archivo no válido']);
            }
        } else {
            $rutaarchivo = $request['imagen'];
            $continuar = true;
        }
        if ($continuar) {
            try {
                $queryresult = Fotografo::where('id', $id)
                    ->update(
                        [
                            'nombre' => $request['nombre'],
                            'biografia' => $request['biografia'],
                            'imagen' => $rutaarchivo,
                            'soportes_id' => $request['soportes_id']
                        ]
                    );
                return response()->json(['respuesta' => true, 'resultado' => $queryresult->id]);
            } catch (QueryException $e) {
                return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
            }
        } else {
            return response()->json([
                'respuesta' => false,
                'resultado' => 'No se pudo cargar el archivo']);
        }
    }

    public function eliminar(Request $request, $id)
    {
        try {
            Fotografo::where('id', $id)
                ->delete();
            return response()->json(['respuesta' => true]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function campos()
    {
        return Fotografo::campos();
    }

    public function estructura()
    {
        $tabla = Fotografo::tabla();
        $campos = Fotografo::campos();
        $resultado = array();
        for ($i = 0; $i < count($campos); $i++) {
            array_push($resultado, DB::select(DB::raw('SHOW COLUMNS FROM ' . $tabla . ' WHERE field = "' . $campos[$i] . '"')));
        }
        return $resultado;
    }

}