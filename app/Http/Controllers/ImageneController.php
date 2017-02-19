<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Imagene;

class ImageneController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['listar', 'visualizar', 'filtrar']]);
    }

    public function listar(Request $request)
    {
        try {
            $queryresult = Imagene::get();
            return response()->json(['respuesta' => true, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function visualizar(Request $request, $id)
    {
        try {
            $queryresult = Imagene::where('id', $id)
                ->get();
            return response()->json(['respuesta' => true, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function filtrar(Request $request)
    {
        $tabla = Imagene::tabla();
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
            return response()->json(['respuesta' => true, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function filtrarinterno($comparaciones = array(), $orden = array())
    {
        $tabla = Imagene::tabla();
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
                        $queryresult = Imagene::create(
                            [
                                'nombre' => $request['nombre'],
                                'codigo' => $request['codigo'],
                                'imagen' => $rutaarchivo,
                                'descripcion' => $request['descripcion'],
                                'fotografos_id' => $request['fotografos_id'],
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
                $queryresult = Imagene::where('id', $id)
                    ->update(
                        [
                            'nombre' => $request['nombre'],
                            'codigo' => $request['codigo'],
                            'imagen' => $rutaarchivo,
                            'descripcion' => $request['descripcion'],
                            'fotografos_id' => $request['fotografos_id'],
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
            Imagene::where('id', $id)
                ->delete();
            return response()->json(['respuesta' => true]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function campos()
    {
        return Imagene::campos();
    }

    public function estructura()
    {
        $tabla = Imagene::tabla();
        $campos = Imagene::campos();
        $resultado = array();
        for ($i = 0; $i < count($campos); $i++) {
            array_push($resultado, DB::select(DB::raw('SHOW COLUMNS FROM ' . $tabla . ' WHERE field = "' . $campos[$i] . '"')));
        }
        return $resultado;
    }

}