<?php
// Datos de conexión a la base de datos
$host = "localhost";
$usuario = "root";  // Cambia esto si tienes un usuario diferente
$password = "";     // Cambia esto si tienes una contraseña para la base de datos
$baseDatos = "proyecto_web_leticia";

// Conexión a la base de datos
$conn = new mysqli($host, $usuario, $password, $baseDatos);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $mensaje = $_POST["mensaje"];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO contacto (nombre, email, telefono, mensaje) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $email, $telefono, $mensaje);

    // Ejecutar la consulta y verificar si se insertaron los datos correctamente
    if ($stmt->execute()) {
        //echo "Mensaje enviado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Enviado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        h1 {
            color: blue;
            margin-bottom: 20px;
            margin-top: -10px;
            font-size: 42px;
             
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #555; /* Gris oscuro */
        }
        a {
            text-decoration: none;
            color: #007bff; /* verde */
            font-weight: bold;
            padding: 10px 15px;
            border: 2px solid #007bff;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        a:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Gracias por contactarnos</h1>
    <p>Tu mensaje ha sido enviado exitosamente.</p>
    <a href="../paginas/index.html">Volver a la página de inicio</a>
</body>
</html>