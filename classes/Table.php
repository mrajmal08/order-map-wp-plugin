<?php


//namespace my_table;


class Table
{
    /** creating the database table for orders detail */
    public static function custom_plugin_tables(){
        global $wpdb, $table_prefix;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $tblname = 'orders_map';
        $wp_track_table = $table_prefix . "$tblname ";

            $sql_query_to_create_table = "CREATE TABLE IF NOT EXISTS ". $wp_track_table ."(
         id INT(11) NOT NULL AUTO_INCREMENT,
         order_id INT(11) NOT NULL,
         name varchar(100) NOT NULL,
         location VARCHAR(100) NOT NULL,
         latitude VARCHAR(100) NOT NULL,
         longitude VARCHAR(100) NOT NULL,
         PRIMARY KEY (id)
        ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1"; /// sql query to create table
            dbDelta($sql_query_to_create_table);

        }

    /** creating the custom page with the activation of plugin */
    public static function custom_page() {

        if ( ! current_user_can( 'activate_plugins' ) ) return;

        global $wpdb;

        if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'google-map'", 'ARRAY_A' ) ) {

            $current_user = wp_get_current_user();

            // create post object
            $page = array(
                'post_title'  => __( 'Google Map' ),
                'post_status' => 'publish',
                'post_author' => $current_user->ID,
                'post_type'   => 'page',
                'post_content'   => '[orders-detail]',
            );

            /** insert the post into the database */
            wp_insert_post( $page );
        }
    }
}
