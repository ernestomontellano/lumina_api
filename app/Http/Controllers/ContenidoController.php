<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Contenido;

class ContenidoController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['listar', 'visualizar', 'filtrar']]);
    }

    public function listar(Request $request)
    {
        try {
            $queryresult = Contenido::get();
            return response()->json(['respuesta' => true, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function visualizar(Request $request, $id)
    {
        try {
            $queryresult = Contenido::where('id', $id)
                ->get();
            return response()->json(['respuesta' => true, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function filtrar(Request $request)
    {
        $tabla = Contenido::tabla();
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
        $tabla = Contenido::tabla();
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

    public function actualizar(Request $request, $id)
    {
        try {
            $queryresult = Contenido::where('id', $id)
                ->update(
                    [
                        'state' => $request['state'],
                        'contenido' => $request['contenido']
                    ]
                );
            return response()->json(['respuesta' => true, 'resultado' => $queryresult->id]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function campos()
    {
        return Contenido::campos();
    }

    public function estructura()
    {
        $tabla = Contenido::tabla();
        $campos = Contenido::campos();
        $resultado = array();
        for ($i = 0; $i < count($campos); $i++) {
            array_push($resultado, DB::select(DB::raw('SHOW COLUMNS FROM ' . $tabla . ' WHERE field = "' . $campos[$i] . '"')));
        }
        return $resultado;
    }

}