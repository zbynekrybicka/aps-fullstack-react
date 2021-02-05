<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 05.02.2021
 * Time: 21:51
 */

namespace App\Resource;

use App\Response;

class Rest
{

    public static function get() {
        static $self;
        if (!$self) {
            $self = new self();
        }
        return $self;
    }

    private function __construct() {
        $this->db = DbConnection::get();
    }

    public function put($table, $data) {
        $id = $data->id;
        unset($data->id);
        $this->db->update($table, (array) $data)->where(['id' => $id])->execute();
        return new Response(200, $data);
    }
}