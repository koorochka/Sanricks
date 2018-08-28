<?
use Bitrix\Main\EventManager;
$eventManager = EventManager::getInstance();
/**
 * Add events handlers
 */
$eventManager->AddEventHandler("sale", "OnBeforeOrderAdd", "OnBeforeOrderAddHandler");
/**
 * Sanricks events handlers
 */

/**
 * Вызывается перед добавлением заказа, может быть использовано для отмены или модификации данных.
 * Метод CSaleOrder::Add
 * @param $arFields
 */
function OnBeforeOrderAddHandler(&$arFields) {
    AddMessage2Log($arFields);

    // Для отмены
    //return false;
}

/**
 * Dev tools
 */
if (!function_exists("d") )
{
    function d($value, $type="pre")
    {
        if ( is_array( $value ) || is_object( $value ) )
        {
            echo "<" . $type . " class=\"prettyprint\">".htmlspecialcharsbx( print_r($value, true) )."</" . $type . ">";
        }
        else
        {
            echo "<" . $type . " class=\"prettyprint\">".htmlspecialcharsbx($value)."</" . $type . ">";
        }
    }
}

/**
 * @param $text
 * @param array $limit
 */
function sanricksTextSizer($text, $limit=array()){
    if(empty($limit)){
        $limit = array(
            6 => 10,
            10 => 9,
            15 => 8
        );
    }
    $textSize = strlen($text);
    $textFont = 0;
    foreach ($limit as $size=>$value) {
        if($textSize > $size){
            $textFont = $value;
        }
    }

    if($textFont > 0){
        ?><div class="text-<?=$textFont?>"><?=$text?></div><?
    }else{
        echo $text;
    }
}
?>