// // 予約フォーム
// // テキストボックスの値を取得
// var textBoxValue = document.getElementById("reservation_date").value;

// // フォームのフィールドにテキストボックスの値を設定
// document.getElementById("reserve__form--confirm").elements["confirm__date"].value = textBoxValue;


// エリア検索・ジャンル検索・店名検索
$(document).ready(function () {
    $('#Area_Select').keypress(function (e) {
        if (e.which === 13) { // Enterキーが押された場合
            e.preventDefault(); // デフォルトのEnterキーの動作をキャンセル
            $('#Area_Form').submit(); // フォームを送信
        }
    });

    $('#Genre_Select').keypress(function (e) {
        if (e.which === 13) { // Enterキーが押された場合
            e.preventDefault(); // デフォルトのEnterキーの動作をキャンセル
            $('#Genre_Form').submit(); // フォームを送信
        }
    });

    $('#Shop_Select').keypress(function (e) {
        if (e.which === 13) { // Enterキーが押された場合
            e.preventDefault(); // デフォルトのEnterキーの動作をキャンセル
            $('#Name_Form').submit(); // フォームを送信
        }
    });
});

