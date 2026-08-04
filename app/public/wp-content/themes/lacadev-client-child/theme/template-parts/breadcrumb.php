<?php
/**
 * Breadcrumb trail — "Trang chủ > ... > Hiện tại".
 * Dùng bên trong page-hero (nền tối), khớp thiết kế tham khảo.
 *
 * @package LacaDevClientChild
 */

if (function_exists('rank_math_the_breadcrumbs')) :
    ?>
    <div class="breadcrumb-trail">
        <?php rank_math_the_breadcrumbs(); ?>
    </div>
    <?php
    return;
endif;

// Fallback khi Rank Math tắt module Breadcrumbs — tự dựng trail đơn giản.
$crumbs = [
    [ 'label' => __('Trang chủ', 'laca'), 'url' => home_url('/') ],
];

if (is_archive()) {
    if (is_post_type_archive()) {
        $crumbs[] = [ 'label' => post_type_archive_title('', false), 'url' => '' ];
    } elseif (is_category() || is_tag() || is_tax()) {
        $crumbs[] = [ 'label' => single_term_title('', false), 'url' => '' ];
    } else {
        $crumbs[] = [ 'label' => get_the_archive_title(), 'url' => '' ];
    }
} elseif (is_search()) {
    $crumbs[] = [ 'label' => __('Kết quả tìm kiếm', 'laca'), 'url' => '' ];
} elseif (is_404()) {
    $crumbs[] = [ 'label' => __('Không tìm thấy trang', 'laca'), 'url' => '' ];
} elseif (is_home()) {
    $posts_page_id = get_option('page_for_posts');
    if ($posts_page_id) {
        $crumbs[] = [ 'label' => get_the_title($posts_page_id), 'url' => '' ];
    }
} elseif (is_singular()) {
    $post_type = get_post_type();

    if ($post_type === 'post') {
        $cats = get_the_category();
        if (!empty($cats)) {
            $crumbs[] = [ 'label' => $cats[0]->name, 'url' => get_category_link($cats[0]) ];
        }
    } elseif ($post_type !== 'page') {
        $archive_link = get_post_type_archive_link($post_type);
        if ($archive_link) {
            $crumbs[] = [ 'label' => post_type_archive_title('', false), 'url' => $archive_link ];
        }
    }

    if (is_page()) {
        $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
        foreach ($ancestors as $ancestor_id) {
            $crumbs[] = [ 'label' => get_the_title($ancestor_id), 'url' => get_permalink($ancestor_id) ];
        }
    }

    $crumbs[] = [ 'label' => get_the_title(), 'url' => '' ];
}

$last = count($crumbs) - 1;
?>
<nav class="breadcrumb-trail" aria-label="<?php esc_attr_e('Breadcrumb', 'laca'); ?>">
    <?php foreach ($crumbs as $i => $crumb) : ?>
        <?php if ($i > 0) : ?>
            <span class="breadcrumb-trail__sep" aria-hidden="true">&gt;</span>
        <?php endif; ?>
        <?php if (!empty($crumb['url']) && $i !== $last) : ?>
            <a href="<?php echo esc_url($crumb['url']); ?>" class="breadcrumb-trail__link"><?php echo esc_html($crumb['label']); ?></a>
        <?php else : ?>
            <span class="breadcrumb-trail__current"<?php echo $i === $last ? ' aria-current="page"' : ''; ?>><?php echo esc_html($crumb['label']); ?></span>
        <?php endif; ?>
    <?php endforeach; ?>
</nav>
