<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var array $arParams */

if (empty($arResult['ITEMS'])) {
    return;
}
?>
<div class="filter-panel" id="smart-filter">
    <form name="<?= $arResult['FILTER_NAME'] ?>_form" action="<?= $arResult['FORM_ACTION'] ?>" method="get">
        <div class="filter-panel__header">
            <span class="filter-panel__title">Фильтры</span>
            <a href="<?= $arResult['FILTER_URL'] ?>" class="filter-panel__reset" id="filterReset">Сбросить</a>
        </div>

        <?php foreach ($arResult['ITEMS'] as $arItem): ?>
            <?php if (empty($arItem['VALUES']) || $arItem['PRICE']): ?>
                <?php /* Цену обработаем отдельно ниже */ ?>
                <?php if (!$arItem['PRICE']) continue; ?>
            <?php endif; ?>

            <?php if ($arItem['PRICE']): ?>
                <?php /* Блок цены — ползунок или два инпута */ ?>
                <?php
                $min = (int)($arItem['VALUES']['MIN']['VALUE'] ?? 0);
                $max = (int)($arItem['VALUES']['MAX']['VALUE'] ?? 0);
                $curMin = (int)($arItem['VALUES']['MIN']['HTML_VALUE'] ?? $min);
                $curMax = (int)($arItem['VALUES']['MAX']['HTML_VALUE'] ?? $max);
                ?>
                <div class="filter-panel__group">
                    <label class="filter-panel__label"><?= htmlspecialchars($arItem['NAME']) ?></label>
                    <div class="filter-panel__price-inputs">
                        <input type="number"
                               class="filter-panel__price-input"
                               name="<?= $arItem['VALUES']['MIN']['CONTROL_NAME'] ?>"
                               value="<?= $curMin ?>"
                               placeholder="От">
                        <span class="filter-panel__price-sep">—</span>
                        <input type="number"
                               class="filter-panel__price-input"
                               name="<?= $arItem['VALUES']['MAX']['CONTROL_NAME'] ?>"
                               value="<?= $curMax ?>"
                               placeholder="До">
                    </div>
                </div>
                <?php continue; ?>
            <?php endif; ?>

            <div class="filter-panel__group">
                <label class="filter-panel__label"><?= htmlspecialchars($arItem['NAME']) ?></label>
                <div class="filter-panel__radio-group">
                    <?php foreach ($arItem['VALUES'] as $value): ?>
                        <?php if (empty($value['VALUE'])) continue; ?>
                        <?php
                        $isChecked = !empty($value['CHECKED']);
                        $inputType = ($arItem['DISPLAY_TYPE'] === 'K') ? 'radio' : 'checkbox';
                        ?>
                        <label class="filter-panel__radio">
                            <input type="<?= $inputType ?>"
                                   name="<?= $value['CONTROL_NAME'] ?>"
                                   value="<?= htmlspecialchars($value['HTML_VALUE']) ?>"
                                   <?= $isChecked ? 'checked' : '' ?>>
                            <?= htmlspecialchars($value['VALUE']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <input type="hidden" name="set_filter" value="Y">
        <button type="submit" class="btn btn--primary btn--full" style="margin-top:16px;">
            Показать
        </button>
    </form>
</div>