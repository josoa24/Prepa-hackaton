<?php

namespace App\Models;

use CodeIgniter\Model;

class Don extends Model
{
  protected $table            = 'dons';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $protectFields    = false;
}
