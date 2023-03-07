/***** トップページ *****/
// トップページで使い方セクションを表示させるアニメーション
var scrollAnimationElm = document.querySelectorAll('.sa');
var scrollAnimationFunc = function() {
  for(var i = 0; i < scrollAnimationElm.length; i++) {
    var triggerMargin = 300;
    var elm = scrollAnimationElm[i];
    var showPos = 0;
    if(elm.dataset.sa_margin != null) {
      triggerMargin = parseInt(elm.dataset.sa_margin);
    }
    if(elm.dataset.sa_trigger) {
      showPos = document.querySelector(elm.dataset.sa_trigger).getBoundingClientRect().top + triggerMargin;
    } else {
      showPos = elm.getBoundingClientRect().top + triggerMargin;
    }
    if (window.innerHeight > showPos) {
      var delay = (elm.dataset.sa_delay)? elm.dataset.sa_delay : 0;
      setTimeout(function(index) {
        scrollAnimationElm[index].classList.add('show');
      }.bind(null, i), delay);
    }
    else {
      var delay = (elm.dataset.sa_delay)? elm.dataset.sa_delay : 0;
      setTimeout(function(index) {
        scrollAnimationElm[index].classList.remove('show');
      }.bind(null, i), delay);
    }
  }
}
window.addEventListener('load', scrollAnimationFunc);
window.addEventListener('scroll', scrollAnimationFunc);

/***** 目標表示画面 *****/
//テキストのカウントアップ+バーの設定
var bar = new ProgressBar.Line(splash_text, {//id名を指定
	easing: 'easeInOut',//アニメーション効果linear、easeIn、easeOut、easeInOutが指定可能
	duration: 1000,//時間指定(1000＝1秒)
	strokeWidth: 3,//進捗ゲージの太さ
	color: '#ffffff',//進捗ゲージのカラー
});

//アニメーションスタート
// index.blade.phpからcurrent_exp変数取得
bar.animate(current_exp, function () {//バーを描画する割合を指定します 1.0 なら100%まで描画します
  $(".loader_cover-up").addClass("coveranime");//カバーが上に上がるクラス追加
  $(".loader_cover-down").addClass("coveranime");//カバーが下に下がるクラス追加
});

/***** マイページ *****/
// 退会確認アラート
function delete_alert(e){
  if(!window.confirm('本当に退会しますか？')){
     window.alert('キャンセルされました'); 
     return false;
  }
  document.deleteform.submit();
};