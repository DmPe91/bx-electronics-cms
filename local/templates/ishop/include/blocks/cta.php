<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// Телефон из области футера (единый источник)
$phoneRaw = @file_get_contents($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/include/footer/phone.php');
$phone = trim($phoneRaw);
$phoneClean = preg_replace('/[^0-9+]/', '', $phone);
?>
<section class="cta">
    <div class="container">
        <h2 class="cta__title">
            <?php $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . '/include/cta_title.php',
                [],
                ['MODE' => 'text', 'NAME' => 'CTA: заголовок']
            ); ?>
        </h2>

        <p class="cta__desc">
            <?php $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . '/include/cta_desc.php',
                [],
                ['MODE' => 'text', 'NAME' => 'CTA: описание']
            ); ?>
        </p>

        <div class="cta__buttons">
            <?php $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . '/include/cta_btn.php',
                [],
                ['MODE' => 'html', 'NAME' => 'CTA: кнопка «Связаться с нами»']
            ); ?>

            <?php if ($phone): ?>
                <a href="tel:<?= htmlspecialchars($phoneClean) ?>" class="btn btn--white-outline">
                    <?= htmlspecialchars($phone) ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>