<?php

namespace App\Http\Controllers;

use App\Models\exampleapp;

use App\Models\Person;

use App\Models\likes_matches;

use Illuminate\Http\Request;

class daytapcontroller extends Controller
{
    public function welcome(){
        return view ('welcome');
    }

    public function createAccount(){
        return view ('createaccount');
    }

    
    public function messages(){


        $matchlist = likes_matches::where(function($query) {
            $query->where('liker_id', session('person_id'))
                  ->orWhere('liked_id', session('person_id'));
        })
        ->where('match', 's') 
        ->get();


        return view('messages', ['matchlist' => $matchlist]);
    }

    public function storeNewAccount(Request $request){

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName(); // Unique filename
            $destinationPath = public_path('userPics'); // Save in 'public/uploads'
            
            // Move the file to the destination folder
            $file->move($destinationPath, $filename);
        }

        $newAccount = new Person;
        $newAccount->name = $request->name;
        $newAccount->password = $request->password;
        $newAccount->avaliable_likes = 200;
        $newAccount->matches = 0;
        $newAccount->user_image = $filename;
        $newAccount->description = $request->desc;
        $newAccount->save();

        return redirect()->route('welcome'); // Redirect to prevent duplicate form submission
    }

    public function login(Request $request)
    {
        $person = Person::where('name', $request->name)->first();
    
        if (!$person || $person->password != $request->password) {
            return redirect()->route('welcome')->with('message', 'Login Inválido!');
        }
    
        // Store user in session
        session(['person_id' => $person->id, 'person_name' => $person->name, 'person_picture' => $person->user_image]);
    
        return redirect()->route('homepage'); // Redirect without passing data
    }


    public function logout(Request $request)
    {

        session()->flush();
        
        return redirect()->route('welcome'); // Redirect without passing data
    }
    

    public function homepage()
    {
        $randomPerson = Person::inRandomOrder()->first(); // Get a fresh random person on each request

        if (Person::count() > 1) {
            while($randomPerson->id === session('person_id')){
                $randomPerson = Person::inRandomOrder()->first();
            }
        }

        return view('homepage', ['person' => $randomPerson]); // Pass a single person
    }

    public function likeUser(Request $request){

        
        $verifyMatch = likes_matches::where('liked_id', session('person_id'))
        ->where('liker_id', $request->liked_person_id)
        ->first();
        
        if($verifyMatch !== null){

            $newLike = new likes_matches;
            $newLike->liker_id = session('person_id');
            $newLike->liked_id = $request->liked_person_id;
            $newLike->match = 's';
            $newLike->save();
            return redirect()->route('messages')->with('message', 'Você deu um match amigão!');

        }else{
            
            $newLike = new likes_matches;
            $newLike->liker_id = session('person_id');
            $newLike->liked_id = $request->liked_person_id;
            $newLike->save();
            return redirect()->route('homepage');
        }

    }

    public function dislikeUser(Request $request){

    // Fetch all valid people except the logged-in user and the disliked person
    $validPeople = Person::where('id', '!=', session('person_id'))
                         ->where('id', '!=', $request->disliked_person_id)
                         ->get();

    // If there are no valid people left, return to homepage with a message
    if ($validPeople->isEmpty()) {
        return redirect()->route('homepage')->with('message', 'No more people available.');
    }

    // Pick a random person from the valid ones
    $randomPerson = $validPeople->random();

    return view('homepage', ['person' => $randomPerson]); // Pass a single person

    }

}
