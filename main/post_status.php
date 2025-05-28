<?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Participante') {
?>
<div class="card">
    <div class="card-head">
        <span><?php echo "Foto aprobada"; ?></span>
    </div>
    <div class="card-body">
        <div class="post">
            <div class="">
                <button
                class="navigate-back"
                <?php echo("onclick=\"location.href='index.php?id=".GetScreenIndex("my_gallery")."'\"");?>
                >
                ←
                </button>
    
                <div class="post-image">
                    <img src="" alt="">
                </div>
    
                <div class="vote-box">
                    <!-- <button>Votar&nbsp;<i style="font-size:24px" class="fa">&#xf087;</i></button> -->
                    <span class="status approved">Aprobada</span>
                    <span class="status pending">Pendiente</span>
                    <span class="status rejected">Rechazada</span>
                    <span>16 344 937&nbsp;<i style="font-size:24px" class="fa">&#xf087;</i></span>
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