<?php

// $tab = [
//     "nom"=> "Kadji",
//     "prenom" => "Philip"
// ];

// foreach ($tab as $keys =>$value){
//     echo $keys." ".$value;
// }


// echo $tab[0]."\n";
// var_dump($tab)."\n" ;
// print_r($tab) ;

use PhpParser\Node\Expr\Cast\Double;

// $sommeReel = function ($a,$b):float{
//     return $a * $b;
// };

// echo " ".$sommeReel(3,2);

// function fullname($array_as){
//     return $array_as['nom']." ". $array_as['prenom'];
// }

// $perso = [
//     "nom"=>  "Kadji",
//     "prenom" => "Philip"
// ];

// echo fullname($perso);

// class personne(){

//     __construc {

//     }

// }

$users= [

        ["nom" => "Kadji","prenom" => "Philip","age" => 15],
        ["nom" => "Peck","prenom" => "Philip","age" => 38],
        ["nom" => "BOP","prenom" => "Philip","age" => 22]

];

// print_r($users[0]) ;

// $nomz[]= "je suis cool";
// array_push($nomz,"hey");
// array_unshift($nomz,"firstElement");
// var_dump($nomz);

// function isMajeur($age){
//     return $age>=18 ? true: false;
// }
// $nb=nulla;
// foreach ($users as $user){
//     if (isMajeur($user['age'])){
//         echo "<p> ".$user['nom']." a ". $user['age']." ans </p>";
//         $nb+=1;
//     } else{
//         echo "<p> {$user['nom']} n'est pas majeur </p>";
//     }
// }

// echo "Il y a ".$nb." personne majeur";

 class personne{
    protected $nom;
    protected $age;
    protected $prenom;

    //Constructeur

    public function __construct($nom,$age, $prenom){
        $this -> nom= $nom;
        $this -> age= $age;
        $this -> prenom= $prenom;


    }

    // Acesseur et mutateur

    public function getnom(){
        return $this->nom;
    }
    public function setnom($nom){
        $this->nom= $nom;
    }

    public function getprenom(){
        return $this-> prenom;
    }
    public function setprenom($prenom){
        $this -> prenom= $prenom;
    }
    public function getage(){
        return $this->age;
    }
    public function setage($age){
        $this->age = $age;
    }

    public function afficheInfo(){
        return "Je m'appele {$this->nom } {$this-> prenom} et j'ai {$this->age} ans ";
    }





}

class employer extends personne {
    protected $salaire;
    protected $position;

    public function __construct($nom,$age,$prenom,$salaire,$position){
        parent::__construct($nom,$age,$prenom);
        $this -> salaire=$salaire;
        $this-> position= $position;

    }

    public function getsalaire(){
        return $this->salaire;
    }
    public function setSalaire($salaire){
        $this-> salaire= $salaire;
    }
    public function getPosition(){
        return $this -> position;
    }
    public function setPosition($position){
        $this->position= $position;
    }

    public function InfoEmployer(){
        return parent::afficheInfo()." a un salaire de {$this->salaire} et une position {$this->position} ";
    }
}

// $p1= new personne("Kadji",13,"Jean");
// $empl= new Employer("Piko", 18,"Dimi",4000,"DG departement Telecom");

//  echo $empl->infoEmployer();

// echo $p1->getnom();
// $p1->setnom("Kipo");
// echo $p1-> getnom();
// print_r($p1 -> afficheInfo());

abstract class Annimal{
    protected $nom;

    public function __construct ($nom){
        $this->nom= $nom;
    }

    public function getNom(){
        return $this->nom;
    }

    abstract public function seDeplacer();
    abstract public function Bruit();
}

class Chien extends Annimal {
    public function seDeplacer(){
        return "marher a quatre pate";
    }
    public function Bruit (){
        return "Aboiement";
    }

}

// $c = new chien ("max");
// echo $c->seDeplacer();

Class Cercle{
    protected $rayon;
    protected static $pi=3.14;

    public function __construct($rayon){
        $this-> rayon =$rayon;
    }
    // Le mot clee self permet d'utiliser une proprieter static
    public function AireCercle($r){
        return self::$pi* $r* $r;
    }
    public static function diametre($r){
        return $r*2;
    }

}

$c = new Cercle (4);
// echo $c->AireCercle(1)."\n";

// IMPORTANT : Pour appeler une methode static ont l'ecrit comme c'est fait plus bas(instance de la classe/classe :: methode)

// echo $c::diametre(9);

// $tab= ['3',"cool","top"];
// foreach ($tab as $tabs){
//     echo str_replace("cool","****",$tabs);
// }
// $nom="Holo";

// echo str_replace('o','-',$nom);

// echo count($tab);



// Exception personnalisée
// class InvalidAgeException extends Exception
// {
//     public function __construct($age)
//     {
//         parent::__construct("L'âge $age n'est pas valide");
//     }
// }

// class UserService
// {
//     private $name;
//     public function __construct($name){
//         $this->name = $name;
//     }
//     public function getName(){
//         return $this->name;
//     }
//     public function createUser($name, $email, $age)
//     {
//         // Validation
//         if (empty($name)) {
//             throw new InvalidArgumentException("Le nom ne peut pas être vide");
//         }

//         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             throw new InvalidArgumentException("Email invalide");
//         }

//         if ($age < 0 || $age > 150) {
//             throw new InvalidAgeException($age);
//         }

//         return new UserService($name, $email, $age);
//     }
// }

// // Utilisation avec gestion d'erreurs
// $userService = new UserService("KaDJI");

// try {
//     $user = $userService->createUser("John", "john@example.com", 25);
//     echo "Utilisateur créé : " . $user->getName();

// } catch (InvalidAgeException $e) {
//     echo "Erreur d'âge : " . $e->getMessage();

// } catch (InvalidArgumentException $e) {
//     echo "Argument invalide : " . $e->getMessage();

// } catch (Exception $e) {
//     echo "Erreur générale : " . $e->getMessage();

// } finally {
//     echo "Nettoyage effectué";
// }


// Exception personnalisée



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mon site</title>
</head>
<body>
    <h3>He back soon !</h3>
</body>
</html>


















?>
