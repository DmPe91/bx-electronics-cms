<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
<div class="brands-grid">
    <?php foreach ($arResult['ITEMS'] as $arItem): ?>
        <?php
        // Регистрируем зону редактирования — даёт иконку «карандаш» в режиме правки
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

        $name = $arItem['NAME'] ?? '';

        // Логотип
        $logoId = $arItem['PROPERTIES']['LOGO']['VALUE'] ?? 0;
        $logo = $logoId ? CFile::GetPath($logoId) : '';

        // Описание (может быть HTML-свойством — массив с ключом TEXT)
        $descRaw = $arItem['PROPERTIES']['DESCRIPTION']['~VALUE'] ?? '';
        $desc = is_array($descRaw) ? ($descRaw['TEXT'] ?? '') : $descRaw;

        $brandClass = ' brand-card--' . mb_strtolower($name);
        ?>
        <div id="<?= $this->GetEditAreaId($arItem['ID']) ?>" class="brand-card<?= htmlspecialchars($brandClass) ?>">
            <a href="/catalog/">
                <div class="brand-card__emoji">
                    <?php if ($logo): ?>
                        <img src="<?= htmlspecialchars($logo) ?>" alt="<?= htmlspecialchars($name) ?>">
                    <?php endif; ?>
                </div>
                <h3 class="brand-card__name"><?= htmlspecialchars($name) ?></h3>
                <?php if ($desc): ?>
                    <p class="brand-card__desc"><?= $desc ?></p>
                <?php endif; ?>
                <span class="brand-card__link">Смотреть каталог →</span>
            </a>
        </div>
    <?php endforeach; ?>
</div>