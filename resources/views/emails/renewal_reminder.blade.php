<x-mail::message>
# Bonjour

Votre abonnement chez {{ config('app.name') }} expirera le {{ $subscription->fin }}. Renouvelez-le rapidement pour continuer à bénéficier de nos services.

<x-mail::button :url="''">
Renouveler abonnement
</x-mail::button>

Remerciements,<br>
{{ config('app.name') }}
</x-mail::message>
