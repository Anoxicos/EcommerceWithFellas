<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Administrateur',
            'email'    => 'admin@shop.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Customer demo
        User::create([
            'name'     => 'Client Demo',
            'email'    => 'client@shop.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
        ]);

        // Categories
        $elec     = Category::create(['name' => 'Électronique',  'description' => 'Téléphones, PC, accessoires']);
        $mode     = Category::create(['name' => 'Vêtements',     'description' => 'Mode homme et femme']);
        $maison   = Category::create(['name' => 'Maison',        'description' => 'Décoration et mobilier']);
        $sport    = Category::create(['name' => 'Sport',         'description' => 'Équipements sportifs']);

        // Products
        Product::create(['name' => 'Smartphone Pro X',  'description' => '5G, 128GB, AMOLED',      'price' => 799.99, 'stock' => 50,  'category_id' => $elec->id]);
        Product::create(['name' => 'Laptop UltraSlim',  'description' => 'Intel i7, 16GB RAM',     'price' => 1299.0, 'stock' => 20,  'category_id' => $elec->id]);
        Product::create(['name' => 'T-shirt Premium',   'description' => 'Coton bio, unisexe',     'price' => 29.99,  'stock' => 200, 'category_id' => $mode->id]);
        Product::create(['name' => 'Jean Slim Fit',     'description' => 'Coupe moderne, stretch', 'price' => 59.99,  'stock' => 80,  'category_id' => $mode->id]);
        Product::create(['name' => 'Lampe Design LED',  'description' => 'Lumière chaleureuse',    'price' => 45.00,  'stock' => 35,  'category_id' => $maison->id]);
        Product::create(['name' => 'Vélo de Route 21V', 'description' => 'Cadre aluminium léger',  'price' => 349.00, 'stock' => 15,  'category_id' => $sport->id]);
    }
}