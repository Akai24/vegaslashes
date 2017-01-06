<div class="fs-container portfolio-protected">
    <div class="portfolio-password-overlay password-page-form">
        <div class="portfolio-passsword">
            <div class="portfolio-form">
                <div class="portfolio-form-header">
                    <h2><?php _e('Enter Your Password', 'photology-themes'); ?></h2>
                </div>
                <div class="portfolio-form-body">
                    <?php echo get_the_password_form(get_the_ID()); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function($){
        $(document).ready(function(){
            /** Full screen **/
            if($(".fs-container").length) {
                $(".fs-container").fsfullheight(['.headermenu', '.responsiveheader', '.topnavigation']);
            }
        });
    })(jQuery);
</script>