<?php

class ModelToolOnline extends Model
{
    public function getTotalUniqueVisitor() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "unique_visitor");

        return $query->row['total'];
    }
}
