<?php
    // Initialize the session
    session_start();
     
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
        exit;
    }
?>

<?php
     
    // Include config file
    require_once "config.php";
     
    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = $login_err = "";
     
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
     
        if(empty(trim($_POST["username"]))){
            $username_err = "Por favor ingrese nombre de usuario.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        if(empty(trim($_POST["password"]))){
            $password_err = "Por favor ingrese su clave.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT id, username, password, is_admin FROM users WHERE username = ?";
            
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_username);
                
                // Set parameters
                $param_username = $username;
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Store result
                    $stmt->store_result();
                    
                    // Check if username exists, if yes then verify password
                    if($stmt->num_rows == 1){                    
                        // Bind result variables
                        $stmt->bind_result($id, $username, $hashed_password, $isAdmin);
                        if($stmt->fetch()){
                            if(password_verify($password, $hashed_password)){                                                                            
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["is_admin"] = $isAdmin;

                                header("location: index.php");
                            } else{
                                // Password is not valid, display a generic error message
                                $login_err = "Usuario o clave invalida.";
                            }
                        }
                    } else{
                        // Username doesn't exist, display a generic error message
                        $login_err = "Usuario o clave invalido.";
                    }
                } else{
                    echo "UPS! Algo salio mal. Por favor, intentelo de nuevo mas tarde.";
                }

                // Close statement
                $stmt->close();
            }
        }
        
        // Close connection
        $mysqli->close();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font: 14px sans-serif; }
        .wrapper {
            padding: 20px;
            border-radius: .7rem;
            box-shadow: 0 0 3px rgba(0, 0, 0, .3);
        }
        .contenedor {
            height: 100vh;
        }

        .f-flow-col {
            flex-flow: column;
        }

        .f-center {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="contenedor f-center">
        <div class="wrapper f-center f-flow-col">
            <h2>Inicio de sesión</h2>
            
            <p>Por favor ingresa los datos solicitados.</p>

            <?php 
            if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }        
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">              
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group f-center">
                    <input type="submit" class="btn btn-primary" value="Iniciar sesión">
                </div>
                <p>¿No tienes una cuenta? <a href="register.php">¡Registrate ahora!</a>.</p>
            </form>
        </div>
    </div>
</body>
</html>