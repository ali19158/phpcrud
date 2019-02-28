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

/*public static function putEl() {

    $curl = curl_init();

    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"PUT");
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

    curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$update_para);
curl_setopt_array($curl, )
    $curl_response = curl_exec($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => self::API_URL . $url_params,
    ]);
}*/

    public static function deleteById($id) {
        $curl = curl_init();
        /*curl_setopt($curl, CURLOPT_URL, $API_URL);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);*/
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::API_URL . $url_params,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_POSTFIELDS => $json,
        ]);
        $resp = curl_exec($curl);
        $resp = json_decode($resp);
        curl_close($curl);

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