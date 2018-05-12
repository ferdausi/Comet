<header class="header header-style-default clearfix">
    <nav class="navbar-default ">
        <div class="container">
            <div class=" navbar  navbar-horizontal ">


                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header navbar-brand site-logo ">
                    <?php comet_custom_logo() ?>
                </div>


                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <div class="main-navbar">
                        <?php wp_nav_menu(apply_filters('comet_wp_nav_menu_header_default', array(
                                'container' => FALSE,
                                'theme_location' => 'primary',
                                'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav ">%3$s</ul>',
                                'walker' => new comet_Menu_Walker(),
                                'fallback_cb' => 'comet_Menu_Walker::fallback'
                            ))
                        );
                        ?>
                    </div>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>







