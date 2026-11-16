<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Доставка");
?>

<div class="info-page">
    <div class="container">
        <div class="info-page__header">
            <h1>Доставка</h1>
            <p>
                <?php $APPLICATION->IncludeFile(
                    SITE_TEMPLATE_PATH . '/include/delivery/subtitle.php',
                    [],
                    ['MODE' => 'text', 'NAME' => 'Подзаголовок «Доставка»']
                ); ?>
            </p>
        </div>

        <div class="delivery-cards">
            <?php $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . '/include/delivery/cards.php',
                [],
                ['MODE' => 'html', 'NAME' => 'Способы доставки']
            ); ?>
        </div>

        <div style="background:#fff;border-radius:12px;padding:32px;border:1px solid #e5e7eb;margin-bottom:48px">
            <h2 style="font-size:22px;font-weight:700;color:#1f2937;text-align:center;margin-bottom:24px">Процесс доставки</h2>
            <div class="steps">
                <?php $APPLICATION->IncludeFile(
                    SITE_TEMPLATE_PATH . '/include/delivery/steps.php',
                    [],
                    ['MODE' => 'html', 'NAME' => 'Этапы доставки']
                ); ?>
            </div>
        </div>

        <div class="info-lists">
            <div class="info-list-block">
                <?php $APPLICATION->IncludeFile(
                    SITE_TEMPLATE_PATH . '/include/delivery/included.php',
                    [],
                    ['MODE' => 'html', 'NAME' => 'Что входит в доставку']
                ); ?>
            </div>
            <div class="info-list-block">
                <?php $APPLICATION->IncludeFile(
                    SITE_TEMPLATE_PATH . '/include/delivery/warnings.php',
                    [],
                    ['MODE' => 'html', 'NAME' => 'Важная информация о доставке']
                ); ?>
            </div>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>