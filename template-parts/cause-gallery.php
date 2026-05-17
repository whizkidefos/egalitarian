<?php
/**
 * Template part: Cause gallery with lightbox
 * File: wp-content/themes/egalitarian-association/template-parts/cause-gallery.php
 *
 * Displays a photo gallery for causes with a lightbox modal.
 */

$gallery_ids = get_post_meta( get_the_ID(), '_ea_cause_gallery_ids', true );
if ( ! $gallery_ids ) return;

$ids = array_filter( array_map( 'intval', explode( ',', $gallery_ids ) ) );
if ( empty( $ids ) ) return;
?>

<section class="ea-cause-gallery py-12" aria-labelledby="gallery-heading">
    <h2 id="gallery-heading" class="text-navy font-bold text-2xl mb-6"><?php esc_html_e( 'Photo Gallery', 'egalitarian' ); ?></h2>
    
    <!-- Gallery grid with lightbox links -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
        <?php foreach ( $ids as $image_id ) :
            $thumb = wp_get_attachment_image_url( $image_id, 'ea-card' );
            $full  = wp_get_attachment_image_url( $image_id, 'full' );
            $alt   = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        ?>
        <a href="<?php echo esc_url( $full ); ?>"
           class="ea-gallery-item group relative overflow-hidden rounded-lg aspect-square shadow-card hover:shadow-card-hover transition-all"
           data-lightbox="cause-gallery"
           aria-label="<?php echo esc_attr( $alt ?: __( 'Gallery image', 'egalitarian' ) ); ?>">
            <img src="<?php echo esc_url( $thumb ); ?>" 
                 alt="<?php echo esc_attr( $alt ); ?>"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-navy/0 group-hover:bg-navy/40 transition-colors flex items-center justify-center">
                <span class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity"><?php echo ea_icon( 'arrow' ); ?></span>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<style>
/* Simple lightbox styles */
.ea-lightbox {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    z-index: 9999;
    padding: 20px;
}
.ea-lightbox.active {
    display: flex;
    align-items: center;
    justify-content: center;
}
.ea-lightbox-content {
    position: relative;
    max-width: 90vw;
    max-height: 90vh;
}
.ea-lightbox-content img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
.ea-lightbox-close {
    position: absolute;
    top: -40px;
    right: 0;
    color: white;
    font-size: 32px;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
}
.ea-lightbox-prev,
.ea-lightbox-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: none;
    padding: 15px 20px;
    font-size: 24px;
    cursor: pointer;
    transition: background 0.2s;
}
.ea-lightbox-prev:hover,
.ea-lightbox-next:hover {
    background: rgba(255, 255, 255, 0.4);
}
.ea-lightbox-prev {
    left: -60px;
}
.ea-lightbox-next {
    right: -60px;
}
@media (max-width: 640px) {
    .ea-lightbox-prev,
    .ea-lightbox-next {
        display: none;
    }
    .ea-lightbox-close {
        top: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('[data-lightbox="cause-gallery"]');
    if (!items.length) return;

    let currentIndex = 0;
    const lightbox = document.createElement('div');
    lightbox.className = 'ea-lightbox';
    lightbox.innerHTML = `
        <div class="ea-lightbox-content">
            <button class="ea-lightbox-close" aria-label="Close">×</button>
            <img src="" alt="" class="ea-lightbox-img">
            <button class="ea-lightbox-prev" aria-label="Previous">❮</button>
            <button class="ea-lightbox-next" aria-label="Next">❯</button>
        </div>
    `;
    document.body.appendChild(lightbox);

    const img = lightbox.querySelector('.ea-lightbox-img');
    const closeBtn = lightbox.querySelector('.ea-lightbox-close');
    const prevBtn = lightbox.querySelector('.ea-lightbox-prev');
    const nextBtn = lightbox.querySelector('.ea-lightbox-next');

    items.forEach((item, index) => {
        item.addEventListener('click', e => {
            e.preventDefault();
            currentIndex = index;
            showImage();
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    function showImage() {
        const href = items[currentIndex].getAttribute('href');
        img.src = href;
        img.alt = items[currentIndex].getAttribute('aria-label') || 'Gallery image';
    }

    closeBtn.addEventListener('click', () => {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    });

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + items.length) % items.length;
        showImage();
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % items.length;
        showImage();
    });

    lightbox.addEventListener('click', e => {
        if (e.target === lightbox) {
            closeBtn.click();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', e => {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape') closeBtn.click();
        if (e.key === 'ArrowLeft') prevBtn.click();
        if (e.key === 'ArrowRight') nextBtn.click();
    });
});
</script>
