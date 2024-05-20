<?php

require '../../modelos/Registros.php';

try {
    // Sanitización de datos para el registro de personas que ingresan al CIT
    $_GET['ingreso_nombre'] = htmlspecialchars($_GET['ingreso_nombre']);
    $_GET['ingreso_apellido'] = htmlspecialchars($_GET['ingreso_apellido']);
    $_GET[' ingreso_fecha_ingreso'] = filter_var($_GET[' ingreso_fecha_ingreso'], FILTER_VALIDATE_REGEXP);
    $_GET[' ingreso_fecha_salida'] = filter_var($_GET[' ingreso_fecha_salida'], FILTER_VALIDATE_REGEXP);
    $_GET['ingreso_razon'] = htmlspecialchars($_GET['ingreso_razon']);
    
    $objRegistros = new Registros($_GET);
    $registros = $objRegistros->buscar();
    
  

    $resultado = [
        'mensaje' => 'Datos encontrados',
        'datos' => $registros,
        'codigo' => 1
    ];
    
} catch (Exception $e) {
    $resultado = [
        'mensaje' => 'OCURRIO UN ERROR EN LA EJECUCIÓN',
        'detalle' => $e->getMessage(),
        'codigo' => 0
    ];
}

$alertas = ['danger', 'success', 'warning'];

include_once '../../vistas/templates/header.php'; 
?>

<div class="row mb-4 justify-content-center">
    <div class="col-lg-6 alert alert-<?= $alertas[$resultado['codigo']] ?> mt-5" role="alert">
        <?= $resultado['mensaje'] ?>
    </div>
</div>

<h1 class="text-center">Listado de ingresos y egresos</h1>
<div class="row justify-content-center">
    <div class="col-lg-10">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de ingreso</th>
                    <th>Fecha de egreso</th>
                    <th>Razon</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $numRegistros = count($registros);
                if ($numRegistros > 0) {
                    foreach ($registros as $key => $registro) {
                        ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= ($registro['INGRESO_NOMBRE']) ?></td>
                            <td><?= ($registro['INGRESO_APELLIDO']) ?></td>
                            <td><?= ($registro['INGRESO_FECHA_INGRESO']) ?></td>
                            <td><?= ($registro['INGRESO_FECHA_SALIDA']) ?></td>
                            <td><?= ($registro['INGRESO_RAZON']) ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6">No hay registrados de ingresos a esta Dependencia Militar</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="row mt-4 justify-content-center">
    <div class="col-lg-6">
        <a href="../../vistas/registros/buscar.php" class="btn btn-primary w-100">Volver al formulario de búsqueda</a>
    </div>
</div>
    </div>
</div>        
<?php include_once '../../vistas/templates/footer.php'; ?>