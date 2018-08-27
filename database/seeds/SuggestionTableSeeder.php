<?php

use Illuminate\Database\Seeder;

class SuggestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suggestions')->insert([
            [
                'content' => '10<sup>o</sup><br/>46’<br/>26.0”N<br/>106<sup>o</sup><br/>42’<br/>13.0”E',
                'answer' => 'pho di bo',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 2,
                'team_id' => 7
            ],
            [
                'content' => '10<sup>o</sup><br/>46’<br/>26.0”N<br/>106<sup>o</sup><br/>42’<br/>13.0”E',
                'answer' => 'pho di bo',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 2,
                'team_id' => 11
            ],
            [
                'content' => '-Liberation Day/Reunification Day<br/>- Norodom street<br/>- khoảng 3,5ha tổng diện tích mặt bằng<br/>',
                'answer' => 'cong vien thong nhat',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 2,
                'team_id' => 8
            ],
            [
                'content' => '-Liberation Day/Reunification Day<br/>- Norodom street<br/>- khoảng 3,5ha tổng diện tích mặt bằng<br/>',
                'answer' => 'cong vien thong nhat',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 2,
                'team_id' => 12
            ],
            [
                'content' => '-Liberation Day/Reunification Day<br/>- Norodom street<br/>- khoảng 3,5ha tổng diện tích mặt bằng<br/>',
                'answer' => 'cong vien thong nhat',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 2,
                'team_id' => 15
            ],
            [
                'content' => 'Đây là thử thách xếp hình. <br/> Vui lòng liên hệ trạm trưởng để được xếp hình',
                'answer' => 'ho con rua',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 2,
                'team_id' => 9
            ],
            [
                'content' => 'Đây là thử thách xếp hình. <br/> Vui lòng liên hệ trạm trưởng để được xếp hình',
                'answer' => 'ho con rua',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 2,
                'team_id' => 13
            ],
            [
                'content' => 'Đây là thử thách xếp hình. <br/> Vui lòng liên hệ trạm trưởng để được xếp hình',
                'answer' => 'ho con rua',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 2,
                'team_id' => 16
            ],
            [
                'content' => '-Khoảng 6 ha diện tích<br/>-Phá hủy kho Pháp<br/>-1/1/1946<br/>-Thiếu nhi',
                'answer' => 'cong vien le van tam',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 2,
                'team_id' => 10
            ],
        ]);

        DB::table('suggestions')->insert([
            [
                'content' => '10<sup>o</sup><br/>46\’<br/>26.0\”N<br/>106<sup>o</sup><br/>42\’<br/>13.0\”E',
                'answer' => 'pho di bo',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 6
            ],
            [
                'content' => '-Liberation Day/Reunification Day<br/>- Norodom street<br/>- khoảng 3,5ha tổng diện tích mặt bằng<br/>',
                'answer' => 'cong vien thong nhat',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 3
            ],
            [
                'content' => 'Đây là thử thách xếp hình. <br/> Vui lòng liên hệ trạm trưởng để được xếp hình',
                'answer' => 'ho con rua',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 4
            ],
            [
                'content' => '-Khoảng 6 ha diện tích<br/>-Phá hủy kho Pháp<br/>-1/1/1946<br/>-Thiếu nhi',
                'answer' => 'cong vien le van tam',
                'map' => 'https://goo.gl/maps/yFnm7AJpF352',
                'station_id' => 5
            ]
        ]);
    }
}
