<?
AddEventHandler('main', 'OnBeforeEventSend', "sanricksBeforeEventSend");
AddEventHandler("main", "OnAfterUserUpdate", "OnAfterUserUpdateHandler");

/**
 * Перед отправкой почтового сообщения сайта
 * @param $arFields
 * @param $arTemplate
 */
function sanricksBeforeEventSend(&$arFields, $arTemplate)
{

    if($arTemplate["EVENT_NAME"] == "NEW_USER"){
        /**
         * Данные менеджера
         */
        $rsUserI = CUser::GetList($by, $order, Array("ID" => $arFields["USER_ID"]), array("SELECT" => array("UF_*")));
        if ($arUserI = $rsUserI->Fetch()) {
            $fields = $arUserI;

            if (!$fields["UF_MANAGER"])
                $fields["UF_MANAGER"] = 443;

            if ($fields["UF_MANAGER"]) {

                if(CModule::IncludeModule("iblock")){
                    $manager = CIBlockElement::GetList(
                        false,
                        array("IBLOCK_ID" => 10, "ACTIVE" => "Y", "ID" => $fields["UF_MANAGER"]),
                        false,
                        array("nPageSize" => 1),
                        array("ID", "NAME", "PROPERTY_EMA")
                    );
                    if ($manager = $manager->Fetch()) {
                        $fields["MANAGER_EMAIL"] = $manager["PROPERTY_EMA_VALUE"];
                        $fields["MANAGER_NAME"] = $manager["NAME"];

                    }
                }
            }

            CEvent::Send("VJWEB_USER_ACTIVATE", "s1", $fields);

            /**
             * Deactivate
             */
            $user = new CUser();
            $user->Update($arFields["USER_ID"], array("ACTIVE" => "N"));
        }
    }
}

/**
 * @param $arFields
 */
function OnAfterUserUpdateHandler(&$arFields)
{
    /**
     * Notify user about activation
     */
    if($arFields["ACTIVE"] == "Y"){
        $user = \Bitrix\Main\UserTable::getList(array(
            "filter" => array(
                "ID" => $arFields["ID"]
            ),
            "select" => array(
                "ID",
                "EMAIL",
                "NAME",
                "LAST_NAME"
            )
        ));
        if($user = $user->fetch()){
            CEvent::Send("USER_ACTIVATE_NOTIFY", "s1", array(
                "EMAIL" => $user["EMAIL"],
                "NAME" => $user["NAME"],
                "LAST_NAME" => $user["LAST_NAME"]
            ));
        }
    }
}

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