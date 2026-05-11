<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Inscription<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<!-- Bibliothèque pour le téléphone international -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.css">
<style>
    .iti { width: 100%; }
    .iti__country-list { background-color: #1a1a2e; border: 1px solid rgba(255, 255, 255, 0.1); color: white; }
    .iti__country:hover { background-color: rgba(255, 255, 255, 0.05); }
    
    /* Category Selector Styles */
    .category-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin-bottom: 25px;
    }
    
    .cat-item {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 15px 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }
    
    .cat-item i {
        font-size: 1.2rem;
        color: var(--mm-text-muted);
    }
    
    .cat-item span {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--mm-text-muted);
        letter-spacing: 0.5px;
    }
    
    .cat-item:hover {
        background: #ffffff;
        border-color: var(--mm-accent);
    }
    
    .cat-item.active {
        background: rgba(106, 13, 173, 0.15);
        border-color: var(--mm-accent);
        box-shadow: 0 5px 15px rgba(106, 13, 173, 0.2);
    }
    
    .cat-item.active i, .cat-item.active span {
        color: var(--mm-accent);
    }

    .dynamic-section {
        display: none;
        animation: fadeInUp 0.4s ease;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-subtitle {
        color: var(--mm-accent);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-subtitle::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, rgba(212, 175, 55, 0.2), transparent);
    }

    /* Custom Searchable Select */
    .custom-select-container {
        position: relative;
        width: 100%;
    }
    .select-trigger {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: var(--mm-text-light);
        border-radius: 10px;
        padding: 12px 16px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        min-height: 50px;
    }
    .select-trigger:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(212, 175, 55, 0.3);
    }
    .select-trigger.active {
        border-color: var(--mm-accent);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
    }
    .select-trigger i {
        color: var(--mm-accent);
        transition: transform 0.3s ease;
    }
    .select-trigger.active i {
        transform: rotate(180deg);
    }

    .select-dropdown {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        width: 100%;
        background: #1a1a2e;
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.5);
        z-index: 1000;
        display: none;
        flex-direction: column;
        max-height: 400px;
        overflow: hidden;
        animation: selectDropdownFade 0.3s ease;
    }
    @keyframes selectDropdownFade {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .select-search-wrapper {
        padding: 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        background: rgba(255, 255, 255, 0.02);
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .select-search {
        background: #f8f9ff;
        border: 1px solid rgba(106, 13, 173, 0.1);
        color: #1a1a2e;
        width: 100%;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 0.9rem;
        outline: none;
    }
    .select-search:focus {
        border-color: var(--mm-accent);
    }

    .select-options {
        overflow-y: auto;
        padding: 8px 0;
    }
    .select-option-header {
        padding: 12px 16px;
        background: rgba(212, 175, 55, 0.1); /* Fond doré très léger */
        color: #D4AF37; /* Gold Classique */
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        cursor: default;
        display: flex;
        align-items: center;
    }
    .select-option-header::before {
        content: "";
        display: inline-block;
        width: 4px;
        height: 14px;
        background: #D4AF37;
        margin-right: 10px;
        border-radius: 2px;
    }
    .select-option {
        padding: 12px 16px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .select-option:hover {
        background: rgba(212, 175, 55, 0.08);
        color: var(--mm-accent);
    }
    .select-option.selected {
        background: rgba(106, 13, 173, 0.15);
        color: var(--mm-accent);
        font-weight: 600;
    }
    
    .quota-badge {
        font-size: 0.65rem;
        padding: 2px 8px;
        border-radius: 20px;
        margin-left: auto;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .quota-badge.available {
        background: rgba(46, 204, 113, 0.1);
        color: #2ecc71;
        border: 1px solid rgba(46, 204, 113, 0.2);
    }
    .quota-badge.warning {
        background: rgba(230, 126, 34, 0.1);
        color: #e67e22;
        border: 1px solid rgba(230, 126, 34, 0.2);
        animation: pulse-orange 2s infinite;
    }
    @keyframes pulse-orange {
        0% { box-shadow: 0 0 0 0 rgba(230, 126, 34, 0.4); }
        70% { box-shadow: 0 0 0 6px rgba(230, 126, 34, 0); }
        100% { box-shadow: 0 0 0 0 rgba(230, 126, 34, 0); }
    }
    .quota-badge.full {
        background: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
        border: 1px solid rgba(231, 76, 60, 0.2);
        text-decoration: line-through;
    }
    .select-option.full {
        opacity: 0.6;
        cursor: not-allowed;
    }
    .no-results {
        padding: 20px;
        text-align: center;
        color: var(--mm-text-muted);
        font-size: 0.85rem;
        display: none;
    }

    /* Scrollbar for select */
    .select-options::-webkit-scrollbar { width: 4px; }
    .select-options::-webkit-scrollbar-track { background: transparent; }
    .select-options::-webkit-scrollbar-thumb { background: rgba(212, 175, 55, 0.3); border-radius: 10px; }
    
    .custom-switch-premium .form-check-input {
        width: 3em;
        height: 1.5em;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        cursor: pointer;
    }
    .custom-switch-premium .form-check-input:checked {
        background-color: var(--mm-accent);
        border-color: var(--mm-accent);
        box-shadow: 0 0 10px rgba(212, 175, 55, 0.5);
    }
    .custom-switch-premium .form-check-label {
        padding-top: 4px;
        cursor: pointer;
    }
    .btn-gold:disabled {
        background: #4a4a4a !important;
        border-color: #555 !important;
        color: #888 !important;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
        opacity: 0.6;
    }

    /* Social Icons Row */
    .social-icons-row {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 10px;
        flex-wrap: wrap;
    }
    .social-icon-btn {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--mm-text-muted);
        font-size: 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        position: relative;
    }
    .social-icon-btn:hover {
        background: rgba(212, 175, 55, 0.12);
        border-color: var(--mm-accent);
        color: var(--mm-accent);
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .social-icon-btn.active {
        background: rgba(106, 13, 173, 0.2);
        border-color: var(--mm-accent);
        color: var(--mm-accent);
        box-shadow: 0 5px 20px rgba(106, 13, 173, 0.4);
    }
    .social-icon-btn.active::after {
        content: '\F26E'; /* bi-check-circle-fill */
        font-family: "bootstrap-icons";
        position: absolute;
        top: -5px;
        right: -5px;
        font-size: 0.9rem;
        background: var(--mm-accent);
        color: #1a1a2e;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #1a1a2e;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Premium Loader Overlay -->
<div id="loader-overlay">
    <div class="loader-content" id="loader-working">
        <div class="spinner-premium"></div>
    </div>
    <div class="loader-content" id="loader-success" style="display: none;">
        <div class="mb-4">
            <i class="bi bi-check-circle-fill" style="font-size: 5rem; color: #5dd39e; filter: drop-shadow(0 0 20px rgba(93, 211, 158, 0.4));"></i>
        </div>
        <div class="brand-title mb-2" style="font-size: 1.5rem; background: linear-gradient(135deg, #5dd39e, #a29bfe); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">TERMINÉ !</div>
        <p class="text-white opacity-75" style="letter-spacing: 2px; font-size: 0.8rem;">VOTRE INVITATION A ÉTÉ ENVOYÉE PAR EMAIL.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 fade-in">
        <div class="text-center mb-4">
            <div class="mb-3 fade-in">
                <img src="<?= base_url('assets/img/ministre_logo.png') ?>" alt="Logo Ministère" style="height: 120px; width: auto; filter: drop-shadow(0 0 15px rgba(255,255,255,0.1));">
            </div>
            <div class="brand-title mb-1" style="font-size: 1.8rem;">MISS MATHS/MISS SCIENCES</div>
            <p class="brand-subtitle">IA DE DAKAR &bull; Édition 2026</p>
        </div>

        <div class="glass-card p-4 p-md-4">
            <div id="error-container" style="display: none;">
                <div class="alert alert-danger mb-4">
                    <ul id="error-list" class="mb-0 ps-2" style="list-style: none; font-size: 0.85rem;">
                    </ul>
                </div>
            </div>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0 ps-2" style="list-style: none; font-size: 0.85rem;">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><i class="bi bi-exclamation-circle me-2"></i><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="/register" method="POST" id="form-register">
                <?= csrf_field() ?>
                <input type="hidden" name="type" id="selected-type" value="cem">

                <div class="form-subtitle">Choisissez votre profil</div>
                <div class="category-grid" style="grid-template-columns: repeat(4, 1fr);">
                    <div class="cat-item active" data-cat="cem">
                        <i class="bi bi-mortarboard"></i>
                        <span>CEM</span>
                    </div>
                    <div class="cat-item" data-cat="lycee">
                        <i class="bi bi-building"></i>
                        <span>Lycée</span>
                    </div>
                    <div class="cat-item" data-cat="groupe_prive">
                        <i class="bi bi-houses"></i>
                        <span>Privé</span>
                    </div>
                    <div class="cat-item" data-cat="communaute">
                        <i class="bi bi-people"></i>
                        <span>Communauté</span>
                    </div>
                </div>

                <div class="form-subtitle">Informations de base</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" placeholder="Votre prénom" required value="<?= old('prenom') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" placeholder="Votre nom" required value="<?= old('nom') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Adresse Email</label>
                        <input type="email" name="email" class="form-control" placeholder="vous@email.com" required value="<?= old('email') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label d-block">Téléphone</label>
                        <input type="tel" id="phone" name="telephone_input" class="form-control" required value="<?= old('telephone') ?>">
                        <input type="hidden" name="telephone" id="phone_full">
                    </div>
                </div>

                <!-- Section Scolarité (CEM/Lycee/Prive) -->
                <div id="section-school" class="dynamic-section">
                    <div class="form-subtitle">Scolarité</div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-7">
                            <label class="form-label" id="label-establishment">Établissement</label>
                            
                            <!-- Dropdown pour Lycée/CEM (Groupé par IEF) -->
                            <div class="custom-select-container" id="establishment-select-wrapper">
                                <div class="select-trigger" id="establishment-trigger">
                                    <span id="selected-establishment-text">Choisir un établissement...</span>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="select-dropdown" id="establishment-dropdown">
                                    <div class="select-search-wrapper">
                                        <input type="text" class="select-search" id="establishment-search" placeholder="Rechercher..." autocomplete="off">
                                    </div>
                                    <div class="select-options" id="establishment-options">
                                        <!-- Options peuplées par JS (Groupées par IEF) -->
                                    </div>
                                    <div class="no-results" id="establishment-no-results">Aucun résultat trouvé</div>
                                </div>
                            </div>

                            <!-- Bouton pour forcer la saisie manuelle (Apparaît pour le Privé) -->
                            <div id="manual-entry-toggle" style="display: none; margin-top: 8px;">
                                <a href="javascript:void(0)" class="text-decoration-none" style="color: var(--mm-accent); font-size: 0.8rem; font-weight: 600;">
                                    <i class="bi bi-pencil-square me-1"></i>Mon établissement n'est pas listé
                                </a>
                            </div>

                            <!-- Input libre pour Privé -->
                            <div id="establishment-input-wrapper" style="display: none;">
                                <input type="text" id="establishment-manual" class="form-control" placeholder="Saisissez le nom de votre établissement">
                            </div>

                            <input type="hidden" name="establishment" id="establishment-hidden-input">

                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Classe</label>
                            <div class="custom-select-container" id="class-container">
                                <div class="select-trigger" id="class-trigger">
                                    <span id="selected-class-text">Choisir votre classe...</span>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="select-dropdown" id="class-dropdown">
                                    <div class="select-options" id="class-options">
                                        <!-- Les options seront générées ici -->
                                    </div>
                                    <div class="no-results" id="class-no-results">Aucun résultat trouvé</div>
                                </div>
                                <input type="hidden" name="class" id="class-hidden-input">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Communauté -->
                <div id="section-community" class="dynamic-section">
                    <div class="form-subtitle">Profil Communauté</div>
                    <div class="mb-3">
                        <label class="form-label" style="text-transform: none; font-size: 0.95rem; color: var(--mm-accent);">Quel est votre intérêt pour le concours&nbsp;?</label>
                        <div class="custom-select-container" id="interest-container">
                            <div class="select-trigger" id="interest-trigger">
                                <span id="selected-interest-text">Choisir votre intérêt...</span>
                                <i class="bi bi-chevron-down"></i>
                            </div>
                            <div class="select-dropdown" id="interest-dropdown">
                                <div class="select-options" id="interest-options">
                                    <!-- Les options seront générées ici -->
                                </div>
                            </div>
                            <input type="hidden" name="interest" id="interest-hidden-input">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Profession</label>
                        <input type="text" name="profession" class="form-control" placeholder="Votre profession">
                    </div>
                </div>

                <!-- Section Intégration Communauté -->
                <div class="form-subtitle">Restons connectés</div>
                <div class="glass-card p-3 mb-4" style="background: rgba(106, 13, 173, 0.03); border: 1px solid rgba(106, 13, 173, 0.1);">
                    <div class="form-check form-switch mb-3 custom-switch-premium">
                        <input class="form-check-input" type="checkbox" id="join_community" name="join_community" value="1" checked>
                        <label class="form-check-label ms-2" for="join_community" style="color: var(--mm-text-light); font-weight: 500;">
                            Souhaitez-vous intégrer notre communauté Miss Maths/Miss Sciences ?
                        </label>
                        <div class="form-text mt-2" style="color: var(--mm-text-muted); font-size: 0.8rem; padding-left: 2.5rem;">
                            <i class="bi bi-info-circle me-1"></i> Cela permettra d'avoir l'actualité du concours et les rappels liés.
                        </div>
                    </div>

                    <!-- Section Réseau Social (Icônes centrées) -->
                    <div id="section-social" class="dynamic-section" style="display: block; text-align: center;">
                        <label class="form-label" style="color: var(--mm-accent); text-transform: none; font-size: 0.9rem; width: 100%;">Sur quel réseau social souhaitez-vous nous rejoindre ?</label>
                        <div class="social-icons-row">
                            <a href="https://chat.whatsapp.com/votre_groupe" target="_blank" class="social-icon-btn" data-social="WhatsApp" title="WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="https://t.me/votre_canal" target="_blank" class="social-icon-btn" data-social="Telegram" title="Telegram">
                                <i class="bi bi-telegram"></i>
                            </a>
                            <a href="https://facebook.com/votre_page" target="_blank" class="social-icon-btn" data-social="Facebook" title="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://instagram.com/votre_compte" target="_blank" class="social-icon-btn" data-social="Instagram" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="https://tiktok.com/@votre_compte" target="_blank" class="social-icon-btn" data-social="TikTok" title="TikTok">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        </div>
                        <input type="hidden" name="social_network" id="social-hidden-input">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-gold w-100 py-3 fw-bold" style="border-radius: 12px; font-size: 1.05rem;">
                    <i class="bi bi-qr-code-scan me-2"></i>Récupérer mon invitation
                </button>
            </form>
        </div>

        <div class="text-center mt-4">
            <p class="footer-text mb-2">
                <i class="bi bi-shield-check me-1"></i> Plateforme sécurisée &bull; &copy; 2026 Miss Maths/Miss Sciences
            </p>
            <?php if(session()->get('isLoggedIn')): ?>
                <a href="/admin/dashboard" class="text-decoration-none" style="color: var(--mm-text-muted); font-size: 0.7rem; opacity: 0.3; transition: opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.3">
                    <i class="bi bi-speedometer2 me-1"></i> Retour au Tableau de Bord
                </a>
            <?php else: ?>
                <a href="/login" class="text-decoration-none" style="color: var(--mm-text-muted); font-size: 0.7rem; opacity: 0.3; transition: opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.3">
                    Accès Administration
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let isQuotaFull = false;
        const phoneInput = document.querySelector("#phone");
        const phoneFull = document.querySelector("#phone_full");
        const iti = window.intlTelInput(phoneInput, {
            initialCountry: "sn",
            preferredCountries: ["sn", "fr", "ci", "gn"],
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js",
        });

        const catItems = document.querySelectorAll('.cat-item');
        const selectedTypeInput = document.querySelector('#selected-type');
        const sectionSchool = document.querySelector('#section-school');
        const sectionCommunity = document.querySelector('#section-community');
        const sectionSocial = document.querySelector('#section-social');
        const labelEstablishment = document.querySelector('#label-establishment');

        // ── Data: Cache des établissements ──
        let establishmentsCache = {
            cem: [],
            lycee: [],
            prive: [],
            groupe_prive: []
        };

        async function fetchEstablishments(type) {
            if (type === 'communaute') return;
            
            const cacheKey = `mm_cache_est_${type}`;
            const now = new Date().getTime();

            // Si déjà en mémoire, on peut l'afficher tout de suite (vitesse)
            if (establishmentsCache[type].length > 0) {
                const currentCat = selectedTypeInput.value;
                if (type === currentCat || (type === 'prive' && currentCat === 'groupe_prive')) {
                    populateOptions(currentCat);
                }
            }

            try {
                const response = await fetch(`/get-establishments?type=${type}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                
                if (!response.ok) {
                    const errData = await response.json().catch(() => ({}));
                    throw new Error(errData.message || `Erreur serveur (${response.status})`);
                }

                const data = await response.json();
                
                const formatted = [];
                let currentIef = null;
                
                if (Array.isArray(data)) {
                    data.forEach(est => {
                        if (est.ief !== currentIef) {
                            currentIef = est.ief;
                            formatted.push({ type: 'zone', name: `IEF : ${currentIef}` });
                        }
                        formatted.push(est);
                    });
                }
                
                establishmentsCache[type] = formatted;
                if (type === 'prive') establishmentsCache['groupe_prive'] = formatted;
                
                localStorage.setItem(cacheKey, JSON.stringify({
                    timestamp: now,
                    data: formatted
                }));

                // Mise à jour de l'UI seulement si c'est la catégorie active
                const activeCat = selectedTypeInput.value;
                if (type === activeCat || (type === 'prive' && activeCat === 'groupe_prive')) {
                    populateOptions(activeCat);
                }
            } catch (e) {
                console.error(`Erreur chargement établissements (${type}):`, e);
                const activeCat = selectedTypeInput.value;
                if (type === activeCat || (type === 'prive' && activeCat === 'groupe_prive')) {
                    if (establishmentsCache[activeCat].length === 0) {
                        optionsContainer.innerHTML = `<div class="p-3 text-center text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Erreur de chargement<br><small style="font-size: 0.65rem; opacity: 0.7;">${e.message}</small></div>`;
                    }
                }
            }
        }

        const estSelectWrapper = document.querySelector('#establishment-select-wrapper');
        const estInputWrapper = document.querySelector('#establishment-input-wrapper');
        const estManualInput = document.querySelector('#establishment-manual');

        // Fonction de vérification des quotas via AJAX
        let quotaTimeout;
        async function checkQuota(establishmentName) {
            if (!establishmentName || establishmentName.length < 2) {
                isQuotaFull = false;
                return;
            }

            const formData = new FormData();
            formData.append('establishment', establishmentName);

            try {
                const response = await fetch('/check-quota', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const res = await response.json();

                if (res.status === 'success') {
                    if (res.remaining !== null && res.remaining <= 0) {
                        isQuotaFull = true;
                    } else {
                        isQuotaFull = false;
                    }
                    validateForm(); 
                }
            } catch (e) { console.error("Erreur quota:", e); }
        }

        const trigger = document.querySelector('#establishment-trigger');
        const dropdown = document.querySelector('#establishment-dropdown');
        const searchInput = document.querySelector('#establishment-search');
        const optionsContainer = document.querySelector('#establishment-options');
        const hiddenInput = document.querySelector('#establishment-hidden-input');
        const selectedText = document.querySelector('#selected-establishment-text');
        const noResults = document.querySelector('#establishment-no-results');
        const otherWrapper = document.querySelector('#other-establishment-wrapper');

        function populateOptions(category, filter = '') {
            const list = establishmentsCache[category] || [];
            optionsContainer.innerHTML = '';
            
            const filtered = list.filter(item => 
                item.name.toLowerCase().includes(filter.toLowerCase())
            );

            if (filtered.length === 0 && filter !== '') {
                noResults.style.display = 'block';
                return;
            }
            noResults.style.display = 'none';

            filtered.forEach(item => {
                const option = document.createElement('div');
                
                if (item.type === 'zone') {
                    option.className = 'select-option-header';
                    option.innerHTML = `<strong>${item.name}</strong>`;
                    optionsContainer.appendChild(option);
                    return;
                }

                const isFull = item.remaining !== null && item.remaining <= 0;
                option.className = `select-option ${isFull ? 'full' : ''}`;
                
                if (hiddenInput.value === item.name) option.classList.add('selected');
                
                let quotaBadge = '';
                if (item.remaining !== null) {
                    let badgeClass = 'available';
                    let text = `${item.remaining} places`;
                    
                    if (item.remaining <= 0) {
                        badgeClass = 'full';
                        text = 'Complet';
                    } else if (item.remaining <= 2) {
                        badgeClass = 'warning';
                        text = `${item.remaining} places`;
                    }
                    
                    quotaBadge = `<span class="quota-badge ${badgeClass}">${text}</span>`;
                }

                option.innerHTML = `<span>${item.name}</span> ${quotaBadge}`;
                
                if (!isFull) {
                    option.addEventListener('click', () => {
                        hiddenInput.value = item.name;
                        selectedText.textContent = item.name;
                        selectedText.style.color = 'white';
                        
                        // Si c'est l'option "Autre"
                        if (item.id === 'other') {
                            estInputWrapper.style.display = 'block';
                            estManualInput.focus();
                        } else {
                            estInputWrapper.style.display = 'none';
                            checkQuota(item.name);
                        }
                        
                        closeDropdown();
                        validateForm();
                    });
                } else {
                    option.addEventListener('click', (e) => {
                        e.stopPropagation();
                    });
                }

                optionsContainer.appendChild(option);
            });

            // Ajouter l'option "Autre" pour les privés
            if (category === 'prive' || category === 'groupe_prive') {
                const otherOption = document.createElement('div');
                otherOption.className = 'select-option other-option-item';
                otherOption.innerHTML = `<span><i class="bi bi-plus-circle me-2"></i>${filter ? 'Utiliser "' + filter + '"' : 'Autre (Saisie manuelle)'}</span>`;
                otherOption.addEventListener('click', () => {
                    const finalValue = filter || '';
                    hiddenInput.value = finalValue;
                    selectedText.textContent = finalValue || 'Autre (Saisie manuelle)';
                    selectedText.style.color = 'white';
                    estInputWrapper.style.display = 'block';
                    estManualInput.value = finalValue;
                    
                    if (!finalValue) {
                        estManualInput.focus();
                    }
                    
                    closeDropdown();
                    validateForm();
                });
                optionsContainer.appendChild(otherOption);
                
                // Si on a un filtre et aucun résultat, on cache le message "Aucun résultat" 
                // car on propose l'option "Utiliser..."
                if (filtered.length === 0 && filter !== '') {
                    noResults.style.display = 'none';
                }
            }
        }

        function toggleDropdown() {
            const isOpen = dropdown.style.display === 'flex';
            if (isOpen) closeDropdown();
            else openDropdown();
        }

        function openDropdown() {
            dropdown.style.display = 'flex';
            trigger.classList.add('active');
            searchInput.focus();
            
            // Rafraîchir les données à chaque ouverture pour le "temps réel"
            const currentCat = selectedTypeInput.value;
            if (currentCat === 'cem' || currentCat === 'lycee') {
                fetchEstablishments(currentCat);
            }
        }

        function closeDropdown() {
            dropdown.style.display = 'none';
            trigger.classList.remove('active');
        }

        function closeClassDropdown() {
            classDropdown.style.display = 'none';
            classTrigger.classList.remove('active');
        }

        function closeSocialDropdown() {
            socialDropdown.style.display = 'none';
            socialTrigger.classList.remove('active');
        }

        function closeInterestDropdown() {
            if (interestDropdown) {
                interestDropdown.style.display = 'none';
                interestTrigger.classList.remove('active');
            }
        }

        document.addEventListener('click', () => {
            closeDropdown();
            closeClassDropdown();
            closeSocialDropdown();
            closeInterestDropdown();
        });

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            closeClassDropdown();
            toggleDropdown();
        });

        searchInput.addEventListener('input', (e) => {
            populateOptions(selectedTypeInput.value, e.target.value);
        });

        searchInput.addEventListener('click', (e) => e.stopPropagation());

        // ── Logic for Class Select ──
        const classTrigger = document.querySelector('#class-trigger');
        const classDropdown = document.querySelector('#class-dropdown');
        const classOptionsContainer = document.querySelector('#class-options');
        const classNoResults = document.querySelector('#class-no-results');
        const classHiddenInput = document.querySelector('#class-hidden-input');
        const selectedClassText = document.querySelector('#selected-class-text');

        const classesData = [
            { name: "6ème", category: "cem" },
            { name: "5ème", category: "cem" },
            { name: "4ème", category: "cem" },
            { name: "3ème", category: "cem" },
            { name: "2nde", category: "lycee" },
            { name: "1ère", category: "lycee" },
            { name: "Terminale", category: "lycee" }
        ];

        function populateClassOptions(category) {
            classOptionsContainer.innerHTML = '';
            const filterCat = category === 'prive' ? 'groupe_prive' : category;
            
            const filtered = classesData.filter(item => {
                // Si c'est un Lycée ou un Groupe Privé, on montre toutes les classes (6ème à Terminale)
                // Si c'est un CEM, on ne montre que les classes du CEM (6ème à 3ème)
                if (filterCat === 'lycee' || filterCat === 'groupe_prive' || filterCat === 'communaute') {
                    return true; 
                }
                return item.category === 'cem';
            });

            if (filtered.length === 0) {
                classNoResults.style.display = 'block';
                return;
            }
            classNoResults.style.display = 'none';

            filtered.forEach(item => {
                const option = document.createElement('div');
                option.className = 'select-option';
                if (classHiddenInput.value === item.name) option.classList.add('selected');
                option.innerHTML = `<span>${item.name}</span>`;
                
                option.addEventListener('click', () => {
                    classHiddenInput.value = item.name;
                    selectedClassText.textContent = item.name;
                    selectedClassText.style.color = 'white';
                    classDropdown.style.display = 'none';
                    classTrigger.classList.remove('active');
                });

                classOptionsContainer.appendChild(option);
            });
        }

        classTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = classDropdown.style.display === 'flex';
            closeDropdown(); // Close establishment dropdown if open
            if (isOpen) {
                classDropdown.style.display = 'none';
                classTrigger.classList.remove('active');
            } else {
                classDropdown.style.display = 'flex';
                classTrigger.classList.add('active');
            }
        });

        // Pas besoin de listener sur classSearchInput car supprimé

        // ── Logic for Social Icons ──
        const socialIcons = document.querySelectorAll('.social-icon-btn');
        const socialHiddenInput = document.querySelector('#social-hidden-input');

        socialIcons.forEach(icon => {
            icon.addEventListener('click', function(e) {
                // On ne bloque pas le lien (target="_blank" ouvrira le lien)
                // Mais on sélectionne l'icône pour le formulaire
                socialIcons.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                socialHiddenInput.value = this.dataset.social;
                validateForm();
            });
        });
        
        // ── Logic for Interest Select ──
        const interestTrigger = document.querySelector('#interest-trigger');
        const interestDropdown = document.querySelector('#interest-dropdown');
        const interestOptionsContainer = document.querySelector('#interest-options');
        const interestHiddenInput = document.querySelector('#interest-hidden-input');
        const selectedInterestText = document.querySelector('#selected-interest-text');

        const interestsData = [
            "Je suis professeur",
            "Je suis chef d'établissement",
            "Je suis encadreur",
            "Je suis parent d'une lauréate",
            "Je suis dans l'école d'une lauréate ou candidate",
            "Autre"
        ];

        function populateInterestOptions() {
            interestOptionsContainer.innerHTML = '';
            interestsData.forEach(item => {
                const option = document.createElement('div');
                option.className = 'select-option';
                if (interestHiddenInput.value === item) option.classList.add('selected');
                option.innerHTML = `<span>${item}</span>`;
                
                option.addEventListener('click', () => {
                    interestHiddenInput.value = item;
                    selectedInterestText.textContent = item;
                    selectedInterestText.style.color = 'white';
                    interestDropdown.style.display = 'none';
                    interestTrigger.classList.remove('active');
                    validateForm();
                });
                interestOptionsContainer.appendChild(option);
            });
        }

        interestTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = interestDropdown.style.display === 'flex';
            closeDropdown();
            closeClassDropdown();
            if (isOpen) {
                interestDropdown.style.display = 'none';
                interestTrigger.classList.remove('active');
            } else {
                interestDropdown.style.display = 'flex';
                interestTrigger.classList.add('active');
            }
        });

        populateInterestOptions();

        function updateClasses(category) {
            classHiddenInput.value = '';
            selectedClassText.textContent = 'Choisir votre classe...';
            selectedClassText.style.color = 'var(--mm-text-muted)';
            populateClassOptions(category);
        }

        // Écouteur pour la saisie manuelle des privés
        estManualInput.addEventListener('input', function() {
            const val = this.value.trim();
            hiddenInput.value = val;
            
            // Délai pour ne pas saturer le serveur de requêtes AJAX
            clearTimeout(quotaTimeout);
            quotaTimeout = setTimeout(() => {
                checkQuota(val);
                validateForm();
            }, 500);
        });

        function filterSelects(category) {
            hiddenInput.value = '';
            selectedText.textContent = 'Choisir un établissement...';
            selectedText.style.color = 'var(--mm-text-muted)';
            
            // Reset status lors du changement de catégorie
            isQuotaFull = false;
            
            const manualToggle = document.querySelector('#manual-entry-toggle');

            // Toujours afficher le wrapper de sélection pour CEM, Lycée et Privé
            estSelectWrapper.style.display = 'block';
            estInputWrapper.style.display = 'none';
            
            if (category === 'groupe_prive') {
                labelEstablishment.innerText = 'Établissement Privé';
                manualToggle.style.display = 'block';
                fetchEstablishments('prive');
            } else {
                labelEstablishment.innerText = category === 'cem' ? 'CEM' : 'Lycée';
                manualToggle.style.display = 'none';
                fetchEstablishments(category);
            }

            // UX: Afficher un loader dans le dropdown pendant le fetch
            optionsContainer.innerHTML = '<div class="p-3 text-center text-muted"><span class="spinner-border spinner-border-sm me-2"></span>Chargement...</div>';
            
            updateClasses(category);
        }

        // Gestion du clic sur le bouton de saisie manuelle
        document.querySelector('#manual-entry-toggle').addEventListener('click', function() {
            estSelectWrapper.style.display = 'none';
            this.style.display = 'none';
            estInputWrapper.style.display = 'block';
            estManualInput.value = '';
            estManualInput.focus();
            hiddenInput.value = '';
            
            // Ajouter un bouton pour revenir à la liste
            if (!document.querySelector('#back-to-list')) {
                const backBtn = document.createElement('div');
                backBtn.id = 'back-to-list';
                backBtn.style.marginTop = '8px';
                backBtn.innerHTML = `<a href="javascript:void(0)" class="text-decoration-none" style="color: var(--mm-text-muted); font-size: 0.8rem;">
                    <i class="bi bi-list-ul me-1"></i>Revenir à la liste
                </a>`;
                backBtn.addEventListener('click', function() {
                    estSelectWrapper.style.display = 'block';
                    document.querySelector('#manual-entry-toggle').style.display = 'block';
                    estInputWrapper.style.display = 'none';
                    this.remove();
                });
                estInputWrapper.after(backBtn);
            }
        });

        // Initial state for 'cem'
        sectionSchool.style.display = 'block';
        sectionSocial.style.display = 'block';
        labelEstablishment.innerText = 'CEM';
        filterSelects('cem');

        // Pré-chargement de TOUTES les catégories pour que ce soit instantané après
        fetchEstablishments('cem');
        fetchEstablishments('lycee');
        fetchEstablishments('prive');

        catItems.forEach(item => {
            item.addEventListener('click', function() {
                catItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                
                const cat = this.dataset.cat;
                selectedTypeInput.value = cat;

                // Toggle sections
                if (cat === 'communaute') {
                    sectionSchool.style.display = 'none';
                    sectionCommunity.style.display = 'block';
                } else {
                    sectionSchool.style.display = 'block';
                    sectionCommunity.style.display = 'none';
                    
                    if (cat === 'cem') labelEstablishment.innerText = 'CEM';
                    else if (cat === 'lycee') labelEstablishment.innerText = 'Lycée';
                    else labelEstablishment.innerText = 'Établissement Privé';
                    
                    filterSelects(cat);
                }
                validateForm();
            });
        });

        // Toggle Social Network section based on Checkbox
        const joinCommunityCheckbox = document.querySelector('#join_community');
        const socialNetworkSelect = document.querySelector('#social_network_select');
        
        joinCommunityCheckbox.addEventListener('change', function() {
            if (this.checked) {
                sectionSocial.style.display = 'block';
                socialHiddenInput.setAttribute('required', 'required');
            } else {
                sectionSocial.style.display = 'none';
                socialHiddenInput.removeAttribute('required');
                socialHiddenInput.value = ''; // Reset selection if unchecked
                socialIcons.forEach(i => i.classList.remove('active'));
            }
        });

        // Note: L'affichage du champ "Autre" est maintenant géré dans populateOptions()


        const form = document.querySelector('#form-register');
        const loader = document.querySelector('#loader-overlay');
        const submitBtn = form.querySelector('button[type="submit"]');

        // Initialisation : bouton désactivé
        submitBtn.disabled = true;

        function validateForm() {
            const currentType = selectedTypeInput.value;
            const prenom = form.querySelector('[name="prenom"]').value.trim();
            const nom = form.querySelector('[name="nom"]').value.trim();
            const email = form.querySelector('[name="email"]').value.trim();
            const phone = phoneInput.value.trim();
            
            // Regex Email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            let isValid = true;

            // Champs de base
            if (!prenom || !nom || !emailRegex.test(email)) isValid = false;
            
            // Téléphone (via iti)
            if (!iti.isValidNumber()) isValid = false;

            // Champs dynamiques
            if (currentType !== 'communaute') {
                if (!hiddenInput.value) isValid = false; // Etablissement
                if (!classHiddenInput.value) isValid = false; // Classe
            } else {
                const interest = interestHiddenInput.value;
                const profession = form.querySelector('[name="profession"]').value.trim();
                if (!interest || !profession) isValid = false;
            }

            // Réseau social (Optionnel désormais pour l'activation du bouton)
            // if (joinCommunityCheckbox.checked && !socialHiddenInput.value) {
            //     isValid = false;
            // }

            // Bloquer si le quota est atteint
            if (isQuotaFull) {
                isValid = false;
            }

            submitBtn.disabled = !isValid;
        }

        // Écouteurs sur tous les champs pour la validation en temps réel
        form.querySelectorAll('input, select').forEach(el => {
            el.addEventListener('input', validateForm);
            el.addEventListener('change', validateForm);
        });
        
        // Écouteurs spécifiques pour intl-tel-input
        phoneInput.addEventListener('keyup', validateForm);
        phoneInput.addEventListener('change', validateForm);
        phoneInput.addEventListener('countrychange', validateForm);

        // Puisqu'on utilise des selects custom, on appelle validateForm quand ils changent
        const originalHiddenInputSet = hiddenInput.setAttribute;
        hiddenInput.addEventListener('change', validateForm);
        classHiddenInput.addEventListener('change', validateForm);
        socialHiddenInput.addEventListener('change', validateForm);

        // Petit Hack pour détecter le changement des inputs hidden (custom selects)
        const observer = new MutationObserver(validateForm);
        [hiddenInput, classHiddenInput, socialHiddenInput, selectedTypeInput].forEach(el => {
            observer.observe(el, { attributes: true, attributeFilter: ['value'] });
        });

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (submitBtn.disabled) return;
            
            const currentType = selectedTypeInput.value;
            
            // Désactivation immédiate du bouton pour éviter les doubles clics
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Génération en cours...';
            
            // Capture du numéro au format international
            try {
                phoneFull.value = iti.getNumber();
            } catch (e) {
                console.warn("Erreur formatage téléphone:", e);
                phoneFull.value = phoneInput.value;
            }
            const formData = new FormData(this);
            
            // Affichage du loader premium avec effet de flou
            loader.style.display = 'flex';
            setTimeout(() => { loader.style.opacity = '1'; }, 10);

            try {
                const response = await fetch('/register', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    // Note : L'email est envoyé de manière synchrone par le serveur pour plus de fiabilité.
                    // Les optimisations (cache PDF, SMTP rapide) garantissent un temps de réponse réduit.

                    // Affichage de l'animation de succès (Expert UX)
                    document.querySelector('#loader-working').style.display = 'none';
                    document.querySelector('#loader-success').style.display = 'block';
                    
                    // On laisse l'utilisateur voir le succès avant de rediriger
                    setTimeout(() => {
                        window.location.href = result.redirect || '/';
                    }, 1500);
                } else {
                    // Réactivation du bouton en cas d'erreur
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="bi bi-qr-code-scan me-2"></i>Récupérer mon invitation';
                    loader.style.display = 'none';
                    
                    // Affichage des erreurs
                    const errorContainer = document.querySelector('#error-container');
                    const errorList = document.querySelector('#error-list');
                    errorList.innerHTML = '';
                    
                    if (result.errors) {
                        Object.values(result.errors).forEach(err => {
                            errorList.innerHTML += `<li><i class="bi bi-exclamation-circle me-2"></i>${err}</li>`;
                        });
                    } else {
                        errorList.innerHTML = `<li><i class="bi bi-exclamation-circle me-2"></i>Une erreur inconnue est survenue.</li>`;
                    }
                    
                    errorContainer.style.display = 'block';
                    errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } catch (error) {
                console.error('Error:', error);
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-qr-code-scan me-2"></i>Récupérer mon invitation';
                loader.style.display = 'none';
                alert("Erreur de communication avec le serveur. Veuillez vérifier votre connexion.");
            }
        });
    });
</script>
<?= $this->endSection() ?>
