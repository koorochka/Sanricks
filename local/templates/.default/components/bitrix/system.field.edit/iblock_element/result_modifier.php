<?
/**
 * @var array $arParams
 * @var array $arResult
 * Filtered managers by city
 */

if($arParams["arUserField"]["FIELD_NAME"] == "UF_MANAGER"){
    if($arParams["arUserField"]["SETTINGS"]["CITY"] > 0){

        $arManagers = array();
        $managers = CIBlockElement::GetList(
            false,
            array(
                "IBLOCK_ID" => $arParams["arUserField"]["SETTINGS"]["IBLOCK_ID"],
                "PROPERTY_CITY" => $arParams["arUserField"]["SETTINGS"]["CITY"]
            ),
            false,
            false,
            array("ID")
        );

        while ($manager = $managers->Fetch())
        {
            $arManagers[] = $manager["ID"];
        }
        foreach ($arParams["arUserField"]["USER_TYPE"]["FIELDS"] as $id=>$manager){
            if(!$id){
                continue;
            }
            if(!in_array($id, $arManagers)){
                unset($arParams["arUserField"]["USER_TYPE"]["FIELDS"][$id]);
            }
        }


    }
}

if($arParams["arUserField"]["FIELD_NAME"] == "UF_FILIAL"){
    $arResult["VALUE"][] = $arParams["arUserField"]["SETTINGS"]["CITY"];
}
?>