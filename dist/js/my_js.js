$(document).ready(function () {
    $(".province").change(function () {
        var provence_id = $(this).val();
        $.ajax({
            url: "district.php",
            method: "POST",
            data: {
                provence_id: provence_id
            },
            success: function (data) {
                $(".district").html(data);
            }
        });
    });
    $(".district").change(function () {
        var district_id = $(this).val();
        $.ajax({
            url: "district.php",
            method: "POST",
            data: {
                district_id: district_id
            },
            success: function (data) {
                $(".sector").html(data);
            }
        });
    });
    $(".sector").change(function () {
        var sector_id = $(this).val();
        $.ajax({
            url: "district.php",
            method: "POST",
            data: {
                sector_id: sector_id
            },
            success: function (data) {
                $(".cell").html(data);
            }
        });
    });
    $(".cell").change(function () {
        var cell_id = $(this).val();
        $.ajax({
            url: "district.php",
            method: "POST",
            data: {
                cell_id: cell_id
            },
            success: function (data) {
                $(".village").html(data);
            }
        });
    });
});
$(function () {

    $('#phone').keyup(function () {
        var yourInput = $(this).val();
        re = /[abcdefghijklmnopqrstuvwxyz`~!@#$%^&*( )_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        if (isSplChar) {
            var no_spl_char = yourInput.replace(
                /[`abcdefghijklmnopqrstuvwxyz~!@#$%^&*( )_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            $(this).val(no_spl_char);
        }
    });
});
$(function () {

    $('#Id_number').keyup(function () {
        var yourInput = $(this).val();
        re = /[abcdefghijklmnopqrstuvwxyz`~!@#$%^&*( )_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        if (isSplChar) {
            var no_spl_char = yourInput.replace(
                /[`abcdefghijklmnopqrstuvwxyz~!@#$%^&*( )_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            $(this).val(no_spl_char);
        }
    });
});
$(function () {

    $('#fname').keyup(function () {
        var yourInput = $(this).val();
        re = /[1234567890`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        if (isSplChar) {
            var no_spl_char = yourInput.replace(
                /[`1234567890~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            $(this).val(no_spl_char);
        }
    });

});
$(function () {

    $('#lname').keyup(function () {
        var yourInput = $(this).val();
        re = /[1234567890`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        if (isSplChar) {
            var no_spl_char = yourInput.replace(
                /[`1234567890~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            $(this).val(no_spl_char);
        }
    });

});

function fileValidation() {
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if (!allowedExtensions.exec(filePath)) {
        alert('Please Uplaod Only Picture');
        fileInput.value = '';
        return false;
    }
}