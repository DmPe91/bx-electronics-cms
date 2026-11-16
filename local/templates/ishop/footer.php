<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// --- Чистые значения для ссылок (без HTML-обёрток) ---
$phoneRaw = @file_get_contents($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/include/footer/phone.php');
$phone = trim($phoneRaw);
$phoneClean = preg_replace('/[^0-9+]/', '', $phone);

$emailRaw = @file_get_contents($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/include/footer/email.php');
$email = trim($emailRaw);
?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer__grid">
                <div class="footer__col">
                    <div class="footer__logo">
                      <a href="<?= SITE_DIR ?>" class="header__logo">
                 <?php $APPLICATION->IncludeFile(
                 SITE_TEMPLATE_PATH . '/include/header/logo.php',
                 [],
                 ['MODE' => 'html', 'NAME' => 'Логотип в шапке']
                ); ?>
               </a>
                    </div>
                    <p class="footer__desc">
                      <?php $APPLICATION->IncludeFile(
                      SITE_TEMPLATE_PATH . '/include/footer/about.php',
                      [],
                      ['MODE' => 'html', 'NAME' => 'Описание в подвале']
                      ); ?>
                    </p>
                </div>
                <div class="footer__col">
    <h3 class="footer__title">Навигация</h3>
    <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "footer_links",
        [
            "ROOT_MENU_TYPE" => "footer",          // 👈 первый тип
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "footer",
            "USE_EXT" => "N",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
        ],
        false
    );?>
</div>

<div class="footer__col">
    <h3 class="footer__title">Информация</h3>
    <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "footer_links",                         // 👈 тот же шаблон
        [
            "ROOT_MENU_TYPE" => "footer_info",  // 👈 второй тип
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "footer_info",
            "USE_EXT" => "N",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
        ],
        false
    );?>
</div>
                <div class="footer__col">
                    <h3 class="footer__title">Контакты</h3>
                     <ul class="footer__contacts">
    <li>
        📞 <a href="tel:<?= htmlspecialchars($phoneClean) ?>"><?= htmlspecialchars($phone) ?></a>
        <?php // Скрытый IncludeFile только для иконки редактирования ?>
        <span style="display:none;">
            <?php $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . '/include/footer/phone.php',
                [],
                ['MODE' => 'text', 'NAME' => 'Телефон в подвале']
            ); ?>
        </span>
    </li>
    <li>
        ✉️ <a href="mailto:<?= htmlspecialchars($email) ?>"><?= htmlspecialchars($email) ?></a>
        <span style="display:none;">
            <?php $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . '/include/footer/email.php',
                [],
                ['MODE' => 'text', 'NAME' => 'Email в подвале']
            ); ?>
        </span>
    </li>
    <li>
        📍 <?php $APPLICATION->IncludeFile(
            SITE_TEMPLATE_PATH . '/include/footer/address.php',
            [],
            ['MODE' => 'text', 'NAME' => 'Адрес в подвале']
        ); ?>
    </li>
</ul>
                    <div class="footer__socials">
                      <?php $APPLICATION->IncludeFile(
                      SITE_TEMPLATE_PATH . '/include/footer/social.php',
                      [],
                      ['MODE' => 'html', 'NAME' => 'Соцсети в подвале']
                      ); ?>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
               <p>© <?= date('Y') ?> TechImport. Все права защищены.</p>
            </div>
        </div>
    </footer>
    <script src="<?= SITE_TEMPLATE_PATH ?>/js/basket.js"></script>
     <script src="<?= SITE_TEMPLATE_PATH ?>/js/main.js"></script>
</body>
</html>