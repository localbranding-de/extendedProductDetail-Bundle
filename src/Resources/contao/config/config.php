<?php

/**
 * Hooks.
 */

$GLOBALS['TL_HOOKS']['addCustomRegexp'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\LBAddCustomRegexpListener::class,'__invoke');
$GLOBALS['TL_HOOKS']['outputBackendTemplate'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\OutputBackendTemplateListener::class, 'myOutputBackendTemplate');
$GLOBALS['TL_HOOKS']['parseTemplate'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\FrontendTemplateListener::class, 'myParseFrontendTemplate');
//$GLOBALS['TL_HOOKS']['executePreActions'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\ExecutePreActionListener::class, 'onExecutePreActions');
//$GLOBALS['TL_HOOKS']['parseBackendTemplate'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\ParseBackendTemplateListener::class, 'addScripts');
$GLOBALS['TL_HOOKS']['activateAccount'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\activateAccountListener::class, 'myActivateAccount');
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\FrontendTemplateListener::class, 'myOutputFrontendTemplate');
$GLOBALS['esitapi']['api']['hooks']['OnBuildQuery'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\OnBuildQuery::class, 'addRessource');
$GLOBALS['esitapi']['api']['hooks']['OnBuildQuery'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\OnBuildQuery::class, 'addId');



// Frontend modules
$GLOBALS['FE_MOD']['LocalBranding Module']['productButton'] = 'LocalbrandingDe\ExtendedProductDetailBundle\Module\ProductButtonModule'; 
$GLOBALS['FE_MOD']['LocalBranding Module']['bundleButton'] = 'LocalbrandingDe\ExtendedProductDetailBundle\Module\BundleButtonModule';
$GLOBALS['FE_MOD']['LocalBranding Module']['domainCheckListe'] = 'LocalbrandingDe\ExtendedProductDetailBundle\Module\DomainCheckListModule';
$GLOBALS['FE_MOD']['LocalBranding Module']['domainCheck'] = 'LocalbrandingDe\ExtendedProductDetailBundle\Module\DomainCheckModule';
$GLOBALS['FE_MOD']['LocalBranding Module']['bundleHandler'] = 'LocalbrandingDe\ExtendedProductDetailBundle\Module\BundleHandlerModule';
$GLOBALS['FE_MOD']['LocalBranding Module']['domainCart'] = 'LocalbrandingDe\ExtendedProductDetailBundle\Module\DomainCartModule';

$GLOBALS['MERCONIS_HOOKS']['addToCart'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\FrontendTemplateListener::class, 'myAddToCart'); 
$GLOBALS['MERCONIS_HOOKS']['afterCheckout'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\FrontendTemplateListener::class, 'myAfterCheckout');
$GLOBALS['TL_HOOKS']['outputBackendTemplate'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\FrontendTemplateListener::class, 'myOutputTemplate');
$GLOBALS['TL_HOOKS']['setCookie'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\FrontendTemplateListener::class, 'setSecureFlag');
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\FrontendTemplateListener::class, 'myOutputTemplate');
$GLOBALS['MERCONIS_HOOKS']['storeCartItemInOrder'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\FrontendTemplateListener::class, 'myStoreCartItemInOrder');
$GLOBALS['MERCONIS_HOOKS']['initializeCartController'][] = array(\LocalbrandingDe\ExtendedProductDetailBundle\EventListener\FrontendTemplateListener::class, 'myInitializeCartController');
//$GLOBALS['TL_HOOKS']['createNewUser'][] = array(\LocalbrandingDe\MembershiplevelsBundle\EventListener\createNewUserListener::class, 'myCreateNewUser');
if (TL_MODE == 'BE') {

}


if ('BE' === TL_MODE) {

     $GLOBALS['TL_CSS'][] = '/bundles/extendedproductdetail/css/lb_be_default.css';
        $GLOBALS['TL_CSS'][] = '/bundles/extendedproductdetail/css/lb_be_basic.css';

    
}


if(\Input::get('do') == 'lb_productCalculation'&&\Input::get('id'))
{


    $GLOBALS['TL_JAVASCRIPT'][] = '/assets/jquery/js/jquery.min.js';
    $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/extendedproductdetail/js/lb_be_products.js';
    $GLOBALS['TL_CSS'][] = '/bundles/extendedproductdetail/css/lb_be_productCalc.css';
}

if(\Input::get('do') == 'ls_shop_product'&&\Input::get('id'))
{
    
    
    $GLOBALS['TL_JAVASCRIPT'][] = '/assets/jquery/js/jquery.min.js';
    $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/extendedproductdetail/js/lb_be_products.js';
    $GLOBALS['TL_CSS'][] = '/bundles/extendedproductdetail/css/lb_be_products.css';
}


if(\Input::get('do') == 'member'&&\Input::get('id'))
{
    
    
    //$GLOBALS['TL_JAVASCRIPT'][] = '/assets/jquery/js/jquery.min.js';
    //$GLOBALS['TL_JAVASCRIPT'][] = '/bundles/extendedproductdetail/js/lb_be_bundle.js';
    $GLOBALS['TL_CSS'][] = '/bundles/extendedproductdetail/css/lb_be_member.css';
    //$GLOBALS['TL_CSS'][] = '/files/theme_lb_demoshop/css/lb-default.css';
    
}
if(\Input::get('do') == 'lb_bundles')
{
    
    
    $GLOBALS['TL_JAVASCRIPT'][] = '/assets/jquery/js/jquery.min.js';
    $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/extendedproductdetail/js/lb_be_bundle.js';
   // $GLOBALS['TL_CSS'][] = '/bundles/extendedproductdetail/css/lb_be_font.css';
    //$GLOBALS['TL_CSS'][] = '/files/theme_lb_demoshop/css/lb-default.css';
    
}

array_insert($GLOBALS['BE_MOD'], 1,
    array(
    
        'lb_calculation' => array
        (
    'lb_costtype' => array
    (
        'tables'        => array('tl_lb_costType')
    ),
    'lb_bundles' => array
     (
        'tables'        => array('tl_lb_productBundle')
     ),
     'lb_productCalculation' => array
     (
        'tables'        => array('tl_lb_productCalculation')
     )
)
        )
    )
;


