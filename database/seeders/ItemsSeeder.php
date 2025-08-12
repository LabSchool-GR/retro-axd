<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeds one demo item (Commodore 64) consistent with your dump,
 * including an attribute and an image.
 */
class ItemsSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Resolve foreign keys
        $adminId    = DB::table('users')->where('email','demo@retro-axd.gr')->value('id');
        $categoryId = DB::table('categories')->where('slug','computers')->value('id');

        if (!$adminId || !$categoryId) {
            // If prerequisites are missing, don't seed items
            return;
        }

        // Insert or fetch item
        DB::table('items')->updateOrInsert(
            ['slug' => 'commodore-64'],
            [
                'category_id'   => $categoryId,
                'user_id'       => $adminId,
                'title'         => 'Commodore 64',
                'company'       => 'Commodore',
                'serial_number' => '-',
                'link'          => null,
                'description'   => 'Ο Commodore 64 (ή απλώς C64) κυκλοφόρησε το 1982 από την Commodore International και καθιερώθηκε ως ο πιο επιτυχημένος οικιακός υπολογιστής όλων των εποχών...',
                'image'         => null,
                'year'          => 1982,
                'location'      => 'Χώρος Συλλόγου',
                'status'        => 'Λειτουργεί κανονικά δίχως τεχνικό πρόβλημα',
                'created_at'    => $now,
                'updated_at'    => $now,
            ]
        );

        $itemId = DB::table('items')->where('slug','commodore-64')->value('id');

        if ($itemId) {
            // Attribute
            DB::table('item_attributes')->updateOrInsert(
                ['id' => 1], // id explicit only to avoid duplicates on repeated seeds; remove if you prefer auto
                [
                    'item_id'        => $itemId,
                    'attribute_name' => 'Συνοδευτικό Υλικό',
                    'attribute_value'=> 'Καλώδιο ρεύματος και βιβλίο οδηγιών',
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ]
            );

            // Image (path is just a string; file may not exist in storage)
            DB::table('item_images')->updateOrInsert(
                ['id' => 1],
                [
                    'item_id'    => $itemId,
                    'image_path' => 'item-images/commodore-64.jpg',
                    'caption'    => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
