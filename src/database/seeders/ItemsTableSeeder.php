<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $param = [
            'name' => '腕時計',
            'brand_name' => 'Rolax',
            'price' => 15000 ,
            'image' => 'Armani+Mens+Clock.jpg',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition_id' => '1',
            'user_id' => '1',
         ];
         DB::table('items')->insert($param);   
         $param = [
            'name' => 'HDD',
            'brand_name' => '西芝',
            'price' => 5000 ,
            'image' => 'HDD+Hard+Disk.jpg',
            'description' => '高速で信頼性の高いハードディスク',
            'condition_id' => '2',
            'user_id' => '2',
         ];
         DB::table('items')->insert($param);   
         $param = [
            'name' => '玉ねぎ3束',
            'brand_name' => 'なし',
            'price' => 300 ,
            'image' => 'iLoveIMG+d.jpg',
            'description' => '新鮮な玉ねぎの3束セット',
            'condition_id' => '3',
            'user_id' => '3',
         ];
         DB::table('items')->insert($param);   
         $param = [
            'name' => '革靴',
            'brand_name' => '',
            'price' => 4000 ,
            'image' => 'Leather+Shoes+Product+Photo.jpg',
            'description' => 'クラシックなデザインの革靴',
            'condition_id' => '4',
            'user_id' => '4',
         ];
         DB::table('items')->insert($param);   
          $param = [
            'name' => 'ノートPC',
            'brand_name' => '',
            'price' => 45000 ,
            'image' => 'Living+Room+Laptop.jpg',
            'description' => '高性能なノートパソコン',
            'condition_id' => '1',
            'user_id' => '5',
         ];
         DB::table('items')->insert($param);   
          $param = [
            'name' => 'マイク',
            'brand_name' => 'なし',
            'price' => 8000 ,
            'image' => 'Music+Mic+4632231.jpg',
            'description' => '高音質のレコーディング用マイク',
            'condition_id' => '2',
            'user_id' => '1',
         ];
         DB::table('items')->insert($param);   
          $param = [
            'name' => 'ショルダーバッグ',
            'brand_name' => 'なし',
            'price' => 3500 ,
            'image' => 'Purse+fashion+pocket.jpg',
            'description' => 'おしゃれなショルダーバッグ',
            'condition_id' => '3',
            'user_id' => '2',
         ];
         DB::table('items')->insert($param);   
          $param = [
            'name' => 'タンブラー',
            'brand_name' => 'なし',
            'price' => 500 ,
            'image' => 'Tumbler+souvenir.jpg',
            'description' => '使いやすいタンブラー',
            'condition_id' => '4',
            'user_id' => '3',
         ];
         DB::table('items')->insert($param);   
          $param = [
            'name' => 'コーヒーミル',
            'brand_name' => 'Starbacks',
            'price' => 4000 ,
            'image' => 'Waitress+with+Coffee+Grinder.jpg',
            'description' => '手動のコーヒーミル',
            'condition_id' => '1',
            'user_id' => '4',
         ];
         DB::table('items')->insert($param);   
          $param = [
            'name' => 'メイクセット',
            'brand_name' => 'なし',
            'price' => 2500 ,
            'image' => '外出メイクアップセット.jpg',
            'description' => '便利なメイクアップセット',
            'condition_id' => '2',
            'user_id' => '5',
         ];
         DB::table('items')->insert($param);   
    }
}
