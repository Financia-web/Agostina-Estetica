
<?php
$uploads_dir = __DIR__ . '/uploads';
if (!file_exists($uploads_dir)) {
    mkdir($uploads_dir, 0777, true);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $servicio = htmlspecialchars($_POST['servicio']);
    $fecha = htmlspecialchars($_POST['fecha']);
    $hora = htmlspecialchars($_POST['hora']);
    $comprobante = $_FILES['comprobante'];
    $filename = basename($comprobante['name']);
    $target_path = $uploads_dir . '/' . time() . '_' . $filename;
    if (move_uploaded_file($comprobante['tmp_name'], $target_path)) {
        $reserva = [$nombre, $telefono, $servicio, $fecha, $hora, $filename];
        $file = fopen(__DIR__ . '/reservas.csv', 'a');
        fputcsv($file, $reserva);
        fclose($file);
        echo "<h2 style='font-family: sans-serif; color: green;'>Reserva recibida con éxito.</h2>";
        echo "<a href='index.html'>Volver al inicio</a>";
    } else {
        echo "<h2 style='font-family: sans-serif; color: red;'>Error al subir el comprobante.</h2>";
    }
} else {
    header('Location: index.html');
    exit;
}
?>
