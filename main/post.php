<?php
if(!isset($_SESSION['rol'])){
?>

<div class="card">
    <div class="card-head">
        <span>Esther Dolores Núñez Burgos</span>
    </div>
    <div class="card-body">
        <div class="post">
            <div class="">

                <button
                class="navigate-back"
                <?php echo("onclick=\"location.href='index.php?id=".GetScreenIndex("gallery")."'\"");?>
                >
                ←
                </button>

                <div class="post-image">
                    <img src="" alt="">
                </div>

                <div class="vote-box">
                    <button>Votar&nbsp;<i style="font-size:24px" class="fa">&#xf087;</i></button>
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