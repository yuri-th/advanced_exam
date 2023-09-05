// ボタン要素を取得
const button = document.getElementById('change__btn');

// ボタンがクリックされたときの処理
button.addEventListener('click', () => {
    // ボタンのクラスを変更して色を変える
    button.classList.toggle('clicked');
});