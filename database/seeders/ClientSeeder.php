<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            [
                'ar' => [
                    'name' => 'ضمان',
                ],
                'en' => [
                    'name' => "Council Of Health Insurance",
                ],
                'web_img' => ('client/web/logo.png'),
                'mobile_img' => ('client/mobile/logo.png'),
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'name' => 'ولاء بلس',
                ],
                'en' => [
                    'name' => "Walaa Plus",
                ],
                'web_img' => ('client/web/wala-plus-logo.png'),
                'mobile_img' => ('client/mobile/wala-plus-logo.png'),
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'name' => 'لين',
                ],
                'en' => [
                    'name' => "Lean",
                ],
                'web_img' => ('client/web/Lean-Logo.png'),
                'mobile_img' => ('client/mobile/Lean-Logo.png'),
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'name' => 'وزارة الشؤون البلدية والقروية والإسكان',
                ],
                'en' => [
                    'name' => "Ministry of Municipal and Rural Affairs and Housing",
                ],
                'web_img' => ('client/web/mh-logo-full.png'),
                'mobile_img' => ('client/mobile/mh-logo-full.png'),
                'added_by' => Admin::query()->first()->id
            ],
        ];

        foreach($clients as $client)
        {
            Client::query()->create($client);
        }
    }
}
