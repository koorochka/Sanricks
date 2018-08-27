<?
/**
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();



\Bitrix\Main\Loader::includeModule("sale");

// get my orders
$arOrders = array();
$orders = \Bitrix\Sale\Order::getList(array(
    "filter" => array(
        "USER_ID" => 1
    ),
    "select" => array(
        "ID"
    )
));
while ($order = $orders->fetch())
{
    $arOrders[] = $order["ID"];
}

d(count($arOrders));

d($arOrders);

// get my basket items
if(count($arOrders) > 0)
{
    $arOrders = array();
    $orders = \Bitrix\Sale\Basket::getList(array(
        "filter" => array(
            "ORDER_ID" => $arOrders
        ),
        "select" => array(
            "ID"
        )
    ));
    d($orders->getSelectedRowsCount());
}

d($arOrders);
?>
