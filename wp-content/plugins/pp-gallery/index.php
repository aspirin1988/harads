<?php
/*
Plugin Name: PP Gallery
Plugin URI: pp-gallery.kz
Description: Posts and pages gallery
Author: Sharipkanov Yertay
Version: 0.0.2
*/

require_once (dirname(dirname(dirname(__DIR__))) . '/wp-config.php');

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

define('PPGALLERYPATH', ABSPATH . 'wp-content/plugins/pp-gallery/');

if(isset($_FILES['files'])) {
    pp_gallery_upload();
}

if(isset($_POST['removeId'])) {
    echo pp_gallery_remove($_POST['removeId']);
}

if(isset($_POST['editId'])) {
    echo pp_gallery_edit($_POST['editId']);
}

function pp_get_breadcrumb ($class='',$home_url=false)
{
    $obj=get_queried_object();
    echo "<ul class='{$class}'>";
    if (!is_front_page()) {
        if (is_page($obj->ID)) {
            echo '<li><a href="/">Главная</a></li>';
            echo '<li><a href="' . get_permalink($obj->ID) . '">' . get_the_title($obj->ID) . '</a></li>';
        } elseif (is_single($obj->ID)) {
            $cat=get_the_category();
            $url='/';
            if ($home_url){
                $url=$home_url;
            }
            echo "<li><a href='{$url}'>Главная</a></li>";
            foreach ($cat as $value){
                echo '<li><a href="' . get_term_link($value->term_id) . '">' . $value->name . '</a></li>';
            }
            echo '<li><a href="' . get_permalink($obj->ID) . '">' . get_the_title($obj->ID) . '</a></li>';

        } elseif (is_category($obj->ID)) {
            echo '<li><a href="/">Главная</a></li>';
            $cat=get_the_category();
            foreach ($cat as $value){
                echo '<li><a href="' . get_term_link($value->term_id) . '">' . $value->name . '</a></li>';
            }


        }
    }
    echo "</ul>";
}

function get_the_post_thumbnail_tag($id=false)
{
    global $post;
    if (!$id) {
        $id=$post->ID;
    }
    $meta=array();
    $img_id = get_post_thumbnail_id($id);
    $attachment = get_post( $img_id );
    $res='';
    $meta['image_name'] = basename( get_attached_file( $img_id ) );
    $meta['image_alt'] = get_post_meta($img_id , '_wp_attachment_image_alt', true);
    $meta['image_description'] =  $attachment->post_content;
    $meta['post_name'] = $post->post_title;
    if ($meta['image_alt'])
    {
        $res.=' alt="'.$meta['image_alt'].'" ';
    }
    else
    {
        $res.=' alt="'.$meta['post_name'].'" ';
    }

    /*if ($meta['image_description'])
    {
        $res.=' title="'.$meta['image_description'].'" ';
    }
    else
    {
        $res.=' title="'.$meta['post_name'].'" ';
    }*/

    echo $res ;
}

function get_the_thumbnail_tag_by_id($id=false)
{
    global $post;
    if (!$id) {
        $id=$post->ID;
    }
    $meta=array();
    $img_id = get_post_thumbnail_id($id);
    $attachment = get_post( $img_id );
    $res='';
    $meta['image_name'] = basename( get_attached_file( $img_id ) );
    $meta['image_alt'] = get_post_meta($img_id , '_wp_attachment_image_alt', true);
    $meta['image_description'] =  $attachment->post_content;
    $meta['post_name'] = $post->post_title;
    if ($meta['image_alt'])
    {
        $res.=' alt="'.$meta['image_alt'].'" ';
    }
    else
    {
        $res.=' alt="'.$meta['post_name'].'" ';
    }

    /*if ($meta['image_description'])
    {
        $res.=' title="'.$meta['image_description'].'" ';
    }
    else
    {
        $res.=' title="'.$meta['post_name'].'" ';
    }*/

    echo $res ;
}

function pp_gallery_upload() {
    global $wp_query;
    $postid = $wp_query->post->ID;
//    echo $postid;
    $pp_upload_data['images'] = $_FILES['files'];
    $pp_upload_data['id'] = $_GET['postID'];

    global $wpdb;

    if($pp_upload_data['images']) {
        foreach($pp_upload_data['images']['error'] as $key => $value) {
            if($value == 0) {
                $target_dir = ABSPATH . "/wp-content/uploads/pp_gallery/" . $pp_upload_data['id'] . '/';
                $target_file = $target_dir . basename($pp_upload_data['images']["name"][$key]);
                $uploadOk = 1;

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }

                    if (move_uploaded_file($pp_upload_data['images']["tmp_name"][$key], $target_file)) {
                        $name=basename($pp_upload_data['images']["name"][$key]);
                        $fileUrl = "/wp-content/uploads/pp_gallery/" . $pp_upload_data['id'] . '/' . $name;
                        $name=explode('.',$name);
                        $name=$name[0];
                        $query = "INSERT INTO pp_gallery_data (url, pp_id,name,alt) VALUES ('$fileUrl','{$pp_upload_data['id']}','{$name}','{$name}')";
                        $wpdb->query($query);

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    }
}

function pp_gallery_activation() {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $table_name = 'pp_gallery_data';
    $sql = "CREATE TABLE $table_name (
        id int(9) NOT NULL AUTO_INCREMENT,
        url varchar(255) DEFAULT '' NOT NULL,
        pp_id int(9) NOT NULL,
        name TEXT,
        alt TEXT,
        description TEXT,
        UNIQUE KEY id (id)
    ) $charset_collate;";

    dbDelta( $sql );
}

function pp_gallery_get($id=false,$all_post=false,$order='pp_id') {
    global $wpdb;
    if ($id){
        $pp_gallery_get_query = "SELECT * FROM pp_gallery_data WHERE pp_id = '{$id}' ORDER BY {$order}";
    }
    else
    {
        global $post;
        if ($all_post) {
            $pp_gallery_get_query = "SELECT * FROM pp_gallery_data ORDER BY {$order}";
        }
        else {
            global $post;
            $id=$post->ID;
            $pp_gallery_get_query = "SELECT * FROM pp_gallery_data WHERE pp_id = '{$id}' ORDER BY {$order}";
        }
    }

    return $wpdb->get_results($pp_gallery_get_query);
}

function pp_gallery_remove($id) {
    global $wpdb;
    $response=0;
    $pp_gallery_get_query = "SELECT * FROM pp_gallery_data WHERE id = '{$id}'";
    if ($res2=$wpdb->get_results($pp_gallery_get_query))
    {
        $response=1;
    };
    $res1=$res2[0];

    $path=ABSPATH.$res1->url;
    if (file_exists($path)){
        unlink($path);
    }
    $pp_gallery_get_query = "DELETE FROM pp_gallery_data WHERE id = '{$id}' ";
    $wpdb->query($pp_gallery_get_query);
    return json_encode($response);
}

function pp_gallery_edit($id) {

    global $wpdb;
    $pp_data=$_POST['pp'];
    $pp_gallery_get_query = "UPDATE pp_gallery_data set name='{$pp_data['name']}',alt='{$pp_data['alt']}',description='{$pp_data['description']}' WHERE id = '{$id}'";
    file_put_contents('text.txt',$pp_gallery_get_query);
    $res=$wpdb->query($pp_gallery_get_query);
    return json_encode($res);
}

function pp_gallery_widget_render() {
    global $post;
    $postID = $post->ID;
    $pp_gallery_current_images = pp_gallery_get($postID);
    include (PPGALLERYPATH. 'pp-gallery-widget.php');
}

function pp_gallery_boxes() {
    add_meta_box('pp_gallery', 'PP Gallery', 'pp_gallery_widget_render', 'post');
    add_meta_box('pp_gallery', 'PP Gallery', 'pp_gallery_widget_render', 'page');
}

function my_enqueue($hook) {
    wp_enqueue_script( 'my_custom_uikit',  '/wp-content/plugins/pp-gallery/bower_components/uikit/js/uikit.min.js' );
    wp_enqueue_script( 'my_custom_upload', '/wp-content/plugins/pp-gallery/bower_components/uikit/js/components/upload.min.js' );
    wp_enqueue_script( 'my_custom_notify', '/wp-content/plugins/pp-gallery/bower_components/uikit/js/components/notify.min.js' );
    wp_enqueue_script( 'my_custom_accordion', '/wp-content/plugins/pp-gallery/bower_components/uikit/js/components/accordion.min.js' );
    wp_enqueue_script( 'my_custom_lightbox', '/wp-content/plugins/pp-gallery/bower_components/uikit/js/components/lightbox.min.js' );
    wp_enqueue_script( 'my_custom_pp-gallery', '/wp-content/plugins/pp-gallery/pp-gallery.js' );

}


function reg_param()
{
    if( ! defined( 'REG_GR_PLUGIN_DIR' ) ){ define( 'REG_GR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) ); }
    // Plugin Folder URL
    if ( ! defined( 'REG_GR_PLUGIN_URL' ) ) { define( 'REG_GR_PLUGIN_URL', plugin_dir_url( __FILE__ ) ); }

    // Plugin folder name
    if( ! defined( 'REG_GR_PLUGIN_FOLDER' ) ){ define('REG_GR_PLUGIN_FOLDER', basename(dirname(__FILE__) )); }
    // Plugin Root File QPath
    if ( ! defined( 'REG_GR_PLUGIN_FILE' ) ){ define( 'REG_GR_PLUGIN_FILE', __FILE__ ); }
}

function get_main() {
    $postID = get_the_ID();
    $pp_gallery_current_images = pp_gallery_get(0,true);

    include_once (PPGALLERYPATH. 'pp-gallery-widget_all.php');
}

function register_my_custom_menu_page(){
    add_menu_page('PP GALLERY', 'PP GALLERY', 'manage_options', REG_GR_PLUGIN_FOLDER, 'get_main', plugins_url( 'pp-gallery/images/icon.png' ));
        //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        add_submenu_page( REG_GR_PLUGIN_FOLDER , 'Menu_item_1', 'Menu item 1', 1, REG_GR_PLUGIN_FOLDER,'get_main');
        add_submenu_page( REG_GR_PLUGIN_FOLDER , 'Menu_item_2', 'Menu item 2', 2, 'index','get_main1');
        add_submenu_page( REG_GR_PLUGIN_FOLDER , 'Menu_item_3', 'Menu item 2', 3, 'index1','get_all_group');
}

add_action( 'admin_menu', 'reg_param' );
add_action( 'admin_menu', 'register_my_custom_menu_page' );

add_action( 'admin_init', 'my_enqueue' );

register_activation_hook( __FILE__, 'pp_gallery_activation');
add_action('add_meta_boxes', 'pp_gallery_boxes');
add_action('save_post', 'pp_gallery_upload');
