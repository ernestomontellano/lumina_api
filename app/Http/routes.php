<?php

Route::get('/', function () {
    return view('index');
});
Route::group(['prefix' => 'api', 'before' => 'jwt.auth', 'after' => 'jwt.refresh'], function ($api) {
    $api->post('authenticate', 'AuthenticateController@authenticate');
    $api->get('authenticate/refresh', 'TokenController@token');
    $api->post('authenticate/resetpassword', 'SistemaController@resetpassword');
    $api->post('authenticate/checkreset', 'SistemaController@checkreset');
    $api->post('authenticate/newpassword', 'SistemaController@newpassword');

    $api->post('buscar', 'SistemaController@buscar');

    $api->get('contenidos', 'ContenidoController@listar');
    $api->get('contenidos/visualizar/{id}', 'ContenidoController@visualizar');
    $api->post('contenidos/filtrar', 'ContenidoController@filtrar');
    $api->post('contenidos/actualizar/{id}', 'ContenidoController@actualizar');
    $api->get('contenidos/acceso', 'ContenidoController@acceso');
    $api->get('contenidos/campos', 'ContenidoController@campos');
    $api->get('contenidos/estructura', 'ContenidoController@estructura');

    $api->get('etiquetas', 'EtiquetaController@listar');
    $api->get('etiquetas/visualizar/{id}', 'EtiquetaController@visualizar');
    $api->post('etiquetas/filtrar', 'EtiquetaController@filtrar');
    $api->post('etiquetas/almacenar', 'EtiquetaController@almacenar');
    $api->post('etiquetas/actualizar/{id}', 'EtiquetaController@actualizar');
    $api->post('etiquetas/eliminar/{id}', 'EtiquetaController@eliminar');
    $api->get('etiquetas/acceso', 'EtiquetaController@acceso');
    $api->get('etiquetas/campos', 'EtiquetaController@campos');
    $api->get('etiquetas/estructura', 'EtiquetaController@estructura');

    $api->get('fotografos', 'FotografoController@listar');
    $api->get('fotografos/visualizar/{id}', 'FotografoController@visualizar');
    $api->post('fotografos/filtrar', 'FotografoController@filtrar');
    $api->post('fotografos/almacenar', 'FotografoController@almacenar');
    $api->post('fotografos/actualizar/{id}', 'FotografoController@actualizar');
    $api->post('fotografos/eliminar/{id}', 'FotografoController@eliminar');
    $api->get('fotografos/acceso', 'FotografoController@acceso');
    $api->get('fotografos/campos', 'FotografoController@campos');
    $api->get('fotografos/estructura', 'FotografoController@estructura');

    $api->get('imagenes', 'ImageneController@listar');
    $api->get('imagenes/visualizar/{id}', 'ImageneController@visualizar');
    $api->post('imagenes/filtrar', 'ImageneController@filtrar');
    $api->post('imagenes/almacenar', 'ImageneController@almacenar');
    $api->post('imagenes/actualizar/{id}', 'ImageneController@actualizar');
    $api->post('imagenes/eliminar/{id}', 'ImageneController@eliminar');
    $api->get('imagenes/acceso', 'ImageneController@acceso');
    $api->get('imagenes/campos', 'ImageneController@campos');
    $api->get('imagenes/estructura', 'ImageneController@estructura');

    $api->get('imagenesetiquetas', 'ImagenesetiquetaController@listar');
    $api->get('imagenesetiquetas/visualizar/{id}', 'ImagenesetiquetaController@visualizar');
    $api->post('imagenesetiquetas/filtrar', 'ImagenesetiquetaController@filtrar');
    $api->post('imagenesetiquetas/almacenar', 'ImagenesetiquetaController@almacenar');
    $api->post('imagenesetiquetas/actualizar/{id}', 'ImagenesetiquetaController@actualizar');
    $api->post('imagenesetiquetas/eliminar/{id}', 'ImagenesetiquetaController@eliminar');
    $api->get('imagenesetiquetas/acceso', 'ImagenesetiquetaController@acceso');
    $api->get('imagenesetiquetas/campos', 'ImagenesetiquetaController@campos');
    $api->get('imagenesetiquetas/estructura', 'ImagenesetiquetaController@estructura');

    $api->get('imagenestamanhos', 'ImagenestamanhoController@listar');
    $api->get('imagenestamanhos/visualizar/{id}', 'ImagenestamanhoController@visualizar');
    $api->post('imagenestamanhos/filtrar', 'ImagenestamanhoController@filtrar');
    $api->post('imagenestamanhos/almacenar', 'ImagenestamanhoController@almacenar');
    $api->post('imagenestamanhos/actualizar/{id}', 'ImagenestamanhoController@actualizar');
    $api->post('imagenestamanhos/eliminar/{id}', 'ImagenestamanhoController@eliminar');
    $api->get('imagenestamanhos/acceso', 'ImagenestamanhoController@acceso');
    $api->get('imagenestamanhos/campos', 'ImagenestamanhoController@campos');
    $api->get('imagenestamanhos/estructura', 'ImagenestamanhoController@estructura');

    $api->get('soportes', 'SoporteController@listar');
    $api->get('soportes/visualizar/{id}', 'SoporteController@visualizar');
    $api->post('soportes/filtrar', 'SoporteController@filtrar');
    $api->post('soportes/almacenar', 'SoporteController@almacenar');
    $api->post('soportes/actualizar/{id}', 'SoporteController@actualizar');
    $api->post('soportes/eliminar/{id}', 'SoporteController@eliminar');
    $api->get('soportes/acceso', 'SoporteController@acceso');
    $api->get('soportes/campos', 'SoporteController@campos');
    $api->get('soportes/estructura', 'SoporteController@estructura');

    $api->get('tamanhos', 'TamanhoController@listar');
    $api->get('tamanhos/visualizar/{id}', 'TamanhoController@visualizar');
    $api->post('tamanhos/filtrar', 'TamanhoController@filtrar');
    $api->post('tamanhos/almacenar', 'TamanhoController@almacenar');
    $api->post('tamanhos/actualizar/{id}', 'TamanhoController@actualizar');
    $api->post('tamanhos/eliminar/{id}', 'TamanhoController@eliminar');
    $api->get('tamanhos/acceso', 'TamanhoController@acceso');
    $api->get('tamanhos/campos', 'TamanhoController@campos');
    $api->get('tamanhos/estructura', 'TamanhoController@estructura');

    $api->get('usuarios', 'UsuarioController@listar');
    $api->get('usuarios/visualizar/{id}', 'UsuarioController@visualizar');
    $api->post('usuarios/filtrar', 'UsuarioController@filtrar');
    $api->post('usuarios/actualizar/{id}', 'UsuarioController@actualizar');
    $api->get('usuarios/acceso', 'UsuarioController@acceso');
    $api->get('usuarios/campos', 'UsuarioController@campos');
    $api->get('usuarios/estructura', 'UsuarioController@estructura');
    $api->post('usuarios/obtenerid', 'UsuarioController@obtenerid');
    $api->post('usuarios/cambiar/{id}', 'UsuarioController@cambiarpass');
});

function scopeRutas()
{
    return $this->getRoutes();
}