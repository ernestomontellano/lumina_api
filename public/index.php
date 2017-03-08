<?php

//switch ($_SERVER['HTTP_ORIGIN']) {
//    case 'https://www.fiedesarrollo.com':
//    case 'https://fieadmin.fiedesarrollo.com':
//        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
//        break;
//    default:
//        header('Access-Control-Allow-Origin: https://www.fiedesarrollo.com');
//        break;
//}
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: accept, authorization, X-Requested-With, Content-Type, Content-Range, Content-Disposition, Content-Description');
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */
/*
  |--------------------------------------------------------------------------
  | Register The Auto Loader
  |--------------------------------------------------------------------------
  |
  | Composer provides a convenient, automatically generated class loader for
  | our application. We just need to utilize it! We'll simply require it
  | into the script here so that we don't have to worry about manual
  | loading any of our classes later on. It feels nice to relax.
  |
 */
//require __DIR__ . '/../../fieapi/bootstrap/autoload.php';
require __DIR__ . '/../bootstrap/autoload.php';
/*
  |--------------------------------------------------------------------------
  | Turn On The Lights
  |--------------------------------------------------------------------------
  |
  | We need to illuminate PHP development, so let us turn on the lights.
  | This bootstraps the framework and gets it ready for use, then it
  | will load up this application so that we can run it and send
  | the responses back to the browser and delight our users.
  |
 */
//$app = require_once __DIR__ . '/../../fieapi/bootstrap/app.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
/*
  |--------------------------------------------------------------------------
  | Run The Application
  |--------------------------------------------------------------------------
  |
  | Once we have the application, we can handle the incoming request
  | through the kernel, and send the associated response back to
  | the client's browser allowing them to enjoy the creative
  | and wonderful application we have prepared for them.
  |
 */
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);
