<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';

    protected $primaryKey = 'user_id';

  protected $allowedFields = [
    'last_name',
    'first_name',
    'address',
    'country',
    'email',
    'phone_number',
    'password',
  ];

  public function getUserById($id)
  {
    return $this->find($id);
  }

  public function getAllUsers()
  {
    return $this->findAll();
  }

  public function getUserByEmail($email)
  {
    return $this->where('email', $email)->first();
  }

  public function countUsers()
  {
    return $this->countAll();
  }

  public function insertUser($data)
  {
    return $this->insert($data);
  }

  public function updateUser($id, $data)
  {
    return $this->update($id, $data);
  }

  public function saveUser($data)
  {
    return $this->save($data);
  }

  public function updateMultipleUsers($users)
  {
    return $this->updateBatch($users, 'user_id');
  }

  public function deleteUser($id)
  {
    return $this->delete($id);
  }

  public function searchUsersByName($name)
  {
    return $this->like('first_name', $name)
      ->orLike('last_name', $name)
      ->findAll();
  }

  public function validLogin($email, $password)
  {
    $builder = $this->db->table($this->table);
    $user = $builder->where('email', $email)
      ->where('password', $password)
      ->get()
      ->getRowArray();

    if ($user)
      session()->set('user_id', $user['user_id']);

    return $user ? $user : null;
  }

  public function getChatGroups($user_id)
  {
    $groupIds = array_unique(array_map(fn($e) => $e['group_id'], (new GroupMemberModel())->where('user_id', $user_id)
      ->findAll()));
    $groups = (new GroupModel())->findAll();

    return array_filter($groups, fn($group) => in_array($group['id'], $groupIds));
  }
}
