<?php
/**
 * Template Name: Create Post
 */
get_header(); ?>
<div class="col-sm-12">
    <h3>Add New Post</h3>
    <form class="form-horizontal" name="form" method="post" id="createpost" enctype="multipart/form-data">
        <input type="hidden" name="ispost" value="1" />
        <input type="hidden" name="userid" value="" />
        <div class="col-md-12">
            <label class="control-label">Title</label>
            <input type="text" class="form-control title" name="title" />
        </div>

        <div class="col-md-12">
            <label class="control-label">Sample Content</label>
            <textarea class="form-control sample_content" rows="8" name="sample_content"></textarea>
        </div>

        <div class="col-md-12">
            <label class="control-label">Choose Category</label>
            <select name="category" class="form-control category">
                <option value="1">Uncategorized</option>
                <?php
                $cat_args = array(  
                    'hide_empty' => 1,    
                    'exclude' =>array(1) // desire id
                );
                $catList = get_categories($cat_args);
                foreach($catList as $listval)
                {
                    echo '<option value="'.$listval->term_id.'">'.$listval->name.'</option>';
                }
                ?>
            </select>
        </div>

        <div class="col-md-12">
            <label class="control-label">Upload Post Image</label>
            <input type="file" id="file-upload" name="sample_image" class="form-control sample_image" />
        </div>

        <div class="col-md-12">
            <input type="submit" id="SubmitApplication" class="btn btn-primary" value="SUBMIT" name="submitpost" />
        </div>
    </form>
    <div class="clearfix"></div>
</div>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.validate.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function() { 
    jQuery('#SubmitApplication').click(function(){
        jQuery("#createpost").validate({
          errorPlacement: function(error, element) {
            error.appendTo('#errordiv');
          },
          rules: {
            title: "required"
        },
         messages: {
            title: "Please enter title"
         },
         // end messages
        
        invalidHandler: function(form, validator) {
            $("input.title").each(function() {
                if($(this).val() == "" && $(this).val().length < 1) {
                    $(this).addClass('error');
                } else {
                    $(this).removeClass('error');
                }
            });                   
        },
            
        submitHandler: function(form) {
            var isValid = true;
            $("input.title").each(function() {
                if($(this).val() == "" && $(this).val().length < 1) {
                    $(this).addClass('error');
                    isValid = false;
                } else {
                    $(this).removeClass('error');
                }
                
            }); 

            if(isValid) {
                var page_url = "<?php echo get_permalink(35); ?>";
                var data =  $("form#createpost").serialize();
                var formData = new FormData($("#createpost")[0]);
                formData.append('uploadfile', $('#file-upload')[0].files[0]);
                $.ajax({
                    type: "POST",
                    url: page_url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        $("#createpost")[0].reset();
                        alert(data);
                    },
                    error: function() {
                        alert('error handing here');
                    }
                });
             }
          }  
      });
   });
});
</script>
<?php get_footer(); ?>