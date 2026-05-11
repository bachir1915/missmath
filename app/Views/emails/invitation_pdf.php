<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; size: A4 portrait; }
        body {
            font-family: 'DejaVu Sans', 'Helvetica', 'Arial', sans-serif;
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
            padding: 30px 30px 25px; 
            border-bottom: 5px solid #D4AF37;
        }
        .title-event {
            font-size: 26px; 
            font-weight: bold;
            color: #D4AF37;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 5px;
        }
        .subtitle-event {
            font-size: 11px;
            color: #ffffff;
            letter-spacing: 4px;
            text-transform: uppercase;
            opacity: 0.85;
        }

        /* Body Section */
        .content {
            padding: 25px 35px; 
        }
        .badge {
            display: inline-block;
            background-color: #fdf5e6;
            color: #b8860b;
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            border: 1px solid #f5deb3;
        }
        .guest-name {
            font-size: 24px; 
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        .welcome-text {
            font-size: 11px;
            color: #7f8c8d;
            line-height: 1.5;
            margin-bottom: 20px; 
            padding: 0 15px;
        }

        /* Info Grid */
        .info-table {
            width: 100%;
            margin-bottom: 15px; 
            border-collapse: collapse;
        }
        .info-box {
            background-color: #f9fbfc;
            border-left: 4px solid #6A0DAD;
            padding: 10px 14px;
            text-align: left;
            border-radius: 0 8px 8px 0;
        }
        .info-label {
            font-size: 8px;
            color: #95a5a6;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        .info-value {
            font-size: 13px;
            color: #2c3e50;
            font-weight: bold;
        }

        /* Separator */
        .separator {
            border: none;
            border-top: 1px dashed #e0e0e0;
            margin: 12px 0;
        }

        /* QR Area */
        .qr-wrapper-table {
            width: 100%;
            margin-bottom: 8px; 
        }
        .qr-box {
            background-color: #ffffff;
            padding: 10px;
            border: 2px solid #eeeeee;
            border-radius: 15px;
            display: inline-block;
        }
        .qr-image {
            width: 140px;
            height: 140px;
        }
        .scan-text {
            font-size: 9px;
            color: #6A0DAD;
            font-weight: bold;
            margin-top: 5px;
            letter-spacing: 1px;
        }
        .ticket-id {
            font-family: monospace;
            font-size: 8px;
            color: #d1d1d1;
            margin-top: 5px;
        }

        /* Footer */
        .footer {
            background-color: #fafafa;
            padding: 18px 20px;
            border-top: 1px solid #eeeeee;
            font-size: 9px;
            color: #bdc3c7;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="ticket-card">
            <!-- HEADER -->
            <div class="header">
                <?php 
                    $logoPath = FCPATH . 'assets/img/ministre_logo.png';
                    if (file_exists($logoPath)): 
                ?>
                <div style="margin-bottom: 10px;">
                    <img src="data:image/png;base64,<?= base64_encode(file_get_contents($logoPath)) ?>" style="height: 70px; width: auto;">
                </div>
                <?php endif; ?>
                <div class="title-event">Miss Maths / Miss Sciences</div>
                <div class="subtitle-event">IA de Dakar &bull; &Eacute;dition 2026</div>
            </div>

            <!-- CONTENT -->
            <div class="content">
                <div class="badge">INVITATION OFFICIELLE</div>
                
                <div class="guest-name"><?= esc($name) ?></div>
                <div class="welcome-text">
                    Nous avons l'honneur de vous inviter &agrave; la c&eacute;r&eacute;monie <strong>MISS MATHS &amp; MISS SCIENCES</strong>, qui met &agrave; l'honneur l'intelligence, la cr&eacute;ativit&eacute; et l'excellence des jeunes talents f&eacute;minins dans les domaines des math&eacute;matiques et des sciences.
                </div>

                <hr class="separator">

                <!-- INFO GRID -->
                <table class="info-table">
                    <tr>
                        <td style="width: 48%; padding-right: 4%;">
                            <div class="info-box">
                                <div class="info-label">T&Eacute;L&Eacute;PHONE DE L'INVIT&Eacute;</div>
                                <div class="info-value"><?= format_phone_number($invite['telephone']) ?></div>
                            </div>
                        </td>
                        <td style="width: 48%;">
                            <div class="info-box">
                                <div class="info-label">DATE &amp; HEURE</div>
                                <div class="info-value">13 Mai 2026 &bull; 09h00</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top: 10px;">
                            <div class="info-box">
                                <div class="info-label">LIEU DE L'&Eacute;V&Eacute;NEMENT</div>
                                <div class="info-value">Th&eacute;&acirc;tre National Daniel Sorano</div>
                            </div>
                        </td>
                    </tr>

                    <?php if (!empty($invite['establishment'])): ?>
                    <tr>
                        <td colspan="2" style="padding-top: 10px;">
                            <div class="info-box">
                                <div class="info-label"><?= ($invite['category_id'] == 3) ? 'GROUPE / ENTIT&Eacute;' : '&Eacute;TABLISSEMENT' ?></div>
                                <div class="info-value"><?= esc($invite['establishment']) ?></div>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <?php if (!empty($invite['class'])): ?>
                    <tr>
                        <td colspan="2" style="padding-top: 10px;">
                            <div class="info-box">
                                <div class="info-label">CLASSE / NIVEAU</div>
                                <div class="info-value"><?= esc($invite['class']) ?></div>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <?php if (!empty($invite['profession'])): ?>
                    <tr>
                        <td colspan="2" style="padding-top: 10px;">
                            <div class="info-box">
                                <div class="info-label">PROFESSION</div>
                                <div class="info-value"><?= esc($invite['profession']) ?></div>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <?php if (!empty($invite['interest'])): ?>
                    <tr>
                        <td colspan="2" style="padding-top: 10px;">
                            <div class="info-box">
                                <div class="info-label">INT&Eacute;R&Ecirc;T POUR LE CONCOURS</div>
                                <div class="info-value"><?= esc($invite['interest']) ?></div>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>

                <hr class="separator">

                <!-- QR CODE -->
                <table class="qr-wrapper-table">
                    <tr>
                        <td align="center">
                            <div class="qr-box">
                                <img src="data:image/png;base64,<?= base64_encode(file_get_contents($qrPath)) ?>" class="qr-image">
                            </div>
                            <div class="scan-text">Scannez ce QR Code &agrave; l'accueil pour validation</div>
                            <div class="ticket-id">R&Eacute;F&Eacute;RENCE : <?= strtoupper(substr($code, 0, 16)) ?></div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- FOOTER -->
            <div class="footer">
                Cette invitation est strictement personnelle et infalsifiable. <br>
                Elle devra &ecirc;tre pr&eacute;sent&eacute;e sous format num&eacute;rique ou imprim&eacute; au service d'accueil.<br>
                <strong>Inspection d'Acad&eacute;mie de Dakar &copy; 2026</strong>
            </div>
        </div>
        
        <div style="margin-top: 12mm; color: #bdc3c7; font-size: 9px; text-transform: uppercase; letter-spacing: 1px;">
            Document officiel certifi&eacute; par l'IA de Dakar
        </div>
    </div>
</body>
</html>
