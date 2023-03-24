@component('mail::message')
Bonjour {{ $user->getFullname() }},

Nous vous informons que votre mot de passe a été changé avec succès sur notre plateforme. Si vous n'avez pas initié cette modification de mot de passe, veuillez contacter immédiatement notre équipe de support clientèle pour signaler cette activité suspecte.

Si vous êtes l'auteur de cette modification, vous pouvez vous connecter à votre compte en utilisant le nouveau mot de passe que vous avez créé. Nous vous recommandons également de prendre les mesures nécessaires pour assurer la sécurité de votre compte en choisissant un mot de passe fort et en évitant de partager vos informations de connexion avec d'autres personnes.

Nous sommes toujours disponibles pour vous aider si vous avez besoin d'assistance ou si vous avez des questions. N'hésitez pas à nous contacter si vous avez besoin d'aide supplémentaire.

Cordialement,<br>
L'équipe de support.
@endcomponent
