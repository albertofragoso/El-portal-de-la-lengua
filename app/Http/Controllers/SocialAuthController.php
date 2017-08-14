<?php

namespace App\Http\Controllers;

use App\User;
use App\SocialProfile;
use Illuminate\Http\Request;
use Socialite;

class SocialAuthController extends Controller
{
    public function facebook()
    {
      return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
      //Obtener usuariio que nos da facebook
      $data = Socialite::driver('facebook')->user();
      // Guarda los datos de la sesion y desapareceran en el siguiente pedido
      // session()->flash('facebookUser', $user);
      // $data = session('facebookUser');
      // $username = request->input('username')
      $existing = User::whereHas('socialProfiles', function($query) use ($data)
      {
        $query->where('social_id', $data->id);
      })->first();

      if($existing !== null)
      {
        auth()->login($existing);

        return redirect('/');
      }

      $user = User::create([
        'name' => $data->name,
        'email' => $data->email,
        'password' => str_random(16),
        'roll' => 0,
      ]);

      $profile = SocialProfile::create([
        'social_id' => $data->id,
        'user_id' => $user->id,
      ]);

      //Loguea al usuario que acabamos de crear
      auth()->login($user);

      return back()->withInput();

    }
}
