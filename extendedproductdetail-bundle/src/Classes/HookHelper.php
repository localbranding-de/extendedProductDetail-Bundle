<?php
namespace LocalbrandingDe\ExtendedProductDetailBundle\Classes;
class HookHelper
{


    /**
     * Ruft die Ausführung eines Hooks mit einem HookDataContainer (HDC) auf.
     * @param $objHDC
     * @return mixed
     * @deprecated use HookHelper::despatch()
     */
    public static function run($objHDC)
    {
        return self::dispatch($objHDC::HOOKNAME, $objHDC);
    }


    /**
     * Führt die Hooks aus und gibt das Ergebnis zurück.
     * @param $strName
     * @param $arrArgs
     * @return mixed
     */
    public static function dispatch($strName, $objHDC)
    {
        if (array_key_exists($strName, $GLOBALS['esitapi']['api']['hooks'])) {
            if (count($GLOBALS['esitapi']['api']['hooks'][$strName])) {
                foreach ($GLOBALS['esitapi']['api']['hooks'][$strName] as $arrHook) {
                    if (count($arrHook) == 2) {
                        $strClass   = $arrHook[0];
                        $strMethode = $arrHook[1];
                        $objClass   = new $strClass();
                        $arrArgs[2] = $objClass->$strMethode($objHDC);
                    }
                }
            }
        }

        if (is_array($arrArgs) && count($arrArgs) > 1) {
            return $arrArgs[2];
        } else {
            return $arrArgs;
        }
    }
}