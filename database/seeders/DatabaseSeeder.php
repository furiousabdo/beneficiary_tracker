<?php

namespace Database\Seeders;

use App\Models\Association;
use App\Models\Family;
use App\Models\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
{
    // Disable foreign key checks only if NOT using SQLite
    if (DB::getDriverName() !== 'sqlite') {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('persons')->truncate();
        DB::table('families')->truncate();
        DB::table('associations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    } else {
        // SQLite: use delete() instead of truncate()
        DB::table('persons')->delete();
        DB::table('families')->delete();
        DB::table('associations')->delete();
    }

    // Seeding logic
    $associations = [
        [
            'name_ar' => 'جمعية الإسكان التعاوني',
            'name_en' => 'Cooperative Housing Association',
            'address' => 'الرياض، حي العليا',
            'phone' => '0112345678',
            'email' => 'info@cha.sa',
            'website' => 'www.cha.sa',
            'description' => 'جمعية تعاونية لتمويل وإسكان المواطنين',
            'is_active' => true,
        ],
        [
            'name_ar' => 'جمعية بيت الخير',
            'name_en' => 'Beit Al-Khair Association',
            'address' => 'جدة، حي الصفا',
            'phone' => '0123456789',
            'email' => 'info@beitalkhair.sa',
            'website' => 'www.beitalkhair.sa',
            'description' => 'تسعى لتوفير سكن لائق للأسر المحتاجة',
            'is_active' => true,
        ],
    ];

    foreach ($associations as $association) {
        $assoc = \App\Models\Association::create($association);

        for ($i = 1; $i <= 3; $i++) {
            $family = \App\Models\Family::create([
                'association_id' => $assoc->id,
                'family_card_number' => 'FAM-' . $assoc->id . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'registration_date' => now()->subMonths(rand(1, 24)),
                'housing_status' => ['مستأجر', 'مستفيد من سكن حكومي', 'يمتلك سكناً'][array_rand([0, 1, 2])],
                'address' => 'عنوان العائلة ' . $i . ' - ' . $assoc->name_ar,
                'notes' => 'ملاحظات إضافية للعائلة ' . $i,
            ]);

            $father = \App\Models\Person::create([
                'name_ar' => 'أب ' . $i . ' ' . $assoc->name_ar,
                'national_id' => '1' . str_pad($assoc->id, 3, '0', STR_PAD_LEFT) . str_pad($i, 7, '0', STR_PAD_LEFT),
                'birth_date' => now()->subYears(rand(30, 60)),
                'gender' => 'ذكر',
                'marital_status' => 'متزوج',
                'occupation' => ['موظف', 'تاجر', 'مهندس', 'طبيب', 'معلم'][array_rand([0, 1, 2, 3, 4])],
                'phone' => '05' . rand(10000000, 99999999),
                'family_id' => $family->id,
                'is_family_head' => true,
            ]);

            $mother = \App\Models\Person::create([
                'name_ar' => 'أم ' . $i . ' ' . $assoc->name_ar,
                'national_id' => '2' . str_pad($assoc->id, 3, '0', STR_PAD_LEFT) . str_pad($i, 7, '0', STR_PAD_LEFT),
                'birth_date' => now()->subYears(rand(25, 55)),
                'gender' => 'أنثى',
                'marital_status' => 'متزوج',
                'occupation' => 'ربة منزل',
                'family_id' => $family->id,
                'father_id' => $father->id,
                'is_family_head' => false,
            ]);

            $family->update(['father_id' => $father->id]);

            for ($j = 1; $j <= rand(1, 5); $j++) {
                $gender = rand(0, 1) ? 'ذكر' : 'أنثى';
                \App\Models\Person::create([
                    'name_ar' => ($gender === 'ذكر' ? 'ابن' : 'ابنة') . ' ' . $j . ' ' . $assoc->name_ar,
                    'national_id' => ($gender === 'ذكر' ? '1' : '2') . str_pad($assoc->id, 3, '0', STR_PAD_LEFT) . str_pad($i, 3, '0', STR_PAD_LEFT) . str_pad($j, 4, '0', STR_PAD_LEFT),
                    'birth_date' => now()->subYears(rand(1, 20)),
                    'gender' => $gender,
                    'marital_status' => 'أعزب',
                    'occupation' => 'طالب',
                    'family_id' => $family->id,
                    'father_id' => $father->id,
                    'mother_id' => $mother->id,
                    'is_family_head' => false,
                ]);
            }
        }
    }
}

}