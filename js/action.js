$(function () {
  // メッセージ表示（$_SESSIONに保存されているもの）
  var $jsShowMsg = $("#js-show-msg");
  var msg = $jsShowMsg.text();
  if (msg.replace(/^[\s　]+|[\s　]+$/g, "").length) {
    $jsShowMsg.slideToggle("slow");
    setTimeout(function () {
      $jsShowMsg.slideToggle("slow");
    }, 5000);
  }
});
