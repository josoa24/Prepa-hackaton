<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupMemberModel extends Model
{
  protected $table            = 'group_members';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = false;

  protected bool $allowEmptyInserts = false;
  protected bool $updateOnlyChanged = true;

  public function group()
  {
    return $this->db->table('groups')
      ->where('group_id', $this->group_id)
      ->get()
      ->getRowArray();
  }
}
