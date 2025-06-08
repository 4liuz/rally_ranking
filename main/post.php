<?php
if(!isset($_SESSION['rol'])){
    $img = GetImg($_POST['id']);
    $participant = GetUser($img->participante);
    $author = $participant->nombre." ".$participant->apellidos;
    $rally = GetRally(1);
    $isVoteDate = ($rally->fecha_inicio_votaciones <= date("Y-m-d") && date("Y-m-d") <= $rally->fecha_fin_votaciones);

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

            <input hidden id="id" value="<?php echo $_POST['id']; ?>" >

            <?php
                if ($isVoteDate) {
            ?>
            <div class="vote-box">
                <button id="vote-button">Votar&nbsp;<i style="font-size:24px" class="fa">&#xf087;</i></button>
                <span id="votes"><?php echo $img->votos; ?>&nbsp;<i style="font-size:24px" class="fa">&#xf087;</i></span>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<?php
    if ($isVoteDate) {
?>
<script src="functions/refresh.js" defer></script>
<script src="functions/votes_updater.js" defer></script>
<?php
    }
} else {
    header("Location:index.php?id=".GetScreenIndex("home"));
}
?>