<?php

//namespace my_map;

class Map
{
    public function add_map_structure()
    {
        ?>
        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Enter Distance</label>
                <input type="number" class="form-control" name="distance" aria-describedby="emailHelp"
                       placeholder="Enter Distance">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <div id="map"></div>
        <?php

    }

    function add_theme_templates()
    {
        if (is_page('Google Map')) {

            wp_enqueue_script('map-script', substr(plugin_dir_url(__FILE__), 0, strrpos(plugin_dir_url(__FILE__), "/", -2)) . "/" . 'assets/orders-map.js', array(), '', true);
            if (isset($_POST['distance'])) {

                wp_enqueue_script('key-script', 'https://maps.googleapis.com/maps/api/js?&callback=initMap', array(), '', true);

            }
            wp_enqueue_script('key-script', 'https://maps.googleapis.com/maps/api/js?&callback=initMap', array(), '', true);

            wp_enqueue_style('style', substr(plugin_dir_url(__FILE__), 0, strrpos(plugin_dir_url(__FILE__), "/", -2)) . "/" . 'assets/plugin-style.css');
        }
    }
}

$map = new Map();
add_shortcode('orders-detail', array($map, 'add_map_structure'));
add_action('wp_enqueue_scripts', array($map, 'add_theme_templates'));
