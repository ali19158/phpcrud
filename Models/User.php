<?php

namespace Models;

class User {

    const API_URL = 'http://test.invision.kz/test.php';

    public function __construct() {

    }

    public static function all() {

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::API_URL
        ]);

        $resp = curl_exec($curl);

        curl_close($curl);

        return json_decode($resp);
    }

    public function findById($id) {

        $users = self::all();

        foreach($users as $k => $user) {
            if($id == $k) {
                return $user;
            }
        }

        return null;

    }

    public static function updateById($id, $userData) {

        $url_params = '?id='.$id . '&name=' . $userData['name'] . '&occupation=' . $userData['occupation'] . '&age=' . $userData['age'];

//        echo self::API_URL . $url_params;

        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::API_URL . $url_params,
            CURLOPT_POST => 1,
        ]);
        // Send the request & save response to $resp
        $resp = curl_exec($curl);

        // Close request to clear up some resources
        curl_close($curl);

        if(empty($resp)) return true;

        return false;
    }

}