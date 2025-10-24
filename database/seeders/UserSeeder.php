<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //läs JSON-filen
        $path=storage_path('jsondb\users.json');
        $jsonstring=file_get_contents($path);
        $data=json_decode($jsonstring, true);
        
        //loopa igenom filen
        foreach($data as $item){
            $item['admin']=(int)$item['admin'];
            User::updateOrCreate(['id'=>$item['id']], $item);
            
        }
    }
}
