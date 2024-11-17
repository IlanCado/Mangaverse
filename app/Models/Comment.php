<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * Représente un commentaire associé à un manga.
 *
 * @package App\Models
 * 
 * @property int $id ID unique du commentaire
 * @property int $user_id ID de l'utilisateur auteur du commentaire
 * @property int $manga_id ID du manga associé
 * @property string $content Contenu du commentaire
 * @property int $likes Nombre de "likes" sur le commentaire
 * @property \Illuminate\Support\Carbon $created_at Date de création
 * @property \Illuminate\Support\Carbon $updated_at Date de mise à jour
 */
class Comment extends Model
{
    use HasFactory;

    /**
     * Champs modifiables en masse.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'manga_id', 'content', 'likes'];

    /**
     * Relation : Un commentaire appartient à un manga.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }

    /**
     * Relation : Un commentaire appartient à un utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
