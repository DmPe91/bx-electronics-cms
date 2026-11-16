<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
<ul class="footer__links">
    <?php foreach ($arResult as $arItem): ?>
        <li>
            <a href="<?= htmlspecialchars($arItem['LINK']) ?>">
                <?= htmlspecialchars($arItem['TEXT']) ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>