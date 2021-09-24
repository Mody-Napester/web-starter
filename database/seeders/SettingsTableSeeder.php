<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resource = new Setting();
        $resource->logos = json_encode(['en'=>'Default', 'ar'=>'افتراضي']);
        $resource->name = json_encode(['en'=>'Default', 'ar'=>'افتراضي']);
        $resource->slogan = json_encode(['en'=>'Default', 'ar'=>'افتراضي']);
        $resource->default_language_id = 1;
        $resource->default_theme_id = 1;
        $resource->save();
    }
}
