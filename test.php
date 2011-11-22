<?php
require_once(realpath(dirname(__FILE__)."/nod.php"));

$nod = new Nod("39W9VSNCSASEOGV");

try {
	$data = $nod->getInfoTraficTANTempsReel();
} catch(Exception $e) {
	$err = $e->getMessage();
}

?>
<html>
<head>
</head>
<body>
	<h1>Nantes Open Data : PHP SDK</h1>
	<p>Data = <?php var_dump($data->opendata->answer->status) ?></p>
</body>
</html>