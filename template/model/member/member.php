<?php

class ModelMemberMember extends Model
{
    public function addMember($data) {

    }

    public function editMember($member_id, $data) {

    }

    public function deleteMember($member_id) {

    }

    public function getMember($member_id) {
        $query = $this->db->query("SELECT *, (SELECT mgd.name FROM `" . DB_PREFIX ."member_group_description` mgd WHERE mgd.member_group_id = m.member_group_id) AS member_group FROM `" . DB_PREFIX . "member` m WHERE member_id = '" . (int)$member_id . "'");

        return $query->row;
    }
}