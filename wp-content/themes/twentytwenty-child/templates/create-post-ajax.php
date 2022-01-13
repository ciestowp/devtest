<?php
/**
 * Template Name: Create Post Ajax
 */

$path = preg_replace('/wp-content.*$/','',__DIR__);
include($path.'wp-load.php');
global $wpdb;

if(is_user_logged_in())
{
    if(isset($_POST['ispost']))
    {
        global $current_user;
        get_currentuserinfo();

        $user_login = $current_user->user_login;
        $user_email = $current_user->user_email;
        $user_firstname = $current_user->user_firstname;
        $user_lastname = $current_user->user_lastname;
        $user_id = $current_user->ID;

        $post_title = $_POST['title'];
        $post_slug_small = strtolower($post_title);
        $post_slug = str_replace(' ', '-', $post_slug_small);
        $sample_image = $_FILES['sample_image']['name'];
        $post_content = $_POST['sample_content'];
        $category = $_POST['category'];

        /*
        echo '$post_title: '.$post_title.'<br>';
        echo '$post_slug_small: '.$post_slug_small.'<br>';
        echo '$post_slug: '.$post_slug.'<br>';
        echo '$sample_image: '.$sample_image.'<br>';
        echo '$post_content: '.$post_content.'<br>';
        echo '$category: '.$category.'<br>';
        */

        $new_post = array(
            'post_title' => $post_title,
            'post_content' => $post_content,
            'post_status' => 'publish',
            'post_name' => $post_slug,
            'post_type' => $post_type,
            'post_category' => array( $category )
        );

        $pid = wp_insert_post($new_post);
        echo "New post added successfully";
        add_post_meta($pid, 'meta_key', true);

        if (!function_exists('wp_generate_attachment_metadata'))
        {
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        }
        if ($_FILES)
        {
            foreach ($_FILES as $file => $array)
            {
                if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK)
                {
                    return "upload error : " . $_FILES[$file]['error'];
                }
                $attach_id = media_handle_upload( $file, $pid );
            }
        }
        if ($attach_id > 0)
        {
            //and if you want to set that image as Post then use:
            update_post_meta($pid, '_thumbnail_id', $attach_id);
        }

        $my_post1 = get_post($attach_id);
        $my_post2 = get_post($pid);
        $my_post = array_merge($my_post1, $my_post2);
    }
}
else
{
    echo "User must be login for add post!";
}
 ?>