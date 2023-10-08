<?php

namespace Database\Seeders;

use App\Models\BusinessSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomePageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $home_page_content = $this->getContentToSeed();
        foreach ($home_page_content as $content) {
            BusinessSetting::query()->updateOrCreate($content, $content);
        }
    }

    protected function getContentToSeed(): array
    {
        return [
            [
                'key' => 'home_page_slogan_1',
                'value' => trans('general.home_page.first_headline', [], 'ar'),
                'lang' => 'ar',
            ],
            [
                'key' => 'home_page_slogan_1',
                'value' => trans('general.home_page.first_headline', [], 'en'),
                'lang' => 'en',
            ],
            [
                'key' => 'home_page_short_intro',
                'value' => trans('general.home_page.first_headline_text', [], 'ar'),
                'lang' => 'ar',
            ],
            [
                'key' => 'home_page_short_intro',
                'value' => trans('general.home_page.first_headline_text', [], 'en'),
                'lang' => 'en',
            ],
            [
                'key' => 'home_page_slogan_2',
                'value' => trans('general.home_page.second_headline', [], 'ar'),
                'lang' => 'ar',
            ],
            [
                'key' => 'home_page_slogan_2',
                'value' => trans('general.home_page.second_headline', [], 'en'),
                'lang' => 'en',
            ],
            [
                'key' => 'home_page_entities_title',
                'value' => trans('general.home_page.entities_headline', [], 'ar'),
                'lang' => 'ar',
            ],
            [
                'key' => 'home_page_entities_title',
                'value' => trans('general.home_page.entities_headline', [], 'en'),
                'lang' => 'en',
            ],
            [
                'key' => 'home_page_services_title',
                'value' => trans('general.home_page.services_headline', [], 'ar'),
                'lang' => 'ar',
            ],
            [
                'key' => 'home_page_services_title',
                'value' => trans('general.home_page.services_headline', [], 'en'),
                'lang' => 'en',
            ],
            [
                'key' => 'home_page_intro_image',
                'value' => ('settings/home_page_intro_image/Image 1.png'),
                'lang' => null,
            ],
        ];
    }
}
