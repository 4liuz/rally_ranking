<div class="d-flex align-items-stretch">
    <div class="side-menu">
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
        <?php
        if(isset($_SESSION['usuario'])){
        ?>
        <div class="side-menu-head">
            <div class="side-menu-img">
                <img src="src/logo_c.png" class="profile-img" />
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
                    <li><a href="index.php?id=<?php EchoScreenIndex("home");?>">Home</a></li><!-- TMP: Ocultar en producicón -->
                    <?php
                    if(isset($_SESSION['rol'])){
                    ?>
                    <!--<li><a href="index.php?id=<?php EchoScreenIndex("login");?>">Login</a></li> -->
                    <!-- <li><a href="index.php?id=<?php EchoScreenIndex("sign_in");?>">Sing In</a></li> -->
                    <li><a href="index.php?id=<?php EchoScreenIndex("profile");?>">Perfil</a></li>
                    <?php
                        if($_SESSION['rol'] == 'administrator'){
                    ?>
                    <li><a href="index.php?id=<?php EchoScreenIndex("ofertar_servicio");?>">Ofertar Servicio</a></li>
                    <li><a href="index.php?id=<?php EchoScreenIndex("mis_ofertas");?>">Mis Ofertas</a></li>
                    <?php
                        }
                    ?>
                    <li><a href="index.php?id=<?php EchoScreenIndex("solicitar_servicio");?>">Solicitar Servicio</a></li>
                    <li><a href="index.php?id=<?php EchoScreenIndex("mis_solicitudes");?>">Mis Solicitudes</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>