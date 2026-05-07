<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Résultat du Scan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-lg overflow-hidden rounded-4">
            <!-- Header Couleur selon statut -->
            <?php 
                $bgColor = 'bg-warning';
                $icon = 'bi-exclamation-circle';
                $title = 'Résultat';
                
                if ($status === 'success') {
                    $bgColor = 'bg-success';
                    $icon = 'bi-check-circle-fill';
                    $title = 'ACCÈS AUTORISÉ';
                } elseif ($status === 'fraud') {
                    $bgColor = 'bg-danger';
                    $icon = 'bi-exclamation-triangle-fill';
                    $title = 'DÉJÀ UTILISÉ';
                } elseif ($status === 'error') {
                    $bgColor = 'bg-secondary';
                    $icon = 'bi-x-circle-fill';
                    $title = 'ERREUR';
                }
            ?>
            
            <div class="<?= $bgColor ?> p-4 text-center text-white">
                <i class="bi <?= $icon ?> display-1 mb-2"></i>
                <h2 class="fw-bold mb-0"><?= $title ?></h2>
            </div>

            <div class="card-body p-4 text-center">
                <?php if ($invite): ?>
                    <div class="mb-4">
                        <?php 
                            $categoryName = 'Invité';
                            $badgeClass = 'bg-secondary';
                            switch($invite['category_id']) {
                                case 1: $categoryName = 'Élève - C.E.M'; $badgeClass = 'bg-info'; break;
                                case 2: $categoryName = 'Élève - Lycée'; $badgeClass = 'bg-primary'; break;
                                case 3: $categoryName = 'Groupe Privé / Partenaire'; $badgeClass = 'bg-warning text-dark'; break;
                                case 4: $categoryName = 'Communauté / Parent'; $badgeClass = 'bg-dark'; break;
                            }
                        ?>
                        <span class="badge <?= $badgeClass ?> rounded-pill px-3 py-2 mb-3 shadow-sm" style="font-size: 0.75rem; letter-spacing: 1px;">
                            <i class="bi bi-person-badge me-1"></i> <?= strtoupper($categoryName) ?>
                        </span>
                        
                        <div class="text-muted small text-uppercase fw-bold mb-1" style="letter-spacing: 1px;">Nom Complet</div>
                        <h3 class="fw-bold text-dark mb-0"><?= esc($invite['prenom']) ?> <?= esc($invite['nom']) ?></h3>
                        <p class="text-muted small"><?= esc($invite['email']) ?></p>
                    </div>

                    <div class="p-4 rounded-4 bg-light mb-4 text-start shadow-sm border border-white">
                        <!-- Identité de base -->
                        <div class="row g-3 mb-3 border-bottom pb-3">
                            <div class="col-6">
                                <div class="text-muted small text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Téléphone</div>
                                <div class="fw-bold text-dark"><?= esc($invite['telephone']) ?></div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted small text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Email</div>
                                <div class="fw-bold text-dark" style="font-size: 0.85rem; overflow: hidden; text-overflow: ellipsis;"><?= esc($invite['email']) ?></div>
                            </div>
                        </div>

                        <!-- Infos spécifiques (Scolaire / Professionnel) -->
                        <div class="row g-3 mb-3">
                            <?php if (!empty($invite['establishment'])): ?>
                            <div class="col-6">
                                <div class="text-muted small text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;"><?= ($invite['category_id'] == 3) ? 'Entité / Groupe' : 'Établissement' ?></div>
                                <div class="fw-bold text-dark"><?= esc($invite['establishment']) ?></div>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($invite['class'])): ?>
                            <div class="col-6">
                                <div class="text-muted small text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Classe</div>
                                <div class="fw-bold text-dark"><?= esc($invite['class']) ?></div>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($invite['profession'])): ?>
                            <div class="col-6">
                                <div class="text-muted small text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Profession</div>
                                <div class="fw-bold text-dark"><?= esc($invite['profession']) ?></div>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($invite['social_network'])): ?>
                            <div class="col-6">
                                <div class="text-muted small text-uppercase" style="font-size: 0.6rem; letter-spacing: 1px;">Réseau Social</div>
                                <div class="fw-bold text-dark text-capitalize"><?= esc($invite['social_network']) ?></div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Intérêt (Largeur complète) -->
                        <?php if (!empty($invite['interest'])): ?>
                        <div class="mb-4 pt-3 border-top">
                            <div class="text-muted small text-uppercase mb-1" style="font-size: 0.6rem; letter-spacing: 1px;">Intérêt pour Miss Maths/Sciences</div>
                            <div class="fw-bold text-dark" style="font-size: 0.9rem; line-height: 1.4;"><?= esc($invite['interest']) ?></div>
                        </div>
                        <?php endif; ?>

                        <!-- Statut de validation -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <span class="text-muted small text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Validation Entrée :</span>
                            <span class="badge bg-<?= $invite['statut'] === 'valide' ? 'danger' : ($invite['statut'] === 'en_attente' ? 'success' : 'secondary') ?> rounded-pill px-3 py-2 shadow-sm">
                                <i class="bi <?= $invite['statut'] === 'valide' ? 'bi-lock-fill' : 'bi-unlock-fill' ?> me-1"></i>
                                <?= strtoupper($invite['statut'] === 'valide' ? 'DÉJÀ VALIDÉ' : ($invite['statut'] === 'en_attente' ? 'À VALIDER' : $invite['statut'])) ?>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="alert <?= $status === 'success' ? 'alert-success' : 'alert-danger' ?> mb-4">
                    <?= esc($message) ?>
                </div>

                <?php if ($status === 'success' && !$isAdmin): ?>
                    <div class="alert alert-info small py-2">
                        <i class="bi bi-info-circle me-1"></i> <strong>Note :</strong> Ce ticket n'a pas été marqué comme "Utilisé" car vous n'êtes pas connecté en tant qu'administrateur sur cet appareil.
                    </div>
                <?php endif; ?>

                <a href="/admin/scanner" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                    <i class="bi bi-camera me-2"></i>Scanner un autre billet
                </a>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="/admin/dashboard" class="text-muted text-decoration-none small">
                <i class="bi bi-arrow-left me-1"></i> Retour au tableau de bord
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
