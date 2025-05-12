<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ Import correct ici

class Produit extends Model
{
    use HasFactory; // ✅ Maintenant ça fonctionnera

    protected $fillable = [
        'numero_inventaire', 'designation', 'quantite_stock', 'unite',
        'societe_id', 'bon_commande', 'date_reception', 'affectation_id', 'remarque'
    ];

    protected $casts = [
        'date_reception' => 'datetime', // Cast to DateTime
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function affectation()
    {
        return $this->belongsTo(Affectation::class);
    }

    public function mouvements()
    {
        return $this->hasMany(Mouvement::class);
    }

   
}
