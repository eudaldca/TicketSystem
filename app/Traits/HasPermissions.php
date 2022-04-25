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
        $permissions = $this->getGroupPermissions();

        // Permissions file error / not found
        if ($permissions === null || !isset($permissions['groups'])) {
            return false;
        }
        $groups = $permissions['groups'];
        // Permission doesn't exist
        if (!isset($groups[$role])) {
            return false;
        }

        return in_array($permission, $groups[$role]);
    }

    /**
     * @return mixed
     */
    private function getGroupPermissions(): mixed
    {
        $permissions = Cache::get('permissions');
        if ($permissions === null) {
            $permissions = Yaml::parse(Storage::disk('local')->get('permissions.yaml'));
            Cache::add('permissions', $permissions);
        }
        return $permissions;
    }
}
