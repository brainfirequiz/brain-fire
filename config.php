<?php
// Iniciamos la sesion
session_start();

// Validamos si la sesion existe. Si no, lo pateamos al login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BRAIN FIRE - Configuracion</title>
    <link rel="stylesheet" href="style-inicio.css">
    <link rel="icon" type="image/png" href="recursos/icono.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    
    <video autoplay muted loop id="bg-video">
        <source src="recursos/fondo3.mp4" type="video/mp4">
    </video>

    <header>
    <div style="width: 40px;"></div> 

    <div class="header-title">
        <h1 style="color: rgb(255, 225, 165);">BRAIN <h1 style="color: rgb(255, 164, 164);"> FIRE</h1></h1>
    </div>

    <a href="semestres.html" class="help-icon">
        <i class="fa-solid fa-arrow-rotate-left"></i>
    </a>
    </header>
    <br><br><br>

<div class="perfil-container">
    <div class="info-actual">
        <h3>Información personal de la cuenta</h3>
        <br><br>
        <div class="perfil-foto-seccion">
            <i class="fa-solid fa-circle-user"></i>
        </div>
        <br>
        
        <p>Correo: <strong><?php echo $_SESSION['email']; ?></strong></p>
        <p>Nombre: <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p>Contraseña: <strong>**********</strong></p>
        
        <a href="logout.php"><button class="btn-secundario">Cerrar sesion</button></a>
    </div>

    <form class="formu-perfil" action="actualizar.php" method="POST">
        <h3>Modificar información</h3>
        <br>
        <label>Nuevo nombre de usuario</label>
        <input type="text" name="nuevo_nombre" placeholder="Introduce tu nuevo nombre...">
        
        <label>Nuevo correo electrónico</label>
        <input type="email" name="nuevo_correo" placeholder="Introduce tu nuevo correo...">
        
        <label>Nueva contraseña</label>
        <input type="password" name="nueva_pass" placeholder="Introduce tu nueva contraseña...">
        
        <label>Confirmar nueva contraseña</label>
        <input type="password" name="confirma_pass" placeholder="Confirma tu nueva contraseña...">
        
        <button type="submit" class="btn-ingresar">Guardar cambios</button>
    </form>
</div>

</body>
</html>