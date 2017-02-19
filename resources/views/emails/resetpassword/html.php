<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Mailing FIE</title>
    </head>
    <body style="background-color: #939598; color:#939598; font-family: Helvetica, sans-serif; font-size: 16px; padding: 40px">

        <table style="border-spacing: 0; overflow:hidden; display: block; margin:0 auto; background-color: #ffffff; width: 600px;">
            <thead style="background-color: #ffffff; width: 600px;">
                <tr>
                    <th colspan="10" style="border-bottom: solid 5px #DD007D; width:600px; padding: 15px 0;text-align: center; vertical-align: middle;">
                        <img style="font-weight:bold; font-size: 22px; margin:0; padding:0; color:#333333; vertical-align: top; display: inline-block; height: 45px;" alt="Banco FIE" src="https://www.fiedesarrollo.com/app/img/logo-fie.png">
                    </th>
                </tr>
            </thead>
            <tbody style="width: 600px;">
                <tr>
                    <td colspan="10" style="width: 600px;padding: 20px 40px;">
                        <h3 style="color: #004F97; font-family: Verdana, sans-serif; font-size: 20px; text-align: center; margin: 30px auto 0 auto; font-weight: normal;">Hola!</h3>
                        <p>
                            Recibimos una solicitud para restablecer tu contraseña de acceso, si no fuiste tu por favor ignora este mensaje.
                            <br><br>
                            Para restablecer tu contraseña por favor haz clic en el siguiente enlace:
                            <br>
                            <a href="<?php echo $enlace; ?>" target="_blank"><?php echo $enlace; ?></a>
                        </p>
                        <h5 style="color:#004F97; font-size: 16px; font-weight: normal; text-align: center; margin: 60px auto 0 auto;">Saludos, Banco FIE</h5>
                        <h6 style="color:#004F97; font-size: 14px; font-weight: normal; text-align: center; margin: 0 auto 15px auto;">Visita nuestra página <a href="https://www.fiedesarrollo.com/" target="_blank" style="text-decoration: underline; color: #DD007D;">www.bancofie.com.bo</a></h6>
                    </td>
                </tr>
            </tbody>
            <tfoot style="background-color: #DD007D; height: 30px; width: 600px;">
            <td style="text-align: center;">&nbsp;</td>
        </tfoot>
    </div>
</table>
</body>
</html>