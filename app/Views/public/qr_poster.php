<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner pour s'inscrire - Miss Maths & Sciences</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            /* Thème Image (Deep Purple & Gold) */
            --bg-grad: radial-gradient(circle at center, #2e0835 0%, #120314 100%);
            --text-main: #ffffff;
            --text-sub: #b18bb1; /* Rose/Violet clair pour le sous-titre */
            --title-color: #D4AF37;
            --box-bg: rgba(255, 255, 255, 0.02);
            --box-border: rgba(212, 175, 55, 0.15);
            --inst-bg: rgba(46, 8, 53, 0.6);
            --inst-border: rgba(212, 175, 55, 0.3);
            --inst-text: rgba(255, 255, 255, 0.9);
            --qr-border: #D4AF37;
            --pattern-opacity: 0.12;
        }

        /* ... (autres thèmes conservés pour la flexibilité) ... */

        body {
            font-family: 'Outfit', sans-serif;
            background: #120314; /* Couleur de base */
            background-image: var(--bg-grad);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
            padding: 2rem;
            margin: 0;
            overflow-x: hidden;
        }

        .bg-pattern {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            /* Motif de petites croix (+) comme sur l'image */
            background-image: 
                radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: var(--pattern-opacity);
            z-index: 0;
        }

        .poster-container {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--box-border);
            border-radius: 60px; /* Plus arrondi comme sur l'image */
            padding: 5rem 3rem;
            max-width: 650px;
            width: 100%;
            text-align: center;
            position: relative;
            z-index: 1;
            box-shadow: 0 30px 60px rgba(0,0,0,0.2);
            transition: all 0.5s ease;
        }

        body.theme-neon .poster-container {
            box-shadow: var(--box-shadow-override, 0 0 40px rgba(246, 211, 101, 0.2));
        }
        body.theme-tech .poster-container {
            border-radius: 15px; /* Plus carré pour le côté tech */
        }

        .stars {
            color: var(--title-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            letter-spacing: 5px;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            color: var(--title-color);
            font-size: 2.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
            text-shadow: 2px 4px 10px rgba(0,0,0,0.1);
        }

        .subtitle {
            font-size: 1.1rem;
            color: var(--text-sub);
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 3rem;
        }

        .qr-wrapper {
            background: white;
            padding: 15px;
            border-radius: 40px; /* Plus arrondi comme sur l'image */
            display: inline-block;
            position: relative;
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.3); /* Lueur dorée */
            margin-bottom: 2rem;
            border: 3px solid var(--qr-border);
        }
        body.theme-neon .qr-wrapper {
            box-shadow: 0 0 30px rgba(246, 211, 101, 0.4);
        }

        .qr-wrapper::before, .qr-wrapper::after {
            content: '';
            position: absolute;
            width: 40px; height: 40px;
            border: 3px solid var(--qr-border);
            border-radius: 10px;
            pointer-events: none;
            transition: all 0.5s ease;
        }
        .qr-wrapper::before { top: -15px; left: -15px; border-right: none; border-bottom: none; }
        .qr-wrapper::after { bottom: -15px; right: -15px; border-left: none; border-top: none; }

        .qr-image {
            width: 250px;
            height: 250px;
            border-radius: 15px;
            display: block;
        }

        .instruction-box {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            padding: 1.2rem;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 15px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .instruction-icon {
            font-size: 2rem;
            color: var(--title-color);
        }

        .instruction-text {
            text-align: left;
        }

        .instruction-text h3 {
            font-size: 1.2rem;
            margin: 0;
            color: #ffffff;
            font-weight: 600;
        }

        .instruction-text p {
            margin: 0;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
        }

        .footer-text {
            margin-top: 2rem;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.3);
            text-transform: uppercase;
            letter-spacing: 2px;
        }



        .btn-print {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #D4AF37;
            color: #1A051D;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            z-index: 100;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-print:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.4);
        }

        @media print {
            body { background: white !important; color: black !important; padding: 0; }
            .bg-pattern { display: none !important; }
            .poster-container { box-shadow: none !important; border: none !important; background: transparent !important; padding: 0 !important; max-width: 100% !important; }
            h1 { color: #4A0E4E !important; text-shadow: none !important; }
            .subtitle { color: #666 !important; }
            .instruction-box { background: #f8f9fa !important; border: 1px solid #ddd !important; }
            .instruction-text h3 { color: #333 !important; }
            .instruction-text p { color: #666 !important; }
            .qr-wrapper { border-color: #4A0E4E !important; box-shadow: none !important; }
            .qr-wrapper::before, .qr-wrapper::after { border-color: #4A0E4E !important; }
            .theme-controls, .btn-print { display: none !important; }
        }

    </style>
</head>
<body>

    <div class="bg-pattern"></div>



    <div class="poster-container">
        <div class="logo-area">
            <div class="mb-4">
                <img src="<?= base_url('assets/img/ministre_logo.png') ?>" alt="Logo Ministère" style="height: 100px; width: auto; mix-blend-mode: screen;">
            </div>
            <div class="stars">✦ ✦ ✦</div>
            <h1>Miss Maths & Sciences</h1>
            <div class="subtitle">Édition 2026 &bull; IA de Dakar</div>
        </div>

        <div class="qr-wrapper">
            <!-- QR Code Base64 Image -->
            <img src="<?= $qrImage ?>" alt="QR Code Inscription" class="qr-image">
        </div>

        <div class="instruction-box">
            <i class="bi bi-phone-vibrate instruction-icon"></i>
            <div class="instruction-text">
                <h3>Ouvrez votre appareil photo</h3>
                <p>Scannez ce QR Code pour accéder directement au formulaire d'inscription officiel.</p>
            </div>
        </div>

        <div class="footer-text">
            Plateforme officielle d'inscription &bull; Invitation requise
        </div>
    </div>

    <!-- Bouton pour imprimer l'affiche -->
    <button onclick="window.print()" class="btn-print d-print-none">
        <i class="bi bi-printer-fill"></i> Imprimer l'affiche
    </button>

</body>
</html>
