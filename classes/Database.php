<?php
//namespace my_database;


class Database
{

    protected function get_direction_of_orders($distance_km, $skt_lat, $skt_long, $tablename)
    {
        global $wpdb;

        $sql_distance = "SELECT *, ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS(                               $skt_lat ) ) + COS( RADIANS( `latitude` ) )
           * COS( RADIANS( $skt_lat )) * COS( RADIANS( `longitude` ) - RADIANS( $skt_long )) ) *                       3956  AS `distance`
            FROM {$tablename}
            WHERE ACOS( SIN( RADIANS( `latitude` ) ) * SIN( RADIANS( $skt_lat ) ) + COS( RADIANS(                      `latitude` ) )
            * COS( RADIANS( $skt_lat )) * COS( RADIANS( `longitude` ) - RADIANS( $skt_long )) ) *                      3956  < $distance_km
            ORDER BY `distance`";

        /** getting orders with in the give directions */
        return $wpdb->get_results($sql_distance);
    }

    protected function get_all_orders($tablename)
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM {$tablename}");

    }

}
