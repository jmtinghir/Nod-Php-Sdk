<?php
require_once(realpath(dirname(__FILE__)."/nod.php"));

// Create an instance of the Nod Sdk
// This API key is only for test, use your application API key instead
$nod = new Nod("39W9VSNCSASEOGV");

try {
	$data = $nod->getDisponibiliteParkingsPublics();
// 	$data = $nod->getInfoTraficTANPrevisionnel();
// 	$data = $nod->getInfoTraficTANTempsReel();
// 	$data = $nod->getTempsParcours();
} catch(Exception $e) {
	$err = $e->getMessage();
}

?>
<html>
<head></head>
<body>
	<h1>Nantes Open Data : PHP SDK</h1>
	<p>Data : <?php echo $data->opendata->request ?></p>
</body>
</html>