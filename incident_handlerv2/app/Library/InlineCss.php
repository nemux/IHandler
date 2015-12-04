<?php

namespace App\Library;

use Monolog\Handler\LogglyHandler;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class InlineCss
{
    /**
     * Filename of the view to render
     * @var string
     */
    private $view;
    /**
     * Data - passed to view
     * @var array
     */
    private $data;

    private $images = array();

    /**
     * @param string $view Filename/path of view to render
     * @param array $data Data of email
     */
    public function __construct($view, array $data)
    {
        // Render the email view
        $emailView = view($view, $data)->render();
        $this->view = $emailView;
        $this->data = $data;
    }

    /**
     * Convert to inlined CSS
     *
     * @return string
     * @throws \TijsVerkoyen\CssToInlineStyles\Exception
     */
    public function convert()
    {
        $html = $this->view;
        $css = '';
        $styles = array();
        $html = preg_replace('/[\r\n\t]*/', '', $html);


        //CSS Styles
        $cssRegex = '/(<link )(rel=\\"[\w\S]*\\")( href=\\")([\w\S]*)(\\")([ \w\S]*)(>)/iU';
        preg_match_all($cssRegex, $html, $styles);
//        $html = preg_replace($cssRegex, " ", $html);

        //Script tags
        $scriptRegex = '/(<script [\w\S ]*><\/script>)/iU';
//        $html = preg_replace($scriptRegex, " ", $html);

        //Reemplaza las imagenes con su binario en base64
        $imgRegex = '/(<img alt=\"[\S\w]*\" src=\")(http:\/\/)([\w]*[:]*[\d]*\/)([\w\S]*)(\" style=\"[\S\w\W]*\" \/>)/miU';
//        $html = preg_replace_callback($imgRegex, function ($m) {
//            $src = 'data:' . mime_content_type($m[4]) . ';base64,' . base64_encode(file_get_contents($m[4]));
//            $img = $m[1] . $src . $m[5];


//            $name = str_replace('/', '', $m[4]);
//            $mime = mime_content_type($m[4]);
//
//            $img['name'] = $name;
//            $img['path'] = $m[4];
//            $img['mime'] = $mime;
//
//            array_push($this->images, $img);
//            $img = $m[1] . 'cid:' . $name . '\\' . $m[5];


//            $img = $m[1] . '/' . $m[4] . $m[5];
//
//            return $img;
//
//        }, $html);

        foreach ($styles[4] as $style) {
            if (strpos($style, 'googleapis.com') === false) {
//                \Log::info($style);
                $pathStyle = preg_replace('/(http:\/\/)*([\w]*[:]*[\d]*)*(\/)*([\w\S]*)/', "$4", $style);
                $css .= file_get_contents($pathStyle);
            }
        }

        $cssToInline = new CssToInlineStyles($html, $css);
        $html = $cssToInline->convert();

        return $html;
    }

    /**
     * Devuelve el array de imágenes contenido en el HTML
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }
}