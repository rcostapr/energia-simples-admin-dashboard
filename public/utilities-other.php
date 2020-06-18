<?php
require __DIR__ . "/init.php";
/**
 * Index Page Admin Dashboard
 */

use app\Blade\Blade;

$metatitle = _("Energia Simples - Dashboard");
$metadescr = _("Energia Simples Admin Dashboard Template");

$customScript = '/js/pages/index.js';

$blade = Blade::new ();
echo $blade->make('pages.utilities-other', ['metatitle' => $metatitle, 'metadescr' => $metadescr, 'customScript' => $customScript])->render();
