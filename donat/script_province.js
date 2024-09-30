$(function () {
    var provinceObject = $('#province');
    var amphureObject = $('#amphure');
    var districtObject = $('#district');
    var zipCodeObject = $('#zip_code'); // เพิ่มการอ้างอิงถึง input zip code

    // on change province
    provinceObject.on('change', function () {
        var provinceId = $(this).val();

        amphureObject.html('<option value="">เลือกอำเภอ</option>');
        districtObject.html('<option value="">เลือกตำบล</option>');
        zipCodeObject.val(''); // ล้างรหัสไปรษณีย์

        $.get('get_amphure.php?province_id=' + provinceId, function (data) {
            var result = JSON.parse(data);
            $.each(result, function (index, item) {
                amphureObject.append(
                    $('<option></option>').val(item.id).html(item.name_th)
                );
            });
        }).fail(function () {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'ไม่สามารถดึงข้อมูลอำเภอได้',
                confirmButtonColor: '#ffaa00'
            });
        });
    });

    // on change amphure
    amphureObject.on('change', function () {
        var amphureId = $(this).val();

        districtObject.html('<option value="">เลือกตำบล</option>');
        zipCodeObject.val(''); // ล้างรหัสไปรษณีย์

        $.get('get_district.php?amphure_id=' + amphureId, function (data) {
            var result = JSON.parse(data);
            $.each(result, function (index, item) {
                districtObject.append(
                    $('<option></option>').val(item.id).html(item.name_th)
                );
            });
        }).fail(function () {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'ไม่สามารถดึงข้อมูลตำบลได้',
                confirmButtonColor: '#ffaa00'
            });
        });
    });

    // on change district
    districtObject.on('change', function () {
        var districtId = $(this).val(); // รับค่า district_id

        // ดึงรหัสไปรษณีย์จากตาราง districts
        if (districtId) {
            $.get('get_zip_code.php?district_id=' + districtId, function (data) {
                var result = JSON.parse(data);
                if (result.zip_code) {
                    zipCodeObject.val(result.zip_code); // ตั้งค่ารหัสไปรษณีย์ใน input
                } else {
                    zipCodeObject.val(''); // หากไม่พบ ให้ล้างค่ารหัสไปรษณีย์
                }
            }).fail(function () {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'ไม่สามารถดึงข้อมูลรหัสไปรษณีย์ได้',
                    confirmButtonColor: '#ffaa00'
                });
            });
        } else {
            zipCodeObject.val(''); // หากไม่มี district_id ให้ล้างค่ารหัสไปรษณีย์
        }
    });
});
