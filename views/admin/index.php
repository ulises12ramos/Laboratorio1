<?php 
    require_once "../../layouts/layout.php";

    session_start();
    if (!isset($_SESSION["logged_ok"])) {
        header("Location: /veterinaria/login");
    }
    
    startHtml();
    head('Inicio Admin');
    pageContentStart();
    sidebar();
    topMenu();
?>
<!-- Page content-->
<div class="container-fluid">
    <h3 class="mt-4">Home</h3>

    <div class="row mt-4">
        <div class="col-12">
             <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class = "row">
                    <div class="col-lg-4 col-sm-12">
                        <img class="img-fluid rounded-start" src="/Laboratorio1/public/img/imagen_1.jpg" alt="Imagen">
                    </div>

                    <div class="col-lg-8 col-sm-12">
                        <div class="card-body">
                            <p class="card-text"><b>Veterinaria Hernandez</b></p>
                            <p class="card-text">
                                Cuenta con una Clínica Veterinaria que presta servicios al público en 
                                general en la atención de especies menores como perros, gatos, aves, etc.-
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    
    </div>

</div>

<?php
    pageContentEnd();
    endHtml();
?>