<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Vérification du Ticket<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5 fade-in">
        <div class="glass-card border-0 shadow-lg overflow-hidden rounded-4 text-center" style="border: 1px solid rgba(255,255,255,0.05) !important;">
            
            <?php 
                // Configuration visuelle dynamique par statut
                $config = [
                    'success' => [
                        'gradient' => 'linear-gradient(135deg, #1a4731 0%, #2d5a44 100%)',
                        'accent'   => '#5dd39e',
                        'icon'     => 'bi-shield-check',
                        'title'    => 'ACCÈS AUTORISÉ',
                        'glow'     => 'rgba(93, 211, 158, 0.3)'
                    ],
                    'fraud' => [
                        'gradient' => 'linear-gradient(135deg, #4a1d1d 0%, #632626 100%)',
                        'accent'   => '#ff6b6b',
                        'icon'     => 'bi-exclamation-octagon',
                        'title'    => 'DÉJÀ UTILISÉ',
                        'glow'     => 'rgba(255, 107, 107, 0.3)'
                    ],
                    'error' => [
                        'gradient' => 'linear-gradient(135deg, #2c2c3e 0%, #3a3a52 100%)',
                        'accent'   => '#adb5bd',
                        'icon'     => 'bi-shield-slash',
                        'title'    => 'TICKET INVALIDE',
                        'glow'     => 'rgba(173, 181, 189, 0.2)'
                    ]
                ];
                
                $current = $config[$status] ?? $config['error'];
            ?>
            
            <!-- Header Premium avec Animation -->
            <div class="p-5 position-relative overflow-hidden" style="background: <?= $current['gradient'] ?>;">
                <!-- Symboles mathématiques en fond -->
                <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%2250%22 x=%2210%22 font-size=%2220%22 fill=%22white%22>π ∑ ∞ √</text></svg>') repeat; font-family: serif;"></div>
                
                <div class="mb-4 position-relative">
                    <div class="status-icon-glow" style="background: <?= $current['glow'] ?>;"></div>
                    <i class="bi <?= $current['icon'] ?> display-1 position-relative" style="color: <?= $current['accent'] ?>; filter: drop-shadow(0 0 20px <?= $current['accent'] ?>80);"></i>
                </div>
                <h2 class="fw-bold mb-0 text-white position-relative" style="letter-spacing: 4px; font-size: 1.8rem; text-shadow: 0 4px 10px rgba(0,0,0,0.3);"><?= $current['title'] ?></h2>
            </div>

            <div class="card-body p-4 p-md-5">
                <?php if ($invite): ?>
                    <!-- Badge Invité -->
                    <div class="mb-5 position-relative">
                        <div class="d-inline-block px-3 py-1 rounded-pill mb-3" style="background: rgba(212, 175, 55, 0.1); border: 1px solid rgba(212, 175, 55, 0.2);">
                            <span style="color: var(--mm-accent); font-size: 0.65rem; text-transform: uppercase; letter-spacing: 3px; font-weight: 800;">INVITÉ(E) OFFICIEL(LE)</span>
                        </div>
                        <h2 class="fw-bold text-white mb-1" style="font-size: 2rem;"><?= esc($invite['prenom']) ?> <?= esc($invite['nom']) ?></h2>
                        <p style="color: var(--mm-text-muted); font-size: 1.1rem;"><?= esc($invite['email']) ?></p>
                    </div>

                    <!-- Fiche de Détails Style VIP -->
                    <div class="p-4 rounded-4 mb-5 text-start shadow-inner" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); box-shadow: inset 0 0 20px rgba(0,0,0,0.2);">
                        <div class="row g-4 mb-4">
                            <div class="col-6">
                                <label class="d-block text-muted small text-uppercase mb-1" style="letter-spacing: 1px; font-size: 0.6rem;">Établissement</label>
                                <div class="text-white fw-bold border-start border-2 ps-2" style="border-color: var(--mm-accent) !important;">
                                    <?= esc($invite['establishment'] ?: 'Non renseigné') ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="d-block text-muted small text-uppercase mb-1" style="letter-spacing: 1px; font-size: 0.6rem;">Classe / Niveau</label>
                                <div class="text-white fw-bold border-start border-2 ps-2" style="border-color: var(--mm-accent) !important;">
                                    <?= esc($invite['class'] ?: 'N/A') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 mb-4">
                            <div class="col-6">
                                <label class="d-block text-muted small text-uppercase mb-1" style="letter-spacing: 1px; font-size: 0.6rem;">Téléphone</label>
                                <div class="text-white fw-bold border-start border-2 ps-2" style="border-color: var(--mm-primary-light) !important;">
                                    <?= esc($invite['telephone']) ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="d-block text-muted small text-uppercase mb-1" style="letter-spacing: 1px; font-size: 0.6rem;">Communauté</label>
                                <div class="text-white fw-bold border-start border-2 ps-2 text-capitalize" style="border-color: var(--mm-primary-light) !important;">
                                    <?= esc($invite['social_network'] ?: 'Membre') ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pt-3 border-top border-white border-opacity-10 d-flex align-items-center justify-content-between">
                            <span class="text-muted small text-uppercase" style="letter-spacing: 1px;">État de l'invitation</span>
                            <span class="px-3 py-1 rounded-pill fw-bold" style="background: <?= $invite['statut'] === 'valide' ? 'rgba(255, 107, 107, 0.15)' : 'rgba(93, 211, 158, 0.15)' ?>; color: <?= $invite['statut'] === 'valide' ? '#ff6b6b' : '#5dd39e' ?>; font-size: 0.75rem; border: 1px solid currentColor;">
                                <?= strtoupper($invite['statut'] === 'valide' ? 'DÉJÀ VALIDÉE' : 'VALIDE POUR ENTRÉE') ?>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Message de Feedback -->
                <div class="mb-5 py-3 px-4 rounded-3 d-flex align-items-center justify-content-center" style="background: rgba(255,255,255,0.03); border-left: 4px solid <?= $current['accent'] ?>;">
                    <i class="bi bi-info-circle-fill me-3" style="color: <?= $current['accent'] ?>; font-size: 1.2rem;"></i>
                    <span class="fw-medium text-white"><?= esc($message) ?></span>
                </div>

                <?php if (isset($isAdmin) && $isAdmin && $status === 'success'): ?>
                    <div class="alert alert-success border-0 py-3 mb-5 fade-in" style="background: linear-gradient(90deg, rgba(93, 211, 158, 0.1) 0%, transparent 100%);">
                        <div class="d-flex align-items-center">
                            <div class="bg-success rounded-circle p-2 me-3" style="--bs-bg-opacity: .2;">
                                <i class="bi bi-shield-check text-success"></i>
                            </div>
                            <div class="text-start">
                                <div class="fw-bold text-success small">STATUT ADMINISTRATEUR</div>
                                <div class="text-white-50 smaller" style="font-size: 0.75rem;">L'entrée a été enregistrée dans le système.</div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Bouton de Retour Premium -->
                <a href="/" class="btn-premium w-100 py-3 text-decoration-none d-block">
                    <i class="bi bi-house-door-fill me-2"></i>RETOUR À L'ACCUEIL
                </a>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <p class="brand-subtitle opacity-50" style="font-size: 0.7rem;">
                Miss Maths/Miss Sciences &bull; IA DE DAKAR &bull; 2026
            </p>
        </div>
    </div>
</div>

<style>
    .status-icon-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 120px;
        height: 120px;
        border-radius: 50%;
        animation: pulseGlow 2s infinite;
        z-index: 0;
    }
    @keyframes pulseGlow {
        0% { transform: translate(-50%, -50%) scale(0.8); opacity: 0.5; }
        50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.2; }
        100% { transform: translate(-50%, -50%) scale(0.8); opacity: 0.5; }
    }
    .shadow-inner {
        box-shadow: inset 0 2px 10px rgba(0,0,0,0.5);
    }
    .smaller {
        font-size: 0.8rem;
    }
</style>
<?= $this->endSection() ?>
