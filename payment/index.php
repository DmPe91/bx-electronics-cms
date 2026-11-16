<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплата");
?>

<div class="info-page">
    <div class="container">
        <div class="info-page__header">
            <h1>Оплата</h1>
            <p>
                <?php $APPLICATION->IncludeFile(
                    SITE_TEMPLATE_PATH . '/include/payment/subtitle.php',
                    [],
                    ['MODE' => 'text', 'NAME' => 'Подзаголовок «Оплата»']
                ); ?>
            </p>
        </div>

        <div class="info-cards" style="margin-bottom:48px">
            <?php $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . '/include/payment/cards.php',
                [],
                ['MODE' => 'html', 'NAME' => 'Способы оплаты']
            ); ?>
        </div>

        <div class="security-block">
            <div class="security-block__grid">
                <div>
                    <?php $APPLICATION->IncludeFile(
                        SITE_TEMPLATE_PATH . '/include/payment/security.php',
                        [],
                        ['MODE' => 'html', 'NAME' => 'Блок «Безопасность платежей»']
                    ); ?>
                </div>
                <div class="security-block__visual">
                    <div class="security-circle">
                        <div>
                            <div class="security-circle__icon">🔒</div>
                            <div class="security-circle__text">100% защита</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 style="font-size:22px;font-weight:700;color:#1f2937;text-align:center;margin-bottom:24px">Частые вопросы</h2>
        <div class="faq">
            <?php $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . '/include/payment/faq.php',
                [],
                ['MODE' => 'html', 'NAME' => 'FAQ по оплате']
            ); ?>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>