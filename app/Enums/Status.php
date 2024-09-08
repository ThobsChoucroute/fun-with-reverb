<?php

namespace App\Enums;

enum Status: string {
    case NEW  = "new";
    case INSTALLING = "installing";
    case INSTALLING_COMPOSER = "installing_composer";
    case INSTALLING_NPM = "installing_npm";
    case INSTALLING_ENV = "installing_env";
    case INSTALLED = "installed";
}
