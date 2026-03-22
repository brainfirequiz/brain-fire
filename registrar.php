<?php
// 1. Incluimos el puente de conexion a la base de datos
include 'conexion.php';

// Verificamos si los datos llegaron por el metodo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. Recibimos los datos del formulario HTML
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // 3. Encriptamos la contrasena por seguridad
    $pass_hash = password_hash($pass, PASSWORD_BCRYPT);

    // 4. Preparamos la orden SQL para insertar el usuario
    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user, $email, $pass_hash);

    // 5. Ejecutamos la orden y verificamos si salio bien
    if ($stmt->execute()) {
        // Si sale bien, lanzamos una alerta y mandamos al usuario al Login
        echo "<script>
                alert('Registro exitoso. Ahora puedes iniciar sesion en Brain Fire.');
                window.location.href = 'index.html';
              </script>";
    } else {
        // Si hay error (como un correo duplicado), lo mostramos
        echo "<script>
                alert('Hubo un error al registrar: " . $stmt->error . "');
                window.history.back();
              </script>";
    }

    // Cerramos la conexion
    $stmt->close();
    $conn->close();
}
?>