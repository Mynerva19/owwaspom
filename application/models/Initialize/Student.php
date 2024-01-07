<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Model {
    protected static $tblname = "scholar_info";

    public function dbfields() {
        return $this->db->list_fields(self::$tblname);
    }

    public function listofstudents() {
        $query = $this->db->get(self::$tblname);
        return $query->result();
    }

    public function find_students($id = "", $email = "") {
        $this->db->where("scholar_id", $id);
        $this->db->or_where("email", $email);
        $query = $this->db->get(self::$tblname);
        
        return $query->num_rows();
    }

    public function find_all_students($user = "") {
        $this->db->where("user_id", $user);
        $query = $this->db->get(self::$tblname);
        
        return $query->num_rows();
    }

    public function single_students($id = "") {
        $this->db->where("scholar_id", $id);
        $query = $this->db->get(self::$tblname, 1);
        return $query->row();
    }

    public function single_student_userid($id = "") {
        $this->db->where("user_id", $id);
        $query = $this->db->get(self::$tblname, 1);
        return $query->row();
    }

    public function instantiate($record) {
        $object = new self;

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }

        return $object;
    }

    private function has_attribute($attribute) {
        return property_exists($this, $attribute);
    }

    protected function attributes() {
        return $this->dbfields();
    }

    protected function sanitized_attributes() {
        $clean_attributes = array();

        foreach ($this->attributes() as $key) {
            $clean_attributes[$key] = $this->db->escape($this->$key);
        }

        return $clean_attributes;
    }

    public function find_user_by_email($email) {
        $this->db->where("email", $email);
        $query = $this->db->get(self::$tblname);
        
        return $query->num_rows();
    }

    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create() {
        $attributes = $this->sanitized_attributes();

        $existingEmail = $this->find_students("", $attributes['email']);
        if ($existingEmail > 0) {
            return false;
        }

        $this->db->insert(self::$tblname, $attributes);
        return true;
    }

    public function update($id = "") {
        $attributes = $this->sanitized_attributes();
        $this->db->where("scholar_id", $id);
        $this->db->update(self::$tblname, $attributes);
    }

    public function delete($id = 0) {
        $this->db->where("scholar_id", $id);
        $this->db->delete(self::$tblname, 1);
    }

    public function getLastInsertId() {
        return $this->db->insert_id();
    }
}
