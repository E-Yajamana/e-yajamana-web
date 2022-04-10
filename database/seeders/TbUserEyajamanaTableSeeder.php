<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbUserEyajamanaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tb_user_eyajamana')->delete();

        \DB::table('tb_user_eyajamana')->insert(array (
            0 =>
            array (
                'id' => 1,
                'id_penduduk' => 1,
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$aDN8y/nNpe9DHte0VIVu/ensr4.Aw91vLA4z1XqlnEnZSW/AeeOEm',
                'nomor_telepon' => '087851423695',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => 'fKzWVR4jQ52G0OwSrzr1BG:APA91bH2n1slLFwm4iMTgX5h0hhDqN8Lm3-xeDKmpc7JbwDraOPpSK5jydG9qesoJ0qZU2pu-z4rqn5YFEPdzCVICWH2kvatdlkKjH73AGzkn0cJ1g7Rnx7HEJgxDtOSdZs1R4Rsj4K3',
                'fcm_token_web' => 'dowZKG_3FfusXx4R0Ii75F:APA91bFctgQof0U1A0a7mSwXsz4mnqdaOu14LcSx1UAG-QEsjCYE9OgHtlRdXHRRfFCet8pnOVf7igA-SC_n81cMG7QFv6AQt9vKTFFyxh9CwlpiH0zeKMbYLWctBBgi0j9RUgECRhNW',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-01-18 14:53:02',
                'updated_at' => '2022-03-18 18:35:09',
            ),
            1 =>
            array (
                'id' => 2,
                'id_penduduk' => 3,
                'email' => 'sulinggih@gmail.com',
                'password' => '$2y$10$xkljavxyQ9xirivMWUw9hulUB5Dx2mX43o0UxnoPDVT1hKX7FoKya',
                'nomor_telepon' => '087221423695',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => 'fL8WEYFpQMql6Px72qhaCV:APA91bEH90BxQ62ze9b2-J0bt4vtPaMDjpjSl0hVnK8s8x23jXxj3nJ4TnovSMBFYHc4crYTdegtczU4VVNF9UvDgxaLL8-Xv7B52wsTDqnA1-CJ1g0wuslNa85KZPjcT_s58S4NTBg_',
                'fcm_token_web' => 'dowZKG_3FfusXx4R0Ii75F:APA91bFctgQof0U1A0a7mSwXsz4mnqdaOu14LcSx1UAG-QEsjCYE9OgHtlRdXHRRfFCet8pnOVf7igA-SC_n81cMG7QFv6AQt9vKTFFyxh9CwlpiH0zeKMbYLWctBBgi0j9RUgECRhNW',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-01-18 14:53:54',
                'updated_at' => '2022-03-18 00:25:33',
            ),
            2 =>
            array (
                'id' => 3,
                'id_penduduk' => 23,
                'email' => 'pemangku@gmail.com',
                'password' => '$2y$10$c90Bb7MqA9AKD3fMhIywt.r7dVbzG0LT3qdGV4Z8FmfJmUwRu0/ZK',
                'nomor_telepon' => '081241241258',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-01-18 14:54:47',
                'updated_at' => '2022-01-18 14:54:49',
            ),
            3 =>
            array (
                'id' => 4,
                'id_penduduk' => 2,
                'email' => 'sanggar@gmail.com',
                'password' => '$2y$10$4LCJHT3xSLboXP4jsrlSc.nu0iaZOVmpadfmrxZFJAOCqaJuG8q7.',
                'nomor_telepon' => '082412859582',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-01-18 14:55:37',
                'updated_at' => '2022-01-18 14:55:39',
            ),
            4 =>
            array (
                'id' => 6,
                'id_penduduk' => 45,
                'email' => 'alingotama14@gmail.com',
                'password' => '$2y$10$6IWqs974AF55uW/UeqVqZ.CWYihCHtk.gDc6lSu/RTFKg8TS1mxHK',
                'nomor_telepon' => '081924124989',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => 'fLhzUOY9RMqENxEqlmRWQ9:APA91bFW6mxM7AJnvNraCzZ-tFiFQNObPr97OaloVZp1RlZScRoYT04H8xIoTkC5DePfHP8pQ3JC4ACO_uiNGeHdlWN3yU4igOtYy4UtorXvMHgasOk_5aXWVzx1SbkRD_vYH42B8pOe',
                'fcm_token_web' => NULL,
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-01-18 14:57:25',
                'updated_at' => '2022-03-15 14:04:35',
            ),
            5 =>
            array (
                'id' => 16,
                'id_penduduk' => 15,
                'email' => 'alingotama1412@gmail.com',
                'password' => '$2y$10$jTTMAW67uCVmb1WlKmq2l.XT7C7vRWOHtQzuCqavvzliWyksjtviK',
                'nomor_telepon' => '081838',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-03-07 09:00:45',
                'updated_at' => '2022-03-07 09:00:45',
            ),
            6 =>
            array (
                'id' => 22,
                'id_penduduk' => 15,
                'email' => 'rismawan1234@gmail.com',
                'password' => '$2y$10$F8bkfLK3/PHBKD4Mxfs6I.G1zJXdPpupUh8OgWJTAu0OzmVePIWA6',
                'nomor_telepon' => '12312312313213',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-03-07 10:03:11',
                'updated_at' => '2022-03-07 10:03:11',
            ),
            7 =>
            array (
                'id' => 49,
                'id_penduduk' => 5,
                'email' => 'rismawan@gmail.com',
                'password' => '$2y$10$mtpvBErgnJHJ3QHSeImOUusD3KD7SQe4Z55PlRlSL3Z4EoxVfAXZm',
                'nomor_telepon' => '0812948122912',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => 'dowZKG_3FfusXx4R0Ii75F:APA91bE8wzvasQTStDEizbyjgLBvVZJ__9eN3_aWjXkpPLfCTYr-X7OTUkVr31LlrtJ9Oea_ElMRCgvSb8STQ5PXTCC4SxEGHa7WWexOiUqFZOW3g97HvmaUQhM5bvSov3TWeThMSKt1',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-03-16 11:13:37',
            ),
            8 =>
            array (
                'id' => 50,
                'id_penduduk' => 14,
                'email' => 'sanggar2@gmail.com',
                'password' => '$2y$10$TSKOMB5t5Bk7CZqCRGcyrOemLFdoYwn7run09uV/4cTLWrKhPrjF2',
                'nomor_telepon' => '0812412412412',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'id' => 51,
                'id_penduduk' => 7,
                'email' => 'krama@gmail.com',
                'password' => '$2y$10$G1B7Zf93flcy1GyyJLIZTeJugJVDPXnjrvEsm2GYu/5O/HDTN8K5a',
                'nomor_telepon' => '0812412412442',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
