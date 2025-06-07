<?php
if(!isset($_SESSION['rol'])){
    $img = GetImg($_POST['id']);
    $participant = GetUser($img->participante);
    $author = $participant->nombre." ".$participant->apellidos;
?>

<div class="card">
    <div class="card-head">
        <span><?php echo $img->foto; ?></span>
    </div>
    <div class="card-body">
        <div class="post">

            <button
            class="navigate-back"
            title="Volver"
            <?php echo("onclick=\"location.href='index.php?id=".GetScreenIndex("gallery")."'\"");?>
            >
            ←
            </button>

            <div class="post-image">
                <img src="uploads/<?php echo $img->ruta; ?>" title="<?php echo $img->foto; ?>" alt="<?php echo $img->foto; ?>">
            </div>
            <span class="author-tag"><em><?php echo $author." (".$img->participante.")"; ?></em></span>

            <div class="vote-box">
                <button>Votar&nbsp;<i style="font-size:24px" class="fa">&#xf087;</i></button>
                <span><?php echo $img->votos; ?>&nbsp;<i style="font-size:24px" class="fa">&#xf087;</i></span>
            </div>
        </div>
    </div>
</div>
<?php
} else {
    header("Location:index.php?id=".GetScreenIndex("home"));
}
?>