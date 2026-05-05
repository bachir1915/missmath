<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Ajouter un Invité<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card p-4 p-md-5">
            <div class="mb-4">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.12); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--admin-success); font-size: 1.2rem;">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-white mb-0">Nouvel Invité</h5>
                        <p class="mb-0" style="color: var(--admin-muted); font-size: 0.8rem;">Remplissez les informations pour créer une invitation</p>
                    </div>
                </div>
            </div>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0 ps-2" style="list-style: none;">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><i class="bi bi-exclamation-circle me-1"></i><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/admin/invites" method="POST">
                <?= csrf_field() ?>
                
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="<?= old('prenom') ?>" placeholder="Prénom de l'invité" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?= old('nom') ?>" placeholder="Nom de famille" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= old('email') ?>" placeholder="email@exemple.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" value="<?= old('telephone') ?>" placeholder="Ex: 77 000 00 00" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Statut Initial</label>
                    <select name="statut" class="form-select">
                        <option value="en_attente">En attente</option>
                        <option value="utilise">Utilisé / Validé</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between pt-2" style="border-top: 1px solid var(--admin-border);">
                    <a href="/admin/invites" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-lg me-1"></i> Ajouter l'invité
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
