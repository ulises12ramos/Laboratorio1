<?php 
    require_once "../../../layouts/layout.php";
    require_once "../../../models/model.php";

    session_start();
    if (!isset($_SESSION["logged_ok"])) {
        header("Location: /Laboratorio1/login");
    }
    
    startHtml();
    head('Crear Medicamentos');
    pageContentStart();
    sidebar();
    topMenu();
?>
<!-- Page content-->
<div class="container-fluid">
    <form action="/Laboratorio1/medicamentos/save" method="post">
        
        <input class="form-control" type="hidden" name="action" value="save">

        <div class="card mt-4">
            <div class="card-header">
                <i class="fa fa-edit"></i>
                Crear medicamentos
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="medicamento">
                                Medicamento
                            </label>
                            <input type="text" class="form-control" name="medicamento" maxlength="100"
                            placeholder="Ingresa el nombre del medicamento" required>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="proveedor">
                                Proveedor
                            </label>
                            <input type="text" class="form-control" name="proveedor" maxlength="100"
                            placeholder="Ingresa el nombre del proveedor" required>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="dosis">
                                Dosis
                            </label>
                            <input type="number" class="form-control" name="dosis"
                            placeholder="Ingresa el numero de dosis" min="0" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="fecha">
                                Fecha de Vencimiento
                            </label>
                            <input type="date" class="form-control" name="fecha"
                            placeholder="Ingresa la fecha de vencimiento" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="modos" class="form-label fw-bold">Modo de aplicación</label>
                            <textarea class="form-control" name="modos" rows="4" 
                            placeholder="Descripción del modo de aplicación del medicamento"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                    Guadar
                </button>

                <a href="/Laboratorio1/medicamentos" class="btn btn-secondary">
                    <i class="fa fa-arrow-circle-left"></i>
                    Regresar
                </a>
            </div>
        </div>
    </form>
</div>

<!--Agregando funcion select2 a select-->
<?php 
    $script = "
    <script>
        $(document).ready(function() {
            $('select').each(function () {
                $(this).select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
                closeOnSelect: !$(this).attr('multiple'),
                });
            });
        });
    </script>
    ";
?>

<?php
    pageContentEnd();
    endHtml($script);
?>