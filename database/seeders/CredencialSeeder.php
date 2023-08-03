<?php

namespace Database\Seeders;

use App\Models\Credencial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CredencialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $credencialData = [
            'brand' => 'update_user',
            'client_id' => 1,
            'secret_id' => NULL
        ];

        $credencialExists = Credencial::where('brand', 'update_user')->first();

        if (!$credencialExists) {
            Credencial::create($credencialData);
        }
    }
}
