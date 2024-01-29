<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['FrontEnd', 'BackEnd', 'Fullstack', 'Design', 'Graphic'];

        foreach ($types as $type) {
            $newType = new Type();
            $newType->nome = $type;
            $newType->slug = Str::slug($type);
            $newType->save();
        }
    }
}
