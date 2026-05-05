<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée | Miss Maths & Sciences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --mm-bg: #0B0B14;
            --mm-primary: #6A0DAD;
            --mm-primary-light: #8B3FCF;
            --mm-accent: #D4AF37;
            --mm-text: #E8E4F0;
            --mm-text-muted: #8E86A8;
        }

        body {
            background-color: var(--mm-bg);
            color: var(--mm-text);
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(106, 13, 173, 0.15), transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(212, 175, 55, 0.1), transparent 25%);
            overflow: hidden;
        }

        .error-container {
            text-align: center;
            padding: 3rem;
            position: relative;
            z-index: 10;
        }

        .error-icon {
            font-size: 7rem;
            background: linear-gradient(135deg, var(--mm-primary-light) 0%, var(--mm-accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
            margin-bottom: 1rem;
            filter: drop-shadow(0 10px 20px rgba(106, 13, 173, 0.4));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .error-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
        }

        .error-text {
            color: var(--mm-text-muted);
            font-size: 1.1rem;
            max-width: 500px;
            margin: 0 auto 2.5rem auto;
            line-height: 1.6;
        }

        .btn-home {
            background: linear-gradient(135deg, var(--mm-primary), var(--mm-primary-light));
            color: white;
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 2px solid transparent;
            box-shadow: 0 10px 25px rgba(106, 13, 173, 0.4);
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(106, 13, 173, 0.6);
            color: white;
            background: linear-gradient(135deg, var(--mm-primary-light), var(--mm-primary));
        }

        /* Decorative Elements */
        .math-symbol {
            position: absolute;
            color: rgba(255, 255, 255, 0.05);
            font-weight: 900;
            z-index: -1;
            animation: spin 20s linear infinite;
        }

        .symbol-1 { font-size: 12rem; top: -50px; left: -100px; }
        .symbol-2 { font-size: 8rem; bottom: 50px; right: -50px; animation-direction: reverse; }
        .symbol-3 { font-size: 6rem; top: 20px; right: 100px; }

        @keyframes spin {
            100% { transform: rotate(360deg); }
        }

    </style>
</head>
<body>

    <div class="math-symbol symbol-1">∑</div>
    <div class="math-symbol symbol-2">∫</div>
    <div class="math-symbol symbol-3">π</div>

    <div class="container">
        <div class="error-container">
            <div class="error-icon">
                <i class="bi bi-compass"></i>
            </div>
            <h1 class="error-title">Oups ! Chemin introuvable.</h1>
            <p class="error-text">
                Il semblerait que vous vous soyez égaré(e) en chemin. 
                Le lien que vous avez suivi est peut-être cassé ou la page a été retirée. Pas de panique, revenons à la maison !
            </p>
            <a href="/" class="btn-home">
                <i class="bi bi-house-door-fill"></i> Retour à l'accueil
            </a>
            
            <div class="mt-5 pt-3" style="border-top: 1px solid rgba(255,255,255,0.05);">
                <p style="color: var(--mm-text-muted); font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase;">
                    Miss Maths & Sciences 2026
                </p>
            </div>
        </div>
    </div>

</body>
</html>
