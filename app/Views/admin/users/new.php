<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Ajouter un Membre<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-transparent py-3 px-4 border-bottom border-white-5">
                <h5 class="mb-0 fw-bold text-white"><i class="bi bi-person-plus me-2"></i>Nouveau Membre</h5>
            </div>
            <div class="card-body p-4">
                <form action="/admin/users" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-white small fw-bold">Prénom</label>
                            <input type="text" name="prenom" class="form-control" placeholder="Prénom" required value="<?= old('prenom') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white small fw-bold">Nom</label>
                            <input type="text" name="nom" class="form-control" placeholder="Nom" required value="<?= old('nom') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white small fw-bold">Adresse Email</label>
                        <input type="email" name="email" class="form-control" placeholder="staff@missmath.com" required value="<?= old('email') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white small fw-bold">Mot de passe</label>
                        <input type="password" name="password" class="form-control" placeholder="Min. 8 caractères" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-white small fw-bold">Rôle</label>
                        <select name="role" class="form-select" required>
                            <option value="staff" selected>Staff / Scanner (Accès limité)</option>
                            <option value="admin">Administrateur (Accès total)</option>
                        </select>
                        <div class="form-text text-muted small mt-2">
                            Le rôle 'Staff' ne pourra accéder qu'au scanner de billets.
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            Créer le compte
                        </button>
                        <a href="/admin/users" class="btn btn-outline-light px-4 rounded-pill">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
