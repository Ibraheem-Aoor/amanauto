<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Club;
use App\Models\CommonQuestion;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clubs = [
            [
                'ar' => [
                    'name' => 'فحوصات السلامة للسيارة',
                    'description' => 'احرص على فحص سيارتك بانتظام للتأكد من سلامتها واكتشاف أية مخاطر محتملة.',
                ],
                'en' => [
                    'name' => 'Car Safety Inspections',
                    'description' => 'Make sure to inspect your car regularly to ensure its safety and detect any potential risks.',
                ],
                'duration' => 60,
                'duration_type' => 'Day',
                'times' => 4,
                'price' => 120,
                'prev_price' => 150,
                'color' => '#3498db',
                'added_by' => Admin::query()->first()->id,
                'is_coming_soon' => false,
                'vat' => 5,
                'vat_type' => 'percent',
            ],
            [

                'ar' => [
                    'name' => 'تأمين السيارة لحماية الأطفال',
                    'description' => 'تعرف على كيفية تأمين سيارتك لحماية الأطفال الصغار وجعل رحلاتهم آمنة.',
                ],
                'en' => [
                    'name' => 'Childproofing Your Car',
                    'description' => 'Learn how to childproof your car to keep young passengers safe during your journeys.',
                ],
                'duration' => 45,
                'duration_type' => 'Month',
                'times' => 3,
                'price' => 140,
                'prev_price' => 160,
                'color' => '#e74c3c',
                'added_by' => Admin::query()->first()->id,
                'is_coming_soon' => false,
                'vat' => 5,
                'vat_type' => 'percent',
            ],
            [
                'ar' => [
                    'name' => 'سلامة وصيانة الإطارات',
                    'description' => 'اعرف كيفية الحفاظ على إطارات سيارتك بحالة جيدة وتوفير السلامة أثناء القيادة.',
                ],
                'en' => [
                    'name' => 'Tire Safety and Maintenance',
                    'description' => 'Learn how to keep your car\'s tires in good condition and ensure safety while driving.',
                ],
                'duration' => 1,
                'duration_type' => 'Year',
                'times' => -1,
                'price' => 150,
                'prev_price' => 180,
                'color' => '#2ecc71',
                'added_by' => Admin::query()->first()->id,
                'is_coming_soon' => false,
                'vat' => 5,
                'vat_type' => 'flat',
            ],
            [
                'ar' => [
                    'name' => 'سلامة ونشاط وسادات الهواء',
                    'description' => 'استكشف كيفية عمل وسادات الهواء وكيف تساهم في سلامة السيارة أثناء الحوادث.',
                ],
                'en' => [
                    'name' => 'Airbag Safety and Deployment',
                    'description' => 'Discover how airbags work and contribute to car safety during accidents.',
                ],
                'duration' => 90,
                'duration_type' => 'Day',
                'times' => 4,
                'price' => 120,
                'prev_price' => 140,
                'color' => '#f39c12',
                'added_by' => Admin::query()->first()->id,
                'is_coming_soon' => true,
                'vat' => 5,
                'vat_type' => 'flat',
            ]


        ];

        $services = Service::query()->pluck('id')->toArray();
        foreach ($clubs as $club) {
            $created_club   = Club::query()->create($club);
            $created_club->services()->sync($services);
        }
    }
}
