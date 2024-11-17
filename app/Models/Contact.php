<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * Représente un message envoyé via le formulaire de contact.
 *
 * @package App\Models
 * 
 * @property int $id ID unique du message
 * @property string $name Nom de l'expéditeur
 * @property string $email Adresse email de l'expéditeur
 * @property string $message Contenu du message
 * @property string|null $screenshot_path Chemin vers la capture d'écran 
 * @property \Illuminate\Support\Carbon $created_at Date de création
 * @property \Illuminate\Support\Carbon $updated_at Date de mise à jour
 */
class Contact extends Model
{
    use HasFactory;

    /**
     * Champs modifiables en masse.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'message', 'screenshot_path'];
}
