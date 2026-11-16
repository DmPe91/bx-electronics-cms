<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>
<div class="products-grid" id="hitProducts">
    <?php foreach ($arResult['ITEMS'] as $arItem): ?>
        <?php
        $name      = $arItem['NAME'] ?? '';
        $productId = (int)($arItem['ID'] ?? 0);
        $imageSrc  = $arItem['PREVIEW_PICTURE']['SRC'] ?? '';
        $priceData = $arItem['ITEM_PRICES'][0] ?? [];
        $price     = $priceData['PRINT_PRICE'] ?? '';
        $oldPrice  = $priceData['PRINT_BASE_PRICE'] ?? '';
        $discountPercent = (int)($priceData['PERCENT'] ?? 0);
        $hasOldPrice = $discountPercent > 0;
        $canBuy    = !empty($arItem['CAN_BUY']);

        // Бренд (привязка к инфоблоку «Бренды»)
        $brand = '';
        $brandId = (int)($arItem['PROPERTIES']['BRAND_REF']['VALUE'] ?? 0);
        if ($brandId) {
            $br = CIBlockElement::GetByID($brandId)->GetNext();
            $brand = $br['NAME'] ?? '';
        }

        $specs = $arItem['PROPERTIES']['SPECS']['VALUE'] ?? [];
        $isNew = ($arItem['PROPERTIES']['IS_NEW']['VALUE'] ?? '') === 'Да';
        $isHit = ($arItem['PROPERTIES']['IS_HIT']['VALUE'] ?? '') === 'Да';
        $categoryName = $arItem['SECTION']['NAME'] ?? '';
        $brandClass = $brand ? ' product-card__brand--' . mb_strtolower($brand) : '';
        ?>
        <div class="product-card">
            <div class="product-card__image">
                <?php if ($imageSrc): ?>
                    <img src="<?= htmlspecialchars($imageSrc) ?>" alt="<?= htmlspecialchars($name) ?>" loading="lazy">
                <?php endif; ?>

                <div class="product-card__badges">
                    <?php if ($isNew): ?><span class="product-card__badge product-card__badge--new">NEW</span><?php endif; ?>
                    <?php if ($isHit): ?><span class="product-card__badge product-card__badge--hit">ХИТ</span><?php endif; ?>
                    <?php if ($hasOldPrice): ?><span class="product-card__badge product-card__badge--sale">-<?= $discountPercent ?>%</span><?php endif; ?>
                </div>

                <?php if ($brand): ?>
                    <span class="product-card__brand<?= htmlspecialchars($brandClass) ?>"><?= htmlspecialchars($brand) ?></span>
                <?php endif; ?>
            </div>

            <div class="product-card__body">
                <h3 class="product-card__name"><?= htmlspecialchars($name) ?></h3>

                <?php if ($categoryName): ?>
                    <p class="product-card__category"><?= htmlspecialchars($categoryName) ?></p>
                <?php endif; ?>

                <?php if ($specs): ?>
                    <div class="product-card__specs">
                        <?php foreach ($specs as $spec): ?>
                            <?php if ($spec): ?><span class="product-card__spec"><?= htmlspecialchars($spec) ?></span><?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="product-card__price-row">
                    <?php if ($price): ?><span class="product-card__price"><?= $price ?></span><?php endif; ?>
                    <?php if ($hasOldPrice && $oldPrice): ?><span class="product-card__old-price"><?= $oldPrice ?></span><?php endif; ?>
                </div>

                <?php if ($canBuy): ?>
                    <button type="button"
                            class="product-card__btn js-add-to-basket"
                            data-product-id="<?= $productId ?>">
                        В корзину
                    </button>
                <?php else: ?>
                    <button class="product-card__btn" disabled>Нет в наличии</button>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>