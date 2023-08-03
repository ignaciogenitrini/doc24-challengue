<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $personaData = [
            ['nombre' => 'Ignacio', 'apellido' => 'Genitrini', 'email' => 'nacho_2009_xp@hotmail.com', 'password' => 'password1', 'edad' => 24, 'telefono' => '5421127361488'],
            ['nombre' => 'Matias', 'apellido' => 'Hernandez', 'email' => 'matias_2009_xp@hotmail.com', 'password' => 'password2', 'edad' => 30, 'telefono' => '542475561488'],
            ['nombre' => 'Lucas', 'apellido' => 'Suarez', 'email' => 'lucas_2009_xp@hotmail.com', 'password' => 'password3', 'edad' => 12, 'telefono' => '542477364481'],
            ['nombre' => 'Lautaro', 'apellido' => 'Messi', 'email' => 'lautaro_2009_xp@hotmail.com', 'password' => 'password4', 'edad' => 40, 'telefono' => '5424773551488'],
        ];

        foreach ($personaData as $persona) {
            $personaExist = Persona::where('nombre', $persona['nombre'])->first();

            if (!$personaExist) {
                Persona::create(
                    [
                        'nombre' => $persona['nombre'],
                        'apellido' => $persona['apellido'],
                        'email' => $persona['email'],
                        'password' => bcrypt($persona['password']),
                        'edad' => $persona['edad'],
                        'telefono' => $persona['telefono']
                    ]
                );
            }
        }
    }
}
