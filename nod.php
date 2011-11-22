<?php

/**
 * @author Jean-Marie Tinghir http://jmtinghir.net
 * 
 * Requires cUrl
 */
class Nod {

	const NOD_URL = "http://data.nantes.fr/api/";


	private $version = "1.0";

	private $apiKey;

	public function __construct($apiKey, $version = "1.0") {
		$this->apiKey = $apiKey;
		$this->version = $version;
	}

	public function getVersion() {
		return $this->version;
	}
	public function setVersion($v) {
		$this->version = $v;
	}

	public function getApiKey() {
		return $this->apiKey;
	}
	public function setApiKey($k) {
		$this->apiKey = $k;
	}


	/**
	 * Return the result of a call to the NOD api.
	 * @param string $cmd
	 * @param boolean $returnJson if true return json string, false return Object
	 * @throws Exception
	 */
	public function callCmd($cmd, $returnJson=false) {
		if (!extension_loaded('curl')) {
			throw new Exception('cUrl extension is not available');
		}

		$url = self::NOD_URL.$cmd."/".$this->version."/".$this->apiKey."?output=json";
		$ch = curl_init($url);

		// cUrl Options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
		
		$res = curl_exec($ch);
// 		$infos = curl_getinfo($ch);
		$err = curl_error($ch);
		curl_close($ch);

		if ($res === false) {
			throw new Exception("Error : ".$err);
		}

		if ($returnJson)
			return $res;
		return json_decode($res);
	}


	/**
	 * http://data.nantes.fr/les-donnees/documentation-de-lapi/getinfotrafictantempsreel/
	 * @param boolean $returnJson if true return json string, false return Object
	 */
	public function getInfoTraficTANTempsReel($returnJson=false) {
		return $this->callCmd("getInfoTraficTANTempsReel", $returnJson);
	}
}
?>