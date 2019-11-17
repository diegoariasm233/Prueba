<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Administrador',],
            ['id' => 2, 'title' => 'Empleado',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
