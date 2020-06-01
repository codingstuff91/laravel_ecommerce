<?php

function getPrice($princeInDecimals)
{
    $numberFloat = floatval($princeInDecimals) / 100;
    return number_format($numberFloat,2,'.',' ')." €";
}