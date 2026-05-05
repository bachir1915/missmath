<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Modifier le Membre<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-transparent py-3 px-4 border-bottom border-white-5">
                <h5 class="mb-0 fw-bold text-white"><i class="bi bi-pencil me-2"></i>Modifier : <?= esc($user['prenom'] . ' ' . $user['nom']) ?></h5>
            </div>
            <div class="card-body p-4">
                <form action="/admin/users/<?= $user['id'] ?>" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <?= csrf_field() ?>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-white small fw-bold">Prénom</label>
                            <input type="text" name="prenom" class="form-control" value="<?= esc($user['prenom']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white small fw-bold">Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?= esc($user['nom']) ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white small fw-bold">Adresse Email</label>
                        <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white small fw-bold">Nouveau Mot de passe (optionnel)</label>
                        <input type="password" name="password" class="form-control" placeholder="Laissez vide pour ne pas changer">
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-white small fw-bold">Rôle</label>
                        <select name="role" class="form-select" required>
                            <option value="staff" <?= $user['role'] == 'staff' ? 'selected' : '' ?>>Staff / Scanner (Accès limité)</option>
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Administrateur (Accès total)</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            Enregistrer
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
