<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/** Seeds the 4 categories from your dump, id values are auto. */
class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $rows = [
            ['name' => 'Υπολογιστές',         'description' => 'Υπολογιστές που διαθέτουν τα μέλη και οι φίλοι του συλλόγου.', 'slug' => 'computers', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Δισκέτες',             'description' => 'Δισκέτες από λογισμικό',                                         'slug' => 'disks',     'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Κονσόλες Παιχνιδιών',  'description' => 'Κονσόλες Παιχνιδιών που διαθέτουν οι φίλοι και τα μέλη του συλλόγου', 'slug' => 'consoles',  'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cartridge',            'description' => 'Cartridge Παιχνιδιών και προγραμμάτων για κονσόλες και υπολογιστές',  'slug' => 'cartridge', 'created_at' => $now, 'updated_at' => $now],
        ];

        // Upsert on unique slug to avoid duplicates
        foreach ($rows as $row) {
            DB::table('categories')->updateOrInsert(['slug' => $row['slug']], $row);
        }
    }
}
