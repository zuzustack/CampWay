<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contact;
use App\Models\ContactType;
use App\Models\Project;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Siswa::create(
            [
                'name' => 'Ridwan Saputra',
                'about' => 'Ridwan Saputra adalah orang',
                'photo' => 'ridwan.jpg',
                'email' => 'ridwan@gmail.com',
            ],
        );

        Siswa::create(
            [
                'name' => 'Nopal Akbar',
                'about' => 'Nopal Akbar adalah orang',
                'photo' => 'Nopal.jpg',
                'email' => 'Nopal@gmail.com',
            ],
        );

        Siswa::create(        
            [
                'name' => 'Vito Ramadhan',
                'about' => 'Vito Ramadhan adalah orang',
                'photo' => 'Vito.jpg',
                'email' => 'Vito@gmail.com',
            ],
        );
        
        Siswa::create(
            [
                'name' => 'Rapli Khiyanuran',
                'about' => 'Rapli Khiyanuran adalah orang',
                'photo' => 'Rapli.jpg',
                'email' => 'Rapli@gmail.com',
            ],
        );

        Siswa::create(
            [
                'name' => 'Ahmes Abhipraya',
                'about' => 'Ahmes Abhipraya adalah orang',
                'photo' => 'Ahmes.jpg',
                'email' => 'Ahmes@gmail.com',
            ],
        );


        Project::create(
            [
                'siswa_id' => 1,
                'project_name' => 'Aplikasi Kurir',
                'photo' => 'app.jpg',
                'project_date' => '2023-08-23'
            ],
        );
        Project::create(
            [
                'siswa_id' => 2,
                'project_name' => 'Aplikasi Kasir',
                'photo' => 'app.jpg',
                'project_date' => '2023-08-23'
            ],
        );

        Project::create(
            [
                'siswa_id' => 3,
                'project_name' => 'Aplikasi Perpus',
                'photo' => 'app.jpg',
                'project_date' => '2023-08-23'
            ],
        );

        Project::create(
            [
                'siswa_id' => 4,
                'project_name' => 'Aplikasi Online Shop',
                'photo' => 'app.jpg',
                'project_date' => '2023-08-23'
            ],
        );

        Project::create(
            [
                'siswa_id' => 5,
                'project_name' => 'Aplikasi Mantap',
                'photo' => 'app.jpg',
                'project_date' => '2023-08-23'
            ],
        );


        ContactType::create(
            [
                'type_name' => 'Telegram'
            ], 
        );
        
        ContactType::create(
            [
                'type_name' => 'WhatsApp'
            ]
        );


        Contact::create(
            [
                'name' => '0812345678',
                'contact_type_id' => 1,
                'siswa_id' => 1
            ], 
        );
        Contact::create(
            [
                'name' => '0812345678',
                'contact_type_id' => 2,
                'siswa_id' => 2
            ],
        );
        Contact::create(
            [
                'name' => '0812345678',
                'contact_type_id' => 2,
                'siswa_id' => 3
            ],
        );
        Contact::create(
            [
                'name' => '0812345678',
                'contact_type_id' => 2,
                'siswa_id' => 4
            ],
        );
        Contact::create(
            [
                'name' => '0812345678',
                'contact_type_id' => 1,
                'siswa_id' => 5
            ],
        );
    }
}
