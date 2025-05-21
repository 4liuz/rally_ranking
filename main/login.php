<div class="main-wrap login-bg-image">
    <div class="saturated h-100 d-flex justify-content-center align-items-center">
        <div class="login-div">
            <div class="login-title">
                <img src="src/logo_c.png" />
                <span>Cerámicart</span>
            </div>
            <div class="login-box">
                <form action="controller/process_login.php" method="post">
                    <div class="label-input-row-1">
                        <label for="usuario">Usuario:</label>
                        <input id="usuario" name="usuario" type="text" />
                    </div>
                    <div class="label-input-row-1 align-items-center">
                        <label for="passwd">Contraseña:</label>
                        <input id="passwd" name="passwd" type="password" />
                    </div>


                    <!-- START IF LOGIN FAILED -->
                    <?php
                    if(isset($_SESSION['failed_login'])){
                        if($_SESSION['failed_login'] == 1){
                    ?>

                    <div class="failed-form">
                        <span>Usuario y/o contraseña incorrectos</span>
                    </div>

                    <?php
                        }
                    }
                    ?>
                    <!-- END IF LOGIN FAILED -->

                    <div class="d-flex justify-content-end">
                        <button type="submit">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    unset($_SESSION['failed_login']);
?>