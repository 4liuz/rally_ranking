<?php
    $rally = GetRally(1);
?>
<div class="card">
    <div class="card-head">
        <span>Rally Ranking</span>
    </div>
    <div class="card-body">
        <p>Presentamos Rally Ranking: La nueva y revolucionaria aplicación gestora de concursos fotográficos.</p>
        <p>¡Date de alta como participante del concurso, sube tus fotos y escala hasta el top 3 del ranking!</p>
        <p>El administrador se encargará de aprobar las fotos válidas, y cualquier persona podrá votar tu foto hasta el máximo de veces que se indiquen en las bases.</p>
        <p>¡Buena suerte y conviértete en el <strong>#1</strong>!</p>
    </div>
</div>
<div class="card">
    <div class="card-head">
        <span>Bases del concurso</span>
    </div>
    <div class="card-body">
        <p>Tema del concurso: Aves</p>
        <p>Periodo de subida de fotos: <span><?php echo $rally->fecha_inicio_subidas; ?></span> / <span><?php echo $rally->fecha_fin_subidas; ?></span></p>
        <p>Periodo votación de fotos: <span><?php echo $rally->fecha_inicio_votaciones; ?></span> / <span><?php echo $rally->fecha_fin_votaciones; ?></span></p>
        <p>Máximo de fotos permitidas por participante: <span><?php echo $rally->limite_fotos_participante; ?></span></p>
        <p>Máximo de votaciones permitidas por usuario: <span>3</span></p>
        <p>Formato de fotografías:</p>
        <ul class="list">
            <li>Extensiones permitidas: .jpg, .jpeg, .png</li>
            <li>Dimensiones permitidas: 1:1 - 2:1</li>
            <li>Tamaño permitido: 4000px de perímetro</li>
        </ul>
    </div>
</div>
<?php
    unset($rally);
?>