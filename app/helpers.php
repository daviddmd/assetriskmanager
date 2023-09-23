<?php

function caseInsensitiveMatch($filter): string
{
    return sprintf("%%%s%%", trim(strtolower($filter)));
}

function lowerLike($column): string
{
    return sprintf('LOWER("%s") LIKE ?', $column);
}