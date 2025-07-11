<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use function Symfony\Component\String\u;

class UserController extends Controller
{
    public function index()
    {
        $users= User::all();
        if($users->count() < 1){
            abort('403','Aucun utilisateurs disponible');
        }
        return view('users.index', [
            'users'=> $users
        ]);
    }
    // La vue du formumlaire
    public function create(){
        return view('users.index');
    }

    public function store (StoreUserRequest $request){
        User::create($request->validated());
        return redirect()->route('users.index')
                            ->with('sucess', 'Inscription effectuer avec succes !');
    }
    // Formulaire pour faire des updates
    public function edit(){
        return view('users.edit');
    }
    // Fonction qui va traiter cet modification
    public function update(StoreUserRequest $request, User $user){
        $user->update($request->validated());
        if(!$user){
            abort('404', 'Aucun utilisateur ne correspond a cette modification');
        }
        return redirect()->route('users.index')
                            ->with('sucess', 'Modification effectuer avec succes !');
    }


    public function show(User $user){
        return view('users.show', compact('user'));
    }




}
