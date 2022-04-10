<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'id' => '0e2e5405-4d65-4ad8-a1de-5659fcaa259f',
                'type' => 'App\\Notifications\\UserNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 51,
                'data' => '{"status":"new","image":"sulinggih","title":"PERMOHONAN RESERVASI DIBUAT","body":"Permohonan reservasi kepada Ida Pandita Sri Agnijaya Mukhi telah berhasil dilakukan, dimohon untuk menunggku konfirmasi dari pihak pemuput karya"}',
                'read_at' => NULL,
                'created_at' => '2022-03-24 21:48:08',
                'updated_at' => '2022-03-24 21:48:08',
            ),
            1 => 
            array (
                'id' => '1d84a978-98d9-47d3-b056-78ed87aa651d',
                'type' => 'App\\Notifications\\UserNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"status":"new","image":"krama","title":"RESERVASI BARU","body":"Terdapat krama yang mengajukan pemuputan karya, reservasi dapat dilihat pada menu Reservasi Masuk"}',
                'read_at' => NULL,
                'created_at' => '2022-03-24 21:46:47',
                'updated_at' => '2022-03-24 21:46:47',
            ),
            2 => 
            array (
                'id' => '4cf59c88-e189-4458-ab21-77f16aef4ff9',
                'type' => 'App\\Notifications\\UserNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 51,
                'data' => '{"status":"new","image":"sulinggih","title":"PERMOHONAN RESERVASI DIBUAT","body":"Permohonan reservasi kepada Ida Pedande watu telah berhasil dilakukan, dimohon untuk menunggku konfirmasi dari pihak pemuput karya"}',
                'read_at' => NULL,
                'created_at' => '2022-03-25 15:16:34',
                'updated_at' => '2022-03-25 15:16:34',
            ),
            3 => 
            array (
                'id' => '5a3fff0a-40a8-4a10-b854-911c719affe3',
                'type' => 'App\\Notifications\\UserNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 49,
                'data' => '{"status":"new","image":"krama","title":"RESERVASI BARU","body":"Terdapat krama yang mengajukan pemuputan karya, reservasi dapat dilihat pada menu Reservasi Masuk"}',
                'read_at' => NULL,
                'created_at' => '2022-03-25 15:16:34',
                'updated_at' => '2022-03-25 15:16:34',
            ),
            4 => 
            array (
                'id' => '731a2d46-674f-4de0-be54-4a16e52949ff',
                'type' => 'App\\Notifications\\UserNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 2,
                'data' => '{"status":"new","image":"krama","title":"RESERVASI BARU","body":"Terdapat krama yang mengajukan pemuputan karya, reservasi dapat dilihat pada menu Reservasi Masuk"}',
                'read_at' => NULL,
                'created_at' => '2022-03-24 21:48:07',
                'updated_at' => '2022-03-24 21:48:07',
            ),
            5 => 
            array (
                'id' => 'dfdb3eb4-b3fa-4f31-b455-c1a01e7b5b8e',
                'type' => 'App\\Notifications\\UserNotification',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 51,
                'data' => '{"status":"new","image":"sulinggih","title":"PERMOHONAN RESERVASI DIBUAT","body":"Permohonan reservasi kepada Ida Pedande Istri Rai Kemenuh telah berhasil dilakukan, dimohon untuk menunggku konfirmasi dari pihak pemuput karya"}',
                'read_at' => NULL,
                'created_at' => '2022-03-24 21:46:48',
                'updated_at' => '2022-03-24 21:46:48',
            ),
        ));
        
        
    }
}