<?php 
    require_once "../../../layouts/layout.php";
    require_once "../../../models/model.php";

    session_start();
    if (!isset($_SESSION["logged_ok"])) {
        header("Location: /Laboratorio1/login");
    }

    startHtml();
    head('Lista Medicamentos');
    pageContentStart();
    sidebar();
    topMenu();
?>
<!-- Page content-->
<div class="container-fluid">

    <h4 class="mt-4">
        Medicamentos 
        <a class="btn btn-primary" href="/Laboratorio1/medicamentos/create">
            <i class="fa fa-add"></i> Nuevo
        </a>
    </h4>
    
    <table id="medicamentos" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="col-2">ID</th>
                <th>Medicamento</th>
                <th>Proveedor</th>
                <th>Modo de aplicación</th>
                <th>Fecha de Vencimiento</th>
                <th>Dosis</th>
                <th class="col-1">Opciones</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
                //seleccionar medicamentos
                foreach (selectAll("medicamentos") as $column) {
                    $id = $column['id'];
                    echo "<tr>";
                    echo "<td>".$column["id"]."</td>";
                    echo "<td>".$column["medicamento"]."</td>";
                    echo "<td>".$column["proveedor"]."</td>";
                    echo "<td>".$column["modos_aplicacion"]."</td>";
                    echo "<td>".$column["fecha_vencimiento"]."</td>";
                    echo "<td>".$column["dosis"]."</td>";
                    echo "<td class='text-center'>";
                    echo "
                    <a class='btn btn-primary' href='/Laboratorio1/medicamentos/$id/edit'>
                        <i class='fa fa-edit'></i>
                    </a>";
                    echo "
                    <button type='button' class='btn btn-danger btn-delete' onclick='deleteMedicamentos($id);' data-id='".$column["id"]."'>
                        <i class='fa fa-trash'></i>
                    </button>";
                    echo"</td>";
                    echo "</tr>";
                }
            ?>    
        </tbody>
    </table>

    <div class="mb-3"></div>
</div>

<!--creando varible con el script a anexar a la plantilla -->
<?php 
    $script = "
    <script>
        $(document).ready(function () {
            $('#medicamentos').DataTable();
        });

        const deleteMedicamentos = (id) => {

            Swal.fire({
                title: 'Estas seguro?',
                text: '¡No podrás revertir esto!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar ahora!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '/Laboratorio1/medicamentos/'+id+'/delete',
                        success: function (data) {
                            if (data.token_delete === true) {
                                Swal.fire(
                                    'Eliminado!',
                                    'Tu registro fue eleminado correctamente.',
                                    'success'
                                    )

                            }else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'El registro de pudo ser eliminado',
                                    footer: '<a>Ingresa aqui para obtener más información?</a>'
                                })
                            }
                            
                            //espera para recargar la pagina
                            setTimeout(() =>{
                                location.reload();
                            }, 500);
                        }
                    });
                }
            });
        };
    </script>
    ";
?>

<?php
    pageContentEnd();
    endHtml($script);
?>