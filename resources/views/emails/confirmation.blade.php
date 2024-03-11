<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Succesvolle inzending van uw bericht</title>
</head>
<body>
    <h1>Succesvolle inzending van uw bericht</h1>
    <p>Beste {{ $data['name'] }},</p>
    <p>Bedankt voor uw bericht! We hebben uw inzending ontvangen en zullen zo snel mogelijk reageren.</p>
    <h2>Uw bericht:</h2>
    <p><strong>Onderwerp:</strong> {{ $data['subject'] }}</p>
    <p><strong>Bericht:</strong> {{ $data['user_message'] }}</p>
    <p>Met vriendelijke groet,</p>
    <p>Toneelvereniging Christina</p>
</body>
</html>
