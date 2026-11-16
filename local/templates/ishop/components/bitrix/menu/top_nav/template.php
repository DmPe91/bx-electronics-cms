<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (empty($arResult)) {
    return;
}
?>
<?php foreach ($arResult as $arItem): ?>
    <a href="<?= htmlspecialchars($arItem['LINK']) ?>"
       class="header__nav-link<?= $arItem['SELECTED'] ? ' active' : '' ?>">
        <?= htmlspecialchars($arItem['TEXT']) ?>
    </a>
<?php endforeach; ?>