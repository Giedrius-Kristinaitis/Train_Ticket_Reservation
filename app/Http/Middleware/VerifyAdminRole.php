<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Role;

class VerifyAdminRole extends AbstractRoleVerifier
{
    /**
     * @return string
     */
    protected function getRoleToVerify(): string
    {
        return Role::ROLE_ADMIN;
    }
}
