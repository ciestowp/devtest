<?php

/* Template Name: NewProduct */

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

/* Start the Loop */
while (have_posts()) :
    the_post();
    get_template_part('template-parts/content/content-page');

    // If comments are open or there is at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) {
        comments_template();
    }
endwhile; // End of the loop.
?>
<?php
$orderby = 'name';
$order = 'asc';
$hide_empty = false;
$cat_args = array(
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
);

$product_categories = get_terms('product_cat', $cat_args);

?>
<div class="ajax-form">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 form-box">
                <form action="" method="post" class="ajax" enctype="multipart/form-data">

                    <label><b>Title</b></label>

                    <input type="text" placeholder="Enter Product Name" name="p_name" required class="p_name">
                    <br>
                    <label><b>Description</b></label>

                    <textarea name="p_desc" cols="5" rows="5" required class="p_desc"></textarea>
                    <br>
                    <label><b>Category</b></label>

                    <select name="p_category" required class="p_category">
                        <?php foreach ($product_categories as $key => $category) {  ?>
                            <option value="<?= $category->name; ?>"><?= $category->name; ?></option>
                        <?php }
                        ?>
                    </select>

                    <br>

                    <label for="">Product Image</label>
                    <input type="file" name="p_image" id="" required class="p_image" accept='image/*'>

                    <br>
                    <div id="msg"></div>

                    <input type="submit" class="submitbtn" value="submit">

                    <div class="success_msg" style="display: none">Product Created Successfully</div>

                    <div class="error_msg" style="display: none">Product Not Created, There is some error.</div>

                </form>

            </div>

        </div>

    </div>

    <script>
        jQuery(document).ready(function($) {
            $('form.ajax').on('submit', function(e) {
                e.preventDefault();
                var that = $(this),
                    url = that.attr('action'),
                    type = that.attr('method');
                var name = $('.p_name').val();
                var desc = $('.p_desc').val();
                var category = $('.p_category').val();
                $.ajax({
                    url: ajax_url,
                    type: "POST",
                    data: {
                        action: 'set_form',
                        name: name,
                        desc: desc,
                        category: category,
                    },
                    success: function(response) {
                        $(".success_msg").css("display", "block");
                    },
                    error: function(data) {
                        $(".error_msg").css("display", "block");
                    }
                });
                $('.ajax')[0].reset();
            });
        });
    </script>
    <?php
    get_footer();
