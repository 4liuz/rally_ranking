<?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Administrador') {
?>
<div class="card">
    <div class="card-head">
        <span>Solicitudes Pendientes</span>
    </div>
    <div class="card-body">
        <div class="gallery">
            <?php
            for ($i = 0; $i<5; $i++) {
                echo("<div
                class=\"gallery-cell\"
                onclick=\"location.href='index.php?id=".GetScreenIndex("post_approval")."'\"
                >
                <img src=\"\" alt=\"\">
                </div>");
            }
            ?>
        </div>
    </div>
</div>
<?php
} else {
header("Location:index.php?id=".GetScreenIndex("home"));
}
?>