<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(["first_name" => "An", "last_name" => "Le Binh", "date_of_birth" => "1980-07-23", "joined_date" => "2005-12-30", "username" => "anlb", "password" => bcrypt(12345), "admin" => TRUE, "state" => -1, "gender" => null, "location" => "HN"]);
        User::create(["first_name" => "Diep", "last_name" => "Nguyen Thi Ngoc", "date_of_birth" => "1979-01-09", "joined_date" => "2015-11-14", "username" => "diepntn", "password" => bcrypt(12345), "admin" => TRUE, "state" => 1, "gender" => 0, "location" => "HN"]);
        User::create(["first_name" => "Duong", "last_name" => "Lam Tran Tung", "date_of_birth" => "1973-08-25", "joined_date" => "2008-03-20", "username" => "duongltt", "password" => bcrypt(12345), "admin" => TRUE, "state" => -1, "gender" => 1, "location" => "HCM"]);
        User::create(["first_name" => "Duc", "last_name" => "Nguyen Anh", "date_of_birth" => "2001-08-03", "joined_date" => "2021-10-24", "username" => "ducna", "password" => bcrypt(12345), "admin" => FALSE, "state" => 1, "gender" => null, "location" => "HN"]);
        User::create(["first_name" => "Hai", "last_name" => "Le Cong", "date_of_birth" => "1996-08-22", "joined_date" => "2017-10-21", "username" => "hailc", "password" => bcrypt(12345), "admin" => FALSE, "state" => 0, "gender" => 1, "location" => "HN"]);
        User::create(["first_name" => "Hao", "last_name" => "Nguyen", "date_of_birth" => "1976-04-21", "joined_date" => "2007-07-05", "username" => "haon", "password" => bcrypt(12345), "admin" => FALSE, "state" => 1, "gender" => null, "location" => "HCM"]);
        User::create(["first_name" => "Huy", "last_name" => "Mai Gia", "date_of_birth" => "1979-11-29", "joined_date" => "2009-02-14", "username" => "huymg", "password" => bcrypt(12345), "admin" => TRUE, "state" => 1, "gender" => 0, "location" => "DN"]);
        User::create(["first_name" => "Nhu", "last_name" => "Nguyen Ho Quynh ", "date_of_birth" => "2001-04-27", "joined_date" => "2021-11-28", "username" => "nhunhq", "password" => bcrypt(12345), "admin" => TRUE, "state" => -1, "gender" => null, "location" => "DN"]);
        User::create(["first_name" => "Phuc", "last_name" => "Nguyen Hoang", "date_of_birth" => "1990-02-05", "joined_date" => "2018-12-21", "username" => "phucnh", "password" => bcrypt(12345), "admin" => FALSE, "state" => 1, "gender" => 1, "location" => "HN"]);
        User::create(["first_name" => "Thinh", "last_name" => "Nguyen Huu", "date_of_birth" => "1997-03-21", "joined_date" => "2020-08-01", "username" => "thinhnh", "password" => bcrypt(12345), "admin" => TRUE, "state" => 1, "gender" => null, "location" => "DN"]);
        User::create(["first_name" => "Thy", "last_name" => "Nguyen Ngoc Xuan", "date_of_birth" => "1981-10-30", "joined_date" => "2011-10-14", "username" => "thynnx", "password" => bcrypt(12345), "admin" => TRUE, "state" => -1, "gender" => 0, "location" => "HCM"]);
        User::create(["first_name" => "Tri", "last_name" => "Nguyen Minh", "date_of_birth" => "2001-05-17", "joined_date" => "2022-04-02", "username" => "trinm", "password" => bcrypt(12345), "admin" => FALSE, "state" => 0, "gender" => 1, "location" => "HN"]);
        User::create(["first_name" => "Tuan", "last_name" => "Duong Duc", "date_of_birth" => "1995-12-13", "joined_date" => "2016-04-19", "username" => "tuandd", "password" => bcrypt(12345), "admin" => FALSE, "state" => 1, "gender" => null, "location" => "HCM"]);
        User::create(["first_name" => "Tuan", "last_name" => "Nguyen Lam", "date_of_birth" => "1979-03-29", "joined_date" => "2015-12-12", "username" => "tuannl", "password" => bcrypt(12345), "admin" => FALSE, "state" => 0, "gender" => 1, "location" => "DN"]);
        User::create(["first_name" => "Vy", "last_name" => "Nguyen Khanh", "date_of_birth" => "1986-02-06", "joined_date" => "2010-12-12", "username" => "vynk", "password" => bcrypt(12345), "admin" => TRUE, "state" => -1, "gender" => 0, "location" => "HN"]);
        User::create(["first_name" => "Nam", "last_name" => "Vu Gia", "date_of_birth" => "1984-02-05", "joined_date" => "2016-01-26", "username" => "namvg", "password" => bcrypt(12345), "admin" => TRUE, "state" => -1, "gender" => null, "location" => "DN"]);
        User::create(["first_name" => "Phong", "last_name" => "Nguyen Toan", "date_of_birth" => "1971-02-20", "joined_date" => "2006-03-12", "username" => "phongnt", "password" => bcrypt(12345), "admin" => TRUE, "state" => 0, "gender" => null, "location" => "DN"]);
        User::create(["first_name" => "Tin", "last_name" => "Ho Trong", "date_of_birth" => "1988-09-22", "joined_date" => "2017-03-16", "username" => "tinht", "password" => bcrypt(12345), "admin" => FALSE, "state" => -1, "gender" => null, "location" => "HCM"]);
        User::create(["first_name" => "Truc", "last_name" => "Le Nguyen Trung", "date_of_birth" => "1995-01-27", "joined_date" => "2016-11-27", "username" => "truclnt", "password" => bcrypt(12345), "admin" => TRUE, "state" => 0, "gender" => null, "location" => "HCM"]);
        User::create(["first_name" => "Bich", "last_name" => "Vo Hoa Thi", "date_of_birth" => "1999-10-16", "joined_date" => "2022-04-16", "username" => "bichvht", "password" => bcrypt(12345), "admin" => TRUE, "state" => 1, "gender" => 0, "location" => "HCM"]);
        User::create(["first_name" => "Hong", "last_name" => "Pham Thi", "date_of_birth" => "1983-02-28", "joined_date" => "2016-08-31", "username" => "hongpt", "password" => bcrypt(12345), "admin" => FALSE, "state" => 0, "gender" => 0, "location" => "HCM"]);
        User::create(["first_name" => "Lam", "last_name" => "Nguyen Van Tung", "date_of_birth" => "1971-03-03", "joined_date" => "2008-12-11", "username" => "lamnvt", "password" => bcrypt(12345), "admin" => FALSE, "state" => -1, "gender" => null, "location" => "HCM"]);
        User::create(["first_name" => "Anh", "last_name" => "Nguyen Thi", "date_of_birth" => "1980-01-03", "joined_date" => "2017-04-14", "username" => "anhnt", "password" => bcrypt(12345), "admin" => FALSE, "state" => 0, "gender" => 0, "location" => "HCM"]);
        User::create(["first_name" => "Dat", "last_name" => "Duong Ngoc", "date_of_birth" => "1994-02-04", "joined_date" => "2020-11-14", "username" => "datdn", "password" => bcrypt(12345), "admin" => FALSE, "state" => 1, "gender" => 1, "location" => "DN"]);
        User::create(["first_name" => "Hieu", "last_name" => "Nguyen Manh", "date_of_birth" => "1971-01-29", "joined_date" => "2016-05-21", "username" => "hieunm", "password" => bcrypt(12345), "admin" => TRUE, "state" => 1, "gender" => 1, "location" => "DN"]);
        User::create(["first_name" => "Kien", "last_name" => "Ho Trung", "date_of_birth" => "1986-12-18", "joined_date" => "2018-07-31", "username" => "kienht", "password" => bcrypt(12345), "admin" => TRUE, "state" => -1, "gender" => null, "location" => "DN"]);
        User::create(["first_name" => "Phuong", "last_name" => "Hoang Quy", "date_of_birth" => "1989-04-19", "joined_date" => "2018-01-11", "username" => "phuonghq", "password" => bcrypt(12345), "admin" => TRUE, "state" => -1, "gender" => null, "location" => "HN"]);
        User::create(["first_name" => "Son", "last_name" => "Nguyen Khac", "date_of_birth" => "1979-10-20", "joined_date" => "2001-12-04", "username" => "sonnk", "password" => bcrypt(12345), "admin" => TRUE, "state" => 0, "gender" => 1, "location" => "HCM"]);
        User::create(["first_name" => "Tuan", "last_name" => "Nguyen Van", "date_of_birth" => "1999-01-22", "joined_date" => "2019-11-06", "username" => "tuannv", "password" => bcrypt(12345), "admin" => TRUE, "state" => 1, "gender" => null, "location" => "HN"]);
        User::create(["first_name" => "Hien", "last_name" => "Pham Ngoc", "date_of_birth" => "1981-07-16", "joined_date" => "2007-03-02", "username" => "hienpn", "password" => bcrypt(12345), "admin" => FALSE, "state" => -1, "gender" => 0, "location" => "DN"]);
        User::create(["first_name" => "Minh", "last_name" => "Hoang Anh", "date_of_birth" => "1987-08-09", "joined_date" => "2018-07-07", "username" => "minhha", "password" => bcrypt(12345), "admin" => TRUE, "state" => 1, "gender" => null, "location" => "HN"]);
        User::create(["first_name" => "Nhung", "last_name" => "Dinh Thi Hong", "date_of_birth" => "1994-07-29", "joined_date" => "2022-06-19", "username" => "nhungdth", "password" => bcrypt(12345), "admin" => TRUE, "state" => -1, "gender" => null, "location" => "DN"]);
        User::create(["first_name" => "Tuan", "last_name" => "Nguyen Cong", "date_of_birth" => "1973-12-13", "joined_date" => "2005-08-19", "username" => "tuannc", "password" => bcrypt(12345), "admin" => FALSE, "state" => 1, "gender" => 1, "location" => "DN"]);
        User::create(["first_name" => "Anh", "last_name" => "Dinh Cuong", "date_of_birth" => "1977-10-27", "joined_date" => "2007-12-04", "username" => "anhdc", "password" => bcrypt(12345), "admin" => TRUE, "state" => 1, "gender" => 1, "location" => "DN"]);
        User::create(["first_name" => "Anh", "last_name" => "Pham Phuong", "date_of_birth" => "1987-02-12", "joined_date" => "2016-07-30", "username" => "anhpp", "password" => bcrypt(12345), "admin" => FALSE, "state" => 0, "gender" => 1, "location" => "HN"]);
        User::create(["first_name" => "Duy", "last_name" => "Vu Manh", "date_of_birth" => "1997-03-09", "joined_date" => "2018-04-29", "username" => "duyvm", "password" => bcrypt(12345), "admin" => FALSE, "state" => 0, "gender" => null, "location" => "HN"]);
        User::create(["first_name" => "Kien", "last_name" => "Vu Van", "date_of_birth" => "1978-03-13", "joined_date" => "2004-06-20", "username" => "kienvv", "password" => bcrypt(12345), "admin" => TRUE, "state" => 0, "gender" => null, "location" => "DN"]);
        User::create(["first_name" => "Tuan", "last_name" => "Dang Cong", "date_of_birth" => "1971-03-22", "joined_date" => "2013-05-23", "username" => "tuandc", "password" => bcrypt(12345), "admin" => TRUE, "state" => 1, "gender" => null, "location" => "HCM"]);
        User::create(["first_name" => "Tuan", "last_name" => "Phung Anh", "date_of_birth" => "1981-06-20", "joined_date" => "2013-01-06", "username" => "tuanpa", "password" => bcrypt(12345), "admin" => FALSE, "state" => 0, "gender" => 0, "location" => "DN"]);
        User::create(["first_name" => "Dat", "last_name" => "Dao Trung", "date_of_birth" => "1972-12-16", "joined_date" => "2021-11-21", "username" => "datdt", "password" => bcrypt(12345), "admin" => FALSE, "state" => -1, "gender" => null, "location" => "DN"]);
        User::create(["first_name" => "Tiep", "last_name" => "Bui Quang", "date_of_birth" => "1990-03-08", "joined_date" => "2014-10-19", "username" => "tiepbq", "password" => bcrypt(12345), "admin" => TRUE, "state" => -1, "gender" => 1, "location" => "DN"]);
        User::create(["first_name" => "Dung", "last_name" => "Vu Anh", "date_of_birth" => "1983-07-28", "joined_date" => "2010-06-23", "username" => "dungva", "password" => bcrypt(12345), "admin" => FALSE, "state" => 1, "gender" => 1, "location" => "HN"]);
        User::create(["first_name" => "Hung", "last_name" => "Le Duy", "date_of_birth" => "1979-11-16", "joined_date" => "2017-05-14", "username" => "hungld", "password" => bcrypt(12345), "admin" => TRUE, "state" => 0, "gender" => null, "location" => "DN"]);
        User::create(["first_name" => "Nam", "last_name" => "Giap Van", "date_of_birth" => "1994-01-21", "joined_date" => "2020-08-16", "username" => "namgv", "password" => bcrypt(12345), "admin" => TRUE, "state" => 1, "gender" => 1, "location" => "DN"]);
        User::create(["first_name" => "Thanh", "last_name" => "Nguyen Trung", "date_of_birth" => "1993-11-16", "joined_date" => "2015-02-01", "username" => "thanhnt", "password" => bcrypt(12345), "admin" => FALSE, "state" => -1, "gender" => null, "location" => "DN"]);
        User::create(["first_name" => "Thao", "last_name" => "Tran Thi", "date_of_birth" => "1970-06-22", "joined_date" => "1991-12-06", "username" => "thaott", "password" => bcrypt(12345), "admin" => FALSE, "state" => 1, "gender" => 0, "location" => "HN"]);
        User::create(["first_name" => "Ngoan", "last_name" => "Tran Thi", "date_of_birth" => "1976-05-25", "joined_date" => "1999-04-27", "username" => "ngoantt", "password" => bcrypt(12345), "admin" => TRUE, "state" => -1, "gender" => 0, "location" => "HN"]);
        User::create(["first_name" => "Quang", "last_name" => "Nguyen Le Minh", "date_of_birth" => "1992-01-11", "joined_date" => "2014-10-09", "username" => "quangnlm", "password" => bcrypt(12345), "admin" => FALSE, "state" => 0, "gender" => null, "location" => "HCM"]);
        User::create(["first_name" => "Bac", "last_name" => "Le Van", "date_of_birth" => "1978-10-23", "joined_date" => "2017-08-26", "username" => "baclv", "password" => bcrypt(12345), "admin" => FALSE, "state" => 0, "gender" => 1, "location" => "HCM"]);
        User::create(["first_name" => "Huy", "last_name" => "Nguyen Quang", "date_of_birth" => "1978-09-30", "joined_date" => "2019-06-27", "username" => "huynq", "password" => bcrypt(12345), "admin" => FALSE, "state" => 0, "gender" => null, "location" => "HCM"]);
        User::create(["first_name" => "Quy", "last_name" => "Truong Cong", "date_of_birth" => "2001-12-26", "joined_date" => "2022-07-14", "username" => "quytc", "password" => bcrypt(12345), "admin" => TRUE, "state" => 1, "gender" => null, "location" => "HN"]);
    }
}