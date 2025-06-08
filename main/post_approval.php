<?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Administrador') {
    $img = GetImg($_POST['id']);
    $participant = GetUser($img->participante);
    $author = $participant->nombre." ".$participant->apellidos;

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
                title="Volver"
                <?php echo("onclick=\"location.href='index.php?id=".GetScreenIndex("manage_requests")."'\"");?>
                >
                ←
                </button>
        
                <div class="post-image">
                    <img src="uploads/<?php echo $img->ruta; ?>" title="<?php echo $img->foto; ?>" alt="<?php echo $img->foto; ?>">
                </div>

                <span class="author-tag"><em><?php echo $author." (".$img->participante.")"; ?></em></span>

                <div class="vote-box">
                    <input hidden id="id" value="<?php echo $_POST['id']; ?>" >
                    <input hidden id="admin" value="<?php echo $_SESSION['usuario']; ?>" >
                    <button class="approve-button">Aceptar&nbsp;<i style="font-size:24px" class="fa">&#xf087;</i></button>
                    <button class="reject-button">Rechazar&nbsp;<i style="font-size:24px" class="fa">&#xf088;</i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="functions/post_approver.js" defer></script>
<?php
} else {
header("Location:index.php?id=".GetScreenIndex("home"));
}
?>