<?php defined('BASEPATH') or exit('No direct script access allowed');

class Host_model extends EA_Model {

    public function get_host($name)
    {
        if ( ! is_string($name))
        {
            // Check argument type.
            throw new Exception('$name argument is not a string: ' . $name);
        }

        if ($this->db->get_where('host', ['name' => $name])->num_rows() == 0)
        {
            // Check if host exists in db.
            throw new Exception('$name host does not exist in database: ' . $name);
        }

        $query = $this->db->get_where('host', ['name' => $name]);
        $host = $query->num_rows() > 0 ? $query->row() : '';
        return $host->value;
    }

    public function set_host($name, $value)
    {
        if ( ! is_string($name))
        {
            throw new Exception('$name argument is not a string: ' . $name);
        }

        $query = $this->db->get_where('host', ['name' => $name]);

        if ($query->num_rows() > 0)
        {
            // Update host
            if ( ! $this->db->update('host', ['value' => $value], ['name' => $name]))
            {
                throw new Exception('Could not update database host.');
            }
            $host_id = (int)$this->db->get_where('host', ['name' => $name])->row()->id;
        }
        else
        {
            // Insert host
            $insert_data = [
                'name' => $name,
                'value' => $value
            ];

            if ( ! $this->db->insert('host', $insert_data))
            {
                throw new Exception('Could not insert database host');
            }

            $host_id = (int)$this->db->insert_id();
        }

        return $host_id;
    }

    public function get_hosts()
    {
        return $this->db->get('hosts')->result_array();
    }
}