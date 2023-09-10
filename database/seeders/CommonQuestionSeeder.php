<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\CommonQuestion;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommonQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'ar' => [
                    'question' => 'ما هو أهمية فحوصات السلامة الدورية للسيارة؟',
                    'answer' => 'تعتبر فحوصات السلامة الدورية مهمة لأنها تساعد في اكتشاف المخاطر المحتملة للسلامة في السيارة، مما يضمن تشغيلها بشكل آمن على الطريق.',
                ],
                'en' => [
                    'question' => "What is the importance of regular car safety inspections?",
                    'answer' => "Regular car safety inspections are crucial because they help identify potential safety hazards in your vehicle, ensuring it operates safely on the road.",
                ],
                'added_by' => Admin::query()->first()->id
            ],
            [
                'ar' => [
                    'question' => "كم مرة يجب عليّ استبدال إطارات سيارتي من أجل السلامة القصوى؟",
                    'answer' => "لضمان السلامة القصوى، يُوصى بأن يتم استبدال إطارات سيارتك كل 6 سنوات أو في وقت سابق إذا أظهرت علامات على التآكل. قم بفحص عمق وحالة الإطارات بانتظام.",
                ],
                'en' => [
                    'question' => "How often should I replace my car's tires for optimal safety?",
                    'answer' => "To ensure optimal safety, it is recommended to replace your car's tires every 6 years or earlier if they show signs of wear. Regularly check tire tread depth and condition.",
                ],
            ],
            [
                'ar' => [
                    'question' => "ماذا يجب علي فعله إذا تم نفخ وسادات الهواء في سيارتي خلال حادث؟",
                    'answer' => " يكون آمنًا الخروج من السيارة. ابحث عن العناية الطبية إذا كان ذلك ضروريًا وقم بالإبلاغ عن الحادث للسلطات.",
                ],
                'en' => [
                    'question' => "What should I do if my car's airbags deploy in an accident?",
                    'answer' => "If your car's airbags deploy during an accident, remain calm and stay seated until it is safe to exit the vehicle. Seek medical attention if necessary, and report the accident to the authorities.",
                ],
            ],

        ];

        foreach ($questions as $service) {
            CommonQuestion::query()->create($service);
        }
    }
}
