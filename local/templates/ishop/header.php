<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

// CSS шаблона
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/style.css');

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $APPLICATION->ShowTitle() ?></title>
    <?php $APPLICATION->ShowHead() ?>
    <meta name="description" content="Оригинальная техника Apple и Google с доставкой из-за рубежа. iPhone, iPad, MacBook, Pixel. Лучшие цены и быстрая доставка по России.">
</head>
<body>
    <!-- Header -->
    <?php $APPLICATION->ShowPanel(); ?>
    <header class="header">
        <div class="container">
            <div class="header__inner">
               <a href="<?= SITE_DIR ?>" class="header__logo">
                 <?php $APPLICATION->IncludeFile(
                 SITE_TEMPLATE_PATH . '/include/header/logo.php',
                 [],
                 ['MODE' => 'html', 'NAME' => 'Логотип в шапке']
                ); ?>
               </a>
                <nav class="header__nav">
    <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "top_nav",
        [
            "ROOT_MENU_TYPE" => "top",
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "top",
            "USE_EXT" => "N",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
        ],
        false
    );?>
</nav>
                <div class="header__actions">
                    <?$APPLICATION->IncludeComponent(
                      "bitrix:sale.basket.basket.line",
                      ".default",
    [
        "PATH_TO_BASKET" => "/personal/cart/",
        "PATH_TO_ORDER" => "/personal/order/make/",
        "SHOW_NUM_PRODUCTS" => "Y",
        "SHOW_TOTAL_PRICE" => "N",
        "SHOW_PERSONAL_LINK" => "N",
        "POSITION_FIXED" => "N",
        "HIDE_ON_BASKET_PAGES" => "N",
    ],
    false
);?>
                    <button class="header__burger" id="burgerBtn" aria-label="Меню">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mobile-nav" id="mobileNav">
           <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "top_nav",
        [
            "ROOT_MENU_TYPE" => "top",
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "top",
            "USE_EXT" => "N",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
        ],
        false
    );?>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main">