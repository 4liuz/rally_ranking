<?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Administrador') {
?>
<div class="card">
    <div class="card-head">
        <span>Configuración de Rally Ranking</span>
    </div>
    <div class="card-body">
        <div class="full-body-form">
            <form action="controller/process_login.php" method="post">
                <div class="">
                    <div class="d-flex justify-content-end align-items-center column-gap-5 m-b-10">
                        <label for="fecha_inicio_subidas">Fecha de inicio:</label>
                        <input id="fecha_inicio_subidas" name="fecha_inicio_subidas" type="date" class="today-date" />
                    </div>
                    <div class="d-flex justify-content-end align-items-center column-gap-5 m-b-10">
                        <label for="fecha_fin_subidas">Fecha de fin:</label>
                        <input id="fecha_fin_subidas" name="fecha_fin_subidas" type="date" class="today-date" />
                    </div>
                    <div class="d-flex justify-content-end align-items-center column-gap-5 m-b-10">
                        <label for="fecha_inicio_votaciones">Fecha de inicio:</label>
                        <input id="fecha_inicio_votaciones" name="fecha_inicio_votaciones" type="date" class="today-date" />
                    </div>
                    <div class="d-flex justify-content-end align-items-center column-gap-5 m-b-10">
                        <label for="fecha_fin_votaciones">Fecha de fin:</label>
                        <input id="fecha_fin_votaciones" name="fecha_fin_votaciones" type="date" class="today-date" />
                    </div>
                    <div class="d-flex justify-content-end align-items-center column-gap-5 m-b-10">
                        <label for="limite_fotos_participante">Límite de fotos por participante:</label>
                        <input id="limite_fotos_participante" name="limite_fotos_participante" type="number" class="spinner" min="1" value="1" />
                    </div>
                    <div class="d-flex justify-content-end align-items-center column-gap-5">
                        <!-- Futura posible implementación para trabajar varios rallys -->
                        <!-- <input hidden id="rally" name="rally" type="text" value="" /> -->
                        <button class="delete-button" <?php //echo("onclick=\"location.href='controller/delete_user.php'\"");?>>Restablecer</button>
                        <button type="submit">Cambiar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
} else {
header("Location:index.php?id=".GetScreenIndex("home"));
}
?>