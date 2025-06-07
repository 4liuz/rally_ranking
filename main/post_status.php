<?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Participante') {
    $img = GetImg($_POST['id']);
    $status = GetImgStatus($img->estado);
    $rally = GetRally($img->rally);

?>
<div class="card">
    <div class="card-head">
        <span><?php echo $status->message; ?></span>
    </div>
    <div class="card-body">
        <div class="post">
            <div class="">
                <button
                class="navigate-back"
                title="Volver"
                <?php echo("onclick=\"location.href='index.php?id=".GetScreenIndex("my_gallery")."'\"");?>
                >
                ←
                </button>
    
                <div class="post-image">
                <img src="uploads/<?php echo $img->ruta; ?>" title="<?php echo $img->foto; ?>" alt="<?php echo $img->foto; ?>">
                </div>
    
                <div class="vote-box">
                    <!-- <button>Votar&nbsp;<i style="font-size:24px" class="fa">&#xf087;</i></button> -->
                    <span class="status <?php echo $status->class; ?>"><?php echo $status->message; ?></span>
                    <?php
                    if($img->estado == 1 && ($rally->fecha_inicio_subidas <= date("Y-m-d") && date("Y-m-d") <= $rally->fecha_fin_subidas)) {
                    ?>
                    <span><?php echo $img->votos; ?> &nbsp;<i style="font-size:24px" class="fa">&#xf087;</i></span>

                    <?php
                    } else {
                    ?>
                        <button class="delete-button" <?php echo("onclick=\"location.href='controller/delete_img.php'})\"");?>>Borrar Foto&nbsp;<i class="fa">&#xf014;</i></button>
                    <?php
                    }
                    ?>
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