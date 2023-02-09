<?php 
    require_once "../../../layouts/layout.php";
    require_once "../../../models/model.php";

    session_start();
    if (!isset($_SESSION["logged_ok"])) {
        header("Location: /Laboratorio1/login");
    }

    startHtml();
    head('Lista Mascotas');
    pageContentStart();
    sidebar();
    topMenu();
?>
<!-- Page content-->
<div class="container-fluid">

    <h4 class="mt-4">
        Mascotas 
        <a class="btn btn-primary" href="/Laboratorio1/mascotas/create">
            <i class="fa fa-add"></i> Nuevo
        </a>
    </h4>
    
    <table id="mascotas" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="col-2">ID</th>
                <th>Cliente</th>
                <th>Nombre Mascota</th>
                <th>Raza</th>
                <th>Especie</th>
                <th>Tipo</th>
                <th>Edad</th>
                <th class="col-2">Opciones</th>
            </tr>
        </thead>
        
        <tbody>
            <?php 

                $query = "
                SELECT mascotas.id, CONCAT(clientes.nombres, ' ', clientes.apellidos) AS cliente, nombre, raza, especie, tipo, TIMESTAMPDIFF(YEAR, mascotas.fecha_nacimiento,CURDATE()) AS edad
                FROM mascotas INNER JOIN clientes ON clientes.id = mascotas.id_cliente WHERE mascotas.status = 1;
                ";

                foreach (selectCustom($query) as $column) {
                    $id = $column['id'];
                    echo "<tr>";
                    echo "<td>".$column["id"]."</td>";
                    echo "<td>".$column["cliente"]."</td>";
                    echo "<td>".$column["nombre"]."</td>";
                    echo "<td>".$column["raza"]."</td>";
                    echo "<td>".$column["especie"]."</td>";
                    echo "<td>".$column["tipo"]."</td>";
                    echo "<td>".$column["edad"]."</td>";
                    echo "<td class='text-center'>";
                    echo "
                    <a class='btn btn-primary' href='/Laboratorio1/mascotas/$id/edit'>
                        <i class='fa fa-edit'></i>
                    </a>";
                    echo "
                    <button type='button' class='btn btn-danger btn-delete' onclick='deleteMascota($id);' data-id='".$column["id"]."'>
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
            $('#mascotas').DataTable();
        });

        const deleteMascota = (id) => {

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
                        url: '/Laboratorio1/mascotas/'+id+'/delete',
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