<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main\Loader;
use Bitrix\Catalog\Product\Basket as CatalogBasket;
use Bitrix\Sale\Basket as SaleBasket;
use Bitrix\Sale\Fuser;

header('Content-Type: application/json; charset=utf-8');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    echo json_encode(['STATUS' => 'ERROR', 'MESSAGE' => 'Method not allowed']);
    die();
}

if (!Loader::includeModule('catalog') || !Loader::includeModule('sale')) {
    echo json_encode(['STATUS' => 'ERROR', 'MESSAGE' => 'Modules not loaded']);
    die();
}

$productId = (int)($_POST['id'] ?? 0);
$quantity  = (float)($_POST['quantity'] ?? 1);
if ($quantity <= 0) $quantity = 1;

if ($productId <= 0) {
    echo json_encode(['STATUS' => 'ERROR', 'MESSAGE' => 'Invalid product ID']);
    die();
}

try {
    $result = CatalogBasket::addProduct(
        ['PRODUCT_ID' => $productId, 'QUANTITY' => $quantity],
        ['LID' => SITE_ID],
        ['USE_MERGE' => 'Y']
    );

    if ($result->isSuccess()) {
        $basket = SaleBasket::loadItemsForFUser(Fuser::getId(), SITE_ID);
        echo json_encode([
            'STATUS' => 'OK',
            'COUNT'  => $basket->count(),
            'METHOD' => 'addProduct',
        ]);
    } else {
        echo json_encode([
            'STATUS'  => 'ERROR',
            'MESSAGE' => implode('; ', $result->getErrorMessages()),
            'CODES'   => array_map(function ($e) { return $e->getCode(); }, $result->getErrors()),
        ]);
    }
} catch (\Throwable $e) {
    echo json_encode([
        'STATUS'  => 'ERROR',
        'MESSAGE' => $e->getMessage(),
        'TRACE'   => $e->getFile() . ':' . $e->getLine(),
    ]);
}