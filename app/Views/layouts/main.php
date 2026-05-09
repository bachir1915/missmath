<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | Miss Maths/Miss Sciences 2026</title>
    <meta name="description" content="Miss Maths/Miss Sciences 2026 - Plateforme officielle d'invitations numériques sécurisées avec QR code.">
    
    <!-- DNS Prefetch + Preconnect pour charger les CDN plus vite -->
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- CSS critique chargé en priorité -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icônes et fonts chargées en non-bloquant -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" media="print" onload="this.media='all'">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    </noscript>
    <style>
        :root {
            --mm-primary: #6A0DAD;
            --mm-primary-light: #8B3FCF;
            --mm-accent: #D4AF37;
            --mm-accent-light: #E8CC6E;
            --mm-dark: #0D0D1A;
            --mm-dark-card: #161628;
            --mm-text-light: #F0ECF7;
            --mm-text-muted: #9B8FB8;
            --mm-glass-bg: rgba(255, 255, 255, 0.06);
            --mm-glass-border: rgba(255, 255, 255, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--mm-dark);
            color: var(--mm-text-light);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Animated Background ── */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background:
                radial-gradient(ellipse at 20% 20%, rgba(119, 26, 186, 0.25) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(212, 175, 55, 0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 50%, rgba(106, 13, 173, 0.08) 0%, transparent 70%);
            z-index: 0;
            pointer-events: none;
        }

        /* ── Math Symbols Floating ── */
        .math-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .math-bg span {
            position: absolute;
            font-size: 1.5rem;
            color: rgba(106, 13, 173, 0.12);
            animation: floatSymbol 25s infinite linear;
            will-change: transform;
        }
        .math-bg span:nth-child(1) { left: 5%; animation-delay: 0s; font-size: 2rem; }
        .math-bg span:nth-child(2) { left: 15%; animation-delay: 3s; }
        .math-bg span:nth-child(3) { left: 25%; animation-delay: 6s; font-size: 1.8rem; }
        .math-bg span:nth-child(4) { left: 40%; animation-delay: 2s; }
        .math-bg span:nth-child(5) { left: 55%; animation-delay: 8s; font-size: 2.2rem; }
        .math-bg span:nth-child(6) { left: 65%; animation-delay: 5s; }
        .math-bg span:nth-child(7) { left: 75%; animation-delay: 10s; font-size: 1.6rem; }
        .math-bg span:nth-child(8) { left: 88%; animation-delay: 7s; }

        @keyframes floatSymbol {
            0% { transform: translateY(110vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
        }

        /* ── Glassmorphism Card ── */
        .glass-card {
            background: var(--mm-glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--mm-glass-border);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }
        .glass-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 30px 80px rgba(106, 13, 173, 0.2);
        }

        /* ── Branding ── */
        .brand-title {
            font-weight: 800;
            font-size: 2.5rem;
            background: linear-gradient(135deg, var(--mm-accent) 0%, var(--mm-accent-light) 50%, var(--mm-accent) 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmerText 3s ease-in-out infinite;
            letter-spacing: 3px;
        }
        .brand-subtitle {
            color: var(--mm-text-muted);
            font-weight: 300;
            letter-spacing: 6px;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        @keyframes shimmerText {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 200% center; }
        }

        /* ── Premium Button ── */
        .btn-premium {
            background: linear-gradient(135deg, var(--mm-primary) 0%, var(--mm-primary-light) 100%);
            border: none;
            color: white;
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }
        .btn-premium::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s ease;
        }
        .btn-premium:hover {
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(106, 13, 173, 0.4);
        }
        .btn-premium:hover::before {
            left: 100%;
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--mm-accent) 0%, #c5981e 100%);
            border: none;
            color: var(--mm-dark);
            font-weight: 700;
        }
        .btn-gold:hover {
            color: var(--mm-dark);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.3);
        }

        .btn-premium:disabled, .btn-gold:disabled {
            background: #444 !important;
            color: #888 !important;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
            opacity: 0.6;
            filter: grayscale(1);
        }

        /* ── Form Controls ── */
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: var(--mm-text-light);
            border-radius: 10px;
            padding: 12px 16px;
            font-family: 'Outfit', sans-serif;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--mm-primary-light);
            box-shadow: 0 0 0 3px rgba(106, 13, 173, 0.2);
            color: white;
        }
        .form-control::placeholder { color: var(--mm-text-muted); }
        .form-label {
            color: #555555;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ── Alerts ── */
        .alert-danger {
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #ff6b7a;
            border-radius: 12px;
        }
        .alert-success {
            background: rgba(25, 135, 84, 0.15);
            border: 1px solid rgba(25, 135, 84, 0.3);
            color: #5dd39e;
            border-radius: 12px;
        }
        .alert-info {
            background: rgba(106, 13, 173, 0.15);
            border: 1px solid rgba(106, 13, 173, 0.3);
            color: var(--mm-primary-light);
            border-radius: 12px;
        }

        /* ── Fade In Animation ── */
        .fade-in {
            animation: fadeInUp 0.8s ease-out;
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* ── Footer ── */
        .footer-text {
            color: var(--mm-text-muted);
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--mm-dark); }
        ::-webkit-scrollbar-thumb { background: var(--mm-primary); border-radius: 3px; }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- Floating Math Symbols -->
    <div class="math-bg">
        <span>∑</span><span>π</span><span>∞</span><span>∫</span>
        <span>Δ</span><span>√</span><span>θ</span><span>φ</span>
    </div>

    <div class="container py-5 position-relative" style="z-index: 1;">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
