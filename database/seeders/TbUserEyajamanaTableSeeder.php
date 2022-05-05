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
                'fcm_token_key' => 'f1IYbrMgSFqliT41ZwYSLK:APA91bHwVeN8hiV_gcHvCeAAesj4dtbylaWMx6u0zzdkLUn2YhXAE3cWNbqOqW24w4INxJuCx93zSbGz76q1Tj1VzIvQiy4O9Yj3BfTzOTYHkHsxKNY7QjaYFJltRO2BL-mCWqE9mLrs',
                'fcm_token_web' => 'cyAumeE-EkSP0c226Ll6Ba:APA91bHYmzzklrLj5h_34uJIyNZ_n9XLhnc5tLeeEcVoG_8FQk7MZZaU1-qCedgp9OkvGo2wyRVDbWi8-bxXBtzGFKk_JOmeFjDjb3vcTI8ynrlGLVm-rtTSp54G5h1Yeuvot8p3K0x0',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-01-18 14:53:02',
                'updated_at' => '2022-04-29 09:05:04',
            ),
            1 => 
            array (
                'id' => 2,
                'id_penduduk' => 3,
                'email' => 'sulinggih@gmail.com',
                'password' => '$2y$10$xkljavxyQ9xirivMWUw9hulUB5Dx2mX43o0UxnoPDVT1hKX7FoKya',
                'nomor_telepon' => '087221423695',
                'user_profile' => 'storage/krama_profile/alin.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => 'cIZJfz5KSSOTS2U5-MjO0L:APA91bFLuo_azZ0rV34JzRRjg-x61DfE4e3sE_M83Nhcd80VFDaefKHVbcRPOyMOxb9X1adOnUPPfJRxoqqj3Te5qBTWbqNf-7VfpvJU5_JywVXycWXizHv8TW2EFsD5SJtsjVtJHFWT',
                'fcm_token_web' => 'dowZKG_3FfusXx4R0Ii75F:APA91bFctgQof0U1A0a7mSwXsz4mnqdaOu14LcSx1UAG-QEsjCYE9OgHtlRdXHRRfFCet8pnOVf7igA-SC_n81cMG7QFv6AQt9vKTFFyxh9CwlpiH0zeKMbYLWctBBgi0j9RUgECRhNW',
                'lat' => '-8.578768000000000000',
                'lng' => '115.213947000000000000',
                'created_at' => '2022-01-18 14:53:54',
                'updated_at' => '2022-04-29 11:11:46',
            ),
            2 => 
            array (
                'id' => 3,
                'id_penduduk' => 23,
                'email' => 'pemangku@gmail.com',
                'password' => '$2y$10$FQ0fzSRoQW5tnwmGVbbGc./whMJ8P7A8IZ07COM99.vX9WJD9N69e',
                'nomor_telepon' => '081241241258',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => 'cyAumeE-EkSP0c226Ll6Ba:APA91bHYmzzklrLj5h_34uJIyNZ_n9XLhnc5tLeeEcVoG_8FQk7MZZaU1-qCedgp9OkvGo2wyRVDbWi8-bxXBtzGFKk_JOmeFjDjb3vcTI8ynrlGLVm-rtTSp54G5h1Yeuvot8p3K0x0',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-01-18 14:54:47',
                'updated_at' => '2022-04-29 07:15:46',
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
                'user_profile' => 'storage/krama_profile/alin.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => 'cIZJfz5KSSOTS2U5-MjO0L:APA91bFLuo_azZ0rV34JzRRjg-x61DfE4e3sE_M83Nhcd80VFDaefKHVbcRPOyMOxb9X1adOnUPPfJRxoqqj3Te5qBTWbqNf-7VfpvJU5_JywVXycWXizHv8TW2EFsD5SJtsjVtJHFWT',
                'fcm_token_web' => NULL,
                'lat' => '-8.445112000000000000',
                'lng' => '115.098214000000000000',
                'created_at' => '2022-01-18 14:57:25',
                'updated_at' => '2022-04-29 11:02:38',
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
                'password' => '$2y$10$FQ0fzSRoQW5tnwmGVbbGc./whMJ8P7A8IZ07COM99.vX9WJD9N69e',
                'nomor_telepon' => '0812412412442',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => 'cyAumeE-EkSP0c226Ll6Ba:APA91bHYmzzklrLj5h_34uJIyNZ_n9XLhnc5tLeeEcVoG_8FQk7MZZaU1-qCedgp9OkvGo2wyRVDbWi8-bxXBtzGFKk_JOmeFjDjb3vcTI8ynrlGLVm-rtTSp54G5h1Yeuvot8p3K0x0',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-04-29 09:28:46',
            ),
            10 => 
            array (
                'id' => 58,
                'id_penduduk' => 21,
                'email' => 'nabe@gmail.com',
                'password' => '$2y$10$5jb0bEmt2Cu5DUirzq3Z9u/Mz3yKBB1EdkrM8QapD8cy75lNLsJCu',
                'nomor_telepon' => '08124124712471',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-04-29 08:08:25',
                'updated_at' => '2022-04-29 08:08:25',
            ),
            11 => 
            array (
                'id' => 59,
                'id_penduduk' => 1,
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$pF6ASpYySELWmiODlt31TumZB2LedyMygKugnAr0cqLrOSbiB4tNm',
                'nomor_telepon' => '087851423695',
                'user_profile' => NULL,
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => '-8.635053600000000000',
                'lng' => '-8.635053600000000000',
                'created_at' => '2022-04-29 11:27:23',
                'updated_at' => '2022-04-29 11:27:23',
            ),
        ));
        
        
    }
}