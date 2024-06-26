<?php include_once '../templates/header.php'; ?>

<h1 class="text-center mt-5">Formulario de búsqueda CIT</h1>
<div class="row justify-content-center mt-5">
    <form action="/PARCIAL_MALDONADO/controladores/registros/buscar.php" method="GET" class="border bg-light shadow rounded p-4 col-lg-6">
        <div class="row mb-3">
            <div class="col">
                <label for="ingreso_nombre" class="form-label">Nombre de la persona</label>
                <input type="text" name="ingreso_nombre" id="ingreso_nombre" class="form-control">
            </div>
            <div class="col">
                <label for="ingreso_apellido" class="form-label">Apellido de la persona</label>
                <input type="text" name="ingreso_apellido" id="ingreso_apellido" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="ingreso_fecha_ingreso" class="form-label">Fecha de ingreso</label>
                <input type="datetime-local" placeholder="a-m-d h:m" name="ingreso_fecha_ingreso" id="ingreso_fecha_ingreso" class="form-control">
            </div>
            <div class="col">
                <label for="ingreso_fecha_salida" class="form-label">Fecha de egreso</label>
                <input type="datetime-local" placeholder="a-m-d h:m" name="ingreso_fecha_salida" id="ingreso_fecha_salida" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="ingreso_razon" class="form-label">Motivo de la visita</label>
                <textarea name="ingreso_razon" id="ingreso_razon" class="form-control" rows="3" required></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" class="btn btn-info w-100"><i class="bi bi-search me-2"></i>Buscar</button>
            </div>
        </div>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>
