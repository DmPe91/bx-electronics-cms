(function () {
  "use strict";

  document.addEventListener("click", function (e) {
    var btn = e.target.closest(".js-add-to-basket");
    if (!btn) return;
    e.preventDefault();

    var id = btn.dataset.productId;
    if (!id) return;

    btn.disabled = true;
    var oldText = btn.textContent;

    fetch("/local/ajax/add-to-basket.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id=" + encodeURIComponent(id) + "&quantity=1",
    })
      .then(function (r) {
        return r.json();
      })
      .then(function (data) {
        if (data.STATUS === "OK") {
          if (window.BX) {
            BX.onCustomEvent("OnBasketChange");
          }
          btn.textContent = "В корзине";
          setTimeout(function () {
            btn.textContent = oldText;
            btn.disabled = false;
          }, 1500);
        } else {
          alert(data.MESSAGE || "Не удалось добавить товар");
          btn.disabled = false;
        }
      })
      .catch(function (err) {
        console.error("add-to-basket:", err);
        alert("Ошибка соединения");
        btn.disabled = false;
      });
  });
})();
