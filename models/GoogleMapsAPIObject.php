<?php

class GoogleMapsAPIObject{


	public function __construct(string $apiKey)
	{
		$this->apiKey = $apiKey;
	}

	public function getLatAndLng(int $housenumber,string $street,string $city,string $country)
	{
		$street = str_replace(" ","+" , $street);
		$city = str_replace(" ","-" , $city);
		$url = curl_init("https://maps.googleapis.com/maps/api/geocode/json?address=".$housenumber."+".$street."+".$city.",".$country."&key=".$this->getApiKey());

		// Ajout d'option en mode tableau associatif
		curl_setopt_array($url, [
			CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR.'../utils/certificat.cer', // Certificat en provenance de Google
			CURLOPT_RETURNTRANSFER => true, // Déverse le resultat de la requête dans $url
			CURLOPT_TIMEOUT => 10 // Time out en secondes de la requête
	]);

		$data = curl_exec($url);

	if ($data === false || curl_getinfo($url, CURLINFO_HTTP_CODE) !== 200) { // Si error curl_exec renvoie false, si code de réponse != 200 -> error
		//var_dump(curl_error($url));
        curl_close($url); // on ferme la communication
		return false;
	}else{
        curl_close($url); // on ferme la communication
		$data = json_decode($data,true); // Mode tableau associatif -> true

		return $data;

        //['results'][0]['geometry']['location']['lat']." , ".$data['results'][0]['geometry']['location']['lng'];
		// Dans le tableau associatif présent dans $data on va chercher la latitude et la longitude comme ci-dessus
        // Pour vérifier comment est fait le tableau --> http://jsonviewer.stack.hu/


	}

//https://maps.googleapis.com/maps/api/geocode/json?address=17+chemin+du+port+montevrain,France&key=AIzaSyA1hXkyuahhWi93NaoeP-RtOSUJ7scK43c

	}
    private $apiKey;

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
}