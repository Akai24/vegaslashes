<?php
    $navobj = jeg_get_navigation_setup();
    if(!$navobj['hidetopmenu'] ) {
?>

        <div class="searchcontent">
            <form method="get" class="search-form" action="<?php echo esc_url ( home_url('/') ); ?>/">
                <input type="text" autocomplete="off" name="s"
                       placeholder="<?php esc_attr_e('Type and Enter to Search', 'photology-themes'); ?>">
            </form>
            <div class="closesearch">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="searchheader">
            <i class="fa fa-search"></i>
        </div>

<?php
    }
?>