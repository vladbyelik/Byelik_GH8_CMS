/**
 * @file
 * Custom scripts for theme.
 */

function clickedOnTabHead (ev) {
  const target = ev.target;
  const headChildren = [...target.parentNode.children];
  const contentChildren = [...target.parentNode.parentNode.querySelector(".custom-tab-contents").children];
  const index = headChildren.indexOf(target);
  target.parentNode.querySelectorAll(".custom-tab-head").forEach(function (headEl) {
    headEl.classList.remove("active");
    if (headChildren.indexOf(headEl) === index) {
      headEl.classList.add("active");
    }
  });
  target.parentNode.parentNode.querySelectorAll(".custom-tab-contents .custom-tab-content")
    .forEach(function (contentEl) {
      contentEl.classList.remove("active");
      if (contentChildren.indexOf(contentEl) === index) {
        contentEl.classList.add("active");
      }
    });
}

window.addEventListener("load", function () {
  document.querySelectorAll(".custom-tabs").forEach(function (el) {
    el.querySelectorAll("header .custom-tab-head").forEach(function (headEl) {
      headEl.addEventListener("click", function (ev) {
        clickedOnTabHead(ev, )
      });
    });
  });
});