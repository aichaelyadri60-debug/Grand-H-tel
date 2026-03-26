<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif;">

    <h2>📩 Nouveau message de contact</h2>

    <p><strong> l’utilisateur :</strong> {{ $name }}</p>

    <p><strong>Email de l’utilisateur :</strong> {{ $email }}</p>

    <p><strong>Subject :</strong> {{ $mailsubject }}</p>

    <p><strong>numero telephone :</strong> {{ $phone }}</p>


    <p><strong>Message :</strong></p>

    <p style="background:#f4f4f4;padding:12px;border-radius:6px;">
        {{ $mailmessage }}
    </p>

</body>
</html>
