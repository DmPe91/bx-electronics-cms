<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>

<div class="info-page">
    <div class="container">
        <div class="info-page__header">
            <h1>О компании TechImport</h1>
            <p>
                <?php $APPLICATION->IncludeFile(
                    SITE_TEMPLATE_PATH . '/include/about/subtitle.php',
                    [],
                    ['MODE' => 'text', 'NAME' => 'Подзаголовок «О компании»']
                ); ?>
            </p>
        </div>

        <div class="two-col" style="margin-bottom:48px;align-items:center">
            <div>
                <h2 style="font-size:22px;font-weight:700;color:#1f2937;margin-bottom:16px">Кто мы такие</h2>
                <?php $APPLICATION->IncludeFile(
                    SITE_TEMPLATE_PATH . '/include/about/description.php',
                    [],
                    ['MODE' => 'html', 'NAME' => 'Описание компании']
                ); ?>
            </div>
            <div class="stats-block">
                <div class="stats-grid">
                    <?php $APPLICATION->IncludeFile(
                        SITE_TEMPLATE_PATH . '/include/about/stats.php',
                        [],
                        ['MODE' => 'html', 'NAME' => 'Статистика о компании']
                    ); ?>
                </div>
            </div>
        </div>

        <h2 style="font-size:22px;font-weight:700;color:#1f2937;text-align:center;margin-bottom:24px">Как мы работаем</h2>
        <div class="steps" style="margin-bottom:48px">
            <?php $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . '/include/about/steps.php',
                [],
                ['MODE' => 'html', 'NAME' => 'Этапы работы']
            ); ?>
        </div>

        <h2 style="font-size:22px;font-weight:700;color:#1f2937;text-align:center;margin-bottom:24px">Наши преимущества</h2>
        <div class="info-cards">
            <?php $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . '/include/about/advantages.php',
                [],
                ['MODE' => 'html', 'NAME' => 'Преимущества компании']
            ); ?>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>