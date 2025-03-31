<?php

namespace App\Models;

use CodeIgniter\Model;

class Publication extends Model
{
    protected $table            = 'Publication';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'title', 'content', 'description', 'date_publication', 'date_evenement', 'created_at', 'type'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPublicationsWithPhotosAndStatus(int $offset, int $limit)
    {
        $query = $this->select('Publication.*, photos.lien AS photo_link, 
                                user.first_name, user.last_name, user.email, user.profile_picture,
                                (CASE 
                                    WHEN progressions.status = 0 THEN "en cours" 
                                    ELSE "terminer" 
                                END) AS progression_status,
                                SUM(dons.montant) AS total_dons,
                                (SUM(dons.montant) / progressions.but) * 100 AS completion_percentage')
                      ->join('photos', 'photos.id_publication = Publication.id', 'left')
                      ->join('progressions', 'progressions.id_publication = Publication.id', 'left')
                      ->join('dons', 'dons.id_publication = Publication.id', 'left')
                      ->join('user', 'user.user_id = Publication.id_user', 'left') // Ajout de la jointure avec la table user
                      ->groupBy('Publication.id, progressions.but, progressions.status, user.user_id')
                      ->orderBy('Publication.created_at', 'DESC');
        
        if ($limit !== 0) {
            $query->limit($limit, $offset);
        }

        return $query->findAll();
    }
}
