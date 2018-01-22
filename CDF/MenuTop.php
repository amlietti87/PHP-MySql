<?php

	$url = end(explode("/",$_SERVER['REQUEST_URI']));
?>
<p>
    <a href="ABMTer.php" class="<?php echo ($url=="ABMTer.php")? 'opmenu activo':'opmenu'; ?>">Administrar Terapeutas</a>
    <a href="ABMPac.php" class="opmenu <?php echo ($url=="ABMPac.php")? 'activo':''; ?>">Administrar Pacientes</a>
</p>