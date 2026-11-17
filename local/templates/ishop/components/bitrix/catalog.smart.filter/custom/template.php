<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var array $arParams */

// Заполняем глобальный фильтр
if (!empty($arResult['FORM_DATA'])) {
    $GLOBALS[$arParams['FILTER_NAME']] = $arResult['FORM_DATA'];
}

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
            
            <?php // Пропускаем пустые элементы ?>
            <?php if (empty($arItem['VALUES'])) continue; ?>

            <?php if (!empty($arItem['PRICE'])): ?>
                <?php
                // === БЛОК ЦЕНЫ ===
                $min = (int)($arItem['VALUES']['MIN']['VALUE'] ?? 0);
                $max = (int)($arItem['VALUES']['MAX']['VALUE'] ?? 0);
                
                // HTML_VALUE - это пустая строка когда пользователь не вводил значение
                $htmlMin = $arItem['VALUES']['MIN']['HTML_VALUE'] ?? '';
                $htmlMax = $arItem['VALUES']['MAX']['HTML_VALUE'] ?? '';
                
                // Если пользователь ввёл значение - используем его, иначе - реальный min/max
                $curMin = ($htmlMin !== '' && $htmlMin !== null) ? (int)$htmlMin : $min;
                $curMax = ($htmlMax !== '' && $htmlMax !== null) ? (int)$htmlMax : $max;
                
                // Защита от отрицательных значений
                if ($curMin <= 0) $curMin = $min;
                if ($curMax <= 0) $curMax = $max;
                ?>
                
                <div class="filter-panel__group">
                    <label class="filter-panel__label"><?= htmlspecialchars($arItem['NAME']) ?></label>
                    <div class="filter-panel__price-inputs">
                        <input type="number"
                               class="filter-panel__price-input"
                               name="<?= $arItem['VALUES']['MIN']['CONTROL_NAME'] ?>"
                               value="<?= $curMin ?>"
                               placeholder="От <?= number_format($min, 0, '.', ' ') ?>"
                               min="0">
                        <span class="filter-panel__price-sep">—</span>
                        <input type="number"
                               class="filter-panel__price-input"
                               name="<?= $arItem['VALUES']['MAX']['CONTROL_NAME'] ?>"
                               value="<?= $curMax ?>"
                               placeholder="До <?= number_format($max, 0, '.', ' ') ?>"
                               min="0">
                    </div>
                </div>
                
            <?php else: ?>
                <?php // === БЛОК ОБЫЧНЫХ СВОЙСТВ (чекбоксы/радио) === ?>
                
                <div class="filter-panel__group">
                    <label class="filter-panel__label"><?= htmlspecialchars($arItem['NAME']) ?></label>
                    <div class="filter-panel__radio-group">
                        <?php foreach ($arItem['VALUES'] as $value): ?>
                            <?php if (empty($value['VALUE'])) continue; ?>
                            
                            <?php
                            $isChecked = !empty($value['CHECKED']);
                            $inputType = ($arItem['DISPLAY_TYPE'] ?? '') === 'K' ? 'radio' : 'checkbox';
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
                
            <?php endif; ?>
            
        <?php endforeach; ?>

        <input type="hidden" name="set_filter" value="Y">
        <button type="submit" class="btn btn--primary btn--full" style="margin-top:16px;">
            Показать
        </button>
    </form>
</div>