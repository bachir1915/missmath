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
                        <div class="text-muted small text-uppercase fw-bold mb-1">Invité concerné</div>
                        <h3 class="fw-bold text-dark mb-0"><?= esc($invite['prenom']) ?> <?= esc($invite['nom']) ?></h3>
                        <p class="text-muted"><?= esc($invite['email']) ?></p>
                    </div>

                    <div class="p-3 rounded-3 bg-light mb-4 text-start">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Statut :</span>
                            <span class="badge bg-<?= $invite['statut'] === 'utilise' ? 'danger' : ($invite['statut'] === 'en_attente' ? 'success' : 'secondary') ?>">
                                <?= strtoupper($invite['statut']) ?>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Code unique :</span>
                            <span class="font-monospace small"><?= esc($invite['code_unique']) ?></span>
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
