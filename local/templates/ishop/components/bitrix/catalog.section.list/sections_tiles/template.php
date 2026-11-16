<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
?>
<div class="sections-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;margin-bottom:32px;">
    <?php foreach ($arResult['SECTIONS'] as $arSection): ?>
        <a href="<?= htmlspecialchars($arSection['SECTION_PAGE_URL']) ?>" class="section-tile" style="display:block;padding:16px;border:1px solid #e5e7eb;border-radius:12px;text-decoration:none;color:inherit;transition:box-shadow .2s;">
            <div style="font-weight:700;margin-bottom:4px;"><?= htmlspecialchars($arSection['NAME']) ?></div>
            <div style="font-size:13px;color:#6b7280;"><?= (int)$arSection['ELEMENT_CNT'] ?> товаров</div>
        </a>
    <?php endforeach; ?>
</div>