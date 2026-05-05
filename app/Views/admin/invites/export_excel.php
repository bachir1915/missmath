<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
    <meta charset="UTF-8">
    <style>
        table { border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; }
        th { background-color: #6a0dad; color: white; font-weight: bold; font-size: 14px; padding: 10px; border: 1px solid #dddddd; text-transform: uppercase; }
        td { font-size: 13px; padding: 8px; border: 1px solid #dddddd; }
        tr:nth-child(even) td { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <h2>Liste des Invités - Miss Maths / Miss Sciences 2026</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Nom</th><th>Prénom</th><th>Catégorie</th><th>Établissement</th><th>Classe</th><th>Profession</th><th>Email</th><th>Téléphone</th><th>Intérêt</th><th>Réseau Social</th><th>Statut</th><th>Date Inscription</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invites as $invite): ?>
            <tr>
                <td style="text-align:center;"><?= $invite['id'] ?></td>
                <td style="font-weight:bold;"><?= esc($invite['nom']) ?></td>
                <td><?= esc($invite['prenom']) ?></td>
                <td style="color:#6a0dad; font-weight:bold;"><?= esc($invite['category_name'] ?? 'Non spécifié') ?></td>
                <td><?= esc($invite['establishment']) ?></td>
                <td style="text-align:center;"><?= esc($invite['class']) ?></td>
                <td><?= esc($invite['profession']) ?></td>
                <td><?= esc($invite['email']) ?></td>
                <td><?= esc($invite['telephone']) ?></td>
                <td><?= esc($invite['interest']) ?></td>
                <td><?= esc($invite['social_network']) ?></td>
                
                <?php 
                    $statusColor = $invite['statut'] == 'valide' ? '#10b981' : ($invite['statut'] == 'annule' ? '#ef4444' : '#f59e0b');
                ?>
                <td style="color:<?= $statusColor ?>; font-weight:bold; text-transform:uppercase;"><?= esc($invite['statut']) ?></td>
                <td><?= esc($invite['created_at']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
