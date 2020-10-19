<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  public function getUser()
  {
    $query = "SELECT `user`.`name`, `user`.`id`, `user_role`.`role`
              FROM `user` JOIN `user_role`
              ON `user`.`role_id` = `user_role`.`id`
              ";

    //select table name di table user dan role di table user_role
    //dari table user dam user_role
    //yang mana role_id = id

    return $this->db->query($query)->result_array();
  }

  public function tambahUser()
  {
    $data = [
      'name'     => $this->input->post('nama', true),
      'email'     => $this->input->post('email', true),
      'image'     => 'default.jpg',
      'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      'role_id'     => $this->input->post('level_id'),
      'is_active'     => 1,
      'date_created'     => time()
    ];

    $this->db->insert('user', $data);
  }
}
