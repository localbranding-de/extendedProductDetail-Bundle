<?php 
namespace LocalbrandingDe\ExtendedProductDetailBundle\EventListener;
use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Widget;

/**
 * @Hook("addCustomRegexp")
 */
class LBAddCustomRegexpListener 
{
    public function __invoke(string $regexp, $input, Widget $widget): bool
    {
        if ('lb_phone' === $regexp) {
            $exp = '^[0-9]{4,5}[ ]?[0-9]*$';
 
            if (!preg_match('/' . $exp . '/', $input)) {
                $widget->addError('Ungültige Telefonnummer. Bitte nach dem Muster 02242 86060');
            }

            return true;
        }
        if ('lb_fax' === $regexp) {
            $exp = '^[0-9]{4,5}[ ]?[0-9]*$';
            
            if (!preg_match('/' . $exp . '/', $input)) {
                $widget->addError('Ungültige Faxnummer. Bitte nach dem Muster 02242 86060');
            }
            
            return true;
        }
        if ('lb_mobile' === $regexp) {
            $exp = '^[0-9]{4,5}[ ]?[0-9]*$';
            
            if (!preg_match('/' . $exp . '/', $input)) {
                $widget->addError('Ungültige Mobilnummer. Bitte nach dem Muster 01769 86060');
            }
            
            return true;
        }
        if ('lb_decimals' === $regexp) {
            $exp = '^[0-9]+[\.]?[0-9]{0,2}$';
            
            if (!preg_match('/' . $exp . '/', $input)) {
                $widget->addError('Ungültige Zahl. Bitte Zahl im gültigen Format eingeben 00.00');
            }
            
            return true;
        }

        return false;
    }
}

?>