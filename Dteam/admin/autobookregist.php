<?php
    // exit;

    require_once("inc_base.php");
    require_once($CMS_COMMON_INCLUDE_DIR . "libs.php");
    require_once($CMS_COMMON_INCLUDE_DIR . "auth_adm.php");

    if(isset($_POST['title']) && isset($_POST['authors']) && isset($_POST['publishedDate']) && isset($_POST['pageCount']) && isset($_POST['price']) && isset($_POST['isbn'])) {
        if(preg_match('/^[0-9]{9}[0-9X]{1}$/',$_POST['isbn']) && (new cbook())->get_tgt_isbn(false, $_POST['isbn']) === false) {
            $data = array();
            $data['book_title'] = $_POST['title'];
            $data['authors'] = $_POST['authors'];
            $data['release_date'] = $_POST['publishedDate'];
            $data['page'] = $_POST['pageCount'];
            $data['price'] = $_POST['price'];
            $data['isbn'] = $_POST['isbn'];
            if(isset($_POST['link'])) {
                $data['image_link'] = $_POST['link'];
            }
            $data['stock'] = 20;
            (new cchange_ex())->insert(false, 'book_table', $data);
        }
        exit;
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <style>
        #loadIcon,#loadIcon2 {
            width: 1rem;
            height: auto;
        }

        .loading {
            animation: loadingAnm 1s linear infinite;
        }

        @keyframes loadingAnm {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
        
        .img {
            height: 110px;
            width: auto;
        }

        .bigCheck {
            width: 35px;
            height: 35px;
        }
        
        #btable > tbody > tr > td {
            padding: 0 10px;
        }
    </style>
</head>
<body>
    <div>
        <input type="search" id="keyword" placeholder="キーワード">
        <button type="button" onclick="start()">検索</button>
        <img id="loadIcon" src="https://icooon-mono.com/i/icon_11972/icon_119720_256.png">
    </div>
    <div>
        最大取得書籍数：
        <input type="number" value="50" min="1" max="1000" id="num">
    </div>
    <table border="1" id="btable">
        <thead>
            <tr>
                <th scope="col">db登録</th>
                <th scope="col">isbn</th>
                <th scope="col">Image</th>
                <th scope="col">タイトル</th>
                <th scope="col">著者</th>
                <th scope="col">発売日</th>
                <th scope="col">ページ</th>
                <th scope="col">価格</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div>
        <button type="button" onclick="dbInsert()">データベースへ登録</button>
        <img id="loadIcon2" src="https://icooon-mono.com/i/icon_11972/icon_119720_256.png">
    </div>
    <script>
        const keywordNode = document.getElementById('keyword');
        const num = document.getElementById('num');
        const btable = document.getElementById('btable');
        const UNDEFINED = 'undefined';
        const NOT_MATURE = 'NOT_MATURE';
        const ISBN_10 = 'ISBN_10';

        let runFlag = false;

        async function start() {
            if(runFlag) {
                return;
            }
            runFlag = true;
            const lIcon = document.getElementById('loadIcon');
            try {
                lIcon.classList.add('loading');
                const books = [];
                const keyword = keywordNode.value;
                const tbody = document.createElement('tbody');
                btable.querySelector('tbody').remove();
                btable.append(tbody);

                let i = 0;
                for (let reg = 0,count = num.value; reg < count; ++i) {
                    let jsonObj = null;
                    let promise = new Promise(function (end) {
                        let xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4) {
                                if (xmlhttp.status == 200) {
                                    try {
                                        jsonObj = JSON.parse(xmlhttp.responseText);
                                    } catch (e) { }
                                }
                                end();
                            }
                        }
                        xmlhttp.open('GET', 'https://www.googleapis.com/books/v1/volumes?printType=books&orderBy=newest&langRestrict=ja&maxResults=30&' + new URLSearchParams({ startIndex: i * 30, q: keyword }).toString());
                        xmlhttp.send();
                    });
                    await promise;
                    if (jsonObj == null || typeof jsonObj.items == UNDEFINED) {
                        break;
                    }
                    for (let j = 0, length = jsonObj.items.length; j < length; ++j) {
                        const itemVol = jsonObj.items[j].volumeInfo;
                        if (itemVol.maturityRating == NOT_MATURE && typeof itemVol.industryIdentifiers != UNDEFINED) {
                            let isbn = null;
                            for (let l = 0, lCount = itemVol.industryIdentifiers.length; l < lCount; ++l) {
                                const type = itemVol.industryIdentifiers[l].type;
                                if (type == ISBN_10) {
                                    isbn = itemVol.industryIdentifiers[l].identifier;
                                    break;
                                }
                            }
                            if (isbn != null && !books.includes(isbn)) { 
                                let title = itemVol.title;
                                let price = 0;        
                                let link = null;
                                let authors = null;
                                let publishedDate = null;
                                let pageCount = 0;
                                if (typeof itemVol.imageLinks != UNDEFINED && itemVol.imageLinks.thumbnail != UNDEFINED) {
                                    link = itemVol.imageLinks.thumbnail;
                                }
                                if (typeof itemVol.authors != UNDEFINED) {
                                    authors = itemVol.authors[0];
                                    let aCount = itemVol.authors.length;
                                    if (aCount != 1) {
                                        for (let aI = 1; aI < aCount; ++aI) {
                                            authors += "　" + itemVol.authors[aI];
                                        }
                                    }
                                }
                                if (typeof itemVol.publishedDate != UNDEFINED) {
                                    publishedDate = itemVol.publishedDate;
                                }
                                if (typeof itemVol.pageCount != UNDEFINED) {
                                    pageCount = itemVol.pageCount;
                                }
                                if (authors != null && publishedDate != null && pageCount != 0 && title.length <= 100 && authors.length <= 30) {
                                    let opendb = null;
                                    promise = new Promise(function (end) {
                                        let xmlhttp = new XMLHttpRequest();
                                        xmlhttp.onreadystatechange = function () {
                                            if (xmlhttp.readyState == 4) {
                                                if (xmlhttp.status == 200) {
                                                    try {
                                                        opendb = JSON.parse(xmlhttp.responseText);
                                                    } catch (e) { }
                                                }
                                                end();
                                            }
                                        }
                                        xmlhttp.open('GET', 'https://api.openbd.jp/v1/get?isbn=' + isbn);
                                        xmlhttp.send();
                                    });
                                    await promise;
                                    if(opendb[0] != null) {
                                        try {
                                            price = opendb[0].onix.ProductSupply.SupplyDetail.Price[0].PriceAmount;
                                            if(link == null && opendb[0].summary.cover != '') {
                                                link = opendb[0].summary.cover;
                                            }                                    
                                        } catch (e) { }
                                    }
                                    if (price != 0) {
                                        isbn = isbn.replaceAll('-','');
                                        books.push(isbn);
                                        const tr = document.createElement('tr');
                                        tr.append(
                                            geneTdDbRegistInput('dbr_' + reg),
                                            geneTd(isbn),
                                            geneTdImg(link),
                                            geneTd(title),
                                            geneTd(authors),
                                            geneTd(publishedDate),
                                            geneTd(pageCount),
                                            geneTd(price),
                                            geneHiddenInput('isbn_' + reg,isbn),
                                            geneHiddenInput('title_' + reg,title),
                                            geneHiddenInput('authors_' + reg,authors),
                                            geneHiddenInput('publishedDate_' + reg,publishedDate),
                                            geneHiddenInput('pageCount_' + reg,pageCount),
                                            geneHiddenInput('price_' + reg,price)
                                        );
                                        if(link != null) {
                                            tr.append(geneHiddenInput('link_' + reg,link));
                                        }
                                        tbody.append(tr);
                                        ++reg;
                                        if(reg >= count) {
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } finally {
                runFlag = false;
                lIcon.classList.remove('loading');
                alert('完了しました。');
            }
        }

        async function dbInsert() {
            if(runFlag) {
                return;
            }
            runFlag = true;
            const lIcon = document.getElementById('loadIcon2');
            try{
                lIcon.classList.add('loading');
                let i = 0;
                while (true) {
                    const dbrNode = document.getElementById('dbr_' + i);
                    if(dbrNode == null) {
                        break;
                    }
                    if(dbrNode.checked) {
                        const isbnNode = document.getElementById('isbn_' + i);
                        const titleNode = document.getElementById('title_' + i);
                        const authorsNode = document.getElementById('authors_' + i);
                        const publishedDateNode = document.getElementById('publishedDate_' + i);
                        const pageCountNode = document.getElementById('pageCount_' + i);
                        const priceNode = document.getElementById('price_' + i);
                        const linkNode = document.getElementById('link_' + i);
                        const params = new URLSearchParams();
                        params.append('isbn',isbnNode.value);
                        params.append('title',titleNode.value);
                        params.append('authors',authorsNode.value);
                        params.append('publishedDate',publishedDateNode.value);
                        params.append('pageCount',pageCountNode.value);
                        params.append('price',priceNode.value);
                        if(linkNode != null) {
                            params.append('link',linkNode.value);
                        }
                        let promise = new Promise(function(end) {
                            let xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4) {
                                    end();
                                }
                            }
                            xmlhttp.open('POST', 'autobookregist.php');
                            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xmlhttp.send(params.toString());
                        });
                        await promise;
                    }
                    ++i;
                }
            }finally {
                runFlag = false;
                lIcon.classList.remove('loading');
                alert('登録処理が完了しました。')
            }    
        }

        function geneTd(innerText) {
            const td = document.createElement('td');
            td.innerText = innerText;
            return td;
        }

        function geneTdImg(src) {
            const td = document.createElement('td');
            const img = document.createElement('img');
            if(src == null) {
                src = './img/book_no_image.jpg';
            }
            img.src = src;
            img.classList.add('img');
            td.append(img);
            return td;
        }

        function geneTdDbRegistInput(id) {
            const td = document.createElement('td');
            const input = document.createElement('input');
            input.type = 'checkbox';
            input.checked = true;
            input.classList.add('bigCheck')
            input.id = id
            td.append(input);
            return td;
        }

        function geneHiddenInput(id,value) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.id = id
            input.value = value;
            return input;
        }
    </script>
</body>
</html>