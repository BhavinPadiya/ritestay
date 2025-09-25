<?php
/**
 * Template Name: Booking Page
 * @package RiteStay
 */
get_header(); ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-7">
            <h1 class="mb-4">Book Your Stay</h1>
            <p class="lead text-muted">Please fill out the details below to check availability and reserve your room. We will confirm your booking within 24 hours.</p>
            
            <div class="booking-form-wrapper p-4 border rounded shadow-sm">
                <?php echo do_shortcode('[contact-form-7 id="2309016" title="Booking form"]'); ?> 
            </div>
        </div>
        
        <div class="col-lg-5">
            <h2 class="mb-3 mt-4 mt-lg-0">Booking Policy</h2>
            <div class="p-4 border rounded bg-light">
                <p><strong>Pay at Check-in:</strong> We do not require payment online. Your room will be reserved, and payment will be settled upon arrival at the Haveli.</p>
                <p><strong>Cancellation:</strong> You may cancel your reservation up to 48 hours before check-in without penalty.</p>
                <p><strong>Check-in/Check-out:</strong> Standard check-in is 2:00 PM. Check-out is 11:00 AM.</p>
                <p class="mt-3">For any questions, please call us at: <strong>+91 9484965885</strong></p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>