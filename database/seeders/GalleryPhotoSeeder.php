<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GalleryPhotoSeeder extends Seeder
{
    /**
     * Run database seeds for real temple gallery photos.
     */
    public function run(): void
    {
        GalleryItem::truncate();

        $items = [
            // 1. Divine Shringar Darshan (darshan)
            [
                'title_gu' => 'શ્રી ગાત્રાળ માતાજી દિવ્ય સુવર્ણ શૃંગાર દર્શન',
                'title_en' => 'Shree Gatrad Maa Divine Golden Shringar Darshan',
                'category' => 'darshan',
                'image_url' => '/uploads/gallery/shringar/shringar_maa_gatrad_gold.jpeg',
                'is_featured' => true,
            ],
            [
                'title_gu' => 'શ્રી ગાત્રાળ માં મનોહર મુખારવિંદ દર્શન',
                'title_en' => 'Shree Gatrad Maa Divine Mukharvind Darshan',
                'category' => 'darshan',
                'image_url' => '/uploads/gallery/shringar/shringar_maa_gatrad_mukharvind.jpeg',
                'is_featured' => true,
            ],
            [
                'title_gu' => 'શ્રી ગાત્રાળ ધામ નિજ મંદિર મહાઆરતી દર્શન',
                'title_en' => 'Shree Gatrad Dham Nij Mandir Maha Aarti Darshan',
                'category' => 'darshan',
                'image_url' => '/uploads/gallery/shringar/shringar_maa_gatrad_nij_mandir.jpeg',
                'is_featured' => true,
            ],
            [
                'title_gu' => 'પવિત્ર તલવાર પૂજન & લાલ વાઘા શૃંગાર દર્શન',
                'title_en' => 'Sacred Talwar Pujan & Red Vastra Shringar Darshan',
                'category' => 'darshan',
                'image_url' => '/uploads/gallery/shringar/shringar_red_vastra_talwar.jpg',
                'is_featured' => true,
            ],
            [
                'title_gu' => 'પુષ્પ શૃંગાર & સુવર્ણ મુગટ દિવ્ય દર્શન',
                'title_en' => 'Floral Decoration & Golden Mukut Darshan',
                'category' => 'darshan',
                'image_url' => '/uploads/gallery/shringar/shringar_puspa_mukut.jpg',
                'is_featured' => false,
            ],
            [
                'title_gu' => 'લીલા વાઘા શૃંગાર & ત્રિશૂળ દર્શન',
                'title_en' => 'Green Bandhani Vastra & Trishul Darshan',
                'category' => 'darshan',
                'image_url' => '/uploads/gallery/shringar/shringar_green_vastra.jpg',
                'is_featured' => false,
            ],

            // 2. Festival / Utsav Darshan (utsav)
            [
                'title_gu' => 'શ્રી ગાત્રાળ ધામ દેવગામ - પૂનમ મહાઉત્સવ & હવન યાદી',
                'title_en' => 'Shree Gatrad Dham Devgam - Poonam Mahotsav & Calendar',
                'category' => 'utsav',
                'image_url' => '/uploads/gallery/festival/utsav_poonam_darshan_calendar.jpeg',
                'is_featured' => true,
            ],
            [
                'title_gu' => 'નવરાત્રિ & દીપોત્સવ રાત્રિ રોશની દર્શન',
                'title_en' => 'Navratri & Deepotsav Festival Night Illumination',
                'category' => 'utsav',
                'image_url' => '/uploads/gallery/festival/utsav_mandir_night_lighting.jpg',
                'is_featured' => true,
            ],
            [
                'title_gu' => 'પાવન ધર્મધ્વજા & મંદિર શિખર દર્શન',
                'title_en' => 'Sacred Dhwaja & Temple Spire Darshan',
                'category' => 'utsav',
                'image_url' => '/uploads/gallery/festival/utsav_mandir_shikhar_dhwaja.jpg',
                'is_featured' => false,
            ],
            [
                'title_gu' => 'શ્રી ગાત્રાળ ધામ મુખ્ય પ્રવેશદ્વાર',
                'title_en' => 'Shree Gatrad Dham Main Temple Entrance',
                'category' => 'utsav',
                'image_url' => '/uploads/gallery/festival/utsav_mandir_praveshdwar.jpg',
                'is_featured' => false,
            ],

            // 3. Mandir Complex / Campus (mandir)
            [
                'title_gu' => 'પુષ્પમાળાઓથી સુશોભિત સભામંડપ & પરિસર',
                'title_en' => 'Temple Campus & Flower Decorated Sabha Mandap',
                'category' => 'mandir',
                'image_url' => '/uploads/gallery/templeCampus/mandir_campus_floral_mandap.jpg',
                'is_featured' => true,
            ],
            [
                'title_gu' => 'શ્રી ગાત્રાળ ધામ પવિત્ર મંદિર પરિસર',
                'title_en' => 'Sacred Shree Gatrad Dham Temple Complex',
                'category' => 'mandir',
                'image_url' => '/uploads/gallery/templeCampus/mandir_campus_pillars_view.jpg',
                'is_featured' => false,
            ],
        ];

        foreach ($items as $item) {
            GalleryItem::create($item);
        }
    }
}
