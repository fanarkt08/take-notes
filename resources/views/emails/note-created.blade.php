<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouvelle note créée</title>
</head>
<body>
    <h1>Votre note a été créée avec succès</h1>

    <p>Bonjour {{ $note->user->name }},</p>

    <p>Voici le récapitulatif de votre nouvelle note :</p>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Titre</th>
            <td>{{ $note->title }}</td>
        </tr>
        <tr>
            <th>Contenu</th>
            <td>{{ $note->content }}</td>
        </tr>
        <tr>
            <th>Créée le</th>
            <td>{{ $note->created_at->format('d/m/Y à H:i') }}</td>
        </tr>
    </table>
</body>
</html>
