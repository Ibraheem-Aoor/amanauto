<?php

namespace Database\Seeders;

use App\Models\BusinessSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferPageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offers_page_content = $this->getContentToSeed();
        foreach ($offers_page_content as $content) {
            BusinessSetting::query()->updateOrCreate($content, $content);
        }
    }

    protected function getContentToSeed(): array
    {
        return [
            [
                'key' => 'offers_page_intro_image',
                'value' => ('settings/offers_page_intro_image/Image 1.png'),
                'lang' => null,
            ],
            [
                'key' => 'offers_page_no_offers_text',
                'value' => trans('general.no_offers_found', [], 'ar'),
                'lang' => 'ar',
            ],
            [
                'key' => 'offers_page_no_offers_text',
                'value' => trans('general.no_offers_found', [], 'en'),
                'lang' => 'en',
            ],
        ];
    }
}
