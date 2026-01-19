<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '0812345678',
            'address' => 'Bangkok, Thailand',
        ]);

        // Create manager user
        User::create([
            'name' => 'Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'phone' => '0823456789',
            'address' => 'Bangkok, Thailand',
        ]);

        // Create test customer
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '0899999999',
            'address' => '123 Test Street, Bangkok 10100',
        ]);

        // Create categories
        $categories = [
            ['name' => 'อิเล็กทรอนิกส์', 'slug' => 'electronics'],
            ['name' => 'แฟชั่น', 'slug' => 'fashion'],
            ['name' => 'บ้านและสวน', 'slug' => 'home-garden'],
            ['name' => 'กีฬาและกิจกรรมกลางแจ้ง', 'slug' => 'sports-outdoors'],
            ['name' => 'เครื่องใช้ไฟฟ้า', 'slug' => 'appliances'],
            ['name' => 'งานอดิเรก', 'slug' => 'hobbies'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'is_active' => true,
            ]);
        }

        // Create sample products
        $products = [
            ['category' => 'electronics', 'name' => 'หูฟังไร้สาย Bluetooth', 'price' => 990, 'stock' => 50, 'description' => 'หูฟังคุณภาพเสียงดีเยี่ยม พร้อมระบบตัดเสียงรบกวน'],
            ['category' => 'electronics', 'name' => 'สมาร์ทวอทช์', 'price' => 2990, 'stock' => 30, 'description' => 'นาฬิกาอัจฉริยะ ติดตามสุขภาพ วัดชีพจร'],
            ['category' => 'electronics', 'name' => 'ลำโพงบลูทูธพกพา', 'price' => 1490, 'stock' => 40, 'description' => 'ลำโพงเสียงดี กันน้ำ พกพาง่าย'],
            ['category' => 'electronics', 'name' => 'เมาส์ไร้สาย', 'price' => 390, 'stock' => 100, 'description' => 'เมาส์เงียบ สำหรับงานออฟฟิศ'],

            ['category' => 'fashion', 'name' => 'เสื้อยืดผ้าคอตตอน', 'price' => 299, 'stock' => 80, 'description' => 'เสื้อยืดคุณภาพดี ผ้านุ่ม สวมใส่สบาย'],
            ['category' => 'fashion', 'name' => 'กระเป๋าสะพาย', 'price' => 890, 'stock' => 25, 'description' => 'กระเป๋าหนังPU ดีไซน์สวย จุของได้เยอะ'],
            ['category' => 'fashion', 'name' => 'รองเท้าผ้าใบ', 'price' => 1290, 'stock' => 35, 'description' => 'รองเท้าสบาย ใส่ได้ทุกโอกาส'],

            ['category' => 'home-garden', 'name' => 'หมอนหนุน Memory Foam', 'price' => 590, 'stock' => 45, 'description' => 'หมอนนุ่ม รองรับศีรษะดี นอนสบาย'],
            ['category' => 'home-garden', 'name' => 'ผ้าม่านกันแสง UV', 'price' => 890, 'stock' => 20, 'description' => 'ผ้าม่านกันแดด กันUV ติดตั้งง่าย'],
            ['category' => 'home-garden', 'name' => 'ชุดกระถางต้นไม้', 'price' => 450, 'stock' => 60, 'description' => 'กระถางสวย พร้อมจานรอง 3 ใบ'],

            ['category' => 'sports-outdoors', 'name' => 'เสื่อโยคะ', 'price' => 390, 'stock' => 50, 'description' => 'เสื่อหนา 10mm กันลื่น พร้อมกระเป๋า'],
            ['category' => 'sports-outdoors', 'name' => 'ดัมเบล 5 กก.', 'price' => 699, 'stock' => 40, 'description' => 'ดัมเบลเคลือบยาง จับถนัดมือ'],
            ['category' => 'sports-outdoors', 'name' => 'ลูกบาสเกตบอล', 'price' => 590, 'stock' => 30, 'description' => 'ลูกบาสเกตบอลยางคุณภาพดี'],

            ['category' => 'appliances', 'name' => 'กระติกน้ำสูญญากาศ', 'price' => 590, 'stock' => 55, 'description' => 'เก็บความเย็น 24 ชม. เก็บความร้อน 12 ชม.'],
            ['category' => 'appliances', 'name' => 'หม้อ Air Fryer', 'price' => 2990, 'stock' => 15, 'description' => 'หม้อทอดไร้น้ำมัน ทำอาหารได้หลากหลาย'],
            ['category' => 'appliances', 'name' => 'เครื่องชงกาแฟ', 'price' => 1990, 'stock' => 20, 'description' => 'เครื่องชงกาแฟอัตโนมัติ ใช้งานง่าย'],

            ['category' => 'hobbies', 'name' => 'ชุดสีไม้ 24 สี', 'price' => 290, 'stock' => 70, 'description' => 'สีไม้คุณภาพดี ติดทนนาน'],
            ['category' => 'hobbies', 'name' => 'จิ๊กซอว์ 1000 ชิ้น', 'price' => 490, 'stock' => 35, 'description' => 'จิ๊กซอว์ภาพสวย ฝึกสมาธิ'],
            ['category' => 'hobbies', 'name' => 'กีตาร์โปร่ง', 'price' => 3990, 'stock' => 10, 'description' => 'กีตาร์เสียงดี เหมาะสำหรับมือใหม่'],
            ['category' => 'hobbies', 'name' => 'กล้องถ่ายรูปโพลารอยด์', 'price' => 2490, 'stock' => 15, 'description' => 'กล้องถ่ายพร้อมปริ้นท์ทันที สนุกและเก๋'],
        ];

        foreach ($products as $prod) {
            $category = Category::where('slug', $prod['category'])->first();

            Product::create([
                'category_id' => $category->id,
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name']),
                'description' => $prod['description'],
                'price' => $prod['price'],
                'stock' => $prod['stock'],
                'is_active' => true,
            ]);
        }
    }
}
