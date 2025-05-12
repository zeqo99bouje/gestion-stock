<?php

namespace App\Exports;

use App\Models\Societe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SocietesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Societe::all();
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Adresse',
            'Téléphone',
            'Email',
        ];
    }

    public function map($societe): array
    {
        return [
            $societe->nom,
            $societe->adresse,
            $societe->telephone,
            $societe->email,
        ];
    }
}