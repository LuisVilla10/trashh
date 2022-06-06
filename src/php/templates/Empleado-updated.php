<?php
require_once("../classes/importar-clases.php");
$empleado= $_POST['usuario'];
$empleado= Empleado::fromJson($empleado);
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title></title>
    <link href="https://allfont.es/allfont.css?fonts=comic-sans-ms" rel="stylesheet" type="text/css" />
	<!--[if mso]>
  <style>
    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
    div, td {padding:0;}
    div {margin:0 !important;}
	</style>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
  <style>
    .todo{
        font-family: "Comic Sans MS", "Comic Sans", cursive;
        background-color: #5a7b99;
    }

    h1 {
        color: #384553;
    }

    .tabla {
        border: 1px solid #384553;
    }

    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

</style>
</head>
<body class="todo">
  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#8eafcf; margin-top: 60px; border-radius: 50px;box-shadow: 4px 10px 5px #00000040;">
    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
      <tr>
        <td align="center" style="padding:0;">
          <!--[if mso]>
          <table role="presentation" align="center" style="width:600px;">
          <tr>
          <td>
          <![endif]-->
          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-size:16px;line-height:22px;color:#363636;">
            <tr>
              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:900;">
                <a href="" style="text-decoration:none;"><h1>TI Support</h1></a>
              </td>
            </tr>
            <tr>
              <td style="padding:5px 30px;">
                <h1 style="margin-top:0;margin-bottom:16px;font-size:24px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">Se han actualizado tus datos</h1>
                <p style="margin:0;">Estos son tus nuevos datos</p>
                <p>Correo: <?php echo $empleado->getCorreo(); ?><br></p>
                <p>Nombre: <?php echo $empleado->getNombre(); ?><br></p>
                <?php 
                if(!$empleado->getEsDirector()){
                  echo "<p>Usted es un Empleado<br></p>";
                }else{
                  echo "<p>Usted es un Director<br></p>";
                }
                ?>
              </td>
            </tr>
            <tr>
              <td style="padding:5px 30px;">
                <h1 style="margin-top:0;margin-bottom:16px;font-size:24px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;text-align: center;"><div style="font-size: 50px; background-color: #384553; color: #5a7b99; border-radius: 50%; width: 50px; height:50px; margin: auto">&#10003;</div> </h1>
              </td>
            </tr>
            <table style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-size:16px;line-height:22px;color:#363636;">
              <tr>
                <td style="padding:5px 30px;">
                  <p style="margin:0;">Si tú no solicitaste este cambio, comunícate con nosotros en <a style="color:#224467" href="mailto:soporte@TI Support.com">soporte@TI Support.com</a></p>
                </td>
              </tr>
              <br>
            </table style="padding:5px 30px;">
            <tr>
                <td style="padding:5px 30px;">
                    
                </td>
              </tr>
            <tr>
            <tr>
                <td style="padding:5px 30px;">
                    
                </td>
              </tr>
            <tr>
              <td style="padding:30px;text-align:center;font-size:12px;background-color:#384553;color:#cccccc; border-bottom-left-radius: 50px; border-bottom-right-radius: 50px;;">
              <p style="margin:0;font-size:14px;line-height:20px;">Este correo se ha generado automáticamente.<br>
                    <p style="margin:0;font-size:14px;line-height:20px;">&copy; TI Support Manejo de Errores 2022<br>
              </td>
            </tr>
          </table>
          <!--[if mso]>
          </td>
          </tr>
          </table>
          <![endif]-->
        </td>
      </tr>
    </table>
  </div>
</body>
</html>