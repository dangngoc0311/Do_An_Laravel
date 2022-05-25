<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}


// INSERT INTO `cities` VALUES (1,'Thành phố Hà Nội', 'Thành phố Trung ương');
// INSERT INTO `cities` VALUES (2,'Tỉnh Hà Giang', 'Tỉnh');
// INSERT INTO `cities` VALUES (3,'Tỉnh Cao Bằng', 'Tỉnh');
// INSERT INTO `cities` VALUES (4,'Tỉnh Bắc Kạn', 'Tỉnh');
// INSERT INTO `cities` VALUES (5,'Tỉnh Tuyên Quang', 'Tỉnh');
// INSERT INTO `cities` VALUES (6,'Tỉnh Lào Cai', 'Tỉnh');
// INSERT INTO `cities` VALUES (7,'Tỉnh Điện Biên', 'Tỉnh');
// INSERT INTO `cities` VALUES (8,'Tỉnh Lai Châu', 'Tỉnh');
// INSERT INTO `cities` VALUES (9,'Tỉnh Sơn La', 'Tỉnh');
// INSERT INTO `cities` VALUES (10,'Tỉnh Yên Bái', 'Tỉnh');
// INSERT INTO `cities` VALUES (11,'Tỉnh Hoà Bình', 'Tỉnh');
// INSERT INTO `cities` VALUES (12,'Tỉnh Thái Nguyên', 'Tỉnh');
// INSERT INTO `cities` VALUES (13,'Tỉnh Lạng Sơn', 'Tỉnh');
// INSERT INTO `cities` VALUES (14,'Tỉnh Quảng Ninh', 'Tỉnh');
// INSERT INTO `cities` VALUES (15,'Tỉnh Bắc Giang', 'Tỉnh');
// INSERT INTO `cities` VALUES (16,'Tỉnh Phú Thọ', 'Tỉnh');
// INSERT INTO `cities` VALUES (17,'Tỉnh Vĩnh Phúc', 'Tỉnh');
// INSERT INTO `cities` VALUES (18,'Tỉnh Bắc Ninh', 'Tỉnh');
// INSERT INTO `cities` VALUES (19,'Tỉnh Hải Dương', 'Tỉnh');
// INSERT INTO `cities` VALUES (20,'Thành phố Hải Phòng', 'Thành phố Trung ương');
// INSERT INTO `cities` VALUES (21,'Tỉnh Hưng Yên', 'Tỉnh');
// INSERT INTO `cities` VALUES (22,'Tỉnh Thái Bình', 'Tỉnh');
// INSERT INTO `cities` VALUES (23,'Tỉnh Hà Nam', 'Tỉnh');
// INSERT INTO `cities` VALUES (24,'Tỉnh Nam Định', 'Tỉnh');
// INSERT INTO `cities` VALUES (25,'Tỉnh Ninh Bình', 'Tỉnh');
// INSERT INTO `cities` VALUES (26,'Tỉnh Thanh Hóa', 'Tỉnh');
// INSERT INTO `cities` VALUES (27,'Tỉnh Nghệ An', 'Tỉnh');
// INSERT INTO `cities` VALUES (28,'Tỉnh Hà Tĩnh', 'Tỉnh');
// INSERT INTO `cities` VALUES (29,'Tỉnh Quảng Bình', 'Tỉnh');
// INSERT INTO `cities` VALUES (30,'Tỉnh Quảng Trị', 'Tỉnh');
// INSERT INTO `cities` VALUES (31,'Tỉnh Thừa Thiên Huế', 'Tỉnh');
// INSERT INTO `cities` VALUES (32,'Thành phố Đà Nẵng', 'Thành phố Trung ương');
// INSERT INTO `cities` VALUES (33,'Tỉnh Quảng Nam', 'Tỉnh');
// INSERT INTO `cities` VALUES (34,'Tỉnh Quảng Ngãi', 'Tỉnh');
// INSERT INTO `cities` VALUES (35,'Tỉnh Bình Định', 'Tỉnh');
// INSERT INTO `cities` VALUES (36,'Tỉnh Phú Yên', 'Tỉnh');
// INSERT INTO `cities` VALUES (37,'Tỉnh Khánh Hòa', 'Tỉnh');
// INSERT INTO `cities` VALUES (38,'Tỉnh Ninh Thuận', 'Tỉnh');
// INSERT INTO `cities` VALUES (39,'Tỉnh Bình Thuận', 'Tỉnh');
// INSERT INTO `cities` VALUES (40,'Tỉnh Kon Tum', 'Tỉnh');
// INSERT INTO `cities` VALUES (41,'Tỉnh Gia Lai', 'Tỉnh');
// INSERT INTO `cities` VALUES (42,'Tỉnh Đắk Lắk', 'Tỉnh');
// INSERT INTO `cities` VALUES (43,'Tỉnh Đắk Nông', 'Tỉnh');
// INSERT INTO `cities` VALUES (44,'Tỉnh Lâm Đồng', 'Tỉnh');
// INSERT INTO `cities` VALUES (45,'Tỉnh Bình Phước', 'Tỉnh');
// INSERT INTO `cities` VALUES (46,'Tỉnh Tây Ninh', 'Tỉnh');
// INSERT INTO `cities` VALUES (47,'Tỉnh Bình Dương', 'Tỉnh');
// INSERT INTO `cities` VALUES (48,'Tỉnh Đồng Nai', 'Tỉnh');
// INSERT INTO `cities` VALUES (49,'Tỉnh Bà Rịa - Vũng Tàu', 'Tỉnh');
// INSERT INTO `cities` VALUES (50,'Thành phố Hồ Chí Minh', 'Thành phố Trung ương');
// INSERT INTO `cities` VALUES (51,'Tỉnh Long An', 'Tỉnh');
// INSERT INTO `cities` VALUES (52,'Tỉnh Tiền Giang', 'Tỉnh');
// INSERT INTO `cities` VALUES (53,'Tỉnh Bến Tre', 'Tỉnh');
// INSERT INTO `cities` VALUES (54,'Tỉnh Trà Vinh', 'Tỉnh');
// INSERT INTO `cities` VALUES (55,'Tỉnh Vĩnh Long', 'Tỉnh');
// INSERT INTO `cities` VALUES (56,'Tỉnh Đồng Tháp', 'Tỉnh');
// INSERT INTO `cities` VALUES (57,'Tỉnh An Giang', 'Tỉnh');
// INSERT INTO `cities` VALUES (58,'Tỉnh Kiên Giang', 'Tỉnh');
// INSERT INTO `cities` VALUES (59,'Thành phố Cần Thơ', 'Thành phố Trung ương');
// INSERT INTO `cities` VALUES (60,'Tỉnh Hậu Giang', 'Tỉnh');
// INSERT INTO `cities` VALUES (61,'Tỉnh Sóc Trăng', 'Tỉnh');
// INSERT INTO `cities` VALUES (62,'Tỉnh Bạc Liêu', 'Tỉnh');
// INSERT INTO `cities` VALUES (63,'Tỉnh Cà Mau', 'Tỉnh');
