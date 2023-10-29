<?php

namespace App\Enums;

enum UserRole: string
{
    case Owner = 'Owner';
    case Admin = 'Admin';
    case Operator = 'Operator';
}
