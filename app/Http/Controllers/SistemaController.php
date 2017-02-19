<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;

class SistemaController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['buscar', 'tcl', 'resetpassword', 'checkreset', 'newpassword']]);
    }

    public function buscar(Request $request)
    {
        $criteriotemp = $request['criterio'];
        $criteriotemp = str_replace(array(',', '.', ';', '-', '_'), ' ', $criteriotemp);
        $criteriotemp = str_replace(array('     ', '    ', '   ', '  '), ' ', $criteriotemp);
        $criterios = explode(' ', $criteriotemp);
        if (count($criterios) > 0) {
            $BusquedaController = new BusquedaController;
            $BusquedaController->buscar($request['criterio']);
            $resultados = array();
            // <productos>
            $ProductoController = new ProductoController;
            for ($i = 0; $i < count($criterios); $i++) {
                if (strlen($criterios[$i]) > 2) {
                    // <nombre>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'nombre',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $productos = $ProductoController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($productos) > 0) {
                        for ($r = 0; $r < count($productos); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'productos') && ($resultados[$res]['registro']['id'] == $productos[$r]['id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                array_push($resultados, ['seccion' => 'productos', 'registro' => $productos[$r]]);
                            }
                        }
                    }
                    // </nombre>
                    // <descripcion>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'descripcion',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $productos = $ProductoController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($productos) > 0) {
                        for ($r = 0; $r < count($productos); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'productos') && ($resultados[$res]['registro']['id'] == $productos[$r]['id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                array_push($resultados, ['seccion' => 'productos', 'registro' => $productos[$r]]);
                            }
                        }
                    }
                    // </descripcion>
                }
            }
            // </productos>
            // <noticias>
            $NoticiaController = new NoticiaController;
            for ($i = 0; $i < count($criterios); $i++) {
                if (strlen($criterios[$i]) > 2) {
                    // <titulo>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'titulo',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $noticias = $NoticiaController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($noticias) > 0) {
                        for ($r = 0; $r < count($noticias); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'noticias') && ($resultados[$res]['registro']['id'] == $noticias[$r]['id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                array_push($resultados, ['seccion' => 'noticias', 'registro' => $noticias[$r]]);
                            }
                        }
                    }
                    // </titulo>
                    // <avance>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'avance',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $noticias = $NoticiaController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($noticias) > 0) {
                        for ($r = 0; $r < count($noticias); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'noticias') && ($resultados[$res]['registro']['id'] == $noticias[$r]['id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                array_push($resultados, ['seccion' => 'noticias', 'registro' => $noticias[$r]]);
                            }
                        }
                    }
                    // </avance>
                    // <contenido>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'contenido',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $noticias = $NoticiaController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($noticias) > 0) {
                        for ($r = 0; $r < count($noticias); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'noticias') && ($resultados[$res]['registro']['id'] == $noticias[$r]['id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                array_push($resultados, ['seccion' => 'noticias', 'registro' => $noticias[$r]]);
                            }
                        }
                    }
                    // </contenido>
                }
            }
            // </noticias>
            // <comunicados>
            $ComunicadoController = new ComunicadoController;
            for ($i = 0; $i < count($criterios); $i++) {
                if (strlen($criterios[$i]) > 2) {
                    // <titulo>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'titulo',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $comunicados = $ComunicadoController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($comunicados) > 0) {
                        for ($r = 0; $r < count($comunicados); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'comunicados') && ($resultados[$res]['registro']['id'] == $comunicados[$r]['id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                array_push($resultados, ['seccion' => 'comunicados', 'registro' => $comunicados[$r]]);
                            }
                        }
                    }
                    // </titulo>
                    // <contenido>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'contenido',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $comunicados = $ComunicadoController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($comunicados) > 0) {
                        for ($r = 0; $r < count($comunicados); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'comunicados') && ($resultados[$res]['registro']['id'] == $comunicados[$r]['id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                array_push($resultados, ['seccion' => 'comunicados', 'registro' => $comunicados[$r]]);
                            }
                        }
                    }
                    // </contenido>
                }
            }
            // </comunicados>
            // <remates>
            $RemateController = new RemateController;
            for ($i = 0; $i < count($criterios); $i++) {
                if (strlen($criterios[$i]) > 2) {
                    // <titulo>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'titulo',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $remates = $RemateController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($remates) > 0) {
                        for ($r = 0; $r < count($remates); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'remates') && ($resultados[$res]['registro']['id'] == $remates[$r]['id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                array_push($resultados, ['seccion' => 'remates', 'registro' => $remates[$r]]);
                            }
                        }
                    }
                    // </titulo>
                    // <descripcion>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'descripcion',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $remates = $RemateController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($remates) > 0) {
                        for ($r = 0; $r < count($remates); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'remates') && ($resultados[$res]['registro']['id'] == $remates[$r]['id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                array_push($resultados, ['seccion' => 'remates', 'registro' => $remates[$r]]);
                            }
                        }
                    }
                    // </descripcion>
                }
            }
            // </remates>
            // <agencias>
            $AgenciaController = new AgenciaController;
            for ($i = 0; $i < count($criterios); $i++) {
                if (strlen($criterios[$i]) > 2) {
                    // <nombre>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'nombre',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $agencias = $AgenciaController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($agencias) > 0) {
                        for ($r = 0; $r < count($agencias); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'agencias') && ($resultados[$res]['registro']['id'] == $agencias[$r]['id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                array_push($resultados, ['seccion' => 'agencias', 'registro' => $agencias[$r]]);
                            }
                        }
                    }
                    // </nombre>
                    // <direccion>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'direccion',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $agencias = $AgenciaController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($agencias) > 0) {
                        for ($r = 0; $r < count($agencias); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'agencias') && ($resultados[$res]['registro']['id'] == $agencias[$r]['id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                array_push($resultados, ['seccion' => 'agencias', 'registro' => $agencias[$r]]);
                            }
                        }
                    }
                    // </direccion>
                }
            }
            // </agencias>
            // <contenidos>
            $ContenidoController = new ContenidoController;
            for ($i = 0; $i < count($criterios); $i++) {
                if (strlen($criterios[$i]) > 2) {
                    // <contenido>
                    $params = array(
                        'comparaciones' => array(
                            array(
                                'campo' => 'contenido',
                                'operador' => 'like',
                                'dato' => $criterios[$i]
                            )
                        ),
                        'orden' => array()
                    );
                    $contenidos = $ContenidoController->filtrarinterno($params['comparaciones'], $params['orden']);
                    if (count($contenidos) > 0) {
                        for ($r = 0; $r < count($contenidos); $r++) {
                            $existe = 0;
                            for ($res = 0; $res < count($resultados); $res++) {
                                if ((isset($resultados[$res]->seccion)) && ($resultados[$res]->seccion == 'contenidos') && ($resultados[$res]['registro']['paginas_id'] == $contenidos[$r]['paginas_id'])) {
                                    $existe++;
                                }
                            }
                            if ($existe == 0) {
                                $PaginaController = new PaginaController;
                                $params2 = array(
                                    'comparaciones' => array(
                                        array(
                                            'campo' => 'id',
                                            'operador' => 'igual',
                                            'dato' => $contenidos[$r]->paginas_id
                                        )
                                    ),
                                    'orden' => array()
                                );
                                $contenidos[$r]->pagina = $PaginaController->filtrarinterno($params2['comparaciones'], $params2['orden']);
                                array_push($resultados, ['seccion' => 'contenidos', 'registro' => $contenidos[$r]]);
                            }
                        }
                    }
                    // </contenido>
                }
            }
            // </contenidos>
            return response()->json(['respuesta' => true, 'resultado' => $resultados]);
        } else {
            return response()->json(['respuesta' => false, 'resultado' => 'Criterio de búsqueda inexistente']);
        }
    }

    public function resetpassword(Request $request)
    {
        if (($request['gc'] != null)) {
            $recaptcha_secret = env('RECAPTCHA_SECRET');
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $request['gc']);
            $response = json_decode($response, true);
            if ($response["success"] === true) {
                if ((isset($request['email'])) && (strlen($request['email']) > 0)) {
                    date_default_timezone_set('America/La_Paz');
                    $fechahora = date('YmdHms');
                    $fecha = date('Y-m-d');
                    $fechavencimiento = strtotime('+7 day', strtotime($fecha));
                    $fechavencimiento = date('Y-m-j', $fechavencimiento);
                    $urltoken = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . $fechahora . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
                    $urltoken = Hash::make($urltoken);
                    $UsuarioController = new UsuarioController;
                    $usuarioid = $UsuarioController->usuarioidxmail($request['email']);
                    if ($usuarioid > 0) {
                        $datacreada = $UsuarioController->crearresetdata($usuarioid, $urltoken, $fechavencimiento);
                        if ($datacreada) {
                            $para = $request['email'];
                            $titulo = 'Restablecer contraseña de acceso';
                            $idcamuflado = rand(0, 9) . rand(0, 9) . rand(0, 9) . $usuarioid . rand(0, 9) . rand(0, 9) . rand(0, 9);
                            if ((isset($request['fs'])) && ($request['fs'] == 'api')) {
                                $enlace = 'https://' . $_SERVER['HTTP_HOST'] . '/#/auth/resetpass/' . $idcamuflado . '/' . $urltoken;
                            } else {
                                $enlace = env('RESETPASS_URL') . '/' . $idcamuflado . '/' . $urltoken;
                            }
                            $data = array('enlace' => $enlace);
                            Mail::send(['emails.resetpassword.html', 'emails.resetpassword.text'], $data, function ($message) use ($titulo, $para) {
                                $message->subject($titulo);
                                $message->to($para);
                            });
                            return response()->json(true);
                        } else {
                            return response()->json(['error' => 'internal_error'], 401);
                        }
                    } else {
                        return response()->json(['error' => 'invalid_email'], 401);
                    }
                } else {
                    return response()->json(['error' => 'insufficient_params'], 401);
                }
            } else {
                return response()->json(['error' => 'is_robot'], 401);
            }
        } else {
            return response()->json(['error' => 'not_security_validation'], 401);
        }
    }

    public function checkreset(Request $request)
    {
        if ((isset($request['ic'])) && (isset($request['utk'])) && (strlen($request['ic']) > 6) && (strlen($request['utk']) > 0)) {
            $idlength = strlen($request['ic']) - 6;
            $id = substr($request['ic'], 0, -3);
            $id = substr($id, -$idlength, $idlength);
            $UsuarioController = new UsuarioController;
            $verificarreset = $UsuarioController->verificarresetdata($id, $request['utk']);
            if ($verificarreset) {
                return response()->json(true);
            } else {
                return response()->json(['error' => 'invalid'], 500);
            }
        } else {
            return response()->json(['error' => 'insufficient_params'], 401);
        }
    }

    public function newpassword(Request $request)
    {
        if ($request['gc'] != null) {
            $recaptcha_secret = env('RECAPTCHA_SECRET');
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $request['gc']);
            $response = json_decode($response, true);
            if ($response["success"] === true) {
                if ((isset($request['ic'])) && (isset($request['utk'])) && (isset($request['password'])) && (strlen($request['ic']) > 6) && (strlen($request['utk']) > 0) && (strlen($request['password']) > 0)) {
                    $idlength = strlen($request['ic']) - 6;
                    $id = substr($request['ic'], 0, -3);
                    $id = substr($id, -$idlength, $idlength);
                    $UsuarioController = new UsuarioController;
                    $verificarreset = $UsuarioController->verificarresetdata($id, $request['utk']);
                    if ($verificarreset) {
                        $resetearpass = $UsuarioController->resetearpass($id, $request['password']);
                        if ($resetearpass) {
                            return response()->json(true);
                        } else {
                            return response()->json(['error' => 'internal_error'], 500);
                        }
                    } else {
                        return response()->json(['error' => 'invalid'], 500);
                    }
                } else {
                    return response()->json(['error' => 'insufficient_params'], 401);
                }
            } else {
                return response()->json(['error' => 'is_robot'], 401);
            }
        } else {
            return response()->json(['error' => 'not_security_validation'], 401);
        }
    }

}