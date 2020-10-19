<?php

//namespace my_orders;

//use my_database\Database;

class Orders extends Database
{

  public function get_orders_detail()
    {
        global $wpdb;
        $latitude = [];
        $longitude = [];
        $name = [];
        $location = [];
        $skt_lat = '32.497223';
        $skt_long = '74.536110';

        if (isset($_POST['distance'])) {

            $distance_km = $_POST['distance'];
            $tablename = $wpdb->prefix . 'orders_map';

            if (!empty($distance_km) && !empty($skt_lat) && !empty($skt_long)) {

                /** getting radius from center of sialkot to given distance */

                $result = $this->get_direction_of_orders($distance_km, $skt_lat, $skt_long, $tablename);
                foreach ($result as $key => $value) {

                    $latitude[] = $value->latitude;
                    $longitude[] = $value->longitude;
                    $name[] = $value->name;
                    $location[] = $value->location;
                }

                $data = json_encode(array_combine($latitude, $longitude));
                $name = json_encode($name);
                $location = json_encode($location);


            }
        } else {
            /** sending default values */
            $tablename = $wpdb->prefix . 'orders_map';

           $result = $this->get_all_orders($tablename);

            foreach ($result as $key => $value) {
                $latitude[] = $value->latitude;
                $longitude[] = $value->longitude;
                $name[] = $value->name;
                $location[] = $value->location;
            }
            $data = json_encode(array_combine($latitude, $longitude));
            $name = json_encode($name);
            $location = json_encode($location);
            $distance_km = json_encode('0');


        }
        /** sending the variables data from php file to javascript file */
        wp_localize_script('map-script', 'my_data', $data);
        wp_localize_script('map-script', 'my_distance', $distance_km);
        wp_localize_script('map-script', 'name', $name);
        wp_localize_script('map-script', 'my_location', $location);
    }

}
$obj = new Orders();
add_action('wp_enqueue_scripts', array( $obj, 'get_orders_detail'));

