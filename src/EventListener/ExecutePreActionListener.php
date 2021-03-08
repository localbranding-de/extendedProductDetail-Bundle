<?php
namespace LocalbrandingDe\ExtendedProductDetailBundle\EventListener;
use Contao\CoreBundle\ServiceAnnotation\Hook;


class ExecutePreActionListener
{
    /**
     * @Hook("executePreActions")
     */
    public function onExecutePreActions(string $action): void
    {
        if ('update' === $action) {
            echo(2);
            exit;
        }
    }
}