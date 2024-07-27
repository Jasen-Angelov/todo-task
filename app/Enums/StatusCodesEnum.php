<?php

namespace App\Enums;

enum StatusCodesEnum: int
{
    case OK = 200;
    case CREATED = 201;
    case ACCEPTED = 202;
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;
    case UNPROCESSABLE = 422;
}
