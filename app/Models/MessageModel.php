<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
  protected $table            = 'messages';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = false;

  protected bool $allowEmptyInserts = false;
  protected bool $updateOnlyChanged = true;
}
