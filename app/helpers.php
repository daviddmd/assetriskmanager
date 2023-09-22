<?php

function caseInsensitiveMatch($filter): string
{
    return sprintf("%%%s%%",trim(strtolower($filter)));
}