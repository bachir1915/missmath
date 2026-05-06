<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Inscription<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<!-- Bibliothèque pour le téléphone international -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.css">
<style>
    .iti { width: 100%; }
    .iti__country-list { background-color: #1a1a2e; border: 1px solid rgba(255,255,255,0.1); color: white; }
    .iti__country:hover { background-color: rgba(255,255,255,0.05); }
    
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
        border-radius: 12px;
        padding: 10px 5px;
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
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--mm-text-muted);
        letter-spacing: 0.5px;
    }
    
    .cat-item:hover {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(212, 175, 55, 0.3);
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
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
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
    .select-group-label {
        padding: 10px 16px 5px;
        font-size: 0.65rem;
        font-weight: 800;
        color: var(--mm-accent);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        opacity: 0.8;
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
        <p class="text-white opacity-75" style="letter-spacing: 2px; font-size: 0.8rem;">VOTRE INVITATION EST PRÊTE.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 fade-in">
        <div class="text-center mb-4">
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
                            <div class="custom-select-container">
                                <div class="select-trigger" id="establishment-trigger">
                                    <span id="selected-establishment-text">Choisir un établissement...</span>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                                <div class="select-dropdown" id="establishment-dropdown">
                                    <div class="select-search-wrapper">
                                        <input type="text" class="select-search" id="establishment-search" placeholder="Rechercher un établissement..." autocomplete="off">
                                    </div>
                                    <div class="select-options" id="establishment-options">
                                        <!-- Options peuplées par JS -->
                                    </div>
                                    <div class="no-results" id="establishment-no-results">Aucun résultat trouvé</div>
                                </div>
                                <input type="hidden" name="establishment" id="establishment-hidden-input">
                            </div>
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
                        <div class="col-12" id="other-establishment-wrapper" style="display: none;">
                            <label class="form-label">Précisez l'établissement</label>
                            <input type="text" name="establishment_other" class="form-control" placeholder="Nom de votre école">
                        </div>
                    </div>
                </div>

                <!-- Section Communauté -->
                <div id="section-community" class="dynamic-section">
                    <div class="form-subtitle">Profil Communauté</div>
                    <div class="mb-3">
                        <label class="form-label" style="text-transform: none; font-size: 0.95rem; color: var(--mm-accent);">Quel est votre intérêt pour le concours&nbsp;?</label>
                        <select name="interest" class="form-select">
                            <option value="" selected disabled>Choisir...</option>
                            <option value="Je suis professeur">Je suis professeur</option>
                            <option value="Je suis chef d'établissement">Je suis chef d'établissement</option>
                            <option value="Je suis encadreur">Je suis encadreur</option>
                            <option value="Je suis parent d'une lauréate">Je suis parent d'une lauréate</option>
                            <option value="Je suis dans l'école d'une lauréate ou candidate">Je suis dans l'école d'une lauréate ou d'une candidate</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Profession</label>
                        <input type="text" name="profession" class="form-control" placeholder="Votre profession">
                    </div>
                </div>

                <!-- Section Intégration Communauté -->
                <div class="form-subtitle">Restons connectés</div>
                <div class="glass-card p-3 mb-4" style="background: rgba(106, 13, 173, 0.05); border: 1px solid rgba(212, 175, 55, 0.2);">
                    <div class="form-check form-switch mb-3 custom-switch-premium">
                        <input class="form-check-input" type="checkbox" id="join_community" name="join_community" value="1" checked>
                        <label class="form-check-label ms-2" for="join_community" style="color: var(--mm-text-light); font-weight: 500;">
                            Souhaitez-vous intégrer la communauté Miss Maths/Miss Sciences de l'IA de Dakar ?
                        </label>
                        <div class="form-text mt-2" style="color: var(--mm-text-muted); font-size: 0.8rem; padding-left: 2.5rem;">
                            <i class="bi bi-info-circle me-1"></i> Cela permettra d'avoir l'actualité du concours et les rappels liés.
                        </div>
                    </div>

                    <!-- Section Réseau Social (Affichée si la case est cochée) -->
                    <div id="section-social" class="dynamic-section" style="padding-left: 2.5rem; display: block;">
                        <label class="form-label" style="color: var(--mm-accent);">Sur quel réseau social souhaitez-vous avoir les informations liées au concours ?</label>
                        <div class="custom-select-container" id="social-container">
                            <div class="select-trigger" id="social-trigger">
                                <span id="selected-social-text">Choisir un réseau...</span>
                                <i class="bi bi-chevron-down"></i>
                            </div>
                            <div class="select-dropdown" id="social-dropdown">
                                <div class="select-options" id="social-options">
                                    <!-- Les options seront générées ici -->
                                </div>
                            </div>
                            <input type="hidden" name="social_network" id="social-hidden-input">
                        </div>
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

        // ── Data: Établissements ──
        const establishmentsData = {
            lycee: [
                { name: "BST LIBERTE 3" },
                { name: "BST POINT E" },
                { name: "INSTITUT ISLAMIQUE DE DAKAR" },
                { name: "LEP BIRAGO DIOP" },
                { name: "LYCEE AMATH DANSOKHO" },
                { name: "LYCEE AMINATA SOW FALL" },
                { name: "LYCEE BLAISE DIAGNE" },
                { name: "LYCEE DE HANN BEL AIR" },
                { name: "LYCEE D’EXCELLENCE MARIAMA BA" },
                { name: "LYCEE FRANCO ARABE CHEIKH MOUHAMADOU FADILOU MBACKE" },
                { name: "LYCEE GALANDOU DIOUF" },
                { name: "LYCÉE JOHN FITZGERARLD KENNEDY" },
                { name: "LYCEE JOHN FITZGERALD KENNEDY" },
                { name: "LYCEE LAMINE GUEYE" },
                { name: "LYCEE MIXTE MAURICE DELAFOSSE" },
                { name: "LYCEE OUSMANE SEMBENE" },
                { name: "LYCEE PARCELLES ASSAINIES UINTE 13" },
                { name: "LYCEE SERGENT MALAMINE CAMARA" },
                { name: "LYCEE TALIBOU DABO" },
                { name: "LYCEE THIERNO SAIDOU NOUROU TALL" },
                { name: "LYCEE THIERNO SAÏDOU NOUROU TALL" },
                { name: "Autre établissement..." }
            ],
            cem: [
                { name: "ABBE ARSEN FRIDOIL" },
                { name: "ABBE PIERRE SOCK( ADAMA NDIAYE)" },
                { name: "ABDOULAYE MATHURIN DIOP" },
                { name: "BLAISE DIAGNE" },
                { name: "CEM ADAMA DIALLO" },
                { name: "CEM ADAMA NDIAYE" },
                { name: "CEM ALIOUNE DIOP" },
                { name: "CEM AMADOU TRAWARE" },
                { name: "CEM Amadou TRAWARE" },
                { name: "CEM BADARA MBAYE KABA" },
                { name: "CEM CAMBERENE" },
                { name: "CEM CHEIKH AWA BALLA MBACKE" },
                { name: "CEM DAVID DIOP" },
                { name: "CEM DOCTEUR SAMBA GUEYE" },
                { name: "CEM DR SAMBA GUEYE" },
                { name: "CEM EL HADJI IBRAHIMA THIAW" },
                { name: "CEM EL HADJI MAMADOU NDIAYE" },
                { name: "CEM ELH MANSOUR SY MALICK" },
                { name: "CEM GRAND YOFF" },
                { name: "CEM HANN MARISTES" },
                { name: "CEM HLM GRAND YOFF" },
                { name: "CEM HLM4C" },
                { name: "CEM IBRAHIMA THIAW" },
                { name: "CEM LIBERTE 6/C" },
                { name: "CEM MAME THIERNO BIRAHIM MBACKE" },
                { name: "CEM MANGUIERS" },
                { name: "CEM NGOR" },
                { name: "CEM OUAKAM 2" },
                { name: "CEM OUSMANE SOCE DIOP DE DIEUPPEUL" },
                { name: "CEM PA 18" },
                { name: "CEM PA U 20" },
                { name: "CEM PA UNITE 20" },
                { name: "CEM SCAT URBAM" },
                { name: "CEM SEYDINA ISSA LAYE" },
                { name: "CEM UNITE 19" },
                { name: "CEM YOFF" },
                { name: "CEMAD" },
                { name: "EL HADJI MALICK SY" },
                { name: "EL HADJI OUSMANE DIOP COUMBA PATHÉ" },
                { name: "JOHN FITZGERALD KENNEDY" },
                { name: "MANGUIERS" },
                { name: "MARTIN LUTHER KING" },
                { name: "SERIGNE AHMET SY MALICK" },
                { name: "Autre établissement..." }
            ],
            groupe_prive: [
                { name: "AL ALIM" },
                { name: "CARDINAL HYACINTHE THIANDOUM" },
                { name: "CATHEDRALE" },
                { name: "COLLEGE 3e MILLENAIRE" },
                { name: "COLLEGE EBOA" },
                { name: "COLLEGE NOTRE DAME DU LIBAN" },
                { name: "COLLEGE SAINT PIERRE" },
                { name: "COMPLEXE DAKAR EDU" },
                { name: "COSMOFALIM" },
                { name: "COURS PRIVES ATHENA SEDAR" },
                { name: "COURS PRIVES LES ERUDITS" },
                { name: "COURS PRIVES MAME ABDOU DABAKH" },
                { name: "COURS SACRE-CŒUR" },
                { name: "COURS SAINTE MARIE DE HANN" },
                { name: "CP ABOUL ABASS" },
                { name: "CP EL HADJI IBRAHIMA NIASS" },
                { name: "CP JOHN WESLEY" },
                { name: "CP KHALIFA KEBA SYLLA" },
                { name: "CP LES INNOVATEURS" },
                { name: "CP LES PEDAGOGUES" },
                { name: "CP MERE JEAN LOUIS DIENG" },
                { name: "CP MIKADO" },
                { name: "CP RASSOUL SCHOOL" },
                { name: "CP REINE FABIOLA" },
                { name: "CP. SAINT-MAURICE" },
                { name: "Cours Privés d'Excellence Ibnata Imran" },
                { name: "ECOLE PRIVEE MAARIF SACRE CŒUR" },
                { name: "ENSUP AFRIQUE/BERKELEY" },
                { name: "EP CHEIKH OMAR TALL NAFOORE" },
                { name: "EP KHADIMOU RASSOUL" },
                { name: "EP REINE FABIOLA" },
                { name: "ESIEX" },
                { name: "GROUPE SCOLAIRE VICTORIA EXCELLENCE" },
                { name: "GS D'EXCELLENCE SENEQUE" },
                { name: "GS LE REFUGE DES PETITS" },
                { name: "GS MAME NAFISSA" },
                { name: "GS SALDIA" },
                { name: "GSPNFSYLLA" },
                { name: "Groupe Scolaire Les Petits PAS" },
                { name: "HALWAR GROUPE SCOLAIRE" },
                { name: "INSTITUT MODERNE DES MARISTES" },
                { name: "INSTITUTION IMMACULEE CONCEPTION DE DAKAR" },
                { name: "INSTITUTION MONTESSORI ATLANTIQUE" },
                { name: "INSTITUTION NOTRE DAME" },
                { name: "INTEGRAL INTERNATIONAL SCHOOL" },
                { name: "Institution Privée Marc Perrot" },
                { name: "KEUR ARAME" },
                { name: "LE PROTESTANT" },
                { name: "LEMBA" },
                { name: "MAISON D'EDUCATION ATHENA" },
                { name: "MAISON DE LA SAGESSE" },
                { name: "MARTIN LUTHER KING (Privé)" },
                { name: "MIKADO" },
                { name: "Autre établissement..." }
            ]
        };

        const trigger = document.querySelector('#establishment-trigger');
        const dropdown = document.querySelector('#establishment-dropdown');
        const searchInput = document.querySelector('#establishment-search');
        const optionsContainer = document.querySelector('#establishment-options');
        const hiddenInput = document.querySelector('#establishment-hidden-input');
        const selectedText = document.querySelector('#selected-establishment-text');
        const noResults = document.querySelector('#establishment-no-results');
        const otherWrapper = document.querySelector('#other-establishment-wrapper');

        function populateOptions(category, filter = '') {
            const list = establishmentsData[category] || [];
            optionsContainer.innerHTML = '';
            
            const filtered = list.filter(item => 
                item.name.toLowerCase().includes(filter.toLowerCase())
            );

            if (filtered.length === 0) {
                noResults.style.display = 'block';
                return;
            }
            noResults.style.display = 'none';

            filtered.forEach(item => {
                const option = document.createElement('div');
                option.className = 'select-option';
                if (hiddenInput.value === item.name) option.classList.add('selected');
                option.innerHTML = `<span>${item.name}</span>`;
                
                option.addEventListener('click', () => {
                    hiddenInput.value = item.name;
                    selectedText.textContent = item.name;
                    selectedText.style.color = 'white';
                    
                    // Toggle other field
                    if (item.name === 'Autre établissement...') {
                        otherWrapper.style.display = 'block';
                        otherWrapper.querySelector('input').focus();
                    } else {
                        otherWrapper.style.display = 'none';
                    }

                    closeDropdown();
                    updateClasses(category);
                });

                optionsContainer.appendChild(option);
            });
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

        document.addEventListener('click', () => {
            closeDropdown();
            closeClassDropdown();
            closeSocialDropdown();
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

        // ── Logic for Social Select ──
        const socialTrigger = document.querySelector('#social-trigger');
        const socialDropdown = document.querySelector('#social-dropdown');
        const socialOptionsContainer = document.querySelector('#social-options');
        const socialHiddenInput = document.querySelector('#social-hidden-input');
        const selectedSocialText = document.querySelector('#selected-social-text');

        const socialsData = [
            { name: "WhatsApp", icon: "bi-whatsapp" },
            { name: "Telegram", icon: "bi-telegram" },
            { name: "Facebook", icon: "bi-facebook" },
            { name: "Instagram", icon: "bi-instagram" },
            { name: "Snapchat", icon: "bi-snapchat" },
            { name: "LinkedIn", icon: "bi-linkedin" },
            { name: "TikTok", icon: "bi-tiktok" },
            { name: "X (Twitter)", icon: "bi-twitter-x" }
        ];

        function populateSocialOptions() {
            socialOptionsContainer.innerHTML = '';
            socialsData.forEach(item => {
                const option = document.createElement('div');
                option.className = 'select-option';
                if (socialHiddenInput.value === item.name) option.classList.add('selected');
                option.innerHTML = `<i class="bi ${item.icon}"></i><span>${item.name}</span>`;
                
                option.addEventListener('click', () => {
                    socialHiddenInput.value = item.name;
                    selectedSocialText.textContent = item.name;
                    selectedSocialText.style.color = 'white';
                    socialDropdown.style.display = 'none';
                    socialTrigger.classList.remove('active');
                });
                socialOptionsContainer.appendChild(option);
            });
        }

        socialTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = socialDropdown.style.display === 'flex';
            closeDropdown();
            closeClassDropdown();
            if (isOpen) {
                socialDropdown.style.display = 'none';
                socialTrigger.classList.remove('active');
            } else {
                socialDropdown.style.display = 'flex';
                socialTrigger.classList.add('active');
            }
        });

        populateSocialOptions(); // Initial population

        function updateClasses(category) {
            classHiddenInput.value = '';
            selectedClassText.textContent = 'Choisir votre classe...';
            selectedClassText.style.color = 'var(--mm-text-muted)';
            populateClassOptions(category);
        }

        function filterSelects(category) {
            hiddenInput.value = '';
            selectedText.textContent = 'Choisir un établissement...';
            selectedText.style.color = 'var(--mm-text-muted)';
            otherWrapper.style.display = 'none';
            populateOptions(category);
            updateClasses(category);
        }

        // Initial state for 'cem'
        sectionSchool.style.display = 'block';
        sectionSocial.style.display = 'block';
        labelEstablishment.innerText = 'CEM';
        filterSelects('cem');

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
                    else labelEstablishment.innerText = 'Groupe Scolaire';
                    
                    filterSelects(cat);
                }
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
                selectedSocialText.textContent = 'Choisir un réseau...';
                selectedSocialText.style.color = 'var(--mm-text-muted)';
            }
        });

        // Note: L'affichage du champ "Autre" est maintenant géré dans populateOptions()


        const form = document.querySelector('#form-register');
        const loader = document.querySelector('#loader-overlay');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const currentType = selectedTypeInput.value;
            
            // Validation manuelle de la classe si on n'est pas en mode communauté
            if (currentType !== 'communaute' && !classHiddenInput.value) {
                loader.style.display = 'none';
                const errorContainer = document.querySelector('#error-container');
                const errorList = document.querySelector('#error-list');
                errorList.innerHTML = '<li><i class="bi bi-exclamation-circle me-2"></i>Veuillez sélectionner votre classe.</li>';
                errorContainer.style.display = 'block';
                errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            // Validation manuelle de l'établissement si on n'est pas en mode communauté
            if (currentType !== 'communaute' && !hiddenInput.value) {
                loader.style.display = 'none';
                const errorContainer = document.querySelector('#error-container');
                const errorList = document.querySelector('#error-list');
                errorList.innerHTML = '<li><i class="bi bi-exclamation-circle me-2"></i>Veuillez sélectionner un établissement dans la liste.</li>';
                errorContainer.style.display = 'block';
                errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            // Collecte des données
            // Capture du numéro au format international
            try {
                phoneFull.value = iti.getNumber();
            } catch (e) {
                console.warn("Erreur formatage téléphone:", e);
                phoneFull.value = phoneInput.value;
            }
            const formData = new FormData(this);
            
            // Affichage du loader premium
            loader.style.display = 'flex';
            loader.style.opacity = '1';

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
                    // Affichage du succès
                    document.querySelector('#loader-working').style.display = 'none';
                    document.querySelector('#loader-success').style.display = 'block';
                    
                    // Redirection vers le ticket
                    setTimeout(() => {
                        window.location.href = result.redirect || '/';
                    }, 800);
                } else {
                    loader.style.display = 'none';
                    
                    // Affichage des erreurs proprement
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
                loader.style.display = 'none';
                alert("Erreur de communication avec le serveur. Veuillez vérifier votre connexion.");
            }
        });
    });
</script>
<?= $this->endSection() ?>
