<?php

class ModelUserUserRole extends Model
{
    public function getUserRole($member_role_id) {
        
    }
    
    public function getUserRoles() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "member_role");
        
        return $query->rows;
    }
    
    public function getTotalUserRoles() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "member_role");
        
        return $query->row['total'];
    }
}