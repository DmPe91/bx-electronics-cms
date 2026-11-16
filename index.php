<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Одежда\"");
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "hero_banner",
    [
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "4",
        "NEWS_COUNT" => "1",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "CACHE_TYPE" => "N", // пока отладка
        "CACHE_TIME" => "3600",
        "SET_TITLE" => "N",

        // 🔑 Вот это и есть решение:
        "PROPERTY_CODE" => [
            "BADGE_TEXT",
            "TITLE",
            "DESCRIPTION",
            "BUTTON1_TEXT",
            "BUTTON1_LINK",
            "BUTTON2_TEXT",
            "BUTTON2_LINK",
            "VISUAL_IMAGE",
            "VISUAL_NAME",
            "VISUAL_PRICE",
            "DISCOUNT_TEXT",
        ],
    ],
    false
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "advantages",
    [
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "5", // <-- ваш ID инфоблока «Преимущества»
        "NEWS_COUNT" => "10",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "SET_TITLE" => "N",
        "PROPERTY_CODE" => [
            "ICON",
        ],
    ],
    false
);?>

<?php
// Получаем ID значения «Да» для свойства IS_HIT
$enumId = null;
$enumRes = CIBlockPropertyEnum::GetList(
    ['SORT' => 'ASC'],
    ['IBLOCK_ID' => 6, 'CODE' => 'IS_HIT', 'VALUE' => 'Да']
);
if ($enum = $enumRes->Fetch()) {
    $enumId = $enum['ID'];
}

$GLOBALS['arrTopFilter'] = [
    'ACTIVE' => 'Y',
];
if ($enumId) {
    $GLOBALS['arrTopFilter']['PROPERTY_IS_HIT'] = $enumId;
}
?>


<section class="section">
    <div class="container">
        <div class="section__header">
               <?php $APPLICATION->IncludeFile(
        SITE_DIR . 'include/hits_header.php',
        [],
        [
            'MODE' => 'html', // разрешаем HTML (ссылки, span)
            'NAME' => 'Заголовок секции «Хиты продаж»', // подпись для менеджера
        ]
    ); ?>
        </div>

<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "hits_slider",
    [
        "IBLOCK_TYPE"        => "catalog",
        "IBLOCK_ID"          => "6",
        "BLOCK_ID" => "hitProducts",
        "SECTION_ID"         => "",          // пустая строка, не false
        "SHOW_ALL_WO_SECTION" => "Y",        // 👈 ключевой параметр
        "FILTER_NAME"        => "arrTopFilter",
        "ELEMENT_SORT_FIELD"  => "sort",
        "ELEMENT_SORT_ORDER"  => "asc",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER2" => "desc",
        "PAGE_ELEMENT_COUNT"  => "4",        // 👈 вместо ELEMENT_COUNT
        "LINE_ELEMENT_COUNT"  => "4",
        "PROPERTY_CODE"       => ["BRAND", "SPECS", "IS_NEW", "IS_HIT"],
        "PRICE_CODE"          => ["BASE"],
        "SHOW_OLD_PRICE"      => "Y",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "DETAIL_URL"          => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
        "CACHE_TYPE"          => "N",
        "CACHE_TIME"          => "3600",
        "SET_TITLE"           => "N",
        "ADD_PROPERTIES_TO_BASKET" => "Y",   // ← генерирует ADD_URL
"USE_PRODUCT_QUANTITY"     => "Y",   // ← генерирует ADD_URL
"AJAX_MODE"                => "Y",   // ← включает AJAX без перезагрузки
"AJAX_OPTION_JUMP"         => "N",
"AJAX_OPTION_HISTORY"      => "N",
    ],
    false
);?>

    </div>
</section>

<?php
// Фильтр для «Новинок»: активные товары со свойством IS_NEW = Да
$GLOBALS['arrNewFilter'] = [
    'ACTIVE' => 'Y',
    'PROPERTY_IS_NEW_VALUE' => 'Да',
];
?>

<section class="section section--gray">
    <div class="container">
         <div class="section__header">
          <?php $APPLICATION->IncludeFile(
        SITE_DIR . 'include/news_header.php',
        [],
        [
            'MODE' => 'html', // разрешаем HTML (ссылки, span)
            'NAME' => 'Заголовок секции «Новинки»', // подпись для менеджера
        ]
    ); ?>
       </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "hits_slider",   // 👈 тот же шаблон
            [
                "IBLOCK_TYPE"        => "catalog",
                "IBLOCK_ID"          => "6",
                "SECTION_ID"         => "",
                "SHOW_ALL_WO_SECTION" => "Y",
                "FILTER_NAME"        => "arrNewFilter",  // 👈 другой фильтр
                "ELEMENT_SORT_FIELD"  => "sort",
                "ELEMENT_SORT_ORDER"  => "asc",
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER2" => "desc",
                "PAGE_ELEMENT_COUNT"  => "4",
                "LINE_ELEMENT_COUNT"  => "4",
                "PROPERTY_CODE"       => ["BRAND_REF", "SPECS", "IS_NEW", "IS_HIT"],
                "PRICE_CODE"          => ["BASE"],
                "SHOW_OLD_PRICE"      => "Y",
                "SHOW_DISCOUNT_PERCENT" => "Y",
                "DETAIL_URL"          => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
                "CACHE_TYPE"          => "N",  // пока отладка
                "CACHE_TIME"          => "3600",
                "SET_TITLE"           => "N",
                "ADD_PROPERTIES_TO_BASKET" => "Y",   // ← генерирует ADD_URL
"USE_PRODUCT_QUANTITY"     => "Y",   // ← генерирует ADD_URL
"AJAX_MODE"                => "Y",   // ← включает AJAX без перезагрузки
"AJAX_OPTION_JUMP"         => "N",
"AJAX_OPTION_HISTORY"      => "N",
            ],
            false
        );?>
    </div>
</section>

<?php
$GLOBALS['arrBrandsFilter'] = [
    'ACTIVE' => 'Y',
    'PROPERTY_SHOW_ON_MAIN_VALUE' => 'Да',
];
?>

<section class="section">
    <div class="container">
        <h2 class="section__title" style="text-align:center;margin-bottom:30px">Наши бренды</h2>

        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "brands_main", // имя кастомного шаблона
            [
                "IBLOCK_TYPE"   => "content",
                "AJAX_MODE" => "Y",
                "IBLOCK_ID"     => "7", // ID инфоблока «Бренды» (узнайте в админке)
                "NEWS_COUNT"    => "10",
                "SORT_BY1"      => "SORT",
                "SORT_ORDER1"   => "ASC",
                "FILTER_NAME"   => "arrBrandsFilter",
                "PROPERTY_CODE" => ["LOGO", "DESCRIPTION", "SHOW_ON_MAIN"],
                "CACHE_TYPE"    => "A",
                "CACHE_TIME"    => "3600",
                "SET_TITLE"     => "N",
            ],
            false
        );?>
    </div>
</section>

<?php require($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/include/blocks/cta.php'); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>