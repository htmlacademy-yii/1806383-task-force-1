<?php


namespace DataBaseUtils\fillTables;


trait CompositeString
{
    function compositeStringToArray(string $info): array
    {
        $string = preg_split("#,\"|\",#", $info);
        $leftPart = explode(",", $string[0]);
        $centerPart = $string[1];
        $finalString = [];

        if (array_key_exists(2, $string)) {

            $rightPart = explode(",", $string[2]);
            $finalString = array_merge($leftPart, array($centerPart), $rightPart);

        } else {

            $finalString = array_merge($leftPart, array($centerPart));

        }


        return $finalString;
    }

    function StringParser($regular, $file)
    {
        if (preg_match($regular, $file->current())) {
            $comment = $file->current();
            if ($file->valid()) {
                $file->next();
            } else {
                return false;
            }

            while (!preg_match($regular, $file->current())) {

                $comment = $comment . $file->current();
                if ($file->valid()) {
                    $file->next();
                } else {
                    return false;
                }
            }
            return $comment;
        }
        if ($file->valid()) {
            $file->next();
        } else {
            return false;
        }
    }

    function checkEnd($file)
    {
        if ($file->valid()) {
            $file->next();
        } else {
            return false;
        }
    }
}
