<?php
// Include config file
require_once "config.php";

// Directorio de subida
$upload_dir = 'public/images/plantas/';
 
// Define variables and initialize with empty values
$nombre = $descripcion = "";
$nombre_err = $descripcion_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $imgFile = $_FILES['imagen']['name'];
    $tmp_dir = $_FILES['imagen']['tmp_name'];
    $imgSize = $_FILES['imagen']['size'];

    // Validate name
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese un nombre";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Por favor ingrese un nombre válido.";
    } else{
        $nombre = $input_nombre;
    }
    
    // Validate description
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Por favor ingrese una descripción.";     
    } else{
        $descripcion = $input_descripcion;
    }
    
    // Procesando imagen
    if (!empty($imgFile)) {
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
        
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

        // rename uploading image
        $userpic = rand(1000,1000000).".".$imgExt;

        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){     
            // Check file size '1MB'
            if($imgSize < 100000000)       {
                move_uploaded_file($tmp_dir, $upload_dir.$userpic);
            }
        }
    } else {
        header("location: noimagen.php");
        exit;
    }

    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($descripcion_err) ){
        // Prepare an insert statement
        $sql = "INSERT INTO plantas (nombre, descripcion, imagen) VALUES (?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss",$param_nombre, $param_descripcion, $param_imagen);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_imagen = $userpic;            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "UPS! Algo salio mal. Por favor, intentelo de nuevo mas tarde.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Nuevo registro</h2>
                    <p>Ingresa los datos solicitados para agregar un nuevo registro.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control <?php echo (!empty($descripcion_err)) ? 'is-invalid' : ''; ?>"><?php echo $descripcion; ?></textarea>
                            <span class="invalid-feedback"><?php echo $descripcion_err;?></span>
                        </div>
                         
                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="file" name="imagen" class="form-control"  value="<?php echo $imagen; ?>">
                        </div>
                        

                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>