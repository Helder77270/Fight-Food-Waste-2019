<?php

require_once (__DIR__.'/../utils/DatabaseManager.php');
require_once (__DIR__ . '/../models/User.php');

class UserDao
{
    private $connectedUser;

    public function getConnectedUser()
    {
        return $this->connectedUser;
    }

    // Créer un utilisateur en BDD
    public static function createUser($username, $firstname, $name, $password, $type, $mail, $country, $city, $postalcode, $street, $housenumber, $LoB, $siret, $skill1, $skill2, $skill3, $token,$region)
    {
        $res = DatabaseManager::getSharedInstance()->exec('INSERT INTO user(username,firstname,name,password,type,mail,country,city,postalcode,street,housenumber,lob,siret,skill1,skill2,skill3,token,region) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$username, $firstname, $name, $password, $type, $mail, $country, $city, $postalcode, $street, $housenumber, $LoB, $siret, $skill1, $skill2, $skill3, $token,$region]);

        if ($res){
            return ['success' => 'You will now receive an e-mail to activate your account !' ];
        }else{
            return ['error' => 'You encountered a problem, try later  !' ];
        }

    }

   public static function updateUser($username,$firstname,$name,$country,$city,$postalcode,$street,$housenumber,$lob,$skill1,$skill2,$skill3,$age,$id)
    {
        // Modifie en base de données un produit composé d'un code bare, un nom et une quantité et une image(lien exclusiment)
        $res = DatabaseManager::getSharedInstance()->exec("UPDATE user SET username=?,firstname=?,name=?,country=?,city=?,postalcode=?,street=?,housenumber=?,lob=?,skill1=?,skill2=?,skill3=?,age=? WHERE id=? ", [$username,$firstname,$name,$country,$city,$postalcode,$street,$housenumber,$lob,$skill1,$skill2,$skill3,$age,$id]);

        if ($res){
            $res2 = DatabaseManager::getSharedInstance()->exec("SELECT * FROM user WHERE id=?",[$id]);
            $usr = new UserDao();
            $reconnect = $usr -> connexionUser($res[0]['mail'],$res[0]['password']);

            if($reconnect){
//                $commonUsr = unserialize($_SESSION['user']);
//                var_dump($commonUsr);
                return ["success" => " Your account has been modified ! "];
            }else{
                return ["error" => " Internal problem you will be logged out "];
            }

        }else{
            return ['error' => 'You encountered a problem, try later  !' ];
        }

    }

    // Supprime un utilisateur en BDD
	public static function deleteUser($username)
	{
        return DatabaseManager::getSharedInstance()->exec('DELETE FROM user WHERE username = ?', [$username]);
	}

	// Vérifie si un mail existe en bdd s'il retourne 0 c'est qu'il n'existe pas, s'il renvoie au moins 1 ça veut dire que le mail existe en BDD
	public static function verifUserMail($mail){
        $count = 0;
        $resQuery = DatabaseManager::getSharedInstance()->selec('SELECT * FROM user WHERE mail=?', [$mail]);
        if ($resQuery == 0) {
            return $count;
        } else {
            foreach ($resQuery as $item) {
                $count += 1;
            }
            return $count;
        }
	}

	public static function validateVolunteer($value){
        $res = DatabaseManager::getSharedInstance()->exec("UPDATE user SET status=?",[$value]);
        if ($res){
            return ["success" => " Volunteer validated! "];
        }else{
            return ["error" => " You encountered a problem, try later ! "];
        }
    }
    // Vérifie si un username existe en bdd s'il retourne 0 c'est qu'il n'existe pas, s'il renvoie au moins 1 ça veut dire que le mail existe en BDD
	public static function verifUsername($username){
        $count = 0;
        $resQuery = DatabaseManager::getSharedInstance()->selec('SELECT * FROM user WHERE username=?', [$username]);
        if ($resQuery == 0) {
            return $count;
        } else {
            foreach ($resQuery as $item) {
                $count += 1;
            }
            return $count;
        }
	}
	public static function verifSiret($siret){
        $count = 0;
        $resQuery = DatabaseManager::getSharedInstance()->selec('SELECT * FROM user WHERE siret=?', [$siret]);
        if ($resQuery == 0) {
            return $count;
        } else {
            foreach ($resQuery as $item) {
                $count += 1;
            }
            return $count;
        }
	}

	// Vérifie si le mail rentré et le mot de passe coincident bien en BDD, la fonction n'est pas static sinon on ne pourrait pas garder l'objet user créé
    // Les fonctions static "s'autodétruise" après utilisation (manière de parler)
      public function connexionUser($login, $pwd){

            $user = DatabaseManager::getSharedInstance()->selec('SELECT * FROM user WHERE mail=?', [$login]);

            // $user[0]['password'] permet de récupérer dans le tableau de ma requête la value du mot de passe, s'ils coincident on créé un objet user et on l'hydrate
            if (!empty($user)){
                if ($user[0]['status']==1){
                    $pwd = sha1($pwd);

                    if ($pwd == $user[0]['password']) {
                        $this->connectedUser = new User(
                            $user[0]['id'],
                            $user[0]['username'],
                            $user[0]['firstname'],
                            $user[0]['name'],
                            $user[0]['mail'],
                            $user[0]['type'],
                            $user[0]['country'],
                            $user[0]['city'],
                            $user[0]['postalcode'],
                            $user[0]['street'],
                            $user[0]['housenumber'],
                            $user[0]['lob'],
                            $user[0]['siret'],
                            $user[0]['skill1'],
                            $user[0]['skill2'],
                            $user[0]['skill3'],
                            $user[0]['token']
                        );

                        session_start();
                        $_SESSION['user'] = serialize($this->connectedUser); //serialize l'objet //!\\ Un objet doit être converti en un autre format pour être affiché (tableau/string) //!\\
                        // Serialize sérialise l'objet (le transforme en une longue chaine de caractères qu'on va unserialisé pour pour être utiliser comme un objet dans une autre page (voir index.php ligne 5 et 70

                        // Ces return sont pour la fonction Ajax qui appelle cette fonction à la connexion, ce sont les messages qui s'affichent en cas d'erreur ou de succès
                        return ["success" => "Connected"];

                    }else {
                        return ["error" => "Wrong credentials"];

                    }
                }else{
                    return ["error" => "Your account isn't validated, please take a loot at your e-mail"];
                }

            }else{
                return ["error" => "Wrong credentials"];
            }

      }

    public static function userIsVolunteer($type){
        $db = DatabaseManager::getSharedInstance();
        $resVolunteer = $db->getAll('SELECT mail,name,firstname,region FROM user WHERE type=? ',[$type]);
        foreach ($resVolunteer as $row){
            $Volunteer[] = $row;
        }
        return $Volunteer;
    }
    public static function userIsVolunteerAndNotBusy($type){
        $db = DatabaseManager::getSharedInstance();
        $resVolunteer = $db->getAll('SELECT mail,name,firstname,region FROM user WHERE type=? AND busy=0 ',[$type]);
        foreach ($resVolunteer as $row){
            $Volunteer[] = $row;
        }
        return $Volunteer;
    }
}
