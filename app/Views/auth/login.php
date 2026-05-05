<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Connexion Admin<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-5 col-lg-4 fade-in">
        <div class="text-center mb-5">
            <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, var(--mm-primary), var(--mm-accent)); border-radius: 18px; box-shadow: 0 10px 30px rgba(106, 13, 173, 0.3);">
                <i class="bi bi-shield-lock-fill text-white" style="font-size: 1.8rem;"></i>
            </div>
            <h2 class="fw-bold text-white mb-1">Accès Administration</h2>
            <p class="brand-subtitle">Miss Maths & Sciences</p>
        </div>

        <div class="glass-card p-4 p-md-5">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger small mb-4">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST">
                <?= csrf_field() ?>
                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-right: none; color: var(--mm-text-muted); border-radius: 10px 0 0 10px;">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" name="email" class="form-control" style="border-left: none; border-radius: 0 10px 10px 0;" placeholder="admin@missmath.com" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-right: none; color: var(--mm-text-muted); border-radius: 10px 0 0 10px;">
                            <i class="bi bi-key"></i>
                        </span>
                        <input type="password" name="password" class="form-control" style="border-left: none; border-radius: 0 10px 10px 0;" placeholder="••••••••" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-premium w-100 py-3">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                </button>
            </form>
        </div>
        
        <div class="text-center mt-4">
            <a href="/" class="text-decoration-none footer-text">
                <i class="bi bi-arrow-left me-1"></i>Retour au site public
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
