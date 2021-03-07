<?php
$form = array(
    "name"      => "fEmail",
    "id"        => "fEmail",
    "class"     => "validate form",
); 
$name = array(
    "name"      => "name",
    "value"     => set_value("name"),
    "class"     => "required focus text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$phone = array(
    "name"      => "phone",
    "value"     => set_value("phone"),
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$email = array(
    "name"      => "email",
    "value"     => set_value("email"),
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$address = array(
    "name"      => "address",
    "value"     => set_value("address"),
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$content = array(
    "name"      => "content",
    "value"     => set_value("content"),
    "id"        => "CONTENT",
    "class"     => "required text width-400 height-100 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
    "minlength" => "20",
);
$submit = array(
    'name'      => 'bntOk',
    'value'     => lang('frontend.send'),
    'class'     => 'bnt bntOK padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 border-shadow',
);
$reset = array(
    'name'      => 'bntReset',
    'value'     => lang('frontend.reset'),
    'class'     => 'bnt bntReset padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 border-shadow',
);
?>
<div class="module module-contact">
    <div class="title">
        <div class="left"><?php echo $static_page['Name'];?></div>
    </div>
    <div class="content">
        <?php echo $static_page['Content'];?>
        <div class="clear-both"></div>
        <div class="form">
            <?php 
                if($successfully == ""){
                    echo "<div class=\"error red text-align-left\">";
                        echo validation_errors();
                        if($error !="" )
                            echo "<p>$error</p>";
                    echo "</div>";
                    echo form_open("",$form);
                    echo "<div class=\"item item-text\">".form_label(lang('frontend.full_name')." <span class=\"color-red\">*</span>").form_input($name)."<div class=\"clear-both\"></div></div>";
                    echo "<div class=\"item item-text\">".form_label(lang('frontend.address')).form_input($address)."<div class=\"clear-both\"></div></div>";
                    echo "<div class=\"item item-text\">".form_label(lang('frontend.email')).form_input($email)."<div class=\"clear-both\"></div></div>";
                    echo "<div class=\"item item-text\">".form_label(lang('frontend.phone')).form_input($phone)."<div class=\"clear-both\"></div></div>";
                    echo "<div class=\"item item-text\">".form_label(lang('frontend.content')." <span class=\"color-red\">*</span>").form_textarea($content)."<script type=\"text/javascript\">var fullVi = new InnovaEditor(\"fullVi\");FullEditor(fullVi, \"CONTENT\", 400);</script><div class=\"clear-both\"></div></div>";
                    echo "<div class=\"item item-submit\">".form_submit($submit).form_reset($reset)."<div class=\"clear-both\"></div></div>";
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
    </div>
    <div class="clear-both"></div>
</div>