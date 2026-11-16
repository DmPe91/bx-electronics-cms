<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket",
    "shop", // ← наш шаблон из /local
    [
        "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
        "COLUMNS_LIST" => [
            0 => "NAME",
            1 => "DISCOUNT",
            // 2 => "PRICE",   ← УБРАЛИ: это колонка «цена за 1 шт» (дублирует «итого»)
            2 => "QUANTITY",
            3 => "SUM",
            // 4 => "PROPS",   ← можно убрать, если нет свойств у товаров
            4 => "DELETE",
            // 5 => "DELAY",   ← можно убрать, если не нужно «отложить»
        ],
        "AJAX_MODE" => "Y", // ← включили AJAX
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "PATH_TO_ORDER" => "/personal/order/make/",
        "HIDE_COUPON" => "N",
        "QUANTITY_FLOAT" => "N",
        "PRICE_VAT_SHOW_VALUE" => "Y",
        "TEMPLATE_THEME" => "site",
        "SET_TITLE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "",
        "OFFERS_PROPS" => [], // ← у вас нет SKU, можно оставить пустым
    ],
    false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>