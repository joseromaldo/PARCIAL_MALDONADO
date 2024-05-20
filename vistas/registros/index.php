<?php include_once '../templates/header.php'; ?>

<h1 class="text-center mt-5">Formulario de registros</h1>
<div class="row justify-content-center">
    <form action="/PARCIAL_MALDONADO/controladores/registros/guardar.php" method="POST" class="border bg-light shadow rounded p-4 col-lg-6 mt-3">
        <div class="row mb-3">
            <div class="col">
                <label for="ingreso_nombre">Nombre</label>
                <input type="text" name="ingreso_nombre" id="ingreso_nombre" class="form-control" required>
            </div> 
            <div class="col">
                <label for="ingreso_apellido">Apellido</label>
                <input type="text" name="ingreso_apellido" id="ingreso_apellido" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="ingreso_fecha_ingreso">Fecha de ingreso</label>
                <input type="datetime_local" placeholder="a-m-d h:m" name="ingreso_fecha_ingreso" id="ingreso_fecha_ingreso" class="form-control" required>
            </div>
            <div class="col">
                <label for="ingreso_fecha_salida">Fecha de egreso</label>
                <input type="datetime_local" placeholder="a-m-d h:m" name="ingreso_fecha_salida" id="ingreso_fecha_salida" class="form-control" required>
            </div>
            <div class="col">
                <label for="ingreso_razon">Motivo de la visita</label>
                <input type="" name="ingreso_razon" id="ingreso_razon" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save me-2"></i>Guardar</button>
            </div>
        </div>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>