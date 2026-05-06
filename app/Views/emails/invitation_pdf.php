<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 0;
            size: A4 portrait;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #1a1a1a;
        }
        .page-wrapper {
            width: 210mm;
            height: 297mm;
            padding-top: 15mm;
            background-color: #f0f2f5;
        }
        .invitation-card {
            width: 160mm;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        /* Purple Header Section */
        .header {
            background-color: #6A0DAD;
            padding: 40px 20px;
            text-align: center;
            border-bottom: 5px solid #D4AF37;
        }
        .logo-title {
            font-size: 28px;
            font-weight: 900;
            color: #D4AF37;
            letter-spacing: 2px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .logo-subtitle {
            font-size: 14px;
            color: #ffffff;
            letter-spacing: 4px;
            font-weight: 500;
            text-transform: uppercase;
            opacity: 0.9;
        }
        
        /* Content Section */
        .content {
            padding: 40px 50px;
            text-align: center;
        }
        
        .badge-official {
            display: inline-block;
            background: #fcefdc;
            color: #D4AF37;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 30px;
            border: 1px solid #f9e3c2;
        }
        
        .congrats-text {
            font-size: 24px;
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 20px;
        }
        
        .main-message {
            font-size: 16px;
            color: #636e72;
            line-height: 1.6;
            margin-bottom: 40px;
            padding: 0 20px;
        }
        .highlight {
            color: #2d3436;
            font-weight: 700;
        }
        
        /* Details Section */
        .details-section {
            background: #f8f9fa;
            border-left: 4px solid #6A0DAD;
            border-radius: 0 12px 12px 0;
            padding: 25px;
            margin-bottom: 30px;
            text-align: left;
        }
        .section-title {
            font-size: 12px;
            color: #6A0DAD;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 15px;
        }
        
        .details-table {
            width: 100%;
        }
        .detail-item {
            margin-bottom: 10px;
        }
        .detail-label {
            font-size: 10px;
            color: #b2bec3;
            text-transform: uppercase;
            font-weight: 700;
        }
        .detail-value {
            font-size: 15px;
            color: #2d3436;
            font-weight: 700;
        }
        
        /* QR Code Section */
        .qr-section {
            padding: 20px;
            border: 1px dashed #e1e1e1;
            border-radius: 15px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .qr-image {
            width: 220px;
            height: 220px;
        }
        .qr-instruction {
            font-size: 11px;
            color: #6A0DAD;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }
        
        .footer {
            padding: 30px;
            background: #ffffff;
            border-top: 1px solid #f0f0f0;
            text-align: center;
        }
        .footer-text {
            font-size: 10px;
            color: #b2bec3;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="invitation-card">
            <!-- Header Section -->
            <div class="header">
                <div class="logo-title">Miss Maths/Miss Sciences</div>
                <div class="logo-subtitle">IA de Dakar &bull; Édition 2026</div>
            </div>

            <div class="content">
                <!-- Official Badge -->
                <div class="badge-official">Invitation Officielle</div>

                <!-- Personalization -->
                <div class="congrats-text">Félicitations <?= esc($name) ?>,</div>
                
                <div class="main-message">
                    Nous sommes honorés de vous compter parmi nos invités pour la prestigieuse cérémonie de remise des prix <span class="highlight">Miss Maths/Miss Sciences 2026</span>.
                </div>
                
                <!-- Event Details -->
                <div class="details-section">
                    <div class="section-title">Lieu de l'événement</div>
                    <table class="details-table">
                        <tr>
                            <td style="width: 50%;">
                                <div class="detail-label">Localisation</div>
                                <div class="detail-value">Théâtre Daniel Sorano</div>
                            </td>
                            <td>
                                <div class="detail-label">Date et Heure</div>
                                <div class="detail-value">13 Mai 2026 &bull; 09h00</div>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- QR Code Area -->
                <div class="qr-section">
                    <img src="data:image/png;base64,<?= base64_encode(file_get_contents($qrPath)) ?>" class="qr-image">
                    <div class="qr-instruction">À présenter à l'entrée</div>
                </div>
                
                <div style="font-family: monospace; font-size: 9px; color: #b2bec3; margin-top: 10px;">ID TICKET: <?= strtoupper(substr($code, 0, 12)) ?></div>
            </div>

            <div class="footer">
                <p class="footer-text">
                    Cette invitation est personnelle et requise pour accéder à la cérémonie.<br>
                    <strong>Inspection d'Académie de Dakar</strong> &bull; Ministère de l'Éducation Nationale<br>
                    &copy; 2026 Tous droits réservés
                </p>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 10mm;">
            <p style="font-size: 8px; color: #b2bec3; letter-spacing: 1px; text-transform: uppercase;">
                Document sécurisé généré par la plateforme officielle Miss Maths/Miss Sciences
            </p>
        </div>
    </div>
</body>
</html>
