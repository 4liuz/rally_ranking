<?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Participante') {
    $mydImgs = GetUserImgs($_SESSION['usuario']);
?>
<div class="card">
    <div class="card-head">
        <span>Mis Fotos</span>
    </div>
    <div class="card-body">
        <div class="gallery">
            <?php
            while($img = $mydImgs -> fetch_object()) {
            ?>
            <div
            class="gallery-cell"
            onclick="document.querySelector('#form-<?php echo$img->id; ?>').submit()"
            >
            
            <img src="uploads/<?php echo $img->ruta ?>" title="<?php echo $img->foto; ?>" alt="<?php echo $img->foto; ?>">

            <form id="form-<?php echo $img->id; ?>" method="post" action="index.php?id=<?php echo GetScreenIndex('post_status'); ?>">
                <input hidden type="text" id="<?php echo $img->id; ?>" name="id" value="<?php echo $img->id; ?>" >
            </form>
            </div>
            <?php
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