<?php if(Themify_Social_Share::is_enabled( 'single' )):?>
    <?php $networks = Themify_Social_Share::get_active_networks();?>
    <?php if(!empty($networks)):?>
        <div class="social-share-wrap">
            <div class="social-share msss54">
                <?php foreach($networks as $k=>$n):?>
                        <div class="<?php echo strtolower($k)?>-share sharrre">
                            <a class="box" onclick="window.open('<?php echo Themify_Social_Share::get_network_url($k)?>','<?php echo $k?>','<?php echo Themify_Social_Share::get_window_params($k)?>')" title="<?php esc_attr_e($n)?>" rel="nofollow" href="javascript:void(0);">
                                <span class="share"></span>
                            </a>
                        </div>
                <?php endforeach;?>
            </div>
        </div>
    <?php endif;?>
<?php endif;?>