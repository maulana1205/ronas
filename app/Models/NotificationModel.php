<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notification';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'message', 'status', 'created_at'];

    public function getNotificationsByUser($id_user)
    {
        return $this->where('id_user', $id_user)->orderBy('created_at', 'desc')->findAll();
    }
}
