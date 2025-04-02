<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GroupMemberModel;
use App\Models\GroupModel;
use App\Models\MessageModel;
use App\Models\Photo;
use App\Models\PublicationGroup;
use App\Models\UserModel;

class ChatGroupController extends BaseController
{
  public function index()
  {
    $user_id = session()->get('user_id');

    if (!$user_id) {
      return redirect()->to('/login');
    }

    $user = (new UserModel())->find($user_id);

    $groups = [];
    foreach ((new UserModel())->getChatGroups($user_id) as $group) {
      $groups[$group['id']] = $group;
    }

    $a = (new PublicationGroup());
    if (count($groups) > 0)
      $a = $a->whereIn('group_id', array_keys($groups));
    $publicationGroupes = $a->findAll();
    $publications = [];

    foreach ((new \App\Models\Publication())->findAll() as $publication) {
      $publications[$publication['id']] = $publication;
    }

    foreach ($publicationGroupes as $publicationGroupe)
      $groups[$publicationGroupe['group_id']]['publication'] = $publications[$publicationGroupe['publication_id']];

    return view('chatgroup/chats.php', compact('groups', 'user'));
  }

  public function list($id)
  {
    $id = intval($id);
    $user_id = session()->get('user_id');
    $user = (new UserModel())->find($user_id);

    $group = (new GroupModel())->find($id);

    if (!$group)
      return redirect()->to('/chats');

    $users = [];

    foreach ((new UserModel())->findAll() as $user_)
      $users[$user_['user_id']] = $user_;

    $groupMemberModel = array_map(fn($e) => $e['user_id'], (new GroupMemberModel())->where('group_id', $id)->findAll());

    $finalUsers = [];
    foreach ($groupMemberModel as $userid)
      if (isset($users[$userid]))
        $finalUsers[$userid] = $users[$userid];

    $users = $finalUsers;

    $messages = (new MessageModel())->where('group_id', $id)->findAll();

    $db = \Config\Database::connect();
    $query = $db->query('SELECT canvas_json FROM canvas_states WHERE group_id = ? ORDER BY timestamp DESC LIMIT 1', [$id]);
    $result = $query->getRowArray();
    $db->close();

    $canvas_json = $result['canvas_json'] ?? '{}';
    $canvas_json = json_decode($canvas_json, true);

    $publication = (new PublicationGroup())
      ->where('group_id', $id)
      ->first();

    if ($publication) {
      $publication = (new \App\Models\Publication())
        ->find($publication['publication_id']);
    }

    $photos = (new Photo())->where('id_publication', $publication['id'])->findAll();
    $photos = array_map(fn($e) => $e['lien'], $photos);

    return view('chatgroup/chat.php', compact('group', 'users', 'user', 'messages', 'canvas_json', 'publication', 'photos'));
  }
}
