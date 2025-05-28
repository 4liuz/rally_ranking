<?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Administrador') {
?>
<div class="card">
    <div class="card-head">
        <span>Confirmar Solicitud</span>
    </div>
    <div class="card-body">
        <div class="post">
            <div class="">
                <button
                class="navigate-back"
                <?php echo("onclick=\"location.href='index.php?id=".GetScreenIndex("manage_requests")."'\"");?>
                >
                ←
                </button>
        
                <div class="post-image">
                    <img src="" alt="">
                </div>

                <div class="vote-box">
                    <!-- <button>Votar <i style="font-size:24px" class="fa">&#xf087;</i></button> -->
                    <button class="">Aceptar&nbsp;<i style="font-size:24px" class="fa">&#xf087;</i></button>
                    <button class="">Rechazar&nbsp;<i style="font-size:24px" class="fa">&#xf088;</i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} else {
header("Location:index.php?id=".GetScreenIndex("home"));
}
?>