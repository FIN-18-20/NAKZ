<?php

/**
 * @author Kévin Mury
 * @email kevin.mury@eduvaud.ch
 * @create date 2019-12-17 09:06:00
 * @modify date 2019-12-17 09:16:27
 * @desc [description]
 */

 /**
  * Checks if a variable exists and isn't empty
  *
  * @param [string] $data The data to check
  * @return [bool] Returns true if it exists and isn't empty, else false
  */
function exists($data) : bool
{
    if (isset($data) and !empty($data)) {
        return true;
    }
    return false;
}

/**
 * Returns the value of a variable if it exists else an empty string.
 *
 * @param [string] $data
 * @return [string] The data value if it exists else an empty string.
 */
function secure($data) : string
{
    if (isset($data) and !empty($data)) {
        return $data;
    }
    return '';
}

?>