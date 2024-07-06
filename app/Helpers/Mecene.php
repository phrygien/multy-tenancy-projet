<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\Pricing;
use App\Models\Abonnement;
use App\Models\Eleve;

class Mecene
{
    public static function generateUniqueId($length = 7)
    {
        do {
            $uniqueId = Str::random($length);
        } while (School::where('identity', $uniqueId)->exists());

        return $uniqueId;
    }

    public static function hasReachedSchoolLimit()
    {
        $user = Auth::user();
        $abonnement = Abonnement::where('user_id', $user->id)
            ->where('tenant_id', $user->tenant->id)
            ->where('is_active', 1)
            ->first();

        if (!$abonnement) {
            return ['status' => false, 'message' => 'Pas d\'abonnement actif pour le moment !'];
        }

        $pricing = Pricing::where('id', $abonnement->pricing_id)->first();
        $currentSchoolCount = School::where('user_id', $user->id)->count();

        if ($currentSchoolCount >= $pricing->max_school) {
            return ['status' => true, 'message' => 'Vous avez atteint le nombre maximum d\'etablissements autorisés'];
        }

        return ['status' => false];
    }

    // ckeck limit eleve
    public static function hasReachedStudentLimit()
    {
        try {
            $user = Auth::user();
            $school = School::where('user_id', $user->id)->first();

            $abonnement = Abonnement::where('user_id', $user->id)
            ->where('tenant_id', $user->tenant->id)
            ->where('is_active', 1)
            ->first();

             if(!$school) {
                return ['status' => false, 'message' => 'Vous n\'etes pas encore affectez a un ecole !'];
             }

             $pricing = Pricing::where('id', $abonnement->pricing_id)->first();
            $currentStudentCount = Eleve::where('school_id', $school->id)->count();

            if ($currentStudentCount >= $pricing->max_student) {
                return ['status' => true, 'message' => 'Vous avez atteint le nombre maximum d\'eleves autorisés'];
            }

            return ['status' => false];

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
