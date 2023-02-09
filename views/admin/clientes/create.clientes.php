<?php 
    require_once "../../../layouts/layout.php";

    session_start();
    
    if (!isset($_SESSION["logged_ok"])) {
        header("Location: /Laboratorio1/login");
    }

    startHtml();
    head('Crear Clientes');
    pageContentStart();
    sidebar();
    topMenu();
?>

<!-- Page content-->
<div class="container-fluid">
    <form action="/Laboratorio1/clientes/save" method="post">
        
        <input class="form-control" type="hidden" name="action" value="save">

        <div class="card mt-4">
            <div class="card-header">
                <i class="fa fa-edit"></i>
                Crear Clientes
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="nombres">
                                Nombres
                            </label>
                            <input type="text" class="form-control" name="nombres" maxlength="75"
                            placeholder="Ingresa el nombre del proveedor" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="apellidos">
                                Apellidos
                            </label>
                            <input type="text" class="form-control" name="apellidos" maxlength="75"
                            placeholder="Ingresa el apellido del proveedor" required>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="documento">
                                DUI
                            </label>
                            <input type="text" class="form-control" name="documento" maxlength="10"
                            placeholder="Ingresa el numero de documento 00000000-0" pattern="[0-9]{8}-[0-9]{1}" required>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="telefono">
                                Teléfono
                            </label>
                            <input type="text" class="form-control" name="telefono" maxlength="9"
                            placeholder="Ingresa el numero de telefono 0000-0000" pattern="[0-9]{4}-[0-9]{4}" required>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="correo">
                                Email
                            </label>
                            <input type="email" class="form-control" name="correo"
                            placeholder="Ingresa el email del proveedor"  required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="direccion" class="form-label fw-bold">Dirección</label>
                            <textarea class="form-control" name="direccion" rows="4" 
                            placeholder="Dirección del Cliente"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                    Guadar
                </button>

                <a href="/Laboratorio1/clientes" class="btn btn-secondary">
                    <i class="fa fa-arrow-circle-left"></i>
                    Regresar
                </a>
            </div>
        </div>
    </form>
</div>

<?php
    pageContentEnd();
    endHtml();
?>