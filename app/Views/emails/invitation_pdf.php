<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; size: A4 portrait; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            color: #2c3e50;
        }
        .page-container {
            width: 210mm;
            padding-top: 5mm; 
            text-align: center;
        }
        .ticket-card {
            width: 170mm;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }
        /* Header Section */
        .header {
            background-color: #6A0DAD;
            padding: 25px 30px; 
            border-bottom: 5px solid #D4AF37;
        }
        .title-event {
            font-size: 24px; 
            font-weight: bold;
            color: #D4AF37;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 2px;
        }
        .subtitle-event {
            font-size: 11px;
            color: #ffffff;
            letter-spacing: 3px;
            text-transform: uppercase;
            opacity: 0.8;
        }

        /* Body Section */
        .content {
            padding: 25px 40px; 
        }
        .badge {
            display: inline-block;
            background-color: #fdf5e6;
            color: #b8860b;
            padding: 6px 15px;
            border-radius: 30px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            border: 1px solid #f5deb3;
        }
        .guest-name {
            font-size: 22px; 
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        .welcome-text {
            font-size: 12px;
            color: #7f8c8d;
            line-height: 1.4;
            margin-bottom: 20px; 
        }

        /* Info Grid via Table for perfect centering */
        .info-table {
            width: 100%;
            margin-bottom: 20px; 
            border-collapse: collapse;
        }
        .info-box {
            background-color: #f9fbfc;
            border-left: 4px solid #6A0DAD;
            padding: 12px;
            text-align: left;
        }
        .info-label {
            font-size: 8px;
            color: #95a5a6;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        .info-value {
            font-size: 13px;
            color: #2c3e50;
            font-weight: bold;
        }

        /* QR Area - The critical part for centering */
        .qr-wrapper-table {
            width: 100%;
            margin-bottom: 10px; 
        }
        .qr-box {
            background-color: #ffffff;
            padding: 10px;
            border: 1px solid #eeeeee;
            border-radius: 15px;
            display: inline-block;
        }
        .qr-image {
            width: 140px; /* Taille optimale pour garantir le mono-page */
            height: 140px;
        }
        .qr-footer-text {
            font-size: 10px;
            color: #6A0DAD;
            font-weight: bold;
            margin-top: 5px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Footer */
        .footer {
            background-color: #fafafa;
            padding: 20px;
            border-top: 1px solid #eeeeee;
            font-size: 9px;
            color: #bdc3c7;
            line-height: 1.4;
        }
        .ticket-id {
            font-family: monospace;
            font-size: 8px;
            color: #d1d1d1;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="ticket-card">
            <!-- HEADER -->
            <div class="header">
                <div class="title-event">Miss Maths/Miss Sciences</div>
                <div class="subtitle-event">IA de Dakar &bull; 2026</div>
            </div>

            <!-- CONTENT -->
            <div class="content">
                <div class="badge">Invitation Officielle</div>
                
                <div class="guest-name"><?= esc($name) ?></div>
                <div class="welcome-text">
                    Nous avons l'honneur de vous inviter à la cérémonie <strong>MISS MATHS & MISS SCIENCES</strong>, qui met à l'honneur l'intelligence, la créativité et l'excellence des jeunes talents féminins dans les domaines des mathématiques et des sciences.
                </div>

                <!-- INFO GRID -->
                <?php 
                    // SVG Icons for maximum PDF compatibility
                    $iconPhone = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="#D4AF37" style="vertical-align: middle; margin-right: 5px;"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58z"/></svg>';
                    $iconDate  = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="#D4AF37" style="vertical-align: middle; margin-right: 5px;"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/></svg>';
                    $iconGeo   = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="#D4AF37" style="vertical-align: middle; margin-right: 5px;"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/></svg>';
                    $iconSchool= '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="#D4AF37" style="vertical-align: middle; margin-right: 5px;"><path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z"/></svg>';
                    $iconGrad  = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="#D4AF37" style="vertical-align: middle; margin-right: 5px;"><path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.274a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"/></svg>';
                    $iconBrief = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="#D4AF37" style="vertical-align: middle; margin-right: 5px;"><path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5m1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.114 1.764a.5.5 0 0 0 .272 0M4 11h8v1H4z"/></svg>';
                    $iconInfo  = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="#D4AF37" style="vertical-align: middle; margin-right: 5px;"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/></svg>';
                ?>
                <table class="info-table">
                    <tr>
                        <td style="width: 48%; padding-right: 4%;">
                            <div class="info-box">
                                <div class="info-label"><?= $iconPhone ?> Téléphone de l'invité</div>
                                <div class="info-value"><?= format_phone_number($invite['telephone']) ?></div>
                            </div>
                        </td>
                        <td style="width: 48%;">
                            <div class="info-box">
                                <div class="info-label"><?= $iconDate ?> Date & Heure</div>
                                <div class="info-value">13 Mai 2026 &bull; 09h00</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top: 12px;">
                            <div class="info-box">
                                <div class="info-label"><?= $iconGeo ?> Lieu de l'événement</div>
                                <div class="info-value">Théâtre National Daniel Sorano</div>
                            </div>
                        </td>
                    </tr>

                    <?php if (!empty($invite['establishment'])): ?>
                    <tr>
                        <td colspan="2" style="padding-top: 12px;">
                            <div class="info-box">
                                <div class="info-label"><?= $iconSchool ?> <?= ($invite['category_id'] == 3) ? 'Groupe / Entité' : 'Établissement' ?></div>
                                <div class="info-value"><?= esc($invite['establishment']) ?></div>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <?php if (!empty($invite['class'])): ?>
                    <tr>
                        <td colspan="2" style="padding-top: 12px;">
                            <div class="info-box">
                                <div class="info-label"><?= $iconGrad ?> Classe / Niveau</div>
                                <div class="info-value"><?= esc($invite['class']) ?></div>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <?php if (!empty($invite['profession'])): ?>
                    <tr>
                        <td colspan="2" style="padding-top: 12px;">
                            <div class="info-box">
                                <div class="info-label"><?= $iconBrief ?> Profession</div>
                                <div class="info-value"><?= esc($invite['profession']) ?></div>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <?php if (!empty($invite['interest'])): ?>
                    <tr>
                        <td colspan="2" style="padding-top: 12px;">
                            <div class="info-box">
                                <div class="info-label"><?= $iconInfo ?> Intérêt pour le concours</div>
                                <div class="info-value"><?= esc($invite['interest']) ?></div>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>

                <!-- QR CODE (CENTERED VIA TABLE) -->
                <table class="qr-wrapper-table">
                    <tr>
                        <td align="center">
                            <div class="qr-box">
                                <img src="data:image/png;base64,<?= base64_encode(file_get_contents($qrPath)) ?>" class="qr-image">
                            </div>
                            <div class="ticket-id">RÉFÉRENCE : <?= strtoupper(substr($code, 0, 16)) ?></div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- FOOTER -->
            <div class="footer">
                Cette invitation est strictement personnelle et infalsifiable. <br>
                Elle devra être présentée sous format numérique ou imprimé au service d'accueil.<br>
                <strong>Inspection d'Académie de Dakar &copy; 2026</strong>
            </div>
        </div>
        
        <div style="margin-top: 15mm; color: #bdc3c7; font-size: 9px; text-transform: uppercase; letter-spacing: 1px;">
            Document officiel certifié par l'IA de Dakar
        </div>
    </div>
</body>
</html>
