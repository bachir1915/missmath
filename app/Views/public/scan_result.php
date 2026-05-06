<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Vérification du Ticket<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="glass-card border-0 shadow-lg overflow-hidden rounded-4 text-center">
            <!-- Header Couleur selon statut -->
            <?php 
                $bgColor = 'rgba(255, 193, 7, 0.2)'; // Warning default
                $textColor = '#ffc107';
                $icon = 'bi-exclamation-circle';
                $title = 'RÉSULTAT';
                
                if ($status === 'success') {
                    $bgColor = 'rgba(93, 211, 158, 0.2)';
                    $textColor = '#5dd39e';
                    $icon = 'bi-check-circle-fill';
                    $title = 'ACCÈS AUTORISÉ';
                } elseif ($status === 'fraud') {
                    $bgColor = 'rgba(255, 107, 107, 0.2)';
                    $textColor = '#ff6b6b';
                    $icon = 'bi-exclamation-triangle-fill';
                    $title = 'DÉJÀ UTILISÉ';
                } elseif ($status === 'error') {
                    $bgColor = 'rgba(108, 117, 125, 0.2)';
                    $textColor = '#adb5bd';
                    $icon = 'bi-x-circle-fill';
                    $title = 'ERREUR';
                }
            ?>
            
            <div class="p-5" style="background: <?= $bgColor ?>;">
                <div class="mb-4">
                    <i class="bi <?= $icon ?> display-1" style="color: <?= $textColor ?>; filter: drop-shadow(0 0 15px <?= $bgColor ?>);"></i>
                </div>
                <h2 class="fw-bold mb-0 text-white" style="letter-spacing: 2px;"><?= $title ?></h2>
            </div>

            <div class="card-body p-4 p-md-5">
                <?php if ($invite): ?>
                    <div class="mb-4">
                        <div style="color: var(--mm-accent); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 3px; font-weight: 700;" class="mb-2">Invité(e) Officiel(le)</div>
                        <h3 class="fw-bold text-white mb-1"><?= esc($invite['prenom']) ?> <?= esc($invite['nom']) ?></h3>
                        <p style="color: var(--mm-text-muted);"><?= esc($invite['email']) ?></p>
                    </div>

                    <div class="p-4 rounded-4 mb-4 text-start" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);">
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <div style="color: var(--mm-text-muted); font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">Établissement</div>
                                <div class="text-white fw-bold small"><?= esc($invite['establishment'] ?: 'N/A') ?></div>
                            </div>
                            <div class="col-6">
                                <div style="color: var(--mm-text-muted); font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">Classe</div>
                                <div class="text-white fw-bold small"><?= esc($invite['class'] ?: 'N/A') ?></div>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <div style="color: var(--mm-text-muted); font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">Téléphone</div>
                                <div class="text-white fw-bold small"><?= esc($invite['telephone']) ?></div>
                            </div>
                            <div class="col-6">
                                <div style="color: var(--mm-text-muted); font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">Réseau Social</div>
                                <div class="text-white fw-bold small text-capitalize"><?= esc($invite['social_network'] ?: 'N/A') ?></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between pt-3 border-top border-white border-opacity-10">
                            <span style="color: var(--mm-text-muted); font-size: 0.65rem; text-transform: uppercase;">Statut Actuel</span>
                            <span class="badge rounded-pill" style="background: <?= $invite['statut'] === 'valide' ? 'rgba(255, 107, 107, 0.2)' : 'rgba(93, 211, 158, 0.2)' ?>; color: <?= $invite['statut'] === 'valide' ? '#ff6b6b' : '#5dd39e' ?>; font-size: 0.7rem;">
                                <?= strtoupper($invite['statut'] === 'valide' ? 'DÉJÀ VALIDÉ' : 'EN ATTENTE') ?>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="p-3 rounded-3 mb-4" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff;">
                    <i class="bi bi-info-circle me-2" style="color: var(--mm-accent);"></i>
                    <?= esc($message) ?>
                </div>

                <?php if (isset($isAdmin) && $isAdmin && $status === 'success'): ?>
                    <div class="alert alert-success py-2 small mb-4" style="background: rgba(93, 211, 158, 0.1); border: 1px solid rgba(93, 211, 158, 0.2); color: #5dd39e;">
                        <i class="bi bi-shield-check me-1"></i> <strong>Admin :</strong> Entrée validée avec succès !
                    </div>
                <?php elseif ($status === 'success'): ?>
                    <div class="alert alert-info py-2 small mb-4" style="background: rgba(0, 123, 255, 0.1); border: 1px solid rgba(0, 123, 255, 0.2); color: #00bcff; font-size: 0.75rem;">
                        <i class="bi bi-shield-exclamation me-1"></i> Note : Ce ticket est valide. La validation finale doit être faite par un administrateur à l'entrée.
                    </div>
                <?php endif; ?>

                <a href="/" class="btn btn-outline-light w-100 py-3 rounded-pill fw-bold" style="border: 1px solid rgba(255,255,255,0.2);">
                    <i class="bi bi-house-door me-2"></i>Retour à l'accueil
                </a>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p style="color: var(--mm-text-muted); font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">
                Miss Maths/Miss Sciences &bull; IA de Dakar 2026
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
