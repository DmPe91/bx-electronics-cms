<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
?>
<section class="advantages">
    <div class="container">
        <div class="advantages__grid">
            <?php foreach ($arResult['ITEMS'] as $arItem): ?>
                <?php
                $this->AddEditAction(
                    $arItem['ID'],
                    $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT')
                );
                $this->AddDeleteAction(
                    $arItem['ID'],
                    $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE')
                );

                $icon        = $arItem['PROPERTIES']['ICON']['VALUE'] ?? '';
                $title       = $arItem['NAME'] ?? '';
                $description = $arItem['PREVIEW_TEXT'] ?? '';
                ?>
                <div class="advantages__item" id="<?= $this->GetEditAreaId($arItem['ID']) ?>">
                    <div class="advantages__icon"><?= htmlspecialchars($icon) ?></div>
                    <div class="advantages__title"><?= htmlspecialchars($title) ?></div>
                    <div class="advantages__desc"><?= htmlspecialchars($description) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>