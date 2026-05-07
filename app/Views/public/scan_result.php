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
                <h2 class="fw-bold mb-0 text-white position-relative scan-title" style="text-shadow: 0 4px 10px rgba(0,0,0,0.3);"><?= $current['title'] ?></h2>
            </div>

            <div class="card-body p-4 p-md-5">
                <?php if ($invite): ?>
                    <!-- Identité de l'invité -->
                    <div class="mb-5">
                        <h2 class="fw-bold text-white mb-1 guest-name" style="letter-spacing: -1px;"><?= esc($invite['prenom']) ?> <?= esc($invite['nom']) ?></h2>
                        <p style="color: var(--mm-accent); font-weight: 500; font-size: 1rem; letter-spacing: 1px;"><?= esc($invite['email']) ?></p>
                    </div>

                    <!-- Liste d'informations Premium -->
                    <div class="text-start mt-5">
                        <!-- Téléphone (Toujours présent) -->
                        <div class="d-flex align-items-center mb-3 p-3 rounded-3 info-item">
                            <div class="me-3 opacity-50"><i class="bi bi-telephone fs-3"></i></div>
                            <div>
                                <span class="d-block text-uppercase fw-bold" style="color: var(--mm-accent); font-size: 0.65rem; letter-spacing: 2px;">Numéro de Téléphone</span>
                                <span class="text-white fs-5 fw-bold"><?= format_phone_number($invite['telephone']) ?></span>
                            </div>
                        </div>

                        <!-- Établissement / Groupe -->
                        <?php if (!empty($invite['establishment'])): ?>
                        <div class="d-flex align-items-center mb-3 p-3 rounded-3 info-item">
                            <div class="me-3 opacity-50"><i class="bi bi-building fs-3"></i></div>
                            <div>
                                <span class="d-block text-uppercase fw-bold" style="color: var(--mm-accent); font-size: 0.65rem; letter-spacing: 2px;"><?= ($invite['category_id'] == 3) ? 'Entité / Groupe' : 'Établissement' ?></span>
                                <span class="text-white fs-5 fw-bold"><?= esc($invite['establishment']) ?></span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Classe -->
                        <?php if (!empty($invite['class'])): ?>
                        <div class="d-flex align-items-center mb-3 p-3 rounded-3 info-item">
                            <div class="me-3 opacity-50"><i class="bi bi-mortarboard fs-3"></i></div>
                            <div>
                                <span class="d-block text-uppercase fw-bold" style="color: var(--mm-accent); font-size: 0.65rem; letter-spacing: 2px;">Classe / Niveau</span>
                                <span class="text-white fs-5 fw-bold"><?= esc($invite['class']) ?></span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Profession -->
                        <?php if (!empty($invite['profession'])): ?>
                        <div class="d-flex align-items-center mb-3 p-3 rounded-3 info-item">
                            <div class="me-3 opacity-50"><i class="bi bi-briefcase fs-3"></i></div>
                            <div>
                                <span class="d-block text-uppercase fw-bold" style="color: var(--mm-accent); font-size: 0.65rem; letter-spacing: 2px;">Profession</span>
                                <span class="text-white fs-5 fw-bold"><?= esc($invite['profession']) ?></span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Réseau Social -->
                        <?php if (!empty($invite['social_network'])): ?>
                        <div class="d-flex align-items-center mb-3 p-3 rounded-3 info-item">
                            <div class="me-3 opacity-50"><i class="bi bi-share fs-3"></i></div>
                            <div>
                                <span class="d-block text-uppercase fw-bold" style="color: var(--mm-accent); font-size: 0.65rem; letter-spacing: 2px;">Réseau Social</span>
                                <span class="text-white fs-5 fw-bold text-capitalize"><?= esc($invite['social_network']) ?></span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Intérêt -->
                        <?php if (!empty($invite['interest'])): ?>
                        <div class="mt-4 p-3 rounded-3 info-item">
                            <span class="d-block text-uppercase fw-bold mb-1" style="color: var(--mm-accent); font-size: 0.65rem; letter-spacing: 2px;">Intérêt pour le concours</span>
                            <span class="text-white fw-bold" style="font-size: 0.95rem; line-height: 1.5;"><?= esc($invite['interest']) ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Message de Feedback (Plus discret) -->
                <div class="mt-5 pt-4 border-top border-white border-opacity-10">
                    <p class="mb-0 fw-bold" style="color: <?= $current['accent'] ?>; letter-spacing: 1px; font-size: 0.9rem;">
                        <i class="bi <?= $current['icon'] ?> me-2"></i>
                        <?= esc($message) ?>
                    </p>
                </div>
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
    /* Halo de statut adaptatif */
    .status-icon-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: clamp(60px, 20vw, 120px);
        height: clamp(60px, 20vw, 120px);
        border-radius: 50%;
        animation: pulseGlow 3s infinite;
        z-index: 0;
    }
    
    @keyframes pulseGlow {
        0% { transform: translate(-50%, -50%) scale(0.8); opacity: 0.4; }
        50% { transform: translate(-50%, -50%) scale(1.3); opacity: 0.1; }
        100% { transform: translate(-50%, -50%) scale(0.8); opacity: 0.4; }
    }

    /* Typographie Fluide Premium */
    .scan-title {
        font-size: clamp(1.2rem, 5vw, 1.8rem);
        letter-spacing: clamp(2px, 1vw, 4px);
    }
    .guest-name {
        font-size: clamp(1.5rem, 6vw, 2.2rem) !important;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    /* Interactivité Info-Item */
    .info-item {
        background: rgba(255,255,255,0.02); 
        border: 1px solid rgba(255,255,255,0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .info-item:hover {
        background: rgba(255,255,255,0.05);
        transform: translateX(8px);
        border-color: rgba(255,255,255,0.1);
    }

    /* Ajustements pour très petits écrans (iPhone SE, etc.) */
    @media (max-width: 360px) {
        .card-body { padding: 1.25rem !important; }
        .p-5 { padding: 2rem !important; }
        .fs-4 { font-size: 1.2rem !important; }
        .fs-5 { font-size: 0.9rem !important; }
        .info-item { padding: 0.75rem !important; margin-bottom: 0.75rem !important; }
    }

    /* Correction des textes longs */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
</style>
<?= $this->endSection() ?>
