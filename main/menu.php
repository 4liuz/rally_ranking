<div class="d-flex align-items-stretch">
    <div class="side-menu">
        <div class="sign-button-box">
            <button
                class="sign-button sign-out"
                <?php echo("onclick=\"location.href='"
                    .((isset($_SESSION['usuario']))
                    ?("controller/sign_out.php")
                    :("index.php?id=".GetScreenIndex("login")))
                ."'\"");?>
            >
            <?php echo(isset($_SESSION['usuario'])?"Cerrar Sesión":"Iniciar Sesión");?>
            </button>
            <?php
            if(!isset($_SESSION['usuario'])){
            ?>
            <button
                class="sign-button"
                <?php echo("onclick=\"location.href='index.php?id=".GetScreenIndex("sign_in")."'\"");?>
            >Registrarme</button>
            <?php
            }
            ?>
        </div>
        <?php
        if(isset($_SESSION['usuario'])){
        ?>
        <div class="side-menu-head">
            <div class="side-menu-img">
                <img src="src/profile_img_<?php echo ($_SESSION['rol']=='Participante')?'part.png':'admin.gif';?>" class="profile-img" />
            </div>
            <span class="user-name"><?php echo($_SESSION['usuario']??"");?></span>
            <span class="user-rol"><?php echo($_SESSION['rol']??"");?></span>
            
        </div>
        <?php
        }
        ?>
        <div class="overflow-y">
            <div class="side-menu-body">
                <ul class="side-menu-list">
                    <li><a href="index.php?id=<?php EchoScreenIndex("home");?>">Home</a></li>
                    <li><a href="index.php?id=<?php EchoScreenIndex("ranking");?>">Ranking</a></li>
                    <?php
                    if(!isset($_SESSION['rol'])){
                    ?>
                    <li><a href="index.php?id=<?php EchoScreenIndex("gallery");?>">Galería</a></li>
                    <?php
                    } elseif($_SESSION['rol']=='Participante') {
                    ?>
                    <li><a href="index.php?id=<?php EchoScreenIndex("profile");?>">Perfil</a></li>
                    <li><a href="index.php?id=<?php EchoScreenIndex("my_gallery");?>">Mis Fotos</a></li>
                    <li><a href="index.php?id=<?php //Launch("new_post");?>">Subir Foto</a></li>
                    <?php
                    } elseif($_SESSION['rol']=='Administrador') {
                    ?>
                    <li><a href="index.php?id=<?php EchoScreenIndex("manage_rally");?>">Configurar Rally</a></li>
                    <li><a href="index.php?id=<?php EchoScreenIndex("manage_requests");?>">Solicitudes Pendientes</a></çli>
                    <li><a href="index.php?id=<?php EchoScreenIndex("manage_profiles");?>">Gestionar Participantes</a></li>
                    <?php
                    }
                    $false = false;
                    if($false){
                        // Comentar código desde php y que no aparezca en el HTML. Poner false directamente da error en el editor
                    ?>
                    <li><a href="index.php?id=<?php EchoScreenIndex("post");?>">post</a></li>
                    <li><a href="index.php?id=<?php EchoScreenIndex("post_status");?>">post_status</a></li>
                    <li><a href="index.php?id=<?php EchoScreenIndex("post_approval");?>">post_approval</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>