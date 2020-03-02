/**
 * 画像ギャラリー
 */
$(document).ready(function () {
  var numPerPanel = 10;              // パネルに表示する画像の枚数
  var navId = "#gallery-navigation"; // ナビゲーションパネルのID

  // スタイルの設定
  $(navId+" a").css("display", "block");
  $(navId+" ul.thumbs li").css({opacity: 0.5});
  $(navId+" a.prev,"+navId+" a.next").css({opacity: 0.5});

  // 最初の画像をメインパネルにセットする
  var firstPhoto = $(navId+" ul.thumbs a").first();
  var url = firstPhoto.attr("href");
  var caption = $("img",firstPhoto).attr("title");
  $("#screen").html('<img src="' + url + '" />');
  $("#caption").html(caption);
  firstPhoto.parent().addClass("selected").css({opacity: 1.0});

  // サムネイル画像パネルの幅を設定する
  var unitWidth = $(navId+" ul.thumbs li").first().outerWidth(true);
  var thumbPanelWidth = unitWidth * numPerPanel;
  $(navId+" #thumb-panel").width(thumbPanelWidth);

  var scrollOffset = thumbPanelWidth;

  // 制御パネル全体の幅を設定し中央寄せにする
  // panelWidth = 表示サムネイルの幅 + 左右矢印の幅
  var panelWidth = thumbPanelWidth + $("a.prev").outerWidth(true) + $("a.next").outerWidth(true);
  $(navId+" .navigation-panel").width(panelWidth).css("margin","auto");

  // サムネイル画像ロール全体の幅を計算する
  var totalWidth = 0;
  $(navId+" ul.thumbs li").each(function () {
    totalWidth += $(this).outerWidth(true);
  });
  $(navId+" ul.thumbs").css("width", totalWidth+"px");
  $(navId+" ul.thumbs li:last-child").css("margin-right", "0"); // 右端のサムネイルの右マージンを0に

  // サムネイル画像ロールが移動できる限界値
  var offsetLimit = thumbPanelWidth + 3 - totalWidth;

  // サムネイル画像をクリックした時の処理
  $(navId+" ul.thumbs a").click(function () {
    $(navId+" ul.thumbs li.selected").removeClass("selected").animate({opacity: 0.5},200);
    $(this).parent().addClass("selected").animate({opacity: 1.0},200);
    var url = $(this).attr("href");
    var caption = $("img", this).attr("title");
    $("#caption").fadeOut(100, function () {
      $(this).html(caption);
      $(this).fadeIn(100);
    });
    $("#screen").fadeOut(100, function () {
      $(this).html('<img src="' + url + '" />');
      $(this).fadeIn(100);
    });
    return false;
  });

  // サムネイル画像ロールの表示オフセット
  var offset = 0;

  // 矢印のホーバー処理
  $(navId+" a.prev,"+navId+" a.next").hover(
    function () {
      if ($(this).css("opacity") > 0.0) {
        $(this).stop().animate({opacity: 1.0}, 100);
      }
    },
    function () {
      if ($(this).css("opacity") > 0.0) {
        $(this).stop().animate({opacity: 0.5}, 100);
      }
    }
  );

  // 右矢印をクリックした時の処理
  $(navId+" a.next").click(function () {
    offset -= scrollOffset;
    if (offset < offsetLimit) offset = offsetLimit;
    $(navId+" ul.thumbs").animate({
      marginLeft: offset + "px"
    }, 500, "easeInOutCubic", updateArrow);
    $(navId).animate({
      backgroundPosition: offset + "px"
    }, 500, "easeInOutCubic");
    return false;
  });

  // 左矢印をクリックした時の処理
  $(navId+" a.prev").click(function () {
    offset += scrollOffset;
    if (offset > 0) offset = 0;
    $(navId+" ul.thumbs").animate({
      marginLeft: offset + "px"
    }, 500, "easeInOutCubic", updateArrow);
    $(navId).animate({
      backgroundPosition: offset + "px"
    }, 500, "easeInOutCubic");
    return false;
  });

  // 矢印の表示更新
  function updateArrow() {
    if (offset > offsetLimit) {
      $(navId+" a.next").css("opacity", 0.5);
    }
    else {
      $(navId+" a.next").css("opacity", 0.0);
    }
    if (offset < 0) {
      $(navId+" a.prev").css("opacity", 0.5);
    }
    else {
      $(navId+" a.prev").css("opacity", 0.0);
    }
  }

  updateArrow();

});
