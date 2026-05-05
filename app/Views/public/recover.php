<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Retrouver mon invitation<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5 fade-in">
        <div class="text-center mb-5">
            <div class="brand-title mb-2">MISS MATH</div>
            <p class="brand-subtitle">Récupération de ticket</p>
            <p style="color: var(--mm-text-muted); font-size: 0.95rem; margin-top: 1rem;">
                Entrez vos informations pour réafficher votre invitation QR Code
            </p>
        </div>

        <div class="glass-card p-4 p-md-5">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="/recover" method="POST">
                <?= csrf_field() ?>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" placeholder="Votre prénom" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" placeholder="Votre nom" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Adresse Email</label>
                    <input type="email" name="email" class="form-control" placeholder="vous@email.com" required>
                </div>
                <button type="submit" class="btn btn-premium w-100 py-3 fw-bold" style="border-radius: 12px; font-size: 1.05rem;">
                    <i class="bi bi-search me-2"></i>Retrouver mon invitation
                </button>
            </form>
        </div>
        
        <div class="text-center mt-4">
            <a href="/" class="text-decoration-none footer-text">
                <i class="bi bi-arrow-left me-1"></i> Retour à l'inscription
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
