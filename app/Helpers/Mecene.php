<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\Pricing;
use App\Models\Abonnement;
use App\Models\Eleve;
use Illuminate\Support\Facades\DB;

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
            $school = School::where('is_published', 1)->first();

            $abonnement = Abonnement::where('is_active', 1)->where('statut', 1)->first();
            $tenantId = $abonnement->tenant_id;
            // $abonnement = Abonnement::where('user_id', $user->id)
            // ->where('tenant_id', $user->tenant->id)
            // ->where('is_active', 1)
            // ->first();

             if(!$abonnement) {
                return ['status' => false, 'message' => 'Abonnement introuvable !'];
             }


            $currentStudentCount = Eleve::where('school_id', $school->id)->count();

            config(['database.connections.mysql.database' => 'eng']);
            DB::purge('mysql');
            DB::reconnect('mysql');
            DB::connection('mysql')->getPdo();

            $pricing = DB::connection('mysql')->table('pricings')->select('name', 'max_students')->where('id', $abonnement->pricing_id)->first();

            if ($currentStudentCount >= $pricing->max_students) {
                return ['status' => true, 'message' => 'Vous avez atteint le nombre maximum d\'eleves autorisés'];
            }

            return ['status' => false];

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
