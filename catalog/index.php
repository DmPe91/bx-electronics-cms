<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:catalog",
    "custom",
    [
        "IBLOCK_TYPE"         => "catalog",
        "IBLOCK_ID"           => "6",
        "SEF_MODE"            => "Y",
        "SEF_FOLDER"          => "/catalog/",
        "SEF_URL_TEMPLATES"   => [
            "sections" => "",
            "section"  => "#SECTION_CODE#/",
            "element"  => "#SECTION_CODE#/#ELEMENT_CODE#/",
        ],
        "USE_FILTER"          => "Y",
        "FILTER_NAME"         => "arrFilter",
        "FILTER_VIEW_MODE"    => "VERTICAL",
        "CACHE_TYPE"          => "A",
        "CACHE_TIME"          => "3600",
        
        // Добавь эти параметры:
        "LIST_PROPERTY_CODE"  => ['BRAND_REF', 'SPECS', 'IS_NEW', 'IS_HIT'],
        "LIST_PRICE_CODE"     => ['BASE'],
        "LIST_DISPLAY_COMPARE" => "N",
        "LIST_PAGE_ELEMENT_COUNT" => "12",
        
        "DETAIL_PROPERTY_CODE" => ['BRAND_REF', 'SPECS', 'IS_NEW', 'IS_HIT'],
        "DETAIL_PRICE_CODE"    => ['BASE'],
        
        "ADD_SECTION_CHAIN"   => "N",
        "ADD_ELEMENT_CHAIN"   => "N",
    ],
    false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>