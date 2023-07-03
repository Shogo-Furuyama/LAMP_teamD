function toggleTag(element) {
  // すべてのタグから選択解除クラスを削除
  var tags = document.querySelectorAll(".tag");
  for (var i = 0; i < tags.length; i++) {
    tags[i].classList.remove("selected");
  }

  // クリックされたタグに選択解除クラスを追加
  element.parentNode.classList.add("selected");
}

function saveCategory() {
  var selectedTag = document.querySelector(".tag.selected");
  var saveButton = document.querySelector(".save-button");
  var warningMessage = document.getElementById("warning-message");
  var selectedCategory = document.getElementById("selected-category");
  var categoryName = document.getElementById("category-name");
  var successMessage = document.getElementById("success-message");

  if (selectedTag) {
    var category = selectedTag.textContent.trim();
    categoryName.textContent = category;

    // 選択されたカテゴリーの保存処理を行います
    console.log("選択されたカテゴリー: " + category);

    // ボタンのクリックスタイルを反転させる
    saveButton.classList.toggle("clicked");

    // 注意書きを非表示にする
    warningMessage.style.display = "none";

    // 選択されたカテゴリーと保存メッセージを表示する
    selectedCategory.style.display = "block";
    successMessage.style.display = "block";
  } else {
    // ボタンのクリックスタイルを反転させる
    saveButton.classList.toggle("clicked");

    // 注意書きを表示する
    warningMessage.style.display = "block";

    // 選択されたカテゴリーと保存メッセージを非表示にする
    selectedCategory.style.display = "none";
    successMessage.style.display = "none";
  }
}

// カテゴリーの選択が解除されたときに実行される関数
function deselectTag(element) {
  // クリックされたタグから選択解除クラスを削除
  element.parentNode.classList.remove("selected");
}

// カテゴリーの選択を解除するイベントリスナーを追加
var tags = document.querySelectorAll(".tag");
for (var i = 0; i < tags.length; i++) {
  tags[i].addEventListener("click", function (e) {
    var selectedTag = e.target.parentNode;
    if (selectedTag.classList.contains("selected")) {
      deselectTag(selectedTag);
    } else {
      // 選択されたタグに選択解除クラスを追加
      for (var j = 0; j < tags.length; j++) {
        if (tags[j].classList.contains("selected")) {
          deselectTag(tags[j]);
        }
      }
      selectedTag.classList.add("selected");
    }
  });
}

// アイコン変更リンクの要素を取得
var changeIconLink = document.getElementById("change-icon-link");

// アイコン変更リンクをクリックしたときの処理
changeIconLink.addEventListener("click", function (e) {
  e.preventDefault();
  // ファイル選択用の<input>要素を作成
  var fileInput = document.createElement("input");
  fileInput.type = "file";

  // ファイル選択時の処理
  fileInput.addEventListener("change", function () {
    var file = fileInput.files[0];
    if (file) {
      // 選択されたファイルを読み込んで表示
      var reader = new FileReader();
      reader.onload = function (e) {
        var imageSrc = e.target.result;
        document.getElementById("profile-image").src = imageSrc;
      };
      reader.readAsDataURL(file);
    }
  });

  // ファイル選択用の<input>要素をクリックしてファイルを選択
  fileInput.click();
});

// 初期アイコンのパス
var defaultIconPath =
  "https://drive.google.com/uc?export=view&id=1_CnXTZV6pTYNkyVqroB3rMZYgVw70VOD";

// ページ読み込み時に初期アイコンを表示
window.addEventListener("load", function () {
  var profileImage = document.getElementById("profile-image");
  profileImage.src = defaultIconPath;
});
