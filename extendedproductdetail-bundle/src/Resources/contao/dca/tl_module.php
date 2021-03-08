<?php
// dca/tl_module.php
$GLOBALS['TL_DCA']['tl_module']['fields']['bundle'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['tl_module']['bundle'],
    'exclude'               => true,
    'inputType'             => 'select',
    //'options'               => $GLOBALS['TL_LANG'][$table]['myselect']['options'],
    'foreignKey'            => 'tl_lb_productBundle.bundleName',
    //'options_callback'      => ['CLASS', 'METHOD'],
    'eval'                  => ['includeBlankOption'=>true, 'tl_class'=>'w50'],
    'sql'                   => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['headlineSearch'] = array
(
    'label' => array('Überschrift', 'Geben Sie die Überschrift für ihre Domainsuche ein.'),
    'inputType' => 'textarea',
    'eval' => array('tl_class' => 'w50'),
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['placeholder'] = array
(
    'label' => array('Platzhaltertext', 'Bitte den Platzhaltertext für das Suchfeld eingeben.'),
    'inputType' => 'text',
    'eval' => array('tl_class' => 'w50'),
    'sql'                   => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['buttonLabel'] = array
(
    'label' => array('Button Text', 'Bitte Beschriftung des Buttons eingeben.'),
    'inputType' => 'text',
    'eval' => array('tl_class' => 'w50'),
    'sql'                   => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['buttonType'] = array
(
    'label' => array('Button-Typ', 'Buttontyp auswählen: Haupt-CTA, Weitere oder Ausnahme.'), 
    'inputType' => 'select',
    'options' => array(
        'button1' => 'Button Standard (Haupt-CTA)',
        'button2' => 'Button Zusatz (Secondary)',
        'button3' => 'Button Ausnahme (Brandcolor2)',
    ),
    'eval' => array('tl_class' => 'w50'),
    'sql'                   => "varchar(255) NOT NULL default 'button2'"
);

// dca/tl_module.phpy

$GLOBALS['TL_DCA']['tl_module']['palettes']['bundleButton'] = '{type_legend},name,type;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['bundleButton'].= '{template_legend:hide},customTpl;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['bundleButton'].= '{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_module']['palettes']['domainCheckListe'] = '{type_legend},name,type,headlineSearch,placeholder,buttonLabel,buttonType;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop;{template_legend:hide},customTpl;';
$GLOBALS['TL_DCA']['tl_module']['palettes']['productButton'].= '{type_legend},name,type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';