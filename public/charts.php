<?php
require __DIR__ . "/init.php";
/**
 * Index Page Admin Dashboard
 */

use app\Blade\Blade;

$metatitle = _("Energia Simples - Dashboard");
$metadescr = _("Energia Simples Admin Dashboard Template");

$customScript = ['/js/pages/chart-area-demo.js','/js/pages/chart-bar-demo.js','/js/pages/chart-pie-demo.js'];

$blade = Blade::new ();
echo $blade->make('pages.charts', ['metatitle' => $metatitle, 'metadescr' => $metadescr, 'customScript' => $customScript])->render();
