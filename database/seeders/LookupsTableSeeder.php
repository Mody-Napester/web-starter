<?php

namespace Database\Seeders;

use App\Models\Lookup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LookupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 'uuid','parent_id','key','name','is_active','created_by','updated_by',

        $lookups = [
            ['name' => ['en' => 'file_type', 'ar' => 'file_type'], 'child' => [['name' => ['en' => 'image', 'ar' => 'image']], ['name' => ['en' => 'video', 'ar' => 'video']], ['name' => ['en' => 'text', 'ar' => 'text']]]],
            ['name' => ['en' => 'providers', 'ar' => 'providers'], 'child' => [['name' => ['en' => 'facebook', 'ar' => 'facebook']], ['name' => ['en' => 'linkedin', 'ar' => 'linkedin']], ['name' => ['en' => 'twitter', 'ar' => 'twitter'], ['name' => ['en' => 'youtube', 'ar' => 'youtube']]]]],
        ];

        foreach ($lookups as $lookup){
            $resource = Lookup::create([
                'parent_id' => 0,
                'key' => Str::slug($lookup['name']['en'], '_'),
                'name' => json_encode($lookup['name']),
                'is_active' => 1,
                'created_by' => 1,
            ]);

            foreach ($lookup['child'] as $child){
                Lookup::create([
                    'parent_id' => $resource->id,
                    'key' => Str::slug($child['name']['en'], '_'),
                    'name' => json_encode($child['name']),
                    'is_active' => 1,
                    'created_by' => 1,
                ]);
            }
        }
    }
}
