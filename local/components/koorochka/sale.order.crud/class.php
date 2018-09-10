<?
use Bitrix\Main\Loader;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
if(class_exists("saleOrderCrud"))
    return;

/**
 * Class saleOrderCrud
 */
class saleOrderCrud extends CBitrixComponent
{



    // <editor-fold defaultstate="collapsed" desc="# Cities">


    // </editor-fold>

    /**
     * Execution
     */
    public function executeComponent()
    {


        $this->IncludeComponentTemplate();
    }
}
