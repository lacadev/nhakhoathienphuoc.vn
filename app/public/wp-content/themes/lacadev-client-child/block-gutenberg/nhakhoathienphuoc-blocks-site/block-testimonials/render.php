<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Testimonials Block — render.php
 *
 * @package lacadev-client-child
 */

require_once __DIR__ . '/icons.php';

$section_title  = $attributes['sectionTitle'] ?? '';
$testimonials   = $attributes['testimonials'] ?? [];

$star_color     = $attributes['starColor']     ?? '#0d631b';
$quote_color    = $attributes['quoteColor']    ?? '#40493d';
$name_color     = $attributes['nameColor']     ?? '#263238';
$location_color = $attributes['locationColor'] ?? '#78716c';
$card_bg_color  = $attributes['cardBgColor']   ?? '#ffffff';
$border_color   = $attributes['borderColor']   ?? '#e1e3e1';

$show_google_review        = $attributes['showGoogleReview']       ?? true;
$google_review_title       = $attributes['googleReviewTitle']      ?? '';
$google_review_rating      = $attributes['googleReviewRating']     ?? '';
$google_review_count       = $attributes['googleReviewCount']      ?? '';
$google_review_button_text = $attributes['googleReviewButtonText'] ?? '';
$google_review_url         = $attributes['googleReviewUrl']        ?? '';

$wrapper_attrs = get_block_wrapper_attributes( [
    'class' => 'block-testimonials',
] );

$grid_class = 'block-testimonials__grid' . ( $show_google_review ? ' block-testimonials__grid--with-google' : '' );
?>

<section <?php echo $wrapper_attrs; ?>>
    <div class="block-testimonials__inner">
        <?php if ( ! empty( $section_title ) ) : ?>
            <h2 class="block-testimonials__title"><?php echo esc_html( $section_title ); ?></h2>
        <?php endif; ?>

        <div class="<?php echo esc_attr( $grid_class ); ?>">
            <?php foreach ( $testimonials as $testimonial ) :
                $quote      = $testimonial['quote']         ?? '';
                $name       = $testimonial['name']           ?? '';
                $location   = $testimonial['location']       ?? '';
                $avatar_url = $testimonial['avatarImageUrl'] ?? '';
                $rating     = min( 5, max( 1, (int) ( $testimonial['rating'] ?? 5 ) ) );
                ?>
                <div
                    class="block-testimonials__card"
                    style="background-color:<?php echo esc_attr( $card_bg_color ); ?>;border-color:<?php echo esc_attr( $border_color ); ?>;"
                >
                    <div class="block-testimonials__stars" style="color:<?php echo esc_attr( $star_color ); ?>;">
                        <?php for ( $i = 0; $i < $rating; $i++ ) : ?>
                            <?php echo lcdc_dental_icon( 'star' ); ?>
                        <?php endfor; ?>
                    </div>

                    <?php if ( ! empty( $quote ) ) : ?>
                        <p class="block-testimonials__quote" style="color:<?php echo esc_attr( $quote_color ); ?>;">&ldquo;<?php echo nl2br( esc_html( $quote ) ); ?>&rdquo;</p>
                    <?php endif; ?>

                    <div class="block-testimonials__author">
                        <?php if ( ! empty( $avatar_url ) ) : ?>
                            <img
                                class="block-testimonials__avatar"
                                src="<?php echo esc_url( $avatar_url ); ?>"
                                alt="<?php echo esc_attr( $name ); ?>"
                                loading="lazy"
                            />
                        <?php else : ?>
                            <div class="block-testimonials__avatar block-testimonials__avatar--placeholder"></div>
                        <?php endif; ?>

                        <div class="block-testimonials__author-info">
                            <?php if ( ! empty( $name ) ) : ?>
                                <span class="block-testimonials__name" style="color:<?php echo esc_attr( $name_color ); ?>;"><?php echo esc_html( $name ); ?></span>
                            <?php endif; ?>
                            <?php if ( ! empty( $location ) ) : ?>
                                <span class="block-testimonials__location" style="color:<?php echo esc_attr( $location_color ); ?>;"><?php echo esc_html( $location ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if ( $show_google_review ) : ?>
                <div
                    class="block-testimonials__google-card"
                    style="background-color:<?php echo esc_attr( $card_bg_color ); ?>;border-color:<?php echo esc_attr( $border_color ); ?>;"
                >
                    <div class="block-testimonials__google-header">
                        <?php echo lcdc_google_icon(); ?>
                        <?php if ( ! empty( $google_review_title ) ) : ?>
                            <span class="block-testimonials__google-title"><?php echo esc_html( $google_review_title ); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="block-testimonials__google-rating">
                        <?php if ( ! empty( $google_review_rating ) ) : ?>
                            <span class="block-testimonials__google-score"><?php echo esc_html( $google_review_rating ); ?></span>
                        <?php endif; ?>
                        <span class="block-testimonials__google-stars" style="color:<?php echo esc_attr( $star_color ); ?>;">
                            <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                                <?php echo lcdc_dental_icon( 'star' ); ?>
                            <?php endfor; ?>
                        </span>
                    </div>

                    <?php if ( ! empty( $google_review_count ) ) : ?>
                        <p class="block-testimonials__google-count"><?php echo esc_html( $google_review_count ); ?></p>
                    <?php endif; ?>

                    <?php if ( ! empty( $google_review_button_text ) ) : ?>
                        <a class="block-testimonials__google-btn" href="<?php echo esc_url( $google_review_url ?: '#' ); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo esc_html( $google_review_button_text ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
