<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    public function run()
    {
        $model = new \App\Models\EstablishmentModel();
        $data = [
            // --- IEF : ALMADIES ---
            ['name' => "LYCEE AMATH DANSOKHO", 'quota' => 4, 'type' => 'lycee', 'ief' => 'ALMADIES'],
            ['name' => "LYCEE OUSMANE SEMBENE", 'quota' => 4, 'type' => 'lycee', 'ief' => 'ALMADIES'],
            ['name' => "LYCEE GALANDOU DIOUF", 'quota' => 100, 'type' => 'lycee', 'ief' => 'ALMADIES'],
            ['name' => "CEM ADAMA DIALLO", 'quota' => 4, 'type' => 'cem', 'ief' => 'ALMADIES'],
            ['name' => "CEM EL HADJI MAMADOU NDIAYE", 'quota' => 4, 'type' => 'cem', 'ief' => 'ALMADIES'],
            ['name' => "CEM YOFF", 'quota' => 4, 'type' => 'cem', 'ief' => 'ALMADIES'],
            ['name' => "CEM OUAKAM 2", 'quota' => 4, 'type' => 'cem', 'ief' => 'ALMADIES'],
            ['name' => "CEM NGOR", 'quota' => 4, 'type' => 'cem', 'ief' => 'ALMADIES'],

            // --- IEF : DAKAR PLATEAU ---
            ['name' => "LYCEE D'EXCELLENCE MARIAMA BA", 'quota' => 4, 'type' => 'lycee', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "LYCEE FRANCO ARABE CHEIKH MOUHAMADOU FADILOU MBACKE", 'quota' => 4, 'type' => 'lycee', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "LYCEE LAMINE GUEYE", 'quota' => 4, 'type' => 'lycee', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "LYCEE MIXTE MAURICE DELAFOSSE", 'quota' => 4, 'type' => 'lycee', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "LYCEE BLAISE DIAGNE", 'quota' => 4, 'type' => 'lycee', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "LYCÉE JOHN FITZGERALD KENNEDY", 'quota' => 4, 'type' => 'lycee', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "LYCEE THIERNO SAIDOU NOUROU TALL", 'quota' => 4, 'type' => 'lycee', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "INSTITUT ISLAMIQUE DE DAKAR", 'quota' => 4, 'type' => 'lycee', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM EL HADJI OUSMANE DIOP COUMBA PATHÉ", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM ABBE PIERRE SOCK (ADAMA NDIAYE)", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM ABDOULAYE MATHURIN DIOP", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM BLAISE DIAGNE", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM CHEIKH AWA BALLA MBACKE", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "BST POINT E", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM EL HADJI MALICK SY", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM MANGUIERS", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM MAME THIERNO BIRAHIM MBACKE", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM SERIGINE AHMET SY MALICK", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM MARTIN LUTHER KING", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM JOHN FITZGERALD KENNEDY", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM ABBE ARSEN FRIDOIL", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],
            ['name' => "CEM ELH MANSOUR SY MALICK", 'quota' => 4, 'type' => 'cem', 'ief' => 'DAKAR PLATEAU'],

            // --- IEF : GRAND DAKAR ---
            ['name' => "LYCEE DE HANN BEL AIR", 'quota' => 4, 'type' => 'lycee', 'ief' => 'GRAND DAKAR'],
            ['name' => "CEM ALIOUNE DIOP", 'quota' => 4, 'type' => 'cem', 'ief' => 'GRAND DAKAR'],
            ['name' => "CEM AMADOU TRAWARE", 'quota' => 4, 'type' => 'cem', 'ief' => 'GRAND DAKAR'],
            ['name' => "CEM BADARA MBAYE KABA", 'quota' => 4, 'type' => 'cem', 'ief' => 'GRAND DAKAR'],
            ['name' => "CEM HLM4C", 'quota' => 4, 'type' => 'cem', 'ief' => 'GRAND DAKAR'],
            ['name' => "CEM DAVID DIOP", 'quota' => 4, 'type' => 'cem', 'ief' => 'GRAND DAKAR'],
            ['name' => "CEM DOCTEUR SAMBA GUEYE", 'quota' => 4, 'type' => 'cem', 'ief' => 'GRAND DAKAR'],
            ['name' => "CEM OUSMANE SOCE DIOP DE DIEUPPEUL", 'quota' => 4, 'type' => 'cem', 'ief' => 'GRAND DAKAR'],
            ['name' => "CEM HANN MARISTES", 'quota' => 4, 'type' => 'cem', 'ief' => 'GRAND DAKAR'],
            ['name' => "CEM LIBERTE 6/C", 'quota' => 4, 'type' => 'cem', 'ief' => 'GRAND DAKAR'],
            ['name' => "BST LIBERTE 3", 'quota' => 4, 'type' => 'cem', 'ief' => 'GRAND DAKAR'],
            ['name' => "CEM ADAMA NDIAYE", 'quota' => 4, 'type' => 'cem', 'ief' => 'GRAND DAKAR'],

            // --- IEF : PARCELLES ASSAINIES ---
            ['name' => "LYCEE TALIBOU DABO", 'quota' => 4, 'type' => 'lycee', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "LYCEE AMINATA SOW FALL", 'quota' => 4, 'type' => 'lycee', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "LYCEE SERGENT MALAMINE CAMARA", 'quota' => 4, 'type' => 'lycee', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "LYCEE PARCELLES ASSAINIES UNITE 13", 'quota' => 4, 'type' => 'lycee', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "CEM CAMBERENE", 'quota' => 4, 'type' => 'cem', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "CEM SEYDINA ISSA LAYE", 'quota' => 4, 'type' => 'cem', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "CEM GRAND YOFF", 'quota' => 4, 'type' => 'cem', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "CEM HLM GRAND YOFF", 'quota' => 4, 'type' => 'cem', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "CEM SCAT URBAM", 'quota' => 4, 'type' => 'cem', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "CEM EL HADJI IBRAHIMA THIAW", 'quota' => 4, 'type' => 'cem', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "CEM PA 18", 'quota' => 4, 'type' => 'cem', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "CEM PA UNITE 20", 'quota' => 4, 'type' => 'cem', 'ief' => 'PARCELLES ASSAINIES'],
            ['name' => "CEM UNITE 19", 'quota' => 4, 'type' => 'cem', 'ief' => 'PARCELLES ASSAINIES'],

            // --- PRIVÉS ET SPÉCIAUX ---
            ['name' => "IA", 'quota' => 51, 'type' => 'special', 'ief' => null],
            ['name' => "MARRAINE", 'quota' => 15, 'type' => 'special', 'ief' => null],
            ['name' => "PARTENAIRES", 'quota' => 50, 'type' => 'special', 'ief' => null],
            ['name' => "ALMADIES", 'quota' => 3, 'type' => 'special', 'ief' => null],
            ['name' => "DAKAR PLATEAU", 'quota' => 3, 'type' => 'special', 'ief' => null],
            ['name' => "GRAND DAKAR", 'quota' => 3, 'type' => 'special', 'ief' => null],
            ['name' => "PARCELLES ASSAINIES", 'quota' => 3, 'type' => 'special', 'ief' => null],
            ['name' => "AL ALIM", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CARDINAL HYACINTHE THIANDOUM", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CATHEDRALE", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "COLLEGE EBOA", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "COLLEGE MODERNE TROISIEME MILLENAIRE", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "COLLEGE NOTRE DAME DU LIBAN", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "COLLEGE SAINT PIERRE", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "Complexe Académique Dakar EDU", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "COURS PRIVES ATHENA SEDAR", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "Cours Privés d'Excellence Ibnata Imran", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "COURS PRIVES LES ERUDITS", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "COURS PRIVES MAME ABDOU DABAKH", 'quota' => 150, 'type' => 'prive', 'ief' => null],
            ['name' => "COURS SACRE-CŒUR", 'quota' => 100, 'type' => 'prive', 'ief' => null],
            ['name' => "COURS SAINTE MARIE DE HANN", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CP ABOUL ABASS", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CP EL HADJI IBRAHIMA NIASS", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CP JOHN WESLEY", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CP KHALIFA KEBA SYLLA", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CP LES INNOVATEURS", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CP LES PEDAGOGUES", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CP MERE JEAN LOUIS DIENG", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CP MIKADO", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CP RASSOUL SCHOOL", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CP REINE FABIOLA", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "CP. SAINT-MAURICE", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "ECOLE PRIVEE MAARIF SACRE CŒUR", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "ENSUP AFRIQUE/BERKELEY", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "EP CHEIKH OMAR TALL NAFOORE", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "EP KHADIMOU RASSOUL", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "EP REINE FABIOLA", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "ESIEX", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "Groupe Scolaire Les Petits PAS", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "GROUPE SCOLAIRE VICTORIA EXCELLENCE", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "GS D'EXCELLENCE SENEQUE", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "GS LE REFUGE DES PETITS", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "GS MAME NAFISSA", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "GS SALDIA", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "GS NDEYE FATOU SYLLA", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "HALWAR GROUPE SCOLAIRE", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "INSTITUT MODERNE DES MARISTES", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "INSTITUTION IMMACULEE CONCEPTION DE DAKAR", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "INSTITUTION MONTESSORI ATLANTIQUE", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "INSTITUTION NOTRE DAME", 'quota' => 100, 'type' => 'prive', 'ief' => null],
            ['name' => "Institution Privée Marc Perrot", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "INTEGRAL International School", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "KEUR ARAME", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "COLLEGE LE PROTESTANT", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "LEMBA", 'quota' => 100, 'type' => 'prive', 'ief' => null],
            ['name' => "MAISON DE LA SAGESSE", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "MAISON D'EDUCATION ATHENA", 'quota' => 4, 'type' => 'prive', 'ief' => null],
            ['name' => "MARTIN LUTHER KING", 'quota' => 4, 'type' => 'prive', 'ief' => null],
        ];

        foreach ($data as $row) {
            $model->insert($row);
        }
    }
}
