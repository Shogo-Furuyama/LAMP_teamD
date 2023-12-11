function toggleTag(element) {
  // すべてのタグから選択解除クラスを削除
  var tags = document.querySelectorAll(".tag");
  for (var i = 0; i < tags.length; i++) {
    tags[i].classList.remove("selected");
  }

  // クリックされたタグに選択解除クラスを追加
  element.parentNode.classList.add("selected");
}

/*===================================================================================-*/

/*==================================================================================-*/

/*===================================================================================-*/

function saveCategory() {
  /*
  var selectedTag = document.querySelector(".tag.selected");
  var saveButton = document.querySelector(".save-button");
  var warningMessage = document.getElementById("warning-message");
  var selectedCategory = document.getElementById("selected-category");
  var categoryName = document.getElementById("category-name");
  var successMessage = document.getElementById("success-message");

  //カテゴリーが設定しているか確認して表示する文字を変える
  if (selectedTag) {
    var category = selectedTag.textContent.trim();
    categoryName.textContent = category;

    // 選択されたカテゴリーの保存処理を行います
    console.log("選択されたカテゴリー: " + category);

    // ボタンのクリックスタイルを反転させる
    //saveButton.classList.toggle("clicked");

    // 注意書きを非表示にする
    warningMessage.style.display = "none";

    // 選択されたカテゴリーと保存メッセージを表示する
    selectedCategory.style.display = "block";
    successMessage.style.display = "block";
  } else {
    // ボタンのクリックスタイルを反転させる
    //saveButton.classList.toggle("clicked");

    // 注意書きを表示する
    warningMessage.style.display = "block";

    // 選択されたカテゴリーと保存メッセージを非表示にする
    selectedCategory.style.display = "none";
    successMessage.style.display = "none";
  }
  */
}

// カテゴリーの選択が解除されたときに実行される関数
function deselectTag(element) {
  // クリックされたタグから選択解除クラスを削除
  element.parentNode.classList.remove("selected");
}

// カテゴリーの選択を解除するイベントリスナーを追加
/*
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
*/

/*===================================================================================-*/

// アイコン変更リンクの要素を取得
var changeIconLink = document.getElementById("change-icon-link");

// アイコン変更リンクをクリックしたときの処理
changeIconLink.addEventListener("click", function (e) {
  // ファイル選択用の<input>要素を取得
  var fileInput = document.querySelector("[name='input-iconfile']");

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
//var defaultIconPath = "./img/default_icon.png";

//パンドラの箱;
/*
var defaultIconPath =
  "https://i.gzn.jp/img/2018/01/15/google-gorilla-ban/00.jpg";
*/

// ページ読み込み時に初期アイコンを表示
window.addEventListener("load", function () {
  /*
  var profileImage = document.getElementById("profile-image");
  profileImage.src = defaultIconPath;
  */
  
  const alertNode = document.querySelector(".alert");
  if (alertNode != null) {
    alertNode.addEventListener('animationend', () => {
      alertNode.remove();
    });
  }

  const default_category = document.getElementById('default_category').value;
  if (default_category != '') {
    document.querySelector('.tag-cloud').querySelectorAll('input').forEach((input) => {
      if (input.value == default_category) {
        input.click();
      }
    });
  }
});

function save(i, event) {
  switch (i) {
    case 1:
      const nameNode = document.querySelector('[name="profile_name"]');
      if(!nameNode.value.match('^.{1,20}$')){
        const dangerDiv1 = document.getElementById('dangerDiv1');
        dangerDiv1.innerText = '1字以上20字以内で入力してください。';
        event.preventDefault();
      }else {
        document.form1.append(document.querySelector('[name="submit_id"]'));
      }
      break;
    case 2:
      const CommentNode = document.querySelector('[name="profile_comment"]');
      if(!CommentNode.value.match('^[\\s\\S]{0,200}$')){
        const dangerDiv2 = document.getElementById('dangerDiv2');
        dangerDiv2.innerText = '200字以内で入力してください。';
        event.preventDefault();
      }else {
        document.form2.append(document.querySelector('[name="submit_id"]'));
      }
      break;
    case 3:
      let selectedTag = document.querySelector(".tag.selected");
      if (!selectedTag) {
        document.getElementById("warning-message").style.display = "block";
        event.preventDefault();
      }else {
        document.form3.append(document.querySelector('[name="submit_id"]'));
      }
      break;
    case 4:
      const countNode = document.querySelector('[name="profile_count"]');
      if(!countNode.value.match('^([1-9]{1}[0-9]{0,8}|0)$')){
        const dangerDiv4 = document.getElementById('dangerDiv4');
        dangerDiv4.innerText = '0以上の整数で入力してください。';
        event.preventDefault();
      }else {
        document.form4.append(document.querySelector('[name="submit_id"]'));
      }
      break;
    case 5:
      document.form5.append(document.querySelector('[name="submit_id"]'));
      break;
    default:
      event.preventDefault();
      break;
  }
}

function modalOpen() {
  document.getElementById('easyModal').style.display = 'flex';
  document.body.style.overflow = 'hidden';
}

function modalClose() {
  document.getElementById('easyModal').style.display = 'none';
  document.body.style.overflow = 'auto';
}


const search_keyword = document.getElementById('search_keyword');
search_keyword.onkeydown = function(event) {
  if (event.key === 'Enter') {
    bookSearchClick();
  }
}

let keyword = '';
let sDorp = 0;
let sDorpActive = 0;


function bookSearchClick() {
  if (!search_keyword.value.match('[^ 　]+')) {
    return;
  }
  sDorp = sDorpActive;
  keyword = search_keyword.value;
  if (sDorp == 2) {
    keyword = keyword.replaceAll('-', '').replaceAll(' ', '').replaceAll('　', '');
    if(!keyword.match('^([0-9]{9}[0-9X]{1}|[0-9]{12}[0-9X]{1})$')) {
    alert('ISBNの形式が正しくありません。\nスペースを含めず、すべて半角英数字で入力してください。');
    return;
  }
}
bookSearch(1);
}

function sDropClick(i) {
  switch (i) {
    case 0:
    case 1:
    case 2:
      if (i != sDorpActive) {
        document.getElementById('sd_' + i).classList.add('active');
        document.getElementById('s_drop_btn').innerText = sDorpText(i);
        document.getElementById('sd_' + sDorpActive).classList.remove('active');
        sDorpActive = i;
      }
      default:
        return;
        break;
  }
}

function sDorpText(i) {
  switch (i) {
    case 0:
      return 'タイトル';
    case 1:
      return '著者';
    case 2:
      return 'ISBN';
    default:
      break;
  }
  return null;
}

async function bookSearch(page) {
  let jsonObj = null;
  let promise = new Promise(function(end) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4) {
        let success = xmlhttp.status == 200;
        if (success) {
          try {
            jsonObj = JSON.parse(xmlhttp.responseText);
          } catch (e) {
            success = false;
          }
        }
        if (!success) {
          alert('検索に失敗しました。\n時間をおいて再度実行してください。');
        }
        end();
      }
    }
    xmlhttp.open("GET", "./booksearch.php?" + new URLSearchParams({k:encodeURIComponent(keyword),page:page,sf:sDorp}).toString());
    xmlhttp.send();
  });
  await promise;
  const search_div = document.getElementById('search_result');
  const new_search_div = search_div.cloneNode(false);
  const search_div_parent = document.getElementById('search');
  search_div.remove();
  search_div_parent.prepend(new_search_div);
  if (jsonObj == null) {
    return;
  }
  let hitNum = document.createElement('p');
  const searchFlagtext = sDorpText(sDorp);
  hitNum.innerText = keyword + 'と' + searchFlagtext + '検索\n' + jsonObj.count + '件ヒットしました';
  initPager(jsonObj.count, page, jsonObj.limit);
  new_search_div.appendChild(hitNum);
  let i = 0;
  jsonObj.books.forEach(book => {
    new_search_div.appendChild(create_search_book(book.id, i, book.title, book.authors, book.link));
    ++i;
  });
  search_div_parent.scrollTop = 0;
}

function initPager(count, m_page, limit) {
  let pagemax = Math.floor(count / limit);
  if (count % limit != 0) {
    ++pagemax;
  }

  let maxflag = false;
  let minflag = false;
  if (m_page == 1) {
    for (let id = 1; id <= 3; ++id) {
      const page = document.getElementById('page_' + id);
      if (id <= pagemax) {
        page.querySelector('a').innerText = id;
        page.style.display = 'inline';
      } else {
        page.style.display = 'none';
      }
      if (id == 1) {
        page.classList.add('active');
      } else {
        page.classList.remove('active');
      }
    }
    maxflag = 3 < pagemax;
  } else if (m_page == pagemax) {
    for (let id = 3, pageNum = m_page; id > 0; --id, --pageNum) {
      const page = document.getElementById('page_' + id);
      if (pageNum > 0) {
        page.querySelector('a').innerText = pageNum;
        page.style.display = 'inline';
      } else {
        page.style.display = 'none';
      }
      if (id == 3) {
        page.classList.add('active');
      } else {
        page.classList.remove('active');
      }
    }
    minflag = m_page > 3;
  } else {
    const page1 = document.getElementById('page_1');
    page1.querySelector('a').innerText = m_page - 1;
    page1.style.display = 'inline';
    page1.classList.remove('active');
    const page2 = document.getElementById('page_2');
    page2.querySelector('a').innerText = m_page;
    page2.style.display = 'inline';
    page2.classList.add('active');
    const page3 = document.getElementById('page_3');
    page3.querySelector('a').innerText = m_page + 1;
    page3.style.display = 'inline';
    page3.classList.remove('active');
    maxflag = m_page + 1 < pagemax;
    minflag = m_page - 1 > 1;
  }

  const page4 = document.getElementById('page_4');
  document.getElementById('page_0').style.display = minflag ? 'inline' : 'none';
  if (maxflag) {
    page4.style.display = 'inline';
    page4.querySelector('span').innerText = pagemax;
  } else {
    page4.style.display = 'none';
  }
}

function searchPageListener(i) {
  switch (i) {
    case 0:
      bookSearch(1);
      break;
    case 1:
    case 2:
    case 3:
      bookSearch(Number(document.getElementById('page_' + i).querySelector('a').innerText));
      break;
    case 4:
      bookSearch(Number(document.getElementById('page_4').querySelector('span').innerText));
      break;
    default:
      return;
      break;
  }
}

function create_search_book(id, i, title, authors, link) {
  let searchImg = document.createElement('div');
  searchImg.classList.add('search_img');
  let img = document.createElement('img');
  img.src = link;
  searchImg.appendChild(img);

  let infoDiv = document.createElement('div');
  infoDiv.classList.add('search_info');

  let h3 = document.createElement('h3');
  h3.innerText = title;
  let h5 = document.createElement('h5');
  h5.innerText = authors;
  let button = document.createElement('button');
  button.classList.add('btn', 'btn-primary');
  button.type = ' button';
  button.innerText = '登録';
  button.addEventListener('click', bookRegisterListener(id, i));
  let inputId = document.createElement('input');
  inputId.type = 'hidden';
  inputId.value = id;
  infoDiv.append(h3, h5, button, inputId)

  let div = document.createElement('div');
  div.id = 'search_' + i;
  div.append(searchImg, infoDiv);

  let reg = document.createElement('span');
  reg.innerText = '登録しました';

  let parent = document.createElement('div');
  parent.append(div, reg);

  return parent;
}

function bookRegisterListener(id, i) {
  return function(e) {
    const div = document.getElementById('search_' + i);
    const bookImgAnker = document.getElementById('favorite_book_img');
    bookImgAnker.classList.remove('favorite_default_book');
    let img = bookImgAnker.querySelector('img');
    if (img == null) {
      img = document.createElement('img');
      bookImgAnker.append(img);
    }
    img.src = div.querySelector('.search_img').querySelector('img').src;
    document.getElementById('favorite_book_title').innerText = div.querySelector('h3').innerText;
    document.querySelector('[name="favorite_book_id"]').value = div.querySelector('input').value;
    modalClose();
  }
}

function favoritBookDef() {
  const bookImgAnker = document.getElementById('favorite_book_img');
  let img = bookImgAnker.querySelector('img');
  if (img != null) {
    img.remove();
  }
  bookImgAnker.classList.add('favorite_default_book');
  document.getElementById('favorite_book_title').innerText = '';
  document.querySelector('[name="favorite_book_id"]').value = '';
}
