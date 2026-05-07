<?php

if (!function_exists('format_phone_number')) {
    /**
     * Formate un numéro de téléphone au format +221 77 000 00 00
     */
    function format_phone_number($phone) {
        if (empty($phone)) return 'N/A';
        
        // Nettoyer le numéro (enlever les espaces existants)
        $clean = str_replace(' ', '', $phone);
        
        // Si c'est un numéro sénégalais (+221XXXXXXXXX)
        if (strpos($clean, '+221') === 0 && strlen($clean) === 13) {
            $prefix = substr($clean, 0, 4);   // +221
            $operator = substr($clean, 4, 2); // 77
            $part1 = substr($clean, 6, 3);    // 000
            $part2 = substr($clean, 9, 2);    // 00
            $part3 = substr($clean, 11, 2);   // 00
            
            return "{$prefix} {$operator} {$part1} {$part2} {$part3}";
        }
        
        // Si c'est un numéro sénégalais sans le + (221XXXXXXXXX)
        if (strpos($clean, '221') === 0 && strlen($clean) === 12) {
            $prefix = '+' . substr($clean, 0, 3);
            $operator = substr($clean, 3, 2);
            $part1 = substr($clean, 5, 3);
            $part2 = substr($clean, 8, 2);
            $part3 = substr($clean, 10, 2);
            
            return "{$prefix} {$operator} {$part1} {$part2} {$part3}";
        }

        // Pour les autres formats ou numéros internationaux, on essaie de grouper par 2
        return $phone; 
    }
}
