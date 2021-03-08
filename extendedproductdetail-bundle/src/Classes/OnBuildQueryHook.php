<?php
namespace LocalbrandingDe\ExtendedProductDetailBundle\Classes;
class OnBuildQueryHook
{

    /**
     * Name des Hooks
     */
    const HOOKNAME = 'OnBuildQuery';

    /**
     * Name der angefragten Ressource (Tabelle)
     * @var string
     */
    protected $ressource = '';

    /**
     * Id der angeforderten Ressource, falls vorhanden
     * @var int
     */
    protected $id = 0;

    /**
     * String mit dem Query.
     * @var string
     */
    protected $query = '';


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }


    /**
     * @param string $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }


    /**
     * @return string
     */
    public function getRessource()
    {
        return $this->ressource;
    }


    /**
     * @param string $ressource
     */
    public function setRessource($ressource)
    {
        $this->ressource = $ressource;
    }
}