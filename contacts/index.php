<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");

// Контакты из включаемых областей
$phoneRaw   = @file_get_contents($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/include/footer/phone.php');
$phone      = trim($phoneRaw);
$phoneClean = preg_replace('/[^0-9+]/', '', $phone);

$emailRaw = @file_get_contents($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/include/footer/email.php');
$email    = trim($emailRaw);

$addressRaw = @file_get_contents($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/include/footer/address.php');
$address    = trim($addressRaw);
?>

<div class="info-page">
    <div class="container">
        <div class="info-page__header">
            <h1>Контакты</h1>
            <p>Свяжитесь с нами любым удобным способом</p>
        </div>

        <div class="two-col" style="margin-bottom:32px">
            <div class="contact-info">
                <div class="contact-block">
                    <div class="contact-block__icon contact-block__icon--phone">📞</div>
                    <div>
                        <div class="contact-block__title">Телефон</div>
                        <a href="tel:<?= htmlspecialchars($phoneClean) ?>" class="contact-block__value">
                            <?= htmlspecialchars($phone) ?>
                        </a>
                        <div class="contact-block__sub">Бесплатно по России</div>
                        <div class="contact-block__sub">Пн-Пт: 9:00-21:00, Сб-Вс: 10:00-18:00</div>
                    </div>
                </div>
                <div class="contact-block">
                    <div class="contact-block__icon contact-block__icon--email">✉️</div>
                    <div>
                        <div class="contact-block__title">Email</div>
                        <a href="mailto:<?= htmlspecialchars($email) ?>" class="contact-block__value">
                            <?= htmlspecialchars($email) ?>
                        </a>
                        <div class="contact-block__sub">Ответим в течение 2 часов</div>
                    </div>
                </div>
                <div class="contact-block">
                    <div class="contact-block__icon contact-block__icon--address">📍</div>
                    <div>
                        <div class="contact-block__title">Адрес офиса</div>
                        <div style="color:#374151"><?= htmlspecialchars($address) ?></div>
                        <div class="contact-block__sub">Пн-Пт: 10:00-20:00, Сб: 11:00-17:00</div>
                    </div>
                </div>
                <div class="contact-block">
                    <div class="contact-block__icon contact-block__icon--messengers">💬</div>
                    <div>
                        <div class="contact-block__title">Мессенджеры</div>
                        <div class="contact-block__tags">
                            <span class="contact-block__tag contact-block__tag--tg">Telegram</span>
                            <span class="contact-block__tag contact-block__tag--wa">WhatsApp</span>
                            <span class="contact-block__tag contact-block__tag--vk">VK Мессенджер</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form" id="contactForm">
                <h2 class="contact-form__title">Напишите нам</h2>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:form.result.new",
                    "custom",
                    [
                        "WEB_FORM_ID"            => "1",
                        "IGNORE_CUSTOM_TEMPLATE" => "N",
                        "USE_EXTENDED_ERRORS"    => "Y",
                        "SEF_MODE"               => "N",
                        "CACHE_TYPE"             => "N",
                        "CACHE_TIME"             => "0",
                    ],
                    false
                );?>
            </div>
        </div>

        <div class="map-placeholder">
            <div class="map-inner">
                <div>
                    <div class="map-inner__icon">🗺️</div>
                    <div class="map-inner__text"><?= htmlspecialchars($address) ?></div>
                    <div class="map-inner__sub">Здесь будет карта (Яндекс.Карты / 2ГИС)</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>