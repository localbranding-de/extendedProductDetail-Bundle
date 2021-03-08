<?php 
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['bought'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_calendar_events']['bought'],
    'sql'       => "char(1) NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['updated'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_calendar_events']['updated'],
    'sql'                     => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['order'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_calendar_events']['updated'],
    'sql'                     => "int(10) unsigned NOT NULL default '0'"
);