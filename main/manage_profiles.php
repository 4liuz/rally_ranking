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
                
                <button
                    id="button<?php echo $user -> id; ?>"
                    class="action-button<?php echo ($user -> baja) ? " sun" : " moon"; ?>"
                    title="Dar de <?php echo ($user -> baja) ? "alta" : "baja"; ?>"
                    onclick="UnsuscribeUserManager(<?php echo $user -> id.', '.$user -> baja; ?>)"
                ><i class="fa">
                <?php
                    echo ($user -> baja) ? "&#xf185;<!-- Sun -->" : "&#xf186;<!-- Moon -->";
                ?>
                </i></button>

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