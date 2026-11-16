<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponent $component */

$sectionId = (int)($arResult['VARIABLES']['SECTION_ID'] ?? 0);
$pageTitle = 'Каталог';
$pageSubtitle = 'Оригинальная техника Apple и Google с доставкой по России';
if ($sectionId > 0) {
    $section = CIBlockSection::GetByID($sectionId)->GetNext();
    if ($section) {
        $pageTitle = $section['NAME'];
    }
}
if ($sectionId <= 0) {
    $sectionId = 21; // 👈 ID раздела «Все товары»
}
?>
<div class="catalog-page__header container" style="margin-bottom:24px;">
    <h1 style="font-size:28px;font-weight:700;color:#374151;margin-bottom:4px;">
        <?= htmlspecialchars($pageTitle) ?>
    </h1>
    <?php if ($sectionId <= 0): ?>
        <p style="color:#6b7280;"><?= htmlspecialchars($pageSubtitle) ?></p>
    <?php endif; ?>
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
                'SECTION_ID'      => $sectionId,
                'FILTER_NAME'     => $arParams['FILTER_NAME'],
                'PRICE_CODE'      => ['BASE'],
                'CACHE_TYPE'      => $arParams['CACHE_TYPE'],
                'CACHE_TIME'      => $arParams['CACHE_TIME'],
                'CACHE_GROUPS'    => $arParams['CACHE_GROUPS'],
                'SAVE_IN_SESSION' => 'N',
                'INSTANT_RELOAD'  => 'Y',
                'AJAX_MODE'       => 'Y',
            ],
            $component
        );
        ?>
    </aside>

    <div class="catalog-page__content">
        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:catalog.section',
            'custom',
            [
                'IBLOCK_TYPE'           => $arParams['IBLOCK_TYPE'],
                'IBLOCK_ID'             => $arParams['IBLOCK_ID'],
                'SECTION_ID'            => $sectionId,
                'FILTER_NAME'           => $arParams['FILTER_NAME'],
                'PAGE_ELEMENT_COUNT'    => '12',
                'PROPERTY_CODE'         => ['BRAND_REF', 'SPECS', 'IS_NEW', 'IS_HIT', 'OLD_PRICE'],
                'PRICE_CODE' => ['BASE'], // или $arParams['PRICE_CODE']
                'SHOW_OLD_PRICE'        => 'Y',
                'SHOW_DISCOUNT_PERCENT' => 'Y',
                'AJAX_MODE'             => 'Y',
                'AJAX_OPTION_JUMP'      => 'N',
                'AJAX_OPTION_HISTORY'   => 'Y',
                'CACHE_TYPE'            => $arParams['CACHE_TYPE'],
                'CACHE_TIME'            => $arParams['CACHE_TIME'],
                'CACHE_GROUPS'          => $arParams['CACHE_GROUPS'],
            ],
            $component
        );
        ?>
    </div>
</div>