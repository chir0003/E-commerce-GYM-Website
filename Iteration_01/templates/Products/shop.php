<section id="collection-1602">
    <div class="cs-container">
        <div class="cs-content">
            <h2 class="cs-title">Our Collection</h2>
            <div class="cs-button-group">
                <?= $this->Html->link('New Arrival', ['?' => ['filter' => 'new']], ['class' => 'cs-button']) ?>
                <?= $this->Html->link('Discounted', ['?' => ['filter' => 'discount']], ['class' => 'cs-button']) ?>
                <?= $this->Html->link('Best Seller', ['?' => ['filter' => 'bestseller']], ['class' => 'cs-button']) ?>
            </div>
            <div class="cs-category-dropdown">
                <label for="categoryFilter" class="form-label">Filter by Category:</label>
                <select id="categoryFilter" class="form-select" onchange="onCategoryChange(this)">
                    <option value="all">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= h($category->id) ?>"
                            <?= $this->request->getQuery('category') == $category->id ? 'selected' : '' ?>>
                            <?= h($category->category) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="cs-listing-wrapper">
            <div class="cs-listing" data-category="one">
                <?php if ($products->count() === 0): ?>
                    <p class="cs-no-products">No products available in this category.</p>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <?php if ($product->stock == 0) continue; ?>
                        <div class="cs-item">
                            <a href="<?= $this->Url->build(['action' => 'viewProduct', $product->id]) ?>" class="cs-link">
                                <div class="cs-picture-group">
                                    <picture class="cs-picture">
                                        <source media="(max-width: 600px)" srcset="<?= h($product->image_url ?: '/img/default-product.png') ?>">
                                        <source media="(min-width: 601px)" srcset="<?= h($product->image_url ?: '/img/default-product.png') ?>">
                                        <img loading="lazy" decoding="async"
                                             src="<?= h($product->image_url ?: '/img/default-product.png') ?>"
                                             alt="<?= h($product->name) ?>" width="305" height="400">
                                    </picture>
                                    <?php if (!empty($product->discount_percent)): ?>
                                        <span class="cs-offer">-<?= h($product->discount_percent) ?>%</span>
                                    <?php endif; ?>
                                </div>
                                <div class="cs-details">
                                    <span class="cs-category"><?= h($product->product_category->category ?? 'Uncategorized') ?></span>
                                    <h3 class="cs-name"><?= h($product->name) ?></h3>
                                    <div class="cs-actions">
                                        <div class="cs-flex">
                                            <span class="cs-price">$<?= h($product->retail_price) ?></span>
                                            <?php if (!empty($product->discount_percent)): ?>
                                                <span class="cs-was-price">$<?= h($product->wholesale_price) ?></span>
                                            <?php endif; ?>
                                            <div class="cs-stars">
                                                <div class="star-rating">
                                                    <?php
                                                    $averageRating = $product->average_rating ?? 0;
                                                    for ($i = 1; $i <= 5; $i++): ?>
                                                        <span class="star <?= $i <= $averageRating ? 'filled' : '' ?>">★</span>
                                                    <?php endfor; ?>
                                                    </div>
                                                    <span class="cs-review-count">
                                                    (<?= h($product->total_reviews ?? 0) ?>)
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>


        <!-- Pagination -->
        <div class="paginator mt-4">
            <ul class="pagination justify-content-center">
                <?= $this->Paginator->first('<<', ['class' => 'page-link']) ?>
                <?= $this->Paginator->prev('<', ['class' => 'page-link']) ?>
                <?= $this->Paginator->numbers(['class' => 'page-link']) ?>
                <?= $this->Paginator->next('>', ['class' => 'page-link']) ?>
                <?= $this->Paginator->last('>>', ['class' => 'page-link']) ?>
            </ul>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.cs-stars').forEach(starContainer => {
            const averageRating = parseFloat(starContainer.getAttribute('data-average-rating')) || 0;
            const stars = starContainer.querySelectorAll('.cs-star');

            stars.forEach((star, index) => {
                if (index < averageRating) {
                    star.style.color = '#ffc107'; // Filled star color
                } else {
                    star.style.color = '#ddd'; // Empty star color
                }
            });
        });
    });
</script>

<script>
    class GalleryFilter {
        filtersSelector = ".cs-button";
        imagesSelector = ".cs-listing";
        activeClass = "cs-active";
        hiddenClass = "cs-hidden";

        constructor() {
            const $filters = document.querySelectorAll(this.filtersSelector);
            this.$activeFilter = $filters[0];
            this.$images = document.querySelectorAll(this.imagesSelector);
            this.$activeFilter.classList.add(this.activeClass);

            for (const $filter of $filters) {
                $filter.addEventListener("click", () => this.onClick($filter));
            }
        }

        onClick($filter) {
            this.filter($filter.dataset.filter);
            this.$activeFilter.classList.remove(this.activeClass);
            $filter.classList.add(this.activeClass);
            this.$activeFilter = $filter;
        }

        filter(filter) {
            const showAll = filter == "all";
            for (const $image of this.$images) {
                const show = showAll || $image.dataset.category == filter;
                $image.classList.toggle(this.hiddenClass, !show);
            }
        }
    }

    new GalleryFilter();

    function onCategoryChange(select) {
        const selectedCategory = select.value;
        const urlParams = new URLSearchParams(window.location.search);

        if (selectedCategory === "all") {
            urlParams.delete("category");
        } else {
            urlParams.set("category", selectedCategory);
        }

        const newUrl = window.location.pathname + "?" + urlParams.toString();
        window.location.href = newUrl;
    }
</script>

<style>
    .star-rating {
        display: inline-block;
        font-size: 18px; /* Smaller star size */
        color: #ddd; /* Default empty star color */
    }

    .star-rating .star {
        cursor: pointer;
        transition: color 0.2s;
        color: #ddd; /* Empty star color */
    }

    .star-rating .star.filled {
        color: #ffc107; /* Filled star color (yellow) */
    }

    .cs-review-count {
        font-size: 16px; /* Increased font size for review count */
        color: #42474c; /* Gray color for review count */
        margin-left: 8px;
        vertical-align: baseline; /* Moves it down slightly */

    }
</style>
<style>
    :root {
        --primary: #ffc107;
        --primaryLight: #ffc107;
        --secondary: #ffc107;
        --secondaryLight: #ffc107;
        --headerColor: #1a1a1a;
        --bodyTextColor: #4e4b66;
        --bodyTextColorWhite: #fafbfc;
        /* 13px - 16px */
        --topperFontSize: clamp(0.8125rem, 1.6vw, 1rem);
        /* 31px - 49px */
        --headerFontSize: clamp(1.9375rem, 3.9vw, 3.0625rem);
        --bodyFontSize: 1rem;
        /* Adjusted padding: Reduced top padding to remove excess space */
        --sectionPadding: clamp(1rem, 2vw, 2rem) 1rem;
    }

    body {
        margin: 0;
        padding: 0;
    }

    *, *:before, *:after {
        box-sizing: border-box;
    }

    .cs-topper {
        font-size: var(--topperFontSize);
        line-height: 1.2em;
        text-transform: uppercase;
        text-align: inherit;
        letter-spacing: .1em;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 0.25rem;
        display: block;
    }

    .cs-title {
        font-size: var(--headerFontSize);
        font-weight: 900;
        line-height: 1.2em;
        text-align: inherit;
        max-width: 43.75rem;
        margin: 0 0 1rem 0;
        color: var(--headerColor);
        position: relative;
    }

    .cs-text {
        font-size: var(--bodyFontSize);
        line-height: 1.5em;
        text-align: inherit;
        width: 100%;
        max-width: 40.625rem;
        margin: 0;
        color: var(--bodyTextColor);


    }

    /*-- -------------------------- -->
<---        Collection          -->
<--- -------------------------- -*/

    /* Mobile - 360px */
    @media only screen and (min-width: 0rem) {

        #collection-1602 .cs-category-dropdown {
            margin-top: 1rem;
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #collection-1602 .cs-category-dropdown .form-select {
            width: 200px;
            padding: 0.5rem;
            font-size: 1rem;
        }

        #collection-1602 {
            padding: var(--sectionPadding);
        }
        #collection-1602 .cs-container {
            width: 100%;
            max-width: 80rem;
            margin: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* 48px - 64px */
            gap: clamp(3rem, 6vw, 4rem);
            position: relative;
            z-index: 1;
        }
        #collection-1602 .cs-content {
            text-align: center;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }
        #collection-1602 .cs-title {
            margin: 0;
        }
        #collection-1602 .cs-button-group {
            margin: 0;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            /* 16px - 32px */
            gap: clamp(1rem, 4vw, 2rem);
        }
        #collection-1602 .cs-button {
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.2em;
            text-transform: uppercase;
            padding: 0;
            color: var(--bodyTextColor);
            background-color: transparent;
            border: none;
            position: relative;
            transition: color 0.3s;
        }
        #collection-1602 .cs-button:before {
            content: "";
            width: 0;
            height: 1px;
            background: var(--primary);
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            transition: width 0.3s;
        }
        #collection-1602 .cs-button:hover {
            color: var(--primary);
            cursor: pointer;
        }
        #collection-1602 .cs-button:hover:before {
            width: 100%;
        }
        #collection-1602 .cs-button.cs-active {
            color: var(--primary);
        }
        #collection-1602 .cs-button.cs-active:before {
            width: 100%;
        }
        #collection-1602 .cs-listing-wrapper {
            width: 100%;
            position: relative;
            z-index: 1;
        }
        .cs-no-products {
            padding: 1rem;
            font-size: 1.2rem;
            color: #666;
            text-align: center;
        }

        #collection-1602 .cs-listing {
            width: 100%;
            margin: 0;
            padding: 0;
            display: grid;
            justify-items: center;
            grid-auto-flow: row;
            /* 16px - 20px */
            gap: clamp(1rem, 1.5vw, 1.25rem);
            position: relative;
            transform-style: preserve-3d;
            perspective: 700px;
            transition: transform 0.7s, opacity 0.3s, visibility 0.5s, top 0.3s, left 0.3s;
            /* makes the transform scaling origin the top left corner, dictates the direction by which the scale transforms animate towards */
            transform-origin: left top;
        }
        #collection-1602 .cs-listing.cs-hidden {
            /* hidden galleries have a 0 opacity, and we animate the opacity to 1 when they become active */
            opacity: 0;
            /* by using visibility:hidden instead of display:none, we can see the animations from the opacity and transforms, display:none won't render animations. */
            visibility: hidden;
            position: absolute;
            /* this top and left value help control the animation, by setting it to position absolute and left 0, the gallery won't fly off screen to the left, it will stop its position to be at the left edge of the .cs-container (left: 0). Same for the top:0 value, the gallery won't go past that position when it animates */
            top: 0;
            left: 0;
            /* prevents the hidden galleries from overflowing the section, and makes a nice animations to transition to and from */
            transform: scaleY(0) scaleX(0);
            /* prevents the mouse from interacting with it */
            pointer-events: none;
        }
        #collection-1602 .cs-listing.cs-hidden .cs-image {
            opacity: 0;
            /* when gallery is hidden, add these styles to the cs-image to animate from when cs-hidden is removed from the .cs-gallery */
            transform: translateY(2.1875rem) rotateX(90deg);
        }
        #collection-1602 .cs-listing.cs-hidden .cs-item {
            transform: rotateY(180deg);
            opacity: 0;
        }
        #collection-1602 .cs-item {
            width: 100%;
            max-width: 23.4375rem;
            /* overwrites the default 'min-width: auto' value, keeping all grid items the same width no matter what*/
            min-width: 0;
            opacity: 1;
            padding: 1rem;
            border: 1px solid #e8e8e8;
            transform: rotateY(0);
            transition: transform 0.7s, opacity 0.3s;
        }
        #collection-1602 .cs-item:nth-of-type(1) {
            transition-delay: 0.1s;
        }
        #collection-1602 .cs-item:nth-of-type(2) {
            transition-delay: 0.2s;
        }
        #collection-1602 .cs-item:nth-of-type(3) {
            transition-delay: 0.3s;
        }
        #collection-1602 .cs-item:nth-of-type(4) {
            transition-delay: 0.4s;
        }
        #collection-1602 .cs-item:nth-of-type(5) {
            transition-delay: 0.5s;
        }
        #collection-1602 .cs-item:nth-of-type(6) {
            transition-delay: 0.6s;
        }
        #collection-1602 .cs-item:nth-of-type(7) {
            transition-delay: 0.7s;
        }
        #collection-1602 .cs-item:nth-of-type(8) {
            transition-delay: 0.8s;
        }
        #collection-1602 .cs-item:nth-of-type(9) {
            transition-delay: 0.1s;
        }
        #collection-1602 .cs-item:nth-of-type(10) {
            transition-delay: 0.1s;
        }
        #collection-1602 .cs-item:nth-of-type(11) {
            transition-delay: 0.1s;
        }
        #collection-1602 .cs-item:nth-of-type(12) {
            transition-delay: 0.1s;
        }
        #collection-1602 .cs-link {
            text-decoration: none;
        }
        #collection-1602 .cs-link:hover .cs-picture img {
            transform: scale(1.1);
        }
        #collection-1602 .cs-picture-group {
            width: auto;
            height: 18.75rem;
            margin-bottom: 1.25rem;
            position: relative;
        }
        #collection-1602 .cs-picture {
            width: 100%;
            height: 100%;
            background-color: #f6f6f6;
            overflow: hidden;
            display: block;
        }
        #collection-1602 .cs-picture img {
            width: 100%;
            height: 100%;
            /* using object-fit contain to keep the entirety of the product image in the frame */
            /* feel free to change this to 'cover', or adjust the background-color above if you have consistent backgrounds on your products */
            object-fit: contain;
            transition: transform 0.6s;
        }
        #collection-1602 .cs-offer {
            font-size: 0.8125rem;
            font-weight: 700;
            line-height: 1.2em;
            text-transform: uppercase;
            letter-spacing: 1.3px;
            padding: 0.375rem;
            color: #fff;
            background: #ff4747;
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
        }
        #collection-1602 .cs-category {
            font-size: 1rem;
            line-height: 1.5em;
            color: #767676;
        }
        #collection-1602 .cs-name {
            /* 20px - 25px */
            font-size: clamp(1.25rem, 1vw, 1.5625rem);
            font-weight: 700;
            line-height: 1.2em;
            text-overflow: ellipsis;
            white-space: nowrap;
            width: 100%;
            margin: 0;
            color: var(--headerColor);
            overflow: hidden;
        }
        #collection-1602 .cs-actions {
            margin-top: 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #collection-1602 .cs-price {
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 1.2em;
            color: var(--secondary);
        }
        #collection-1602 .cs-was-price {
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.2em;
            text-decoration: line-through;
            color: #767676;
        }
        #collection-1602 .cs-stars {
            margin-top: 0.25rem;
            display: flex;
        }
        #collection-1602 .cs-star {
            width: 1.25rem;
            height: 1.25rem;
        }
        #collection-1602 .cs-buy {
            max-height: 2.5rem;
            padding: 0.5rem;
            background: none;
            border: 2px solid var(--primary);
            border-radius: 0.25rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #collection-1602 .cs-basket {
            width: 1.5rem;
            height: auto;
        }
    }
    /* Tablet - 768px */
    @media only screen and (min-width: 48rem) {
        #collection-1602 .cs-content {
            flex-direction: row;
            justify-content: space-between;
        }
        #collection-1602 .cs-listing {
            grid-template-columns: repeat(3, 1fr);
        }
        #collection-1602 .cs-item {
            max-width: none;
        }
        #collection-1602 .cs-picture-group {
            /* 200px - 320px */
            height: clamp(12.5rem, 23vw, 20rem);
        }
    }

</style>
