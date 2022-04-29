<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

trait HasPermissions
{
    /**
     * Whether a said user has a permission node
     * @param string $permission the permission node
     * @return bool true if authorised
     */
    public function hasPermission(string $permission): bool
    {
        $role = $this->role ?? 'default';
        $groups = $this->getGroupPermissions();

        //No groups or permission doesn't exist
        if (empty($groups) || !isset($groups[$role])) {
            return false;
        }

        return in_array($permission, $groups[$role]);
    }

    private function getGroupPermissions(): array
    {
        $groups = Cache::get('permissions');
        if ($groups === null) {
            $groups = $this->parsePermissions(
                Yaml::parse(
                    Storage::disk('local')->get('permissions.yaml')
                ));

            Cache::add('permissions', $groups);
        }
        return $groups;
    }

    private function parsePermissions($permissions): array
    {
        $groups = [];
        foreach ($permissions['groups'] as $group => $perms) {
            $groups[$group] = $perms;
        }
        return $groups;
    }
}
