<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\OrderProduct;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create();
        Stock::factory(16)->create();
        $testUser = new User();
        $testUser->name = "test";
        $testUser->email = "test@test";
        $testUser->password = Hash::make("test");
        $testUser->phoneNumber = "11";
        $testUser->isAdmin = true;
        $testUser->save();

        $arr = ["roast", "steaks", "beef_sausages", "minced_beef", "potatoes", "beef_salami","one","two","three","four","five","six","seven","eight","nine","ten"];
        $productDescrip = ["The famous organic roast - you must taste this!", "Best steaks in Europe! Voted by local population!", "The greatest organic meat, made into sausages!", "Fresh, quality ground beef from a local farm, grass fed!", "Organic potatoes, grown right here on the farm!", "Salami, but made from a cow. Both healthier and tastier!", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10"];

        for ($i = 0; $i < count($arr); $i++) {
            $ent = new Picture();
            $ent->fileName = $arr[$i];
            $ent->fileExtension = ".png";
            $ent->save();
        }
        for ($j = 0; $j < count($arr); $j++) {
            $en = new Product();
            $en->name = $arr[$j];
            $en->unit_price = 25;
            $en->dateAdded = date('Y-m-d H:i:s');
            $en->picture_id = $j + 1;
            $en->stock_id = $j + 1;
            $en->description = $productDescrip[$j];
            $en->save();
        }

        // Makes huge stock
        $stocks = Stock::all();

        foreach ($stocks as $stock) {
            $stock->quantity = 5000;
            $stock->save();
        }





        // Test - Create an order
        $order = Order::create([
            'date' => now(),
            'user_id' => 1,
        ]);

        // Attach products to the order
        $products = Product::inRandomOrder()->limit(4)->get();
        foreach ($products as $product) {
            Order_product::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => rand(1, 5),
            ]);
        }


    }
}
