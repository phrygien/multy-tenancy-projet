<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Module;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModuleAccessPolicy
{
    use HandlesAuthorization;

    public function accessModule(User $user, Module $module)
    {
        // Vérifie si l'utilisateur a un abonnement valide pour un pack contenant ce module
        return $user->abonnements()
                    ->whereHas('pack', function ($query) use ($module) {
                        $query->whereHas('modules', function ($query) use ($module) {
                            $query->where('modules.id', $module->id);
                        });
                    })
                    ->exists();
    }
}
