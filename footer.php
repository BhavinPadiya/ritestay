</div> </main>
    
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5 class="text-uppercase mb-4 fw-bold text-secondary">Send us your Feedback</h5>
                    <?php echo do_shortcode('[contact-form-7 id="a6fc047" title="Send us your Feedback"]') ?>
                </div>

                <div class="col-md-6 mb-4">
                    <h5 class="text-uppercase mb-4 fw-bold text-secondary">About Our Hotel</h5>
                    <p class="text-white-50">
                        <?php echo nl2br( get_theme_mod( 'ritestay_about_text', '' ) ); ?>
                    </p>
                    <p class="text-white-50">
                        <?php echo nl2br( get_theme_mod( 'ritestay_contact_info', '' ) ); ?>
                    </p>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="row">
                <div class="col-md-12 text-center text-white-50">
                    <p>&copy; <?php echo date('Y'); ?> Hotel Haveli. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>