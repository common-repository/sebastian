<?php

class Admin_Theme {

    public function get_header() { ?>

        <div class="sebastian-menu-page-wrapper wrap sebastian-clear general">
            <div id="sebastian-menu-page">
                <div class="sebastian-menu-page-header general">
                    <div class="sebastian-container sebastian-flex">
                        <div class="sebastian-title">
                            <a href="https://batuhan.me/sebastian" target="_blank" rel="noopener">
                                <img src="<?php echo plugin_dir_url( __FILE__ )?>/images/logo.png" class="sebastian-header-icon" alt="Sebastian">
                                Sebastian
                                <br>
                                <span class="sebastian-plugin-description"><?php echo __('sebastian_logo_description', 'sebastian'); ?></span>
                                <span class="sebastian-plugin-version">1.0.0</span>
                            </a>
                        </div>
                        <div class="sebastian-top-links">
                            <?php echo __('developed_by', 'sebastian'); ?></span> <a href="https://batuhan.me" target="_blank">Batuhan Kök</a>.
                        </div>
                    </div>
                </div>

                <div class="sebastian-container sebastian-general">
                    <div id="poststuff">
                        <div id="post-body" class="columns-2">
                            <div id="post-body-content">
                                <!-- All WordPress Notices below header -->
                                <h1 class="screen-reader-text">Sebastian</h1>
                                <div class="widgets postbox">
                                    <div class="sebastian-intro-section">
                                        <div class="sebastian-intro-col">
                                            <h2>
                                                <span class="sebastian-intro-icon dashicons dashicons-smiley"></span>
                                                <span><?php echo __('welcome_title', 'sebastian'); ?></span>
                                            </h2>
                                            <p><?php echo __('welcome_text', 'sebastian'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="widgets postbox">
    <?php } 
    
    public function get_footer() {?>
                            </div>
                        </div>
                        <div class="postbox-container sebastian-sidebar" id="postbox-container-1">
                            <div id="side-sortables">
                                <div class="postbox">
                                    <h2 class="hndle ast-normal-cusror">
                                        <span class="dashicons dashicons-book"></span>
                                        <span><?php echo __('box_2_title', 'sebastian'); ?></span>
                                    </h2>
                                    <div class="inside">
                                        <h4><?php echo __('faq_1_title', 'sebastian'); ?></h4>
                                        <p><?php echo __('faq_1_description', 'sebastian'); ?>-</p>
                                        <h4><?php echo __('faq_2_title', 'sebastian'); ?></h4>
                                        <p><?php echo __('faq_2_description', 'sebastian'); ?></p>
                                        <p>
                                            <?php echo __('to_know_more_please_read', 'sebastian'); ?>
                                            <a href="https://radix.works/sebastian#faq" target="_blank" >
                                                <?php echo __('this_page', 'sebastian'); ?>
                                            </a>.
                                        </p>
                                    </div>
                                </div>
                                <div class="postbox">
                                    <h2 class="hndle sebastian-normal-cusror">
                                        <span class="dashicons dashicons-admin-page"></span>
                                        <span><?php echo __('box_3_title', 'sebastian'); ?></span>
                                    </h2>
                                    <div class="inside">
                                        <p><?php echo __('box_3_description', 'sebastian'); ?></p>
                                        <a href="https://radix.works/contact" class="button button-primary" target="_blank">
                                            <?php echo __('take_me', 'sebastian'); ?> »
                                        </a>
                                    </div>
                                </div>
                                <div class="postbox sebastian-radix-sidebar">
                                    <a href="https://radix.works/sebastian" target="_blank" alt="Radix.Works">
                                        <img class="sebastian-radix-img" src="<?php echo plugin_dir_url( __FILE__ )?>/images/radixworks.png">
                                    </a>
                                </div>
                                <!--<div class="postbox">
                                    <h2 class="hndle sebastian-normal-cusror">
                                        <span class="dashicons dashicons-awards"></span>
                                        <span>Review the Plugin</span>
                                    </h2>
                                    <div class="inside">
                                        <p>Please review our plugin to make it easier the proccess of development.</p>
                                        <a href="#" target="_blank" rel="noopener">Review Now »</a>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    <!-- /post-body -->
                    <br class="clear">
                </div>
            </div>

        </div>
    </div>
<?php }

}