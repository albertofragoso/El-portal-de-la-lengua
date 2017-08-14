<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //Crear 15 usuarios y para cada usuario 20 articulos
        $users = factory(App\User::class, 15)->create();

        $users->each(function(App\User $user) use ($users){
          $articulos = factory(App\Articulo::class)
            ->times(20)
            ->create([
              'user_id' => $user->id,
            ]);

          $articulos->each(function(App\Articulo $articulo) use ($users) {
            factory(App\Message::class, random_int(1,10))->create([
              'articulo_id' => $articulo->id,
              'user_id' => $users->random(1)->first()->id,
            ]); //create
          });//each
        });

        //Crear articulos y seguira 10 usuarios
        /*$users->each(function(App\User $user) use ($users){
          factory(App\Articulo::class)
            ->times(20)
            ->create([
              'user_id' => $user->id,
            ]);

            $user->follows()->sync(
              $users->random(10)
            );
        });*/
    }
}
