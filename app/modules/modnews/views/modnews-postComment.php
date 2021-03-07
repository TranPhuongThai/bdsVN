<?php
$form = array(
    "name"      => "fComment",
    "id"        => "fComment",
    "class"     => "validate form",
); 
$name = array(
    "name"      => "name",
    "value"     => set_value("name"),
    "class"     => "required focus text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$email = array(
    "name"      => "email",
    "value"     => set_value("email"),
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$content = array(
    "name"      => "content",
    "value"     => set_value("content"),
    "id"        => "CONTENT",
    "class"     => "required text width-400 height-100 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
    "minlength" => "10",
);
$submit = array(
    'name'      => 'bntOk',
    'value'     => lang('frontend.send'),
    'class'     => 'bnt bntOK padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 border-shadow',
);
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#fComment").submit(function (){
            var name = $(this).find('input[name="name"]').val();
            var email = $(this).find('input[name="email"]').val();
            var content = $(this).find('textarea[name="content"]').val();
            var cct = $("input[name=csrf_token_name]").val();
            //var cct = $.cookie("csrf_cookie_name");
            $.post("<?php echo base_url();?>/modnews/postComment/<?php echo $type,'/',$id;?>", {
                    'name' : name,
                    'email' : email,
                    'content' : content,
                    'csrf_token_name': cct
                },function(data){
                    $(".comment-form div.error").html("<p style='margin-top: 10px;'>"+data+"</p>");
                    $("#fComment").hide();
                }); 
            return false;
        });
    });
</script>
<div class="comment-form">
    <?php 
        if($successfully == ""){
            echo "<div class=\"error red text-align-left\">";
                echo validation_errors();
                if($error !="" )
                    echo "<p style='margin-top: 10px;'>$error</p>";
            echo "</div>";
            echo form_open("",$form);
            echo "<div class=\"item item-text\">".form_label("Tên/Số điện thoại <span class=\"color-red\">*</span>").form_input($name)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('frontend.email')).form_input($email)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label("Nội dung <span class=\"color-red\">*</span>").form_textarea($content)."<script type=\"text/javascript\">var fullVi = new InnovaEditor(\"fullVi\");FullEditor(fullVi, \"CONTENT\", 400);</script><div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-submit\">".form_submit($submit)."<div class=\"clear-both\"></div></div>";
            echo form_close();
        }else{
            echo "<div class=\"error red text-align-left\">";
                echo "<p>$successfully</p>";
            echo "</div>";
        }
    ?>
    <script src="<?php echo base_url();?>public/js/jquery.validate.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".validate").validate();
        });
    </script>
    <div class="clear-both"></div>
</div>