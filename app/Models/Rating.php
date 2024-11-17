<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rating
 * Représente une évaluation/notation d'un manga.
 *
 * @package App\Models
 * 
 * @property int $id ID unique de la note
 * @property int $user_id ID de l'utilisateur ayant donné la note
 * @property int $manga_id ID du manga noté
 * @property float $rating_value Valeur de la note (1.0 à 5.0)
 * @property \Illuminate\Support\Carbon $created_at Date de création
 * @property \Illuminate\Support\Carbon $updated_at Date de mise à jour
 */
class Rating extends Model
{
    use HasFactory;

    /**
     * Champs modifiables en masse.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'manga_id', 'rating_value'];

    /**
     * Relation : Une évaluation appartient à un manga.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }

    /**
     * Relation : Une évaluation appartient à un utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
