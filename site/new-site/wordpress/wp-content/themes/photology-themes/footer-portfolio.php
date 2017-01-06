                        </div> <!-- .content -->
                    </div> <!-- .contentholder -->
                </div> <!-- #rightsidecontainer -->
            <div class="contentoverflow"></div> <!-- .contentoverflow -->
            </div> <!-- .containerwrapper -->
        </div> <!-- .container -->
    </div> <!-- .jviewport -->

        <?php
            if(vp_metabox("photology_portfolio_list.expand_type") === 'theather') {
                get_template_part('fragment/portfolio-fragment-theather');
            }
        ?>

    <?php wp_footer() ?>
</body>
</html>