<?php 
    require_once "../../../layouts/layout.php";
    require_once "../../../models/model.php";
    require_once "../../../requests/request.php";

    session_start();
    if (!isset($_SESSION["logged_ok"])) {
        header("Location: /Laboratorio1/login");
    }
    
    startHtml();
    head('Editar Mascotas');
    pageContentStart();
    sidebar();
    topMenu();
?>
<!-- Page content-->
<div class="container-fluid">
    <?php 
        foreach (find("mascotas", getParam("id")) as $mascota) {
    ?>
    <form action="/Laboratorio1/mascotas/<?php echo $mascota["id"]; ?>/update" method="post">

        <input class="form-control" type="hidden" name="id" value="<?php echo $mascota["id"]; ?>">
        <input class="form-control" type="hidden" name="action" value="update">

        <div class="card mt-4">
            <div class="card-header">
                <i class="fa fa-edit"></i>
                Editar mascota: <?php echo $mascota["nombre"] ; ?>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="cliente">
                                Cliente
                            </label>
                            <select class="form-control" name="cliente">
                                <?php
                                    //Selecionamos los clientes
                                    $query = "
                                        SELECT clientes.id, clientes.nombres, clientes.apellidos 
                                        FROM clientes
                                        WHERE clientes.status = 1;
                                    ";

                                    foreach(selectCustom($query) as $cliente) {
                                        if($cliente["id"] == $mascota["id_cliente"]) {
                                            echo "<option value='".$cliente["id"]."' selected>".$cliente["nombres"].''.$cliente["apellidos"]."</option>";
                                        }
                                        else{
                                            echo "<option value='".$cliente["id"]."'>".$cliente["nombres"].''.$cliente["apellidos"]."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="nombre">
                                Nombre
                            </label>
                            <input type="text" class="form-control" name="nombre" maxlength="75"
                                placeholder="Ingresa el nombre de la mascota" value="<?php echo $mascota["nombre"]; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="tipo">
                                Tipo Mascota
                            </label>
                            <select name="tipo" class="form-control">
                                <?php 
                                    $selectMamifero = ($mascota["tipo"] == "Mamiferos") ? " selected" : "";
                                    $selectAves = ($mascota["tipo"] == "Aves") ? " selected" : "";
                                    $selectRectiles = ($mascota["tipo"] == "Rectiles") ? " selected" : "";
                                    $selectAnfibio = ($mascota["tipo"] == "Anfibios") ? " selected" : "";
                                ?>
                                <option value="Mamiferos" <?=$selectMamifero ?>>Mamiferos</option>
                                <option value="Aves" <?=$selectAves ?>>Aves</option>
                                <option value="Retiles" <?=$selectRectiles ?>>Retiles</option>
                                <option value="Anfibios" <?=$selectAnfibio ?>>Anfibios</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="raza">
                                Raza
                            </label>
                            <input type="text" class="form-control" name="raza"
                                placeholder="Ingresa el nombre de la raza" value="<?php echo $mascota["raza"]; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="especie">
                                Especie
                            </label>
                            <input type="text" class="form-control" name="especie" maxlength="10" value="<?php echo $mascota["especie"]; ?>"
                                placeholder="Ingresa el nombre de la especie, por ejemplo 'perro'" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold" for="fecha">
                                Fecha de nacimiento
                            </label>
                            <input type="date" class="form-control" value="<?php echo $mascota["fecha_nacimiento"]; ?>" name="fecha" maxlength="9" required>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-edit"></i>
                    Guadar
                </button>

                <a href="/Laboratorio1/mascotas" class="btn btn-secondary">
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