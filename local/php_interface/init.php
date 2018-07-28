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


use Bitrix\Main\Entity;
/**
 * Class OrderNamesTable
 */
class OrderNamesTable extends Entity\DataManager {

    /**
     * @return string
     */
    public static function getFilePath() {
        return __FILE__;
    }

    /**
     * @return string
     */
    public static function getTableName() {
        return 'b_hlbd_order';
    }

    /**
     * @return array
     */
    public static function getMap() {
        return [
            new Entity\IntegerField('id', [
                'primary' => true,
                'column_name' => 'ID',
                'autocomplete' => true
            ]),
            new Entity\IntegerField('orderId', [
                'column_name' => 'UF_ID',
                'required' => true,
                'title' => 'Номер заказа'
            ]),
            new Entity\StringField('name', [
                'column_name' => 'UF_NAME',
                'required' => true,
                'title' => 'Наименование заказа'
            ]),
            new Entity\StringField('xmlId', [
                'column_name' => 'UF_XML_ID',
                'required' => true,
                'title' => 'Внешний идентификатор обмена'
            ])
        ];
    }
}

/**
 * Class TagsTable
 */
class TagsTable extends Entity\DataManager {

    /**
     * @return string
     */
    public static function getFilePath() {
        return __FILE__;
    }

    /**
     * @return string
     */
    public static function getTableName() {
        return 'b_hlbd_metki';
    }

    /**
     * @return array
     */
    public static function getMap() {
        return [
            new Entity\IntegerField('id', [
                'primary' => true,
                'column_name' => 'ID',
                'autocomplete' => true
            ]),
            new Entity\IntegerField('fileId', [
                'column_name' => 'UF_FILE',
                'required' => true,
                'title' => 'Файл'
            ]),
            new Entity\StringField('def', [
                'column_name' => 'UF_DEF',
                'required' => true,
                'title' => 'def'
            ]),
            new Entity\StringField('xmlId', [
                'column_name' => 'UF_XML_ID',
                'required' => true,
                'title' => 'Внешний идентификатор обмена'
            ]),
            new Entity\StringField('fd', [
                'column_name' => 'UF_FULL_DESCRIPTION',
                'required' => true,
                'title' => 'fd'
            ]),
            new Entity\StringField('desc', [
                'column_name' => 'UF_DESCRIPTION',
                'required' => true,
                'title' => 'desc'
            ]),
            new Entity\StringField('link', [
                'column_name' => 'UF_LINK',
                'required' => true,
                'title' => 'link'
            ]),
            new Entity\StringField('sort', [
                'column_name' => 'UF_SORT',
                'required' => true,
                'title' => 'sort'
            ]),
            new Entity\StringField('name', [
                'column_name' => 'UF_NAME',
                'required' => true,
                'title' => 'name'
            ])
        ];
    }
}