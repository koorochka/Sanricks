<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("KOOROCHKA_SANRICKS_NAME"),
	"DESCRIPTION" => GetMessage("KOOROCHKA_SANRICKS_DESC"),
	"ICON" => "/images/koorochka.gif",
	"SORT" => 10,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "koorochka",
        "NAME" => GetMessage("KOOROCHKA"),
        "SORT" => 1,
		"CHILD" => array(
			"ID" => "sanricks",
			"NAME" => GetMessage("KOOROCHKA_SANRICKS"),
			"SORT" => 10,
		)
	)
);

?>