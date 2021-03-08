<?php
/**
 * Table tl_lb_costType
 */


//Legenden hinzuf�gen
$GLOBALS['TL_DCA']['tl_lb_costType']['palettes']['default']=str_replace('alias;','alias;{lb_priceDescriptionLegend},lb_inPriceHeader1,lb_inPriceText1,lb_inPriceHeader2,lb_inPriceText2,lb_inPriceHeader3,lb_inPriceText3',$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default'] );

$GLOBALS['TL_DCA']['tl_lb_costType'] = array
(
    
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'costType' => 'index'
            )
        )
    ),
    // Palettes
    'palettes' => array
    (
        '__selector__'                => array('isTask,costType,measure'),
        'default'                     => '{costType_legend},isTask,costType,description,measure,costPerMinute;'
        
    ),
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                 => "int(10) unsigned NOT NULL auto_increment",
        ),
        'isTask' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_costType']['isTask'],
            'inputType' => 'checkbox',
            'eval'      => array( 'submitOnChange'=>true,'feEditable'=>true, 'feViewable'=>true,'tl_class'=>'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'costType' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_costType']['costType'],
            'inputType' => 'text',
            'eval'      => array('tl_class'=>'w50 costType','maxlength'=>255),
            'sql'       => "varchar(256) NOT NULL default ''"
        ),
        'costPerMinute' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_costType']['costPerMinute'],
            'inputType' => 'text',
            'eval'      => array('tl_class'=>'w50','maxlength'=>10, 'rgxp'=>'lb_decimals'),
            'sql'       => "varchar(256) NOT NULL default ''"
        ),
        'description' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_costType']['description'],
            'inputType' => 'text',
            'eval'      => array('tl_class'=>'long costType_description','maxlength'=>255),
            'sql'       => "varchar(256) NOT NULL default ''"
        ),
        'measure' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_costType']['measure'],
            'inputType' => 'text',
            'eval'      => array('tl_class'=>'w50','maxlength'=>255),
            'sql'       => "varchar(256) NOT NULL default ''"
        ),
        'cid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['lb_cid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'cdate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['lb_cdate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'uid' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['lb_uid'],
            'sql'                => "varchar(64) COLLATE utf8_bin NULL",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'udate' => array
        (
            'label'              => &$GLOBALS['TL_LANG']['tl_lb_location']['lb_udate'],
            'sql'                => "int(10) unsigned NOT NULL default '0'",
            'eval'               => array('feEditable'=>true, 'feViewable'=>true),
            'inputType'          => 'text'
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        )
    ),
    
    
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 2,
            'fields'                  => array('costType','description','measure','isTask'),
            'panelLayout'             => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('costType','description','measure','isTask'),
            'showColumns'             => true
            
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_costType']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_costType']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.svg',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            )
        )
    )
    
);
