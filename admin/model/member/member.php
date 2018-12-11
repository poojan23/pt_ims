<?php

class ModelMemberMember extends Model
{
    public function getMembers() {
        $query = $this->db->query("SELECT m.*, mgd.name FROM " . DB_PREFIX . "member m LEFT JOIN " . DB_PREFIX . "member_group_description mgd ON m.member_group_id = mgd.member_group_id");
        return $query->rows;

    }
}

