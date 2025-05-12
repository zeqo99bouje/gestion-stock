<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Sociétés</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h1>Liste des Sociétés</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($societes as $societe)
                <tr>
                    <td>{{ $societe->nom }}</td>
                    <td>{{ $societe->adresse }}</td>
                    <td>{{ $societe->telephone }}</td>
                    <td>{{ $societe->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>