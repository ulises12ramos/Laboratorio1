<?php 
    require_once "../../../layouts/layout.php";
    require_once "../../../models/model.php";
    require_once "../../../requests/request.php";

    session_start();
    if (!isset($_SESSION["logged_ok"])) {
        header("Location: /Laboratorio1/login");
    }
    
    startHtml();
    head('Editar Medicamento');
    pageContentStart();
    sidebar();
    topMenu();
?>
<!-- Page content-->
<div class="container-fluid">
    <?php 
        foreach (find("medicamentos", getParam("id")) as $medicamento) {
    ?>

    <form action="/Laboratorio1/medicamentos/<?php echo $medicamento["id"]; ?>/update" method="post">
        <input type="hidden" value="<?php echo $medicamento["id"]; ?>" name="id">
        <input class="form-control" type="hidden" name="action" value="update">

        <div class="card mt-4">
            <div class="card-header">
                <i class="fa fa-edit"></i>
                Editar medicamento: <?php echo $medicamento["medicamento"]; ?>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="medicamento">
                                Medicamento
                            </label>
                            <input type="text" class="form-control" name="medicamento" maxlength="100"
                            placeholder="Ingresa el nombre del medicamento" value = "<?=$medicamento["medicamento"] ?>" required>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="proveedor">
                                Proveedor
                            </label>
                            <input type="text" class="form-control" name="proveedor" maxlength="100"
                            placeholder="Ingresa el nombre del proveedor" value = "<?=$medicamento["proveedor"] ?>" required>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="dosis">
                                Dosis
                            </label>
                            <input type="number" class="form-control" name="dosis"
                            placeholder="Ingresa el numero de dosis" value = "<?=$medicamento["dosis"] ?>" min="0" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="fecha">
                                Fecha de Vencimiento
                            </label>
                            <input type="date" class="form-control" name="fecha"
                            placeholder="Ingresa la fecha de vencimiento" value = "<?=$medicamento["fecha_vencimiento"] ?>" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="modos" class="form-label fw-bold">Modo de aplicación</label>
                            <textarea class="form-control" name="modos" rows="4" 
                            placeholder="Descripción del modo de aplicación del medicamento"><?=$medicamento["modos_aplicacion"] ?></textarea>
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

    <?php 
        }
    ?>
</div>

<?php
    pageContentEnd();
    endHtml();
?>