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
                'fcm_token_web' => 'cyAumeE-EkSP0c226Ll6Ba:APA91bF3xggGDiZVhdHci33pxvmLyOOPRpvCGVrcr3gYwfyDt6QBASuMHrMEkHl9Hty95PVfBUEAhqBpBwndkpVcRXzyRYBjIpgamMf50QM1F1sbzI3tXVYbrCnDQHgleetNfsZwdIYQ',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-01-18 14:53:02',
                'updated_at' => '2022-05-24 14:21:36',
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
                'fcm_token_key' => 'f2wKL9iaRQKX30buWd37B-:APA91bHO0VV0ciQMQFHemCdLYlTtxgJz0khMBbOfk3qFuY6XCkB9g1okeJqQJSkAOMW-T2CSgNWUNS8S_yxs3Bw5gEb70aZWM7Ds5vSgFF7cQC7EqF6qmNCO0KrkCMq-Ubl7WNN48bnf',
                'fcm_token_web' => 'cyAumeE-EkSP0c226Ll6Ba:APA91bHYmzzklrLj5h_34uJIyNZ_n9XLhnc5tLeeEcVoG_8FQk7MZZaU1-qCedgp9OkvGo2wyRVDbWi8-bxXBtzGFKk_JOmeFjDjb3vcTI8ynrlGLVm-rtTSp54G5h1Yeuvot8p3K0x0',
                'lat' => '-8.578768000000000000',
                'lng' => '115.213947000000000000',
                'created_at' => '2022-01-18 14:53:54',
                'updated_at' => '2022-05-20 12:35:34',
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
                'fcm_token_web' => 'eh5T3s-BFajSAfVfqCsGbf:APA91bFvPW948_qmZYikI0ESfxITVi7VmTNvv1GQGsjag946sux5_6YJfiVVwLCMRbCknBQULhk6ZbeIjXHDTPG_VzDkYUJ3j75hYBlamqqjG25mS_lRu74Hy1s1gAppshwVXMcb1YeD',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-01-18 14:54:47',
                'updated_at' => '2022-05-24 14:32:37',
            ),
            3 =>
            array (
                'id' => 4,
                'id_penduduk' => 2,
                'email' => 'sanggar1@gmail.com',
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
                'fcm_token_key' => 'f2wKL9iaRQKX30buWd37B-:APA91bHO0VV0ciQMQFHemCdLYlTtxgJz0khMBbOfk3qFuY6XCkB9g1okeJqQJSkAOMW-T2CSgNWUNS8S_yxs3Bw5gEb70aZWM7Ds5vSgFF7cQC7EqF6qmNCO0KrkCMq-Ubl7WNN48bnf',
                'fcm_token_web' => NULL,
                'lat' => '-8.445112000000000000',
                'lng' => '115.098214000000000000',
                'created_at' => '2022-01-18 14:57:25',
                'updated_at' => '2022-05-20 12:31:17',
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
                'fcm_token_web' => 'cyAumeE-EkSP0c226Ll6Ba:APA91bHYmzzklrLj5h_34uJIyNZ_n9XLhnc5tLeeEcVoG_8FQk7MZZaU1-qCedgp9OkvGo2wyRVDbWi8-bxXBtzGFKk_JOmeFjDjb3vcTI8ynrlGLVm-rtTSp54G5h1Yeuvot8p3K0x0',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-05-11 21:09:00',
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
                'password' => '$2y$10$TYZaDjVYMk.fqdcgz4pMrOoMZUFj85XFjrlJHe6Ek48hoLGJjKUTS',
                'nomor_telepon' => '0812412412442',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => 'cyAumeE-EkSP0c226Ll6Ba:APA91bF3xggGDiZVhdHci33pxvmLyOOPRpvCGVrcr3gYwfyDt6QBASuMHrMEkHl9Hty95PVfBUEAhqBpBwndkpVcRXzyRYBjIpgamMf50QM1F1sbzI3tXVYbrCnDQHgleetNfsZwdIYQ',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2022-05-22 11:57:39',
                'updated_at' => '2022-05-24 08:58:48',
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
                'id' => 60,
                'id_penduduk' => 11,
                'email' => 'testingsulinggih@gmail.com',
                'password' => '$2y$10$Xrj9FYfcVRxkI7bg0NPtAeRwDzWWmiXQHjV1t2YqH9G.Eycw3kmEO',
                'nomor_telepon' => '08124712412642',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => '-8.578768000000000000',
                'lng' => '115.213947000000000000',
                'created_at' => '2022-05-05 09:47:22',
                'updated_at' => '2022-05-05 09:47:22',
            ),
            12 =>
            array (
                'id' => 61,
                'id_penduduk' => 8,
                'email' => 'pasangan@gmail.com',
                'password' => '$2y$10$LZ5xbFcOsGfxlxZg71NkKOdJFxUpHbuKXRWELGHfmGEBrl6.9IbHu',
                'nomor_telepon' => '01284984198491',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => '-8.578768000000000000',
                'lng' => '115.213947000000000000',
                'created_at' => '2022-05-05 09:48:20',
                'updated_at' => '2022-05-05 09:48:20',
            ),
            13 =>
            array (
                'id' => 62,
                'id_penduduk' => 19,
                'email' => 'rismawantugas@gmail.com',
                'password' => '$2y$10$GVJ8a8WiRTAso6tnJrSctOTPUzI.gSuOXMT/V/jJsQ5L8kcefWF42',
                'nomor_telepon' => '08124124515125',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => '-8.578768000000000000',
                'lng' => '115.213947000000000000',
                'created_at' => '2022-05-06 04:18:02',
                'updated_at' => '2022-05-06 04:18:02',
            ),
            14 =>
            array (
                'id' => 63,
                'id_penduduk' => 12,
                'email' => 'dota@gmail.com',
                'password' => '$2y$10$OUBgOt.Wn/jQEBL1OSSdDuYmfS3f3e9EhPN/HYIegt1hNAM7j3wZq',
                'nomor_telepon' => '08124124124812',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => '-8.583465485402808000',
                'lng' => '115.146606420166790000',
                'created_at' => '2022-05-06 22:54:31',
                'updated_at' => '2022-05-06 22:54:31',
            ),
            15 =>
            array (
                'id' => 64,
                'id_penduduk' => 1,
                'email' => 'rismawan1234@gmail.com',
                'password' => '$2y$10$GWHaadjMZJLURayL6RWbce.qfp9JIK6bMUZ24Lwn8o4aO49OFB0OK',
                'nomor_telepon' => '08124712495121',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => NULL,
                'lat' => '-8.578768000000000000',
                'lng' => '115.213947000000000000',
                'created_at' => '2022-05-07 06:53:29',
                'updated_at' => '2022-05-07 06:53:29',
            ),
            16 =>
            array (
                'id' => 65,
                'id_penduduk' => 6,
                'email' => 'sanggar@gmail.com',
                'password' => '$2y$10$JskKCNZRgjQ8S.IOoN2Hae984WFNWOgGgEaMVY6T3xdkMCRgeSjM6',
                'nomor_telepon' => '08412412020120',
                'user_profile' => 'app/default/profile/user.jpg',
                'json_token_lupa_password' => NULL,
                'fcm_token_key' => NULL,
                'fcm_token_web' => 'cyAumeE-EkSP0c226Ll6Ba:APA91bF3xggGDiZVhdHci33pxvmLyOOPRpvCGVrcr3gYwfyDt6QBASuMHrMEkHl9Hty95PVfBUEAhqBpBwndkpVcRXzyRYBjIpgamMf50QM1F1sbzI3tXVYbrCnDQHgleetNfsZwdIYQ',
                'lat' => '-8.578768000000000000',
                'lng' => '115.213947000000000000',
                'created_at' => '2022-05-07 14:03:06',
                'updated_at' => '2022-05-24 14:32:01',
            ),
        ));


    }
}
