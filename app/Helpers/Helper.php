<?php

use Illuminate\Support\Facades\Request;

function isActive($param)
{
    if (is_array($param)) {
        foreach ($param as $par) {
            if (Request::route()->getPrefix() == '/' . $par) {
                return 'active';
            }
        }
    } else {
        return Request::route()->getPrefix() == '/' . $param ? 'active' : '';
    }

    return Request::route()->getPrefix();

    return '';
}