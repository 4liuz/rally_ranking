<?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Administrador') {
?>

<div class="card">
    <div class="card-head">
        <span>Administrar Participantes</span>
    </div>
    <div class="card-body">
        <?php
        $result = GetProfileManagerData();
        while($user = $result -> fetch_object()) {
        ?>
        <div class="d-flex justify-content-between align-items-center m-b-10">
            <span class=""><?php echo "{$user -> nombre} {$user -> apellidos}";?></span>   
            <div class="action-buttons-box">
                <?php
                if($user -> baja) {
                    ?>
                <button class="action-button" title="Dar de alta" onclick=""><i class="fa">&#xf185;<!-- Sun --></i></button>
                <?php
                } else {
                    ?>
                <button class="action-button moon" title="Dar de baja" onclick=""><i class="fa">&#xf186;<!-- Moon --></i></button>
                <?php
                }
                ?>
                <form action="index.php?id=<?php echo GetScreenIndex("profile"); ?>" method="post" class="d-inline">
                    <input hidden type="text" id="id<?php echo $user -> id; ?>" name="id" value="<?php echo $user->id; ?>" />
                    <button class="action-button" title="Editar">
                        <i class="fa">&#xf040;<!-- Pencil --></i>
                    </button>
                </form> 
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<?php
} else {
header("Location:index.php?id=".GetScreenIndex("home"));
}
?>