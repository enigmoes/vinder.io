<?php

class Date {

    public static function dateTimeToDb($date) {
        if (!empty($date)) {
            $delimiter = '-';
            if (strpos($date, '/')) {
                $delimiter = '/';
            }
            list($d, $m, $y) = explode($delimiter, $date);
            return $y.'-'.$m.'-'.$d.' '.date('H:i:s');
        } else {
            return null;
        }
    }

    public static function dateToDb($date) {
        if (!empty($date)) {
            $delimiter = '-';
            if (strpos($date, '/')) {
                $delimiter = '/';
            }
            list($d, $m, $y) = explode($delimiter, $date);
            return $y.'-'.$m.'-'.$d;
        } else {
            return null;
        }
    }

    public static function dateToView($date) {
        if (!empty($date)) {
            $delimiter = '-';
            if (strpos($date, '/')) {
                $delimiter = '/';
            }
            list($y, $m, $d) = explode($delimiter, $date);
            return $d.'/'.$m.'/'.$y;
        } else {
            return null;
        }
    }

    public static function getYears($from, $to) {
        $years = [];
        for ($i = $from; $i <= $to; $i++) {
            $years[$i] = $i;
        }
        return $years;
    }

}

class Time {

    // Funcion convierte tiempo en decimal
    public static function timeToDec($time) {
        $result = 0;
        $tiempo = explode(':', $time);
        $minutos = $tiempo[0] * 60 + $tiempo[1];
        $result += round($minutos / 60, 2);
        return $result;
    }

}

class Functions {

    /**
     * Funcion que extrae una columna de un array convertida en string
     */
    public function addFieldAsString(&$datas, $field_name, $rule, $glue = ',')
    {
        // Recorremos datos
        foreach ($datas as $data) {
            $data[$field_name] = implode($glue, Hash::extract($data, $rule));
        }
    }

    /**
     * Funcion convierte subitems de un array en variable simple
     */
    public function arrayToObject($array, $pos = 0)
    {
        foreach ($array as $key => $item) {
            // Comprobamos que el item sea array
            if (is_array($item)) {
                $array[$key] = $item[$pos];
            }
        }
        return $array;
    }

    /**
     * Retorna cadena alpanumerica aleatoria
     */
    public static function random_string($length)
    {
        return strtoupper(substr(bin2hex(random_bytes($length)), 0, $length)); 
    }

    /**
     * Returns a html string truncated
     */
    static function truncateHtml($html, $maxLength, $isUtf8=true) {
        $printedLength = 0;
        $position = 0;
        $tags = array();
        $string = '';

        // For UTF-8, we need to count multibyte sequences as one character.
        $re = $isUtf8
            ? '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;|[\x80-\xFF][\x80-\xBF]*}'
            : '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}';

        while ($printedLength < $maxLength && preg_match($re, $html, $match, PREG_OFFSET_CAPTURE, $position))
        {
            list($tag, $tagPosition) = $match[0];

            // Print text leading up to the tag.
            $str = substr($html, $position, $tagPosition - $position);
            if ($printedLength + strlen($str) > $maxLength)
            {
                $string .= substr($str, 0, $maxLength - $printedLength);
                $printedLength = $maxLength;
                break;
            }

            $string .= $str;
            $printedLength += strlen($str);
            if ($printedLength >= $maxLength) break;

            if ($tag[0] == '&' || ord($tag) >= 0x80)
            {
                // Pass the entity or UTF-8 multibyte sequence through unchanged.
                $string .= $tag;
                $printedLength++;
            }
            else
            {
                // Handle the tag.
                $tagName = $match[1][0];
                if ($tag[1] == '/')
                {
                    // This is a closing tag.

                    $openingTag = array_pop($tags);
                    assert($openingTag == $tagName); // check that tags are properly nested.

                    $string .= $tag;
                }
                else if ($tag[strlen($tag) - 2] == '/')
                {
                    // Self-closing tag.
                    $string .= $tag;
                }
                else
                {
                    // Opening tag.
                    $string .= $tag;
                    $tags[] = $tagName;
                }
            }

            // Continue after the tag.
            $position = $tagPosition + strlen($tag);
        }

        // Print any remaining text.
        if ($printedLength < $maxLength && $position < strlen($html))
            $string .= substr($html, $position, $maxLength - $printedLength);

        // Close any open tags.
        //while (!empty($tags))
        // $string .= printf('</%s>', array_pop($tags));
        $string = preg_replace('/<p[^>]*><img[^>]+\><\/p>/i', '', $string);

        return $string;
    }
    
}
