<?php

namespace App\Library;

class StringHelper
{


    /**
     * Hace algunos parseos necesarios para evitar que tenga problemas para usar el método Html::addHtml
     *
     * @param $html
     * @param bool $decode define si el $html se va a decodificar (NOTA: Dejar en false para los documentos de Word)
     * @return mixed|string
     */
    public static function parseHtml($html, $decode = false)
    {
//        \Log::info('-----------------------------------------------------------------------
//        ' . $html);

        if ($decode) {
            $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
//            \Log::info($html . '
//        -----------------------------------------------------------------------');
        }

        self::removeAttributes($html);

        self::removeTag('span', $html);
        self::removeTag('i', $html);
        self::removeTag('u', $html);

        //Replace all tags from a table
//        self::replaceTag('div', 'p', $html);
        self::replaceTag('table', 'p', $html);
        self::replaceTag('caption', 'h1', $html);
        self::replaceTag('tbody', 'p', $html);
        self::replaceTag('thead', 'p', $html);
        self::replaceTag('tfoot', 'p', $html);
        self::replaceTag('tr', 'p', $html);
        self::replaceTag('td', 'span', $html);
        self::replaceTag('th', 'span', $html);
        self::replaceTag('th', 'span', $html);

        self::replaceTag('b', 'strong', $html);

        $html = preg_replace('/<!--[\s\S]*?-->/i', '', $html);
        $html = str_replace("<hr/>", "", $html);
        $html = str_replace("<br>", "<br/>", $html);
        $html = str_replace("<br />", "<br/>", $html);
        $html = str_replace("&amp;", "&amp;amp;", $html);  //Escapar doble ampersand para que no truene la generación de documentos
        $html = str_replace("&lt;", "&amp;lt;", $html); //Escapar doble los picoparéntesis
        $html = str_replace("&gt;", "&amp;gt;", $html); //TODO buscar todos los escapes con ampersand y escaparlos doble
        $html = str_replace("&nbsp;", " ", $html); //Reemplazamos los espacios escapados con espacios
        $html = str_replace(array("\n", "\r", "\r\n"), ' ', $html);

        $html = preg_replace('/<a\b[^>]*>(.*?)<\/a>/i', '$1', $html);

        $html = trim($html);
        $html = preg_replace('/\s{2,}/', ' ', $html);
        $html = preg_replace('/\n{2,}/', '\n', $html);
        $html = str_replace(array("> <"), array('><'), $html);


//        $html = str_replace("<br/>", "</p><p>", $html); //106
//        self::fixBadFormed($html); //107
//        self::fixOrphanTag('p', $html); //7

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
        return strip_tags(self::parseHtml($html, true));
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

    /**
     * Reemplaza un tag en un html
     *
     * @param $fromtag
     * @param $totag
     *
     * @param $html
     */
    private static function replaceTag($fromtag, $totag, &$html)
    {
        $html = str_replace("<$fromtag>", "<$totag>", $html);
        $html = str_replace("</$fromtag>", "</$totag>", $html);
    }

    /**
     * Remueve todas las propiedades de los tags de HTML
     *
     * @param $html
     */
    private static function removeAttributes(&$html)
    {
        $html = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\\/?)>/", "<$1$2>", $html);
    }

    /**
     * Arregla el tag $tag cuando se detecta que está huérfano, para cumplir con un XML well formed
     *
     * @param $tag
     * @param $html
     */
    private static function fixOrphanTag($tag, &$html)
    {
        $split = preg_split('/<' . $tag . '>/i', $html);
        $newhtml = '';
        foreach ($split as $item) {
            $replaced = preg_replace('/<\/' . $tag . '>/i', '', $item);

//            \Log::info($replaced);

            //Si no empieza y no termina con alguna de estas opciones
            if (
                substr($replaced, 0, 4) !== "<ul>" && substr($replaced, -5, 5) !== "</ul>" &&
                substr($replaced, 0, 4) !== "<ol>" && substr($replaced, -5, 5) !== "</ol>" &&
                substr($replaced, 0, 5) !== "<div>" && substr($replaced, -6, 6) !== "</div>"
            ) {
                $replaced = "<$tag>$replaced</$tag>";
            }

            $newhtml .= $replaced;
        }
        $html = $newhtml;
    }

    private static function fixBadFormed(&$html)
    {
        $html = preg_replace('/(<li>)(<\/?\w>)?(.*?)(<\/?\w>)?(<\/li>)/i', '$1$3$5', $html);
        return $html;

    }

    /**
     * Cuando un parseo no funciona, se aplica otro parseo para evitar excepciones al crear un documento de Word
     *
     * @param $html
     * @return mixed
     */
    public static function extraParse($html)
    {
        $html = preg_replace('/(<p>\s*)(\b.*?)?(<\/p>)?(\W*<ul>)/i', '$1$2</p>$4', $html);
        $html = preg_replace('/(<\/ul>\s*)(\b.*?)?(<\/p>)?(\W*<\/p>)/i', '$1<p>$3$4', $html);

        return $html;
    }
}