<?php

namespace app\Controller;

use app\Blade\Blade;

class Pages
{
    private $metatitle = "";
    private $metadescr = "";

    public function __construct()
    {
        $this->metatitle = _("Energia Simples - Dashboard");
        $this->metadescr = _("Energia Simples Admin Dashboard Template");
    }
    public function index($request)
    {
        $customScript = ['/js/pages/chart-area-demo.js', '/js/pages/chart-pie-demo.js', '/js/pages/index.js'];
        $blade = Blade::new ();
        $html = $blade->make('pages.index', ['metatitle' => $this->metatitle, 'metadescr' => $this->metadescr, 'customScript' => $customScript])->render();
        return $html;
    }
    public function render($request)
    {
        $page = $request["page"];
        $template = 'pages.' . $page;
        $customScript = ['/js/pages/chart-area-demo.js', '/js/pages/chart-pie-demo.js', '/js/pages/chart-bar-demo.js', '/js/pages/index.js', '/js/pages/ckeditor.js', '/js/pages/datatables-demo.js'];
        $blade = Blade::new ();
        $html = $blade->make($template, ['metatitle' => $this->metatitle, 'metadescr' => $this->metadescr, 'customScript' => $customScript])->render();
        return $html;
    }
}
