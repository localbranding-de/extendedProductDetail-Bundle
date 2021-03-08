<?php 
namespace LocalbrandingDe\ExtendedProductDetailBundle\EventListener;
class OnBuildQuery
{
    /**
     * Fügt die Tabelle der Anfrage hinzu.
     * @param OnBuildQueryHook $objOnBuildQuery
     */
    public function addRessource($objOnBuildQuery)
    {
        $objOnBuildQuery->setQuery('SELECT * FORM `' . $objOnBuildQuery->strRessource . '`');
    }
    
    /**
     * Fügt die Id in die Anfrage ein.
     * @param OnBuildQueryHook $objOnBuildQuery
     */
    public function addId( $objOnBuildQuery)
    {

        $strQuery = $objOnBuildQuery->getQuery();
        $objOnBuildQuery->setQuery($strQuery . ' WHERE `id` = ' . $objOnBuildQuery->intId);
    }
}