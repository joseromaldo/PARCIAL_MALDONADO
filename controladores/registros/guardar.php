<?php
require '../../modelos/Registros.php';

$mensaje = '';
$nombre = htmlspecialchars($_POST['ingreso_nombre']);
$apellido = htmlspecialchars($_POST['ingreso_apellido']);

// Validación de fecha de ingreso y salida
$ingreso = date('Y-m-d H:i:s', strtotime($_POST['ingreso_fecha_ingreso']));
$salida = date('Y-m-d H:i:s', strtotime($_POST['ingreso_fecha_salida']));

$razon = htmlspecialchars($_POST['ingreso_razon']);

if (empty($nombre) || empty($apellido) || empty($ingreso) || empty($salida) || empty($razon)) {
    $resultado = [
        'mensaje' => 'DEBE VALIDAR LOS DATOS',
        'codigo' => 2
    ];
} else {
    try {
        $persona = new Registros([
            'ingreso_nombre' => $nombre,
            'ingreso_apellido' => $apellido,
            'ingreso_fecha_ingreso' => $ingreso,
            'ingreso_fecha_salida' => $salida,
            'ingreso_razon' => $razon
        ]);
        $guardar = $persona->guardar();
        $resultado = [
            'mensaje' => 'SU REGISTRO FUE INSERTADO CORRECTAMENTE',
            'codigo' => 1
        ];
    } catch (PDOException $pe) {
        $resultado = [
            'mensaje' => 'OCURRIÓ UN ERROR INSERTANDO SU REGISTRO EN LA BD',
            'detalle' => $pe->getMessage(),
            'codigo' => 0
        ];
    } catch (Exception $e) {
        $resultado = [
            'mensaje' => 'OCURRIÓ UN ERROR EN LA EJECUCIÓN',
            'detalle' => $e->getMessage(),
            'codigo' => 0
        ];
    }
}

$alertas = ['danger', 'success', 'warning'];

include_once '../../vistas/templates/header.php'; 
?>

<div class="row justify-content-center mt-5">
    <div class="col-lg-6 alert alert-<?= $alertas[$resultado['codigo']] ?>" role="alert">
        <?= $resultado['mensaje'] ?>
        <?php if (isset($resultado['detalle'])): ?>
            <p><?= $resultado['detalle'] ?></p>
        <?php endif; ?>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <a href="../../vistas/registros/index.php" class="btn btn-primary w-100">Regresar al formulario</a>
    </div>
</div>

<?php include_once '../../vistas/templates/footer.php'; ?>
