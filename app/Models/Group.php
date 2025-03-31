<?php

namespace App\Models;

use CodeIgniter\Model;

class Group extends Model
{
  protected $table            = 'groups';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = false;

  protected bool $allowEmptyInserts = false;
  protected bool $updateOnlyChanged = true;
}
