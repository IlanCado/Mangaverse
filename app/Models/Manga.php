<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Manga
 * Représente un manga dans la base de données.
 *
 * @package App\Models
 * 
 * @property int $id ID unique du manga
 * @property string $title Titre du manga
 * @property string $author Auteur du manga
 * @property string $description Description du manga
 * @property string $genre Genre du manga
 * @property float|null $rating Note moyenne du manga
 * @property \Illuminate\Support\Carbon $created_at Date de création
 * @property \Illuminate\Support\Carbon $updated_at Date de mise à jour
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereTitle(string $title) Rechercher par titre
 * @method static \Illuminate\Database\Eloquent\Builder|Manga whereAuthor(string $author) Rechercher par auteur
 */
class Manga extends Model
{
    use HasFactory;

    /**
     * Champs modifiables en masse.
     *
     * @var string[]
     */
    protected $fillable = ['title', 'author', 'description', 'genre', 'rating'];

    /**
     * Relation : Un manga peut avoir plusieurs commentaires.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relation : Un manga peut avoir plusieurs évaluations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
