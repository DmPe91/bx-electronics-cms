<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$sectionId = (int)($arResult['VARIABLES']['SECTION_ID'] ?? 0);
$sectionCode = $arResult['VARIABLES']['SECTION_CODE'] ?? '';

// Если SECTION_ID пустой - попробуй получить из COMPONENT_PARAMS
if ($sectionId <= 0 && !empty($component->arParams['SECTION_ID'])) {
    $sectionId = (int)$component->arParams['SECTION_ID'];
}

// Отладка
echo "<!-- Отладка: SECTION_ID={$sectionId}, SECTION_CODE={$sectionCode} -->";

$pageTitle = 'Каталог';
if ($sectionId > 0) {
    $section = CIBlockSection::GetByID($sectionId)->GetNext();
    if ($section) {
        $pageTitle = $section['NAME'];
    }
}
?>


<div class="catalog-page__header container">
    <h1><?= htmlspecialchars($pageTitle) ?></h1>
</div>

<div class="catalog-page__layout container">
    <aside class="catalog-page__sidebar">
        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:catalog.smart.filter',
            'custom',
            [
                'IBLOCK_TYPE'     => $arParams['IBLOCK_TYPE'],
                'IBLOCK_ID'       => $arParams['IBLOCK_ID'],
                'SECTION_ID'      => $sectionId > 0 ? $sectionId : '',
                'SECTION_CODE'    => $sectionCode,
                'FILTER_NAME'     => $arParams['FILTER_NAME'],
                'PRICE_CODE'      => ['BASE'],
                'CACHE_TYPE'      => $arParams['CACHE_TYPE'],
                'CACHE_TIME'      => $arParams['CACHE_TIME'],
                'SAVE_IN_SESSION' => 'N',
                'INSTANT_RELOAD'  => 'N',
            ],
            $component
        );
        ?>
    </aside>

    <div class="catalog-page__content">
        <?php
        // Установим фильтр вручную если он пустой
        if (empty($GLOBALS[$arParams['FILTER_NAME']])) {
            $GLOBALS[$arParams['FILTER_NAME']] = ['ACTIVE' => 'Y'];
        }
        
        $APPLICATION->IncludeComponent(
            'bitrix:catalog.section',
            'custom',
            [
                'IBLOCK_TYPE'           => $arParams['IBLOCK_TYPE'],
                'IBLOCK_ID'             => $arParams['IBLOCK_ID'],
                'SECTION_ID'            => $sectionId > 0 ? $sectionId : '',
                'SECTION_CODE'          => $sectionCode,
                'FILTER_NAME'           => $arParams['FILTER_NAME'],
                'PAGE_ELEMENT_COUNT'    => '12',
                'PROPERTY_CODE'         => ['BRAND_REF', 'SPECS', 'IS_NEW', 'IS_HIT'],
                'PRICE_CODE'            => ['BASE'],
                'SHOW_OLD_PRICE'        => 'Y',
                'INCLUDE_SUBSECTIONS'   => 'Y',
                'CACHE_TYPE'            => $arParams['CACHE_TYPE'],
                'CACHE_TIME'            => $arParams['CACHE_TIME'],
            ],
            $component
        );
        ?>
    </div>
</div>