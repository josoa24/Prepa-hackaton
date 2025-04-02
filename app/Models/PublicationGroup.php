<?php

namespace App\Models;

use CodeIgniter\Model;

class PublicationGroup extends Model
{
  protected $table            = 'publication_groups';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $protectFields    = false;
}
