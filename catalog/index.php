<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:catalog",
    "custom",
    [
        "IBLOCK_TYPE"         => "catalog",
        "IBLOCK_ID"           => "6",
        "AJAX_MODE"           => "Y",
        "AJAX_OPTION_JUMP"    => "N",
        "AJAX_OPTION_HISTORY" => "Y",
        "SEF_MODE"            => "Y",
        "SEF_FOLDER"          => "/catalog/",
        "SEF_URL_TEMPLATES"   => [
            "sections" => "",
            "section"  => "#SECTION_CODE#/",
            "element"  => "#SECTION_CODE#/#ELEMENT_CODE#/",
        ],
        "USE_FILTER"          => "Y",
        "FILTER_NAME"         => "arrFilter",
        "CACHE_TYPE"          => "A",
        "CACHE_TIME"          => "3600",
        "CACHE_GROUPS"        => "N",
        "SET_TITLE"           => "Y",
        "ADD_SECTION_CHAIN"   => "N",
        "ADD_ELEMENT_CHAIN"   => "N",
		'PRICE_CODE' => ['BASE'],
    ],
    false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>