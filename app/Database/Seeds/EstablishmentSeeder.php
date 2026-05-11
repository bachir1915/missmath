<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    public function run()
    {
        $model = new \App\Models\EstablishmentModel();
        
        // On vide la table proprement avant de repeupler
        $this->db->table('establishments')->truncate();

        $data = [
            // --- LYCÉES PUBLICS ---
            ['name' => "LEMBA", 'ief' => 'ALMADIES', 'quota' => 50, 'type' => 'lycee'],
            ['name' => "INSTITUT ISLAMIQUE", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'lycee'],
            ['name' => "LFA FADILOU MBACKE", 'ief' => 'DAKAR PLATEAU', 'quota' => 4, 'type' => 'lycee'],
            ['name' => "LYCEE DES PARCELLES ASSAINIES U 13", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'lycee'],
            ['name' => "LYCEE AMATH DANSOKHO", 'ief' => 'ALMADIES', 'quota' => 4, 'type' => 'lycee'],
            ['name' => "LYCEE AMINATA SOW FALL", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 4, 'type' => 'lycee'],
            ['name' => "LYCEE BLAISE DIAGNE", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'lycee'],
            ['name' => "LYCEE DE HANN BEL AIR", 'ief' => 'GRAND DAKAR', 'quota' => 4, 'type' => 'lycee'],
            ['name' => "LYCEE GALANDOU DIOUF", 'ief' => 'ALMADIES', 'quota' => 50, 'type' => 'lycee'],
            ['name' => "LYCEE JOHN FITZGERALD KENNEDY", 'ief' => 'DAKAR PLATEAU', 'quota' => 4, 'type' => 'lycee'],
            ['name' => "LYCEE LAMINE GUEYE", 'ief' => 'DAKAR PLATEAU', 'quota' => 4, 'type' => 'lycee'],
            ['name' => "LYCEE MIXTE MAURICE DELAFOSSE", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'lycee'],
            ['name' => "LYCEE OUSMANE SEMBENE", 'ief' => 'ALMADIES', 'quota' => 2, 'type' => 'lycee'],
            ['name' => "LYCEE SCIENTIFIQUE DE GRAND DAKAR", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'lycee'],
            ['name' => "LYCEE SERGENT MALAMINE CAMARA", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 10, 'type' => 'lycee'],
            ['name' => "LYCEE TALIBOU DABO", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'lycee'],
            ['name' => "LYCEE THIERNO SAÏDOU NOUROU TALL", 'ief' => 'DAKAR PLATEAU', 'quota' => 4, 'type' => 'lycee'],

            // --- CEM ---
            ['name' => "CEM Abbé Arsène FRIDOIL", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM ABBE PIERRE SOCK", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM ADAMA DIALLO", 'ief' => 'ALMADIES', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM ADAMA NDIAYE", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM ALIOUNE DIOP", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM Amadou TRAWARE", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM CAMBERENE", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM DAVID DIOP", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM DR SAMBA GUEYE", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM EL HADJI IBRAHIMA THIAW", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM GRAND YOFF", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM HANN MARISTES", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM HLM GRAND YOFF", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM HLM4C", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM IBRAHIMA THIAW", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM JOHN FITZGERALD KENNEDY", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM MANGUIERS", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM MARTIN LUTHER KING", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM PA U 20", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'cem'],
            ['name' => "CEM SCAT URBAM", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'cem'],

            // --- ÉCOLES PRIVÉES ---
            ['name' => "CEMAD", 'ief' => 'ALMADIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "COURS SAINTE MARIE DE HANN", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CP ABOUL ABASS", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CP EL HADJI IBRAHIMA NIASS", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CP JOHN WESLEY", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CP KHALIFA KEBA SYLLA", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CP LES ANNEES LUMIERE", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CP LES INNOVATEURS", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CP LES PEDAGOGUES", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CP lycée d'excellence Privé Birago DIOP", 'ief' => 'DAKAR PLATEAU', 'quota' => 30, 'type' => 'prive'],
            ['name' => "CP MERE JEAN LOUIS DIENG", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CP MIKADO", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 20, 'type' => 'prive'],
            ['name' => "CP RASSOUL SCHOOL", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CP REINE FABIOLA", 'ief' => 'ALMADIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CP. SAINT-MAURICE", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'prive'],
            ['name' => "ECOLE PRIVEE MAARIF SACRE CŒUR", 'ief' => 'ALMADIES', 'quota' => 20, 'type' => 'prive'],
            ['name' => "ECOLE PRIVEE MADIBA MANDELA", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'prive'],
            ['name' => "Enko Waca", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'prive'],
            ['name' => "ENSUP AFRIQUE/BERKELEY", 'ief' => 'ALMADIES', 'quota' => 20, 'type' => 'prive'],
            ['name' => "EP CHEIKH OMAR TALL NAFOORE", 'ief' => 'ALMADIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "EP KELUMAK", 'ief' => 'ALMADIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "EP KHADIMOU RASSOUL", 'ief' => 'ALMADIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "EP REINE FABIOLA", 'ief' => 'ALMADIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "ESIEX", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'prive'],
            ['name' => "Groupe Scolaire Les Petits PAS", 'ief' => 'ALMADIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "GROUPE SCOLAIRE VICTORIA EXCELLENCE", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'prive'],
            ['name' => "GS D'EXCELLENCE SENEQUE", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "GS LE REFUGE DES PETITS", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "GS MAME NAFISSA", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "GS NDEYE FATOU SYLLA", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "GS SALDIA", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'prive'],
            ['name' => "HALWAR GROUPE SCOLAIRE", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'prive'],
            ['name' => "INSTITUT MODERNE DES MARISTES", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'prive'],
            ['name' => "INSTITUTION IMMACULEE CONCEPTION DE DAKAR", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'prive'],
            ['name' => "INSTITUTION MONTESSORI ATLANTIQUE", 'ief' => 'ALMADIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "Institution Privée Marc Perrot", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'prive'],
            ['name' => "INSTITUTION SAINTE JEANNE D'ARC", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'prive'],
            ['name' => "INTEGRAL International School", 'ief' => 'ALMADIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "KEUR ARAME", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'prive'],
            ['name' => "LES INNOVATEURS", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "LES PEDAGOGUES", 'ief' => 'PARCELLES ASSAINIES', 'quota' => 2, 'type' => 'prive'],
            ['name' => "MAISON D'EDUCATION ATHENA", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'prive'],
            ['name' => "MAISON DE LA SAGESSE", 'ief' => 'DAKAR PLATEAU', 'quota' => 2, 'type' => 'prive'],
            ['name' => "SALDIA", 'ief' => 'GRAND DAKAR', 'quota' => 2, 'type' => 'prive'],
            ['name' => "CATHEDRALE", 'ief' => 'DAKAR PLATEAU', 'quota' => 100, 'type' => 'prive'],
            ['name' => "INSTITUTION NOTRE DAME", 'ief' => 'DAKAR PLATEAU', 'quota' => 100, 'type' => 'prive'],
            ['name' => "COURS PRIVES MAME ABDOU DABAKH", 'ief' => 'ALMADIES', 'quota' => 200, 'type' => 'prive'],

            // --- SPÉCIAUX (conservés pour la plateforme) ---
            ['name' => "IA", 'quota' => 51, 'type' => 'special', 'ief' => null],
            ['name' => "MARRAINE", 'quota' => 15, 'type' => 'special', 'ief' => null],
            ['name' => "PARTENAIRES", 'quota' => 50, 'type' => 'special', 'ief' => null],
            ['name' => "ALMADIES", 'quota' => 3, 'type' => 'special', 'ief' => null],
            ['name' => "DAKAR PLATEAU", 'quota' => 3, 'type' => 'special', 'ief' => null],
            ['name' => "GRAND DAKAR", 'quota' => 3, 'type' => 'special', 'ief' => null],
            ['name' => "PARCELLES ASSAINIES", 'quota' => 3, 'type' => 'special', 'ief' => null],
        ];

        foreach ($data as $row) {
            $model->insert($row);
        }
    }
}
