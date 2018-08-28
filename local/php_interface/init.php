<?
use Bitrix\Main\EventManager,
    Bitrix\Main\Loader,
    Bitrix\Main\Application;
$eventManager = EventManager::getInstance();
global $request;
$request = Application::getInstance();
$request = $request->getContext();
$request = $request->getRequest();
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
    global $USER, $request;
    // modifire order status for jur users only
    if(sanricksIsUserJur($USER->GetID())){
        if($request->get("status"))
        {
            $arFields["STATUS_ID"] = "CH";
        }
    }



    // Для отмены
    //return false;
}

/**
 * Sanricks tools
 *
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

/**
 * @param $userId
 * @return bool
 */
function sanricksIsUserJur($userId){
    if(in_array(6, CUser::GetUserGroup($userId)))
        return true;
    return false;
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
?>