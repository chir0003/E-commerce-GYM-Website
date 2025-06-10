const stripe = Stripe('pk_test_51RMHU4PwQ8uNzZNslOJL6WNOKQa0VSq94BPYEGggHh7H1JkB57zi89Q8HJS6JzG8mEAuSbRluuzTkHO0w7fUZpTl00AOKYdIoz');
let elements = null;

document.addEventListener('DOMContentLoaded', async () => {
    await initializeStripe();

    const orderForm = document.querySelector('form');
    if (!orderForm) return console.error('Order form not found');

    orderForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (!validateCustomerForm()) return;

        const loadingIndicator = document.getElementById('loading-indicator');
        const submitButton = document.getElementById('submit-button');
        loadingIndicator.style.display = 'block';
        submitButton.disabled = true;

        try {
            const paymentResult = await confirmStripePayment();

            if (paymentResult.error) {
                showError(paymentResult.error.message);
                return;
            }

            //  Only submit order if Stripe payment succeeded
            if (paymentResult.paymentIntent && paymentResult.paymentIntent.status === 'succeeded') {
                await submitOrder(paymentResult.paymentIntent.id);
            } else {
                showError('Payment was not successful. Please try again.');
            }

        } catch (err) {
            showError('Unexpected error: ' + err.message);
        } finally {
            loadingIndicator.style.display = 'none';
            submitButton.disabled = false;
        }
    });
});

async function initializeStripe() {
    try {
        const csrfToken = document.querySelector('meta[name="csrfToken"]').content;

        const response = await fetch(STRIPE_CHECKOUT_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken
            },
            body: JSON.stringify({ amount: CART_TOTAL })
        });

        const data = await response.json();

        if (!data.clientSecret) throw new Error('No client secret returned');

        elements = stripe.elements({
            clientSecret: data.clientSecret,
            appearance: { theme: 'stripe' }
        });

        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

    } catch (err) {
        showError(`Stripe init error: ${err.message}`);
    }
}

async function confirmStripePayment() {
    try {
        const { error, paymentIntent } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: THANK_YOU_URL,
            },
            redirect: 'if_required'
        });

        if (error) return { error };

        if (!paymentIntent || paymentIntent.status !== 'succeeded') {
            return {
                error: {
                    message: `Payment failed: ${paymentIntent?.last_payment_error?.message || paymentIntent?.status || 'Unknown error'}`
                }
            };
        }

        return { paymentIntent };

    } catch (err) {
        console.error('Stripe payment error:', err);
        return { error: { message: 'Stripe JS error: ' + err.message } };
    }
}

async function submitOrder(paymentIntentId) {
    const formData = {
        name: document.getElementById('name').value.trim(),
        email: document.getElementById('email').value.trim(),
        address: document.getElementById('address').value.trim(),
        delivery_method: document.getElementById('delivery-method').value,
        payment_intent_id: paymentIntentId
    };

    try {
        const csrfToken = document.querySelector('meta[name="csrfToken"]').content;
        if (!csrfToken) {
            throw new Error('CSRF token not found');
        }

        console.log('Submitting order to:', PLACE_ORDER_URL);
        const response = await fetch(PLACE_ORDER_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        console.log('Response status:', response.status);
        console.log('Response headers:', Object.fromEntries(response.headers.entries()));

        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            const text = await response.text();
            console.error('Non-JSON response:', text);
            throw new Error('Server returned non-JSON response');
        }

        const data = await response.json();
        console.log('Response data:', data);

        if (!response.ok) {
            throw new Error(data.message || 'Order saving failed');
        }

        if (data.success) {
            console.log('Redirecting to:', THANK_YOU_URL + '?success=1');
            window.location.href = THANK_YOU_URL + '?success=1';
        } else {
            throw new Error(data.message || 'Order saving failed');
        }

    } catch (err) {
        console.error('Order submission error:', err);
        showError('Unexpected error saving order: ' + err.message);
    }
}

function validateCustomerForm() {
    let isValid = true;

    ['name', 'email', 'address', 'delivery-method'].forEach(id => {
        const input = document.getElementById(id);
        if (!input || !input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });

    return isValid;
}

function showError(message) {
    let messageContainer = document.getElementById('payment-message');
    if (!messageContainer) {
        messageContainer = document.createElement('div');
        messageContainer.id = 'payment-message';
        messageContainer.className = 'alert alert-danger mt-3';
        document.getElementById('checkout-container').appendChild(messageContainer);
    }

    messageContainer.className = 'alert alert-danger mt-3';
    messageContainer.textContent = message;
}
