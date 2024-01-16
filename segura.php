<?php
// Conexion a la base de datos
$host = 'localhost';
$dbname = 'users';
$user = 'root';
$pass = 'root';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta SQL segura con sentencias preparadas
$query = "SELECT * FROM user WHERE name=? AND password=?";
$stmt = $conn->prepare($query);
$stmt->execute([$username, $password]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró un usuario
if ($result) {
    echo "Inicio de sesión exitoso";
} else {
    echo "Nombre de usuario o contraseña incorrectos";
}



// Cerrar la conexión
$conn = null;
?>
