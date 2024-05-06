<?php

namespace App\Core;

enum ApiKeys: string
{
    case PER_PAGE = 'perPage';
    case TOTAL = 'total';
    case CURRENT_PAGE = 'currentPage';
    case LAST_PAGE = 'lastPage';
    case META = 'meta';

    case ID = 'id';
    case NAME = 'name';
    case RATE = 'rate';
}
