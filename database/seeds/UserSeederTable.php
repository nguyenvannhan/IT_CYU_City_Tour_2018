<?php

use Illuminate\Database\Seeder;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('city_tour_2018'),
            'role_id' => 9
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Trạm Trung Tâm (Cuối đường Hàm Nghi)',
                'username' => 'duongtuankiet',
                'password' => bcrypt('dtkiet'),
                'map' => 'pb=!1m18!1m12!1m3!1d823.9793304293281!2d106.70042939308132!3d10.770787952779605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2c7ba05709e6903c!2sH%C3%A0m+Nghi+M!5e0!3m2!1sen!2s!4v1535128578594',
                'role_id' => 1
            ],
            [
                'name' => 'Trạm 1 (Phố đi bộ)',
                'username' => 'phamhuuvinh',
                'password' => bcrypt('phvinh'),
                'map' => 'pb=!1m18!1m12!1m3!1d3919.4716411745308!2d106.7003252148295!3d10.775143192322387!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f46c2b5141b%3A0x4a65758684cb85fd!2zTmd1eeG7hW4gSHXhu4cgUGVkZXN0cmlhbiBTdHJlZXQ!5e0!3m2!1sen!2s!4v1535077056560',
                'role_id' => 1
            ],
            [
                'name' => 'Trạm 2 (Công viên Thống Nhất)',
                'username' => 'leductoan',
                'password' => bcrypt('ldtoan'),
                'map' => 'pb=!1m18!1m12!1m3!1d3919.418086428419!2d106.69529261482954!3d10.779256092319612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f379b655c4b%3A0xc7b6b180cb08b9fd!2sThong+nhat+park!5e0!3m2!1sen!2s!4v1535077212504',
                'role_id' => 1
            ],
            [
                'name' => 'Trạm 3 (Hồ Con Rùa)',
                'username' => 'nguyentaminhtrung',
                'password' => bcrypt('ntmtrung'),
                'map' => 'pb=!1m18!1m12!1m3!1d3919.374327492922!2d106.69372886482951!3d10.782615542317346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f369339942d%3A0x2e5c61408d70ef53!2sTurtle+Lake!5e0!3m2!1sen!2s!4v1535077285540',
                'role_id' => 1
            ],
            [
                'name' => 'Trạm 4 (Công viên Lê Văn Tám)',
                'username' => 'vohongphuc',
                'password' => bcrypt('vhphuc'),
                'map' => 'pb=!1m18!1m12!1m3!1d3919.3022553628193!2d106.69163041482958!3d10.788146392313546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f335e220ab3%3A0x483379de8a30f8bd!2sLe+Van+Tam+Park!5e0!3m2!1sen!2s!4v1535077338976',
                'role_id' => 1
            ],
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Đội 1 (Đội Đen)',
                'username' => 'mauden',
                'password' => bcrypt('mauden'),
                'role_id' => 0
            ],
            [
                'name' => 'Đội 2 (Xanh da trời)',
                'username' => 'datroi',
                'password' => bcrypt('datroi'),
                'role_id' => 0
            ],
            [
                'name' => 'Đội 3 (Đội tím)',
                'username' => 'mautim',
                'password' => bcrypt('mautim'),
                'role_id' => 0
            ],
            [
                'name' => 'Đội 4 (Đội vàng)',
                'username' => 'mauvang',
                'password' => bcrypt('mauvang'),
                'role_id' => 0
            ],
            [
                'name' => 'Đội 5 (Đội Xanh nước biển)',
                'username' => 'nuocbien',
                'password' => bcrypt('nuocbien'),
                'role_id' => 0
            ],
            [
                'name' => 'Đội 6 (Đội Cam)',
                'username' => 'maucam',
                'password' => bcrypt('maucam'),
                'role_id' => 0
            ],
            [
                'name' => 'Đội 7 (Đội Trắng)',
                'username' => 'mautrang',
                'password' => bcrypt('mautrang'),
                'role_id' => 0
            ],
            [
                'name' => 'Đội 8 (Đội Hồng)',
                'username' => 'mauhong',
                'password' => bcrypt('mauhong'),
                'role_id' => 0
            ],
            [
                'name' => 'Đội 9 (Đội Xanh lá)',
                'username' => 'xanhla',
                'password' => bcrypt('xanhla'),
                'role_id' => 0
            ],
            [
                'name' => 'Đội 10 (Đội Xanh đen)',
                'username' => 'xanhden',
                'password' => bcrypt('xanhden'),
                'role_id' => 0
            ]
        ]);
    }
}
