<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'ar' => [
                    'name' => 'استبدل الإطار المسطح',
                ],
                'en' => [
                    'name' => "REPLACE FLAT TIRE",
                ],
                'web_img' => ('service/web/tire.svg'),
                'mobile_img' => ('service/mobile/tire.svg'),
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'name' => 'احتياطية الوقود',
                ],
                'en' => [
                    'name' => "FUEL BACKUP",
                ],
                'web_img' => ('service/web/Fuel.svg'),
                'mobile_img' => ('service/mobile/Fuel.svg'),
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'name' => 'تعزيز البطارية',
                ],
                'en' => [
                    'name' => "BATTERY BOOST",
                ],
                'web_img' => ('service/web/Car_Battery.svg'),
                'mobile_img' => ('service/mobile/Car_Battery.svg'),
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'name' => 'تعزيز البطارية',
                ],
                'en' => [
                    'name' => "BATTERY BOOST",
                ],
                'web_img' => ('service/web/service-station.svg'),
                'mobile_img' => ('service/mobile/service-station.svg'),
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'name' => 'خدمة السحب',
                ],
                'en' => [
                    'name' => "TOWING SERVIC",
                ],
                'web_img' => ('service/web/service-station.svg'),
                'mobile_img' => ('service/mobile/service-station.svg'),
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'name' => 'قطر الاصطدام',
                ],
                'en' => [
                    'name' => "CRASH TOWING",
                ],
                'web_img' => ('service/web/bump.svg'),
                'mobile_img' => ('service/mobile/bump.svg'),
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'name' => 'الغطاء',
                ],
                'en' => [
                    'name' => "COVERED KSA",
                ],
                'web_img' => ('service/web/Insurance.svg'),
                'mobile_img' => ('service/mobile/Insurance.svg'),
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'name' => 'خدمة الليموزين',
                ],
                'en' => [
                    'name' => "LIMOUSINE SERVICE",
                ],
                'web_img' => ('service/web/g19.png'),
                'mobile_img' => ('service/mobile/g19.png'),
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'name' => 'قطر الاصطدام',
                ],
                'en' => [
                    'name' => "CRASH TOWING",
                ],
                'web_img' => ('service/web/bump.svg'),
                'mobile_img' => ('service/mobile/bump.svg'),
                'added_by' => Admin::query()->first()->id
            ],
        ];

        foreach ($services as $service) {
            Service::query()->create($service);
        }
    }
}
