<div class="card">
    <?php
        echo "¡Bienvenido";
        if(isset($_SESSION['usuario'])){
            echo " ".$_SESSION['usuario'];
        }
        echo "!";
    ?>
</div>