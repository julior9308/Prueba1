<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DevolverUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:devolver';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando devuelve usuarios cuya edad es mayor a 25';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      //  $users=User::where('edad','>',25)->get();
      //  foreach ($users as $user){
       //     $this->info("Nombre:{$user->name}, Edad:{$user->edad}");
            $users = User::where('edad', '>', 25)->get();

            $datos = [];
            foreach ($users as $user) {
                $userImages = $user->images->map(function($image) {
                    return [
                        'url' => $image->url,
                        'is_visible' => $image->is_visible,
                    ];
                })->toArray();

                $datos[] = [
                    'Nombre' => $user->name,
                    'Edad' => $user->edad,
                    'Imagenes' => $userImages,
                ];
            }

            $this->info(json_encode($datos, JSON_PRETTY_PRINT));
        }

}
