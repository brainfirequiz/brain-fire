<?php
// Iniciamos la sesion para recordar al usuario
session_start();

// Incluimos el archivo de conexion
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Buscamos el usuario por su correo electronico
    $stmt = $conn->prepare("SELECT id, username, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si el correo existe en la base de datos
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verificamos si la contrasena coincide con el hash guardado
        if (password_verify($pass, $row['password_hash'])) {
            
            // Guardamos los datos en la sesion
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $email;
            
            // Redirigimos a la pantalla de semestres
            header("Location: semestres.html");
            exit();
            
        } else {
            // Contrasena incorrecta
            echo "<script>
                    alert('La contrasena es incorrecta.');
                    window.history.back();
                  </script>";
        }
    } else {
        // Correo no encontrado
        echo "<script>
                alert('No existe ninguna cuenta con este correo.');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>