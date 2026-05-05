<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Votre Invitation<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4 fade-in">
        <div class="text-center mb-4">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success border-0 shadow-sm mb-4" style="background: rgba(40, 167, 69, 0.2); color: #fff; border-radius: 12px;">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <span class="badge rounded-pill px-4 py-2 mb-3" style="background: rgba(212, 175, 55, 0.15); color: var(--mm-accent); font-size: 0.8rem; letter-spacing: 2px; font-weight: 600;">
                <i class="bi bi-star-fill me-1"></i> INVITATION VIP
            </span>
        </div>

        <div class="glass-card text-center overflow-hidden" style="border: 1px solid rgba(212, 175, 55, 0.2);">
            <!-- Header doré -->
            <div class="py-4 px-3 position-relative" style="background: linear-gradient(135deg, var(--mm-primary) 0%, rgba(212, 175, 55, 0.4) 100%);">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%2250%22 x=%2210%22 font-size=%2220%22 fill=%22rgba(255,255,255,0.05)%22>∑ π ∞ Δ</text></svg>') repeat; opacity: 0.5;"></div>
                <h4 class="mb-0 fw-bold text-white position-relative" style="letter-spacing: 3px;">INVITATION OFFICIELLE</h4>
            </div>

            <!-- Body -->
            <div class="p-5">
                <p class="mb-1" style="color: var(--mm-accent); font-weight: 600; letter-spacing: 4px; font-size: 0.8rem;">MISS MATHS - MISS SCIENCES 2026</p>
                
                <div class="my-4" style="width: 60px; height: 1px; background: linear-gradient(to right, transparent, var(--mm-accent), transparent); margin: 1rem auto;"></div>
                
                <h2 class="fw-bold text-white mb-1"><?= esc($invite['prenom']) ?> <?= esc($invite['nom']) ?></h2>
                <p style="color: var(--mm-text-muted);"><?= esc($invite['email']) ?></p>

                <!-- Event Details -->
                <div class="mt-4 p-3" style="background: rgba(255,255,255,0.05); border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);">
                    <div class="row g-0">
                        <div class="col-6 border-end border-white border-opacity-10">
                            <div style="font-size: 0.65rem; color: var(--mm-accent); text-transform: uppercase; letter-spacing: 1px;">Date</div>
                            <div class="text-white fw-bold">13 Mai 2026</div>
                        </div>
                        <div class="col-6">
                            <div style="font-size: 0.65rem; color: var(--mm-accent); text-transform: uppercase; letter-spacing: 1px;">Lieu</div>
                            <div class="text-white fw-bold">Sorano</div>
                        </div>
                    </div>
                </div>

                <!-- QR Code -->
                <div class="d-inline-block p-4 my-4" style="background: white; border-radius: 16px; box-shadow: 0 8px 30px rgba(0,0,0,0.3);">
                    <img src="<?= base_url('uploads/qrcodes/' . $invite['qr_path']) ?>" alt="QR Code" class="img-fluid" style="width: 180px; height: 180px;">
                </div>

                <!-- Code Unique -->
                <div class="mx-auto p-3 mb-4" style="background: rgba(106, 13, 173, 0.12); border: 1px solid rgba(106, 13, 173, 0.25); border-radius: 12px; max-width: 100%;">
                    <div style="color: var(--mm-text-muted); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 4px;">Code Unique</div>
                    <div class="fw-bold text-white" style="font-size: 0.95rem; letter-spacing: 1px; word-break: break-all;"><?= esc($invite['code_unique']) ?></div>
                </div>

                <p class="small" style="color: var(--mm-text-muted); line-height: 1.6;">
                    <i class="bi bi-info-circle me-1"></i>
                    Présentez ce QR code à l'entrée du <strong>Théâtre Sorano</strong>.<br>
                    <strong style="color: var(--mm-accent);">Utilisation unique.</strong> Ne le partagez avec personne.
                </p>
            </div>

            <!-- Footer -->
            <div class="py-3 px-4 d-print-none" style="border-top: 1px solid var(--mm-glass-border);">
                <button onclick="window.print()" class="btn btn-outline-light btn-sm rounded-pill px-4">
                    <i class="bi bi-printer me-1"></i> Imprimer / PDF
                </button>
            </div>
        </div>

        <!-- Email Animation & Return Section -->
        <div class="text-center mt-4 d-print-none">
            <div id="email-status-container" class="glass-card p-3 d-inline-block w-100 mb-3" style="border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.03);">
                <div id="email-sending-state">
                    <div class="paper-plane-container mb-3">
                        <i class="bi bi-send-fill paper-plane-icon"></i>
                    </div>
                    <p class="mb-0" style="color: var(--mm-text-muted); font-size: 0.9rem;">
                        <span class="spinner-border spinner-border-sm me-2" style="color: var(--mm-accent);"></span>
                        Envoi de votre invitation par email en cours...
                    </p>
                </div>
                
                <div id="email-success-state" style="display: none;">
                    <div class="mb-2">
                        <i class="bi bi-check-all" style="font-size: 2.5rem; color: #5dd39e; filter: drop-shadow(0 0 10px rgba(93, 211, 158, 0.4));"></i>
                    </div>
                    <p class="mb-2 fw-bold" style="color: #5dd39e; font-size: 0.95rem;">Invitation envoyée sur ce mail :</p>
                    <p class="mb-0 fw-bold" style="color: white; font-size: 1rem; letter-spacing: 1px;"><?= esc($invite['email']) ?></p>
                </div>
            </div>

            <!-- Return Countdown -->
            <div id="return-container" style="opacity: 0.5; transition: opacity 0.5s;">
                <div class="d-inline-block px-4 py-2 rounded-pill" style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <span style="color: var(--mm-text-muted); font-size: 0.85rem;">Retour automatique dans <strong id="countdown" style="color: var(--mm-accent);">5</strong>s</span>
                </div>
                <div class="mt-3">
                    <div class="mx-auto" style="width: 200px; height: 2px; background: rgba(255,255,255,0.05); border-radius: 2px; overflow: hidden;">
                        <div id="progress-bar" style="width: 100%; height: 100%; background: linear-gradient(90deg, var(--mm-accent), var(--mm-primary));"></div>
                    </div>
                </div>
            </div>
            
            <a href="/" class="text-decoration-none footer-text d-block mt-4" style="font-size: 0.8rem; opacity: 0.6;">
                <i class="bi bi-arrow-left me-1"></i> Revenir à l'accueil
            </a>
        </div>
    </div>
</div>

<style>
    .paper-plane-container {
        position: relative;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .paper-plane-icon {
        font-size: 1.8rem;
        color: var(--mm-accent);
        animation: fly 2s infinite ease-in-out;
        filter: drop-shadow(0 0 15px rgba(212, 175, 55, 0.4));
    }
    @keyframes fly {
        0% { transform: translate(-20px, 10px) rotate(-15deg); opacity: 0; }
        50% { transform: translate(0, 0) rotate(0deg); opacity: 1; }
        100% { transform: translate(20px, -10px) rotate(15deg); opacity: 0; }
    }

    @media print {
        @page { margin: 0; size: auto; }
        body { background: white !important; color: black !important; padding: 20px !important; }
        body::before, .math-bg, .d-print-none { display: none !important; }
        .row { display: block !important; }
        .col-md-5 { width: 100% !important; max-width: 500px !important; margin: 0 auto !important; }
        .glass-card { 
            box-shadow: none !important; 
            border: 1px solid #ddd !important; 
            background: white !important;
            backdrop-filter: none !important;
            page-break-inside: avoid;
        }
        .text-white, .fw-bold { color: #000 !important; }
        .badge { border: 1px solid #ddd !important; color: #000 !important; }
        h2, h4 { color: #000 !important; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sendingState = document.getElementById('email-sending-state');
        const successState = document.getElementById('email-success-state');
        const returnContainer = document.getElementById('return-container');
        const countdownEl = document.getElementById('countdown');
        const progressBar = document.getElementById('progress-bar');
        
        let seconds = 5;
        let countdownStarted = false;

        function startCountdown() {
            if (countdownStarted) return;
            countdownStarted = true;
            returnContainer.style.opacity = '1';
            
            const timer = setInterval(() => {
                seconds--;
                if (countdownEl) countdownEl.textContent = seconds;
                if (progressBar) progressBar.style.width = ((seconds / 5) * 100) + '%';
                
                if (seconds <= 0) {
                    clearInterval(timer);
                    window.location.href = "<?= base_url('/') ?>";
                }
            }, 1000);
        }

        // Déclencher l'envoi de l'email
        fetch('<?= base_url('/ticket/' . $invite['code_unique'] . '/send-email') ?>', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Une fois l'email envoyé (ou même si erreur mais fin de process)
            sendingState.style.display = 'none';
            successState.style.display = 'block';
            startCountdown();
        })
        .catch(e => {
            console.error('Email error:', e);
            // On démarre quand même le compte à rebours pour ne pas bloquer l'utilisateur
            startCountdown();
        });
    });
</script>

<?= $this->endSection() ?>
