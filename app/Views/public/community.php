<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Rejoindre la Communauté<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.css">
<style>
    .iti { width: 100%; }
    .iti__country-list { background-color: #1a1a2e; border: 1px solid rgba(255,255,255,0.1); color: white; }
    
    .category-selector {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 30px;
    }

    @media (min-width: 768px) {
        .category-selector {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .category-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .category-card i {
        font-size: 1.5rem;
        color: var(--mm-text-muted);
        transition: all 0.3s ease;
    }

    .category-card span {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--mm-text-muted);
    }

    .category-card:hover {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(212, 175, 55, 0.3);
        transform: translateY(-3px);
    }

    .category-card.active {
        background: rgba(106, 13, 173, 0.15);
        border-color: var(--mm-accent);
        box-shadow: 0 10px 25px rgba(106, 13, 173, 0.2);
    }

    .category-card.active i {
        color: var(--mm-accent);
        transform: scale(1.1);
    }

    .category-card.active span {
        color: white;
    }

    .dynamic-field {
        display: none;
        animation: fadeInSlide 0.4s ease-out forwards;
    }

    @keyframes fadeInSlide {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--mm-accent);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, rgba(212, 175, 55, 0.3), transparent);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-8 fade-in">
        <div class="text-center mb-5">
            <div class="brand-title mb-2">COMMUNAUTÉ</div>
            <p class="brand-subtitle">Miss Maths/Miss Sciences IA</p>
        </div>

        <div class="glass-card p-4 p-md-5">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success mb-4 text-center">
                    <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0 ps-2" style="list-style: none;">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><i class="bi bi-exclamation-circle me-2"></i><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/communaute/register" method="POST" id="form-community">
                <?= csrf_field() ?>
                <input type="hidden" name="category" id="selected-category" value="communaute">

                <div class="category-selector">
                    <div class="category-card" data-cat="cem">
                        <i class="bi bi-mortarboard"></i>
                        <span>CEM</span>
                    </div>
                    <div class="category-card" data-cat="lycee">
                        <i class="bi bi-building"></i>
                        <span>Lycée</span>
                    </div>
                    <div class="category-card" data-cat="groupe_prive">
                        <i class="bi bi-houses"></i>
                        <span>GS Privé</span>
                    </div>
                    <div class="category-card active" data-cat="communaute">
                        <i class="bi bi-people"></i>
                        <span>Communauté</span>
                    </div>
                </div>

                <div class="section-title">
                    <i class="bi bi-person-badge"></i> Informations Personnelles
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <label class="form-label">Prénom & Nom</label>
                        <input type="text" name="full_name" class="form-control" placeholder="Votre nom complet" required value="<?= old('full_name') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="exemple@email.com" required value="<?= old('email') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label d-block">Téléphone</label>
                        <input type="tel" id="phone" name="telephone_input" class="form-control" required value="<?= old('telephone') ?>">
                        <input type="hidden" name="telephone" id="phone_full">
                    </div>
                </div>

                <!-- Fields for CEM / Lycée / GS Privé -->
                <div id="fields-school" class="dynamic-field">
                    <div class="section-title">
                        <i class="bi bi-book"></i> Scolarité
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label class="form-label" id="label-establishment">Établissement</label>
                            <select name="establishment" class="form-select">
                                <option value="" selected disabled>Choisir un établissement...</option>
                                <optgroup label="CEM Populaires">
                                    <option value="CEM Martin Luther King">CEM Martin Luther King</option>
                                    <option value="CEM Lamine Guèye">CEM Lamine Guèye</option>
                                    <option value="CEM Blaise Diagne">CEM Blaise Diagne</option>
                                </optgroup>
                                <optgroup label="Lycées d'Excellence">
                                    <option value="Lycée Limamou Laye">Lycée Limamou Laye</option>
                                    <option value="Lycée Mariama Bâ">Lycée Mariama Bâ</option>
                                    <option value="Lycée Seydina Limamou Laye">Lycée Seydina Limamou Laye</option>
                                </optgroup>
                                <option value="Autre">Autre établissement...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Classe</label>
                            <select name="class" class="form-select">
                                <option value="" selected disabled>Classe...</option>
                                <option value="6ème">6ème</option>
                                <option value="5ème">5ème</option>
                                <option value="4ème">4ème</option>
                                <option value="3ème">3ème</option>
                                <option value="2nde">2nde</option>
                                <option value="1ère">1ère</option>
                                <option value="Terminale">Terminale</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Fields for Communauté -->
                <div id="fields-communaute" class="dynamic-field" style="display: block;">
                    <div class="section-title">
                        <i class="bi bi-briefcase"></i> Profil & Intérêt
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Profession</label>
                            <input type="text" name="profession" class="form-control" placeholder="Votre profession" value="<?= old('profession') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Intérêt pour le concours</label>
                            <select name="interest" class="form-select">
                                <option value="" selected disabled>Sélectionnez votre intérêt...</option>
                                <option value="Encadreur">Je suis encadreur</option>
                                <option value="Parent">Je suis parent d'une lauréate</option>
                                <option value="Ecole">Je suis dans l'école d'une lauréate/candidate</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="section-title">
                    <i class="bi bi-share"></i> Communication
                </div>
                <div class="mb-5">
                    <label class="form-label">Sur quel réseau social souhaitez-vous recevoir les informations ?</label>
                    <select name="social_network" class="form-select" required>
                        <option value="" selected disabled>Choisir un réseau...</option>
                        <option value="WhatsApp">WhatsApp</option>
                        <option value="Telegram">Telegram</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Instagram">Instagram</option>
                        <option value="LinkedIn">LinkedIn</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-premium w-100 py-3 fw-bold">
                    <i class="bi bi-person-plus-fill me-2"></i>REJOINDRE LA COMMUNAUTÉ
                </button>
            </form>
        </div>

        <div class="text-center mt-4">
            <p class="footer-text">
                <i class="bi bi-shield-lock-fill me-1"></i> Vos données sont protégées &bull; Miss Maths/Miss Sciences IA 2026
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.querySelector("#phone");
        const phoneFull = document.querySelector("#phone_full");
        const iti = window.intlTelInput(phoneInput, {
            initialCountry: "sn",
            preferredCountries: ["sn", "fr", "ci"],
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js",
        });

        const cards = document.querySelectorAll('.category-card');
        const selectedCatInput = document.querySelector('#selected-category');
        const fieldsSchool = document.querySelector('#fields-school');
        const fieldsCommunaute = document.querySelector('#fields-communaute');
        const labelEstablishment = document.querySelector('#label-establishment');

        cards.forEach(card => {
            card.addEventListener('click', function() {
                // UI Toggle
                cards.forEach(c => c.classList.remove('active'));
                this.classList.add('active');

                const cat = this.dataset.cat;
                selectedCatInput.value = cat;

                // Logic Toggle
                if (cat === 'communaute') {
                    fieldsSchool.style.display = 'none';
                    fieldsCommunaute.style.display = 'block';
                } else {
                    fieldsSchool.style.display = 'block';
                    fieldsCommunaute.style.display = 'none';
                    
                    // Update label based on category
                    if (cat === 'cem') labelEstablishment.innerText = 'CEM';
                    else if (cat === 'lycee') labelEstablishment.innerText = 'Lycée';
                    else labelEstablishment.innerText = 'Groupe Scolaire';
                }
            });
        });

        // Form Submission
        const form = document.querySelector('#form-community');
        form.addEventListener('submit', function(e) {
            phoneFull.value = iti.getNumber();
            const btn = this.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Inscription en cours...';
        });
    });
</script>
<?= $this->endSection() ?>
