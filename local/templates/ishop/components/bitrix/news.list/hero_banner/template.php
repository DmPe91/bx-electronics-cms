<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * Шаблон компонента news.list: hero_banner
 * @var array $arResult
 */
?>
<section class="hero">
    <div class="container">
        <?php foreach ($arResult['ITEMS'] as $arItem): ?>
            <?php
            // Извлекаем значения с защитой от отсутствующих ключей
            $badgeText  = $arItem['PROPERTIES']['BADGE_TEXT']['VALUE'] ?? '';
            $button1Text = $arItem['PROPERTIES']['BUTTON1_TEXT']['VALUE'] ?? '';
            $button1Link = $arItem['PROPERTIES']['BUTTON1_LINK']['VALUE'] ?? '';
            $button2Text = $arItem['PROPERTIES']['BUTTON2_TEXT']['VALUE'] ?? '';
            $button2Link = $arItem['PROPERTIES']['BUTTON2_LINK']['VALUE'] ?? '';
            $visualImageId = (int)($arItem['PROPERTIES']['VISUAL_IMAGE']['VALUE'] ?? 0);
            $visualName  = $arItem['PROPERTIES']['VISUAL_NAME']['VALUE'] ?? '';
            $visualPrice = $arItem['PROPERTIES']['VISUAL_PRICE']['VALUE'] ?? '';
            $discountText = $arItem['PROPERTIES']['DISCOUNT_TEXT']['VALUE'] ?? '';

            // TITLE: подходит и для строки, и для HTML-типа
            $titleRaw = $arItem['PROPERTIES']['TITLE']['~VALUE'] ?? '';
            $title = is_array($titleRaw) ? ($titleRaw['TEXT'] ?? '') : $titleRaw;

            // DESCRIPTION: тип HTML/текст => массив с ключом TEXT
            $descRaw = $arItem['PROPERTIES']['DESCRIPTION']['~VALUE'] ?? '';
            $description = is_array($descRaw) ? ($descRaw['TEXT'] ?? '') : $descRaw;

            // Картинка
            $imageSrc = $visualImageId ? CFile::GetPath($visualImageId) : '';
            ?>
            <div class="hero__grid">
                <div>
                    <div class="hero__badge">
                        <span></span><?= htmlspecialchars($badgeText) ?>
                    </div>

                    <h1 class="hero__title">
                        <?= $title /* HTML/строка — доверенное значение из админки */ ?>
                    </h1>

                    <p class="hero__desc"><?= $description ?></p>

                    <div class="hero__buttons">
                        <?php if ($button1Text && $button1Link): ?>
                            <a href="<?= htmlspecialchars($button1Link) ?>" class="btn btn--primary">
                                <?= htmlspecialchars($button1Text) ?> →
                            </a>
                        <?php endif; ?>
                        <?php if ($button2Text && $button2Link): ?>
                            <a href="<?= htmlspecialchars($button2Link) ?>" class="btn btn--outline">
                                <?= htmlspecialchars($button2Text) ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="hero__visual">
                    <div class="hero__visual-card">
                        <div>
                            <?php if ($imageSrc): ?>
                                <img src="<?= htmlspecialchars($imageSrc) ?>"
                                     alt="<?= htmlspecialchars($visualName) ?>"
                                     class="hero__visual-image">
                            <?php endif; ?>
                            <div class="hero__visual-name"><?= htmlspecialchars($visualName) ?></div>
                            <div class="hero__visual-price"><?= htmlspecialchars($visualPrice) ?></div>
                        </div>
                        <div class="hero__visual-badge">
                            <div>СКИДКА</div>
                            <div style="font-size:18px"><?= htmlspecialchars($discountText) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>