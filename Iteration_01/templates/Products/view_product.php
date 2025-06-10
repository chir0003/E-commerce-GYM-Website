<div class="container mt-5">
    <!-- Product -->
    <div class="list-group-item">
        <a href="<?= $this->Url->build(['action' => 'shop']) ?>" class="btn btn-warning">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>
    <br>
    <div class="card shadow-sm mb-4">
        <div class="card-header text-black d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><?= h($product->name) ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="<?= h($product->image_url) ?>" alt="<?= h($product->name) ?>" class="img-fluid rounded shadow" style="max-height: 300px;">
                </div>
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Description:</strong> <?= h($product->description) ?></li>
                        <li class="list-group-item"><strong>Retail Price:</strong> $<?= number_format($product->retail_price, 2) ?></li>
                        <?php if (!empty($product->discount_percent)): ?>
                            <li class="list-group-item"><strong>Discount:</strong> <?= h($product->discount_percent) ?>%</li>
                        <?php endif; ?>
                        <li class="list-group-item"><strong>Availability:</strong>
                            <?php if ($product->stock > 0): ?>
                                <span class="text-success">In stock</span>
                            <?php else: ?>
                                <span class="text-danger">Out of stock</span>
                            <?php endif; ?>
                        </li>
                    </ul>
                    <div class="mt-4">
                        <?= $this->Form->create(null, ['url' => ['controller' => 'Orders', 'action' => 'cart']]) ?>
                        <?= $this->Form->hidden('product_id', ['value' => $product->id]) ?>
                        <div class="mb-3">
                            <label for="quantity" class="form-label"><strong>Quantity:</strong></label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?= h($product->stock ?? 99) ?>" class="form-control w-50" <?= $product->stock <= 0 ? 'disabled' : '' ?> />
                        </div>
                        <button type="submit" class="btn btn-success" <?= $product->stock <= 0 ? 'disabled' : '' ?>>
                            <?= $product->stock <= 0 ? 'Out of Stock' : 'Add to Cart' ?>
                        </button>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-4">
        <!-- Review Button -->
        <button class="btn btn-yellow mt-4" data-bs-toggle="modal" data-bs-target="#reviewModal">Leave a Review</button>

        <!-- Review Modal -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalLabel">Submit a Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= $this->Form->create(null, ['url' => ['controller' => 'Reviews', 'action' => 'add', $product->id]]) ?>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Your Rating</label>
                            <div class="star-rating d-flex">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fa fa-star star" data-value="<?= $i ?>" style="font-size: 24px; cursor: pointer; color: #ddd;"></i>
                                <?php endfor; ?>
                                <input type="hidden" name="rating" id="rating" value="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <?= $this->Form->control('review_text', ['label' => 'Your Review', 'type' => 'textarea', 'class' => 'form-control']) ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <?= $this->Form->button('Submit Review', ['class' => 'btn btn-yellow', 'id' => 'submitReviewBtn', 'disabled' => 'disabled']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>



    <!-- Reviews Section -->
    <?php if (!empty($reviews)) : ?>
        <h4 class="mt-4">Reviews</h4>
        <ul class="list-group mb-4">
            <?php foreach ($reviews as $review): ?>
                <li class="list-group-item mb-3">
                    <strong class="text-primary" id="review-author-<?= $review->id ?>"></strong>
                    <div class="star-display mb-2">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fa fa-star <?= ($i <= $review->rating) ? 'text-warning' : 'text-muted' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <p><?= h($review->review_text) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>



    <!-- JavaScript for Stars and Random Names -->
    <!-- JavaScript for Stars and Random Names -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating .star');
            const submitButton = document.getElementById('submitReviewBtn');
            const reviewText = document.querySelector('textarea[name="review_text"]');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-value');
                    document.getElementById('rating').value = rating;
                    stars.forEach(s => s.style.color = '#ddd');
                    for (let i = 0; i < rating; i++) {
                        stars[i].style.color = '#ffc107';
                    }
                    checkFormValidity();
                });
            });

            reviewText.addEventListener('input', checkFormValidity);

            function checkFormValidity() {
                const rating = document.getElementById('rating').value;
                const review = reviewText.value.trim();

                // Enable the submit button if both rating and review text are valid
                if (rating > 0 && review.length > 0) {
                    submitButton.removeAttribute('disabled');
                } else {
                    submitButton.setAttribute('disabled', 'disabled');
                }
            }

            // Generate random names for reviews
            document.querySelectorAll('[id^=review-author-]').forEach(authorElement => {
                authorElement.innerText = generateRandomName();
            });
        });

        function generateRandomName() {
            const initials = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const randomInitial = initials.charAt(Math.floor(Math.random() * initials.length));
            return `Anonymous ${randomInitial}.`;
        }
    </script>
<!-- style -->
<style>
    .btn-yellow {
        background-color: #ffc107;
        color: black;
        font-weight: bold;
        border: none;
    }

    .btn-yellow:hover {
        background-color: #e0a800;

        .btn-yellow {
        background-color: #ffc107;
        color: black;
        font-weight: bold;
        text-transform: uppercase;
        border: none;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .btn-yellow:hover {
        background-color: #e0a800;
        color: black;
    }

    .btn-outline-secondary {
        font-weight: bold;
    }

    .card-header.bg-black {
        background-color: #000 !important;
        color: white !important;
    }

    .list-group-item {
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .list-group-item {
            font-size: 14px;
        }

        .btn {
            font-size: 13px;
            padding: 6px 10px;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    }
</style>
