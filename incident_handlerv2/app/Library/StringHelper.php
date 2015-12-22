<?php

namespace App\Library;

class StringHelper
{


    /**
     * Hace algunos parseos necesarios para evitar que tenga problemas para usar el método Html::addHtml
     *
     * @param $html
     * @return mixed|string
     */
    public static function parseHtml($html)
    {
        self::removeTag('span', $html);
        self::removeTag('div', $html);
        self::removeTag('i', $html);
        self::removeTag('b', $html);
        $html = str_replace("<br>", "<br/>", $html);
        $html = str_replace(array("\n", "\r", "\r\n"), ' ', $html);
        $html = preg_replace('/<a\b[^>]*>(.*?)<\/a>/i', '$1', $html);
        $html = str_replace("&nbsp;", " ", $html);
        $html = str_replace("&", "&amp;", $html);
        $html = trim($html);
        $html = preg_replace('/\s{2,}/', ' ', $html);
        $html = preg_replace('/\n{2,}/', '\n', $html);
        $html = str_replace(array("> <"), array('><'), $html);

        return $html;
    }

    /**
     * Remueve todas las etiquetas html del string $html
     *
     * @param $html
     * @return string
     */
    public static function htmlToString($html)
    {
        return strip_tags(self::parseHtml($html));
    }

    /**
     * Remueve el tag $tag del html $html
     *
     * @param $tag
     * @param $html
     */
    private static function removeTag($tag, &$html)
    {
        $html = str_replace("<$tag>", "", $html);
        $html = str_replace("</$tag>", "", $html);
    }
}