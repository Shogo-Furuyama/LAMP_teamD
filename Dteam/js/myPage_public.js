"use strict";

const Tabs = {
  init() {
    this.$tabs = document.querySelectorAll(".custom-tabs a");
    this.bindEvents();
    this.checkHash();
  },

  bindEvents() {
    for (const tab of this.$tabs) {
      tab.addEventListener("click", this.tabClicked.bind(this));
    }
  },

  checkHash() {
    if (window.location.hash) {
      this.toggleTab(window.location.hash);
    }
  },

  tabClicked(e) {
    e.preventDefault();

    // クリックされたタブの親要素のliを取得
    const clickedTabLi = e.target.closest("li");

    // すべてのタブの背景色を初期化
    this.resetTabBackgrounds();

    // クリックされたタブと対応するコンテンツの背景色を変更
    clickedTabLi.classList.add("active");
    const tabContentId = e.target.getAttribute("href");
    document.querySelector(tabContentId).classList.add("is-active");
  },

  resetTabBackgrounds() {
    const tabLis = document.querySelectorAll(".custom-tabs li");
    for (const tabLi of tabLis) {
      tabLi.classList.remove("active");
      const tabContentId = tabLi.querySelector("a").getAttribute("href");
      document.querySelector(tabContentId).classList.remove("is-active");
    }
  },
};

Tabs.init();
