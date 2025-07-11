<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function showView(){
        return view('hello');
    }
    //Ici je cree un contoller avec une vue qui aura  des parametre sous 
    //la forme de tableau associatif cle =>valeur

    public function showViewWithData(){
        $nom="Kadji";
        $age= 19;

        return view('hello-data',[
            'nom'=>$nom,
            'age'=>$age
        ]);
    }

    public function vuePersonaliser($nom){
        $messageDeBienvenue="Bienvenue dans ce site Laravel";
        $anneeActuelle= date('Y');

        return view('vue_personaliser',[
            'nom'=>$nom,
            'message'=>$messageDeBienvenue,
            'annee'=>$anneeActuelle
        ]);
    }
}
