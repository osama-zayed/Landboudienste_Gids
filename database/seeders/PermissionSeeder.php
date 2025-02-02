<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'منح موافقة اوليه لاقامة منشاة أنتاج بذور(تقاوي) اكثار بالانسجة / مخصبات زراعيه']);
        Permission::create(['name' => 'منح ترخيص انتاج (اكثار)بذور وتقاوي']);
        Permission::create(['name' => 'منح ترخيص انتاج مخصبات زراعيه']);
        Permission::create(['name' => 'منح ترخيص تداول بذور وتقاوي ومخصبات زراعيه']);
        Permission::create(['name' => 'منح موافقة انشاء معمل اكثار نباتات بالانسجة']);
        Permission::create(['name' => 'منح ترخيص انتاج نباتات بالانسجة']);
        Permission::create(['name' => 'تسجيل المخصبات الزراعية']);
        Permission::create(['name' => 'تسجيل أصناف البذور والتقاوي المستوردة في السجل الوطني']);
        Permission::create(['name' => 'تسجيل أصناف البذور والتقاوي المنتجة محليا']);
        $role = Role::create(['name' => 'إدارة التسجيلات']);
        $role->givePermissionTo(
            [
                'منح موافقة اوليه لاقامة منشاة أنتاج بذور(تقاوي) اكثار بالانسجة / مخصبات زراعيه',
                'منح ترخيص انتاج (اكثار)بذور وتقاوي',
                'منح ترخيص انتاج مخصبات زراعيه',
                'منح ترخيص تداول بذور وتقاوي ومخصبات زراعيه',
                'منح موافقة انشاء معمل اكثار نباتات بالانسجة',
                'منح ترخيص انتاج نباتات بالانسجة',
                'تسجيل المخصبات الزراعية',
                'تسجيل أصناف البذور والتقاوي المستوردة في السجل الوطني',
                'تسجيل أصناف البذور والتقاوي المنتجة محليا',

            ]
        );


        Permission::create(['name' => 'منح موافقة استيراد فسائل نخيل وغراس (شتلات).']);
        Permission::create(['name' => 'منح موافقة استيراد بذور وتقاوي (أصناف متداوله + عينات )']);
        Permission::create(['name' => 'منح موافقة استيراد مخصبات زراعية (اسمدة ومحسنات تربة)']);
        $role = Role::create(['name' => 'إدارة المستلزمات']);
        $role->givePermissionTo(
            [
                'منح موافقة استيراد فسائل نخيل وغراس (شتلات).',
                'منح موافقة استيراد بذور وتقاوي (أصناف متداوله + عينات )',
                'منح موافقة استيراد مخصبات زراعية (اسمدة ومحسنات تربة)'
            ]
        );

        Permission::create(['name' => 'فحص وتحليل عينات المخصبات الزراعية']);
        Permission::create(['name' => 'فحص عينات البذور والتقاوي والغراس (الشتلات)']);
        $role = Role::create(['name' => 'إدارة المختبرات']);
        $role->givePermissionTo(
            [
                'فحص وتحليل عينات المخصبات الزراعية',
                'فحص عينات البذور والتقاوي والغراس (الشتلات)'
            ]
        );

        Permission::create(['name' => 'منح موافقة الافراج عن المخصبات الزراعية']);
        Permission::create(['name' => 'منح موافقة نقل مخصبات زراعية من المنافذ الى مخازن المستفيد']);
        Permission::create(['name' => 'منح موافقة نقل وتوزيع مخصبات زراعية']);
        Permission::create(['name' => 'منح موافقة الافراج عن البذور/التقاوي/الغراس(الشتلات)']);
        Permission::create(['name' => 'التفتيش على محلات تداول البذور والتقاوي والمخصبات الزراعية']);
        Permission::create(['name' => 'التفتيش على منشات انتاج البذور والتقاوي والمخصبات الزراعية']);
        Permission::create(['name' => 'التفتيش الحقلي على حقول انتاج البذوروالتقاوي']);
        Permission::create(['name' => 'الموافقة على اصدار بطائق اعتماد البذور']);
        Permission::create(['name' => 'اتلاف البذور والتقاوي الغير صالحة']);
        Permission::create(['name' => 'اخذ عينات بذور وتقاوي ومخصبات زراعية من المنافذ']);
        Permission::create(['name' => 'اصدار بدل فاقد (موافقة استيراد/افراج عن شحنة/موافقات نقل وتوزيع)/ شهادة تسجيل بذور او مخصبات زراعية']);
        Permission::create(['name' => 'تثبيت البيانات الناقصة على عبوات البذور/المخصبات الزراعية']);

        $role = Role::create(['name' => 'إدارة الرقابة الفنية']);
        $role->givePermissionTo(
            [
                'منح موافقة الافراج عن المخصبات الزراعية',
                'منح موافقة نقل مخصبات زراعية من المنافذ الى مخازن المستفيد',
                'منح موافقة نقل وتوزيع مخصبات زراعية',
                'منح موافقة الافراج عن البذور/التقاوي/الغراس(الشتلات)',
                'التفتيش على محلات تداول البذور والتقاوي والمخصبات الزراعية',
                'التفتيش على منشات انتاج البذور والتقاوي والمخصبات الزراعية',
                'التفتيش الحقلي على حقول انتاج البذوروالتقاوي',
                'الموافقة على اصدار بطائق اعتماد البذور',
                'اتلاف البذور والتقاوي الغير صالحة',
                'اخذ عينات بذور وتقاوي ومخصبات زراعية من المنافذ',
                'اصدار بدل فاقد (موافقة استيراد/افراج عن شحنة/موافقات نقل وتوزيع)/ شهادة تسجيل بذور او مخصبات زراعية',
                'تثبيت البيانات الناقصة على عبوات البذور/المخصبات الزراعية'
            ]
        );
        // Permission::create(['name' => '']);
        // $user = Role::create(['name' => 'مستخدم']);

        // $user->givePermissionTo('فتح مؤاسسة');
        // $user->givePermissionTo('ترخيص');
    }
}
