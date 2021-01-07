    <?php

class User
{
	private $id;
	private $username;
	private $firstname;
	private $name;
	private $mail;
	private $password;
	private $type;
	private $country;
	private $city;
	private $postalcode;
	private $street;
	private $housenumber;
	private $lob;
	private $siret;
	private $skill1;
	private $skill2;
	private $skill3;
	private $token;

	public function __construct($id, $username, $firstname, $name, $mail, $type, $country, $city, $postalcode, $street, $housenumber, $lob, $siret, $skill1, $skill2, $skill3, $token)
	{
		$this->id = $id;
		$this->username = $username;
		$this->firstname = $firstname;
		$this->name = $name;
		$this->mail = $mail;
		$this->type = $type;
		$this->country = $country;
		$this->city = $city;
		$this->postalcode = $postalcode;
		$this->street = $street;
		$this->housenumber = $housenumber;
		$this->lob = $lob;
		$this->siret = $siret;
		$this->skill1 = $skill1;
		$this->skill2 = $skill2;
		$this->skill3 = $skill3;
		$this->token = $token;
	}


	// La fonctionne __toString() permet d'echo un objet sinon PHP renvoie une erreur
	public function __toString()
	{
		return 'User (' .$this->id.',' . $this->username. ',' . $this->firstname . ',' . $this->name . ',' . $this->password . ','. $this->mail . ')' ;
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username=$username;
	}

	public function getFirstname(){
		return $this->firstname;
	}

	public function setFirstname($firstname){
		$this->firstname=$firstname;
	}

	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name=$name;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password=$password;
	}

	public function getMail(){
		return $this->mail;
	}

	public function setMail($mail){
		$this->mail=$mail;
	}

	/**
	 * @return mixed
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param mixed $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * @return mixed
	 */
	public function getCountry()
	{
		return $this->country;
	}

	/**
	 * @param mixed $country
	 */
	public function setCountry($country)
	{
		$this->country = $country;
	}

	/**
	 * @return mixed
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * @param mixed $city
	 */
	public function setCity($city)
	{
		$this->city = $city;
	}

	/**
	 * @return mixed
	 */
	public function getPostalcode()
	{
		return $this->postalcode;
	}

	/**
	 * @param mixed $postalcode
	 */
	public function setPostalcode($postalcode)
	{
		$this->postalcode = $postalcode;
	}

	/**
	 * @return mixed
	 */
	public function getStreet()
	{
		return $this->street;
	}

	/**
	 * @param mixed $street
	 */
	public function setStreet($street)
	{
		$this->street = $street;
	}

	/**
	 * @return mixed
	 */
	public function getHousenumber()
	{
		return $this->housenumber;
	}

	/**
	 * @param mixed $housenumber
	 */
	public function setHousenumber($housenumber)
	{
		$this->housenumber = $housenumber;
	}

	/**
	 * @return mixed
	 */
	public function getLob()
	{
		return $this->lob;
	}

	/**
	 * @param mixed $lob
	 */
	public function setLob($lob)
	{
		$this->lob = $lob;
	}

	/**
	 * @return mixed
	 */
	public function getSiret()
	{
		return $this->siret;
	}

	/**
	 * @param mixed $siret
	 */
	public function setSiret($siret)
	{
		$this->siret = $siret;
	}

	/**
	 * @return mixed
	 */
	public function getSkill1()
	{
		return $this->skill1;
	}

	/**
	 * @param mixed $skill1
	 */
	public function setSkill1($skill1)
	{
		$this->skill1 = $skill1;
	}

	/**
	 * @return mixed
	 */
	public function getSkill2()
	{
		return $this->skill2;
	}

	/**
	 * @param mixed $skill2
	 */
	public function setSkill2($skill2)
	{
		$this->skill2 = $skill2;
	}

	/**
	 * @return mixed
	 */
	public function getSkill3()
	{
		return $this->skill3;
	}

	/**
	 * @param mixed $skill3
	 */
	public function setSkill3($skill3)
	{
		$this->skill3 = $skill3;
	}

	/**
	 * @return mixed
	 */
	public function getToken()
	{
		return $this->token;
	}

	/**
	 * @param mixed $token
	 */
	public function setToken($token)
	{
		$this->token = $token;
	}

}
