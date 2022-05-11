<?php defined('BASEPATH') or exit('No direct script access allowed');

class Host_model extends EA_Model {

    public function get_host($chinese_name)
    {
        if ( ! is_string($chinese_name))
        {
            // Check argument type.
            throw new Exception('$chinese_name argument is not a string: ' . $chinese_name);
        }

        if ($this->db->get_where('host', ['chinese_name' => $chinese_name])->num_rows() == 0)
        {
            // Check if setting exists in db.
            throw new Exception('$chinese_name host does not exist in database: ' . $chinese_name);
        }

        $query = $this->db->get_where('host', ['chinese_name' => $chinese_name]);
        $host = $query->num_rows() > 0 ? $query->row() : '';
        $data = [
            'chinese_name' => $chinese_name,
            'english_name' => $english_name,
            'url' => $url,
            'logo' => $logo,
            'description' => $description,
            'main_color' => $main_color,
            'secondary_color' => $secondary_color,
            'text_color' => $text_color
        ];
        return $host -> $data;
    }

    public function set_host($chinese_name, $english_name, $url, $logo, $description, $main_color, $secondary_color, $text_color)
    {
        if ( ! is_string($chinese_name))
        {
            throw new Exception('$chinese_name argument is not a string: ' . $chinese_name);
        }

        $query = $this->db->get_where('host', ['chinese_name' => $chinese_name]);

        if ($query->num_rows() > 0)
        {
            // Update setting
            if ( ! $this->db->update('host', ['text_color' => $text_color], ['secondary_color' => $secondary_color], 
                                            ['main_color' => $main_color], ['description' => $description], ['logo' => $logo], 
                                            ['url' => $url], ['english_name' => $english_name], ['chinese_name' => $chinese_name]))
            {
                throw new Exception('Could not update database host.');
            }
            $host_id = (int)$this->db->get_where('host', ['chinese_name' => $$chinese_name])->row()->id;
        }
        else
        {
            // Insert setting
            $insert_data = [
                'chinese_name' => $chinese_name,
                'english_name' => $english_name,
                'url' => $url,
                'logo' => $logo,
                'description' => $description,
                'main_color' => $main_color,
                'secondary_color' => $secondary_color,
                'text_color' => $text_color
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
        return $this->db->get('host')->result_array();
    }
}