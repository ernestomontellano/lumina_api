<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Route;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Usuario;
use Hash;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function listar(Request $request)
    {
        try {
            $queryresult = Usuario::select('id', 'email', 'nombre', 'apellido')
                ->get();
            return response()->json(['respuesta' => true, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function visualizar(Request $request, $id)
    {
        try {
            $queryresult = Usuario::select('id', 'email', 'nombre', 'apellido')
                ->where('id', $id)
                ->get();
            return response()->json(['respuesta' => true, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }

    }

    public function filtrar(Request $request)
    {
        $TokenController = new TokenController;
        $userid = $TokenController->usertoken();
        $tabla = Usuario::tabla();
        $queryresult = DB::table($tabla)->select('id', 'nombre', 'apellido', 'email');
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
        if (!(isset($request['own']))) {
            $queryresult = $queryresult->where('id', '!=', $userid->id);
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
            return response()->json(['respuesta' => true, 'own' => $userid, 'owner_id' => $userid->id, 'resultado' => $queryresult]);
        } catch (QueryException $e) {
            return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
        }
    }

    public function filtrarinterno($comparaciones = array(), $orden = array())
    {
        $tabla = Usuario::tabla();
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

    public function usuarioidxmail($email = '')
    {
        if (strlen($email) > 0) {
            $queryresult = Usuario::select('id')
                ->where('email', $email)
                ->get();
            if (count($queryresult) > 0) {
                if ($queryresult[0]['id'] > 0) {
                    return $queryresult[0]['id'];
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function crearresetdata($usuarioid, $urltoken, $fechavencimiento)
    {
        try {
            Usuario::where('id', $usuarioid)
                ->update(
                    [
                        'reset_token' => $urltoken,
                        'reset_date' => $fechavencimiento
                    ]
                );
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    public function verificarresetdata($usuarioid, $urltoken)
    {
        date_default_timezone_set('America/La_Paz');
        $fecha = date('Y-m-d');
        try {
            $queryresult = Usuario::select('reset_token', 'reset_date')
                ->where('id', $usuarioid)
                ->get();
            if (count($queryresult) > 0) {
                if ($urltoken == $queryresult[0]['reset_token']) {
                    if ($fecha <= $queryresult[0]['reset_date']) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    public function actualizar(Request $request, $id)
    {
        $TokenController = new TokenController;
        $usuario = $TokenController->usertoken();
        if ($usuario['id'] == $id) {
            $tabla = Usuario::tabla();
            try {
                Usuario::where('id', $id)
                    ->update(
                        [
                            'email' => $request['email'],
                            'nombre' => $request['nombre'],
                            'apellido' => $request['apellido']
                        ]
                    );
                return response()->json(['respuesta' => true]);
            } catch (QueryException $e) {
                return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
            }
        } else {
            return response()->json(['respuesta' => false, 'resultado' => 'Permisos de usuario insuficientes']);
        }
    }

    public function campos()
    {
        return Usuario::campos();
    }

    public function estructura()
    {
        $tabla = Usuario::tabla();
        $campos = Usuario::campos();
        $resultado = array();
        for ($i = 0; $i < count($campos); $i++) {
            array_push($resultado, DB::select(DB::raw('SHOW COLUMNS FROM ' . $tabla . ' WHERE field = "' . $campos[$i] . '"')));
        }
        return $resultado;
    }

    public function obtenerid()
    {
        $TokenController = new TokenController;
        $usuario = $TokenController->usertoken();
        if ($usuario['id'] > 0) {
            return response()->json(['respuesta' => true, 'resultado' => $usuario['id']]);
        } else {
            return response()->json(['respuesta' => false, 'resultado' => 'Permisos de usuario insuficientes']);
        }
    }

    public function cambiarpass(Request $request, $id)
    {
        $TokenController = new TokenController;
        $usuario = $TokenController->usertoken();
        if ($usuario['id'] == $id) {
            try {
                Usuario::where('id', $id)
                    ->update(
                        [
                            'password' => Hash::make($request['password'])
                        ]
                    );
                return response()->json(['respuesta' => true]);
            } catch (QueryException $e) {
                return response()->json(['respuesta' => false, 'resultado' => $e->errorInfo]);
            }
        } else {
            return response()->json(['respuesta' => false, 'resultado' => 'Permisos de usuario insuficientes']);
        }
    }

    public function resetearpass($id, $pass)
    {
        try {
            Usuario::where('id', $id)
                ->update(
                    [
                        'password' => Hash::make($pass),
                        'reset_token' => NULL,
                        'reset_date' => NULL
                    ]
                );
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

}