<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if ($cart_payment_method->payment_option == "stripe") :
    $data = new stdClass();
    $data->currency = $currency;
    $data->total_amount = $total_amount;
    $data->payment_type = $mds_payment_type;
    $this->session->set_userdata('mds_stripe_cart', $data);
    //if JPY
    if ($currency == "JPY") {
        $data->total_amount = $total_amount / 100;
    } ?>
    <div class="row">
        <div class="col-12">
            <?php $this->load->view('product/_messages'); ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 stripe-checkout">
            <form id="payment-form">
                <div class="form-group text-center">
                    <label class="payment-icons">
                        <img src="<?php echo base_url(); ?>assets/img/payment/visa.svg" alt="visa">
                        <img src="<?php echo base_url(); ?>assets/img/payment/mastercard.svg" alt="mastercard">
                        <img src="<?php echo base_url(); ?>assets/img/payment/amex.svg" alt="amex">
                        <img src="<?php echo base_url(); ?>assets/img/payment/stripe.svg" alt="stripe">
                    </label>
                </div>
                <div class="form-group">
                    <input type="text" name="name" id="sp_input_name" class="form-control shadow-sm" placeholder="<?= trans("full_name"); ?>">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="sp_input_email" class="form-control shadow-sm" placeholder="<?= trans("email"); ?>">
                </div>
                <div class="form-group">
                    <div id="card-element" class="form-control input-card-element shadow-sm"></div>
                </div>
                <button id="submit" class="btn btn-primary">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <?= trans("pay"); ?>&nbsp;<?= price_formatted($total_amount, $currency); ?>
                </button>
            </form>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('<?= $this->payment_settings->stripe_publishable_key; ?>');
        var elements = stripe.elements();
        var style = {
            base: {
                color: "#32325d",
                lineHeight: '38px',
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            },
        };
        var cardElement = elements.create('card', {
            style: style
        });
        cardElement.mount('#card-element');
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var validation = true;
            var buyer_name = $("#sp_input_name").val();
            var buyer_email = $("#sp_input_email").val();

            if (buyer_name == null || buyer_name.trim() < 2) {
                $("#sp_input_name").addClass("is-invalid");
                return false;
            } else {
                $("#sp_input_name").removeClass("is-invalid");
            }
            if (buyer_email == null || buyer_email.trim() < 2) {
                $("#sp_input_email").addClass("is-invalid");
                return false;
            } else {
                $("#sp_input_email").removeClass("is-invalid");
            }
            stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
                billing_details: {
                    name: buyer_name,
                    email: buyer_email
                },
            }).then(stripePaymentMethodHandler);
        });

        function stripePaymentMethodHandler(result) {
            if (!result.error) {
                $('.stripe-checkout #submit').prop("disabled", true);
                $('.stripe-checkout .spinner-border').css('display', 'inline-block');

                fetch(base_url + 'stripe-payment-post', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        payment_method_id: result.paymentMethod.id,
                        mds_payment_type: "<?= $mds_payment_type; ?>",
                        "sys_lang_id": sys_lang_id
                    })
                }).then(function(result) {
                    result.json().then(function(json) {
                        if (json.result == 1) {
                            window.location.href = json.redirect_url;
                        } else {
                            location.reload();
                        }
                    });
                });
            }
        }

        $(document).on("input keyup paste change", "#payment-form input", function() {
            var val = $(this).val();
            if (val == null || val.trim() < 2) {
                $(this).addClass("is-invalid");
            } else {
                $(this).removeClass("is-invalid");
            }
        });
    </script>
<?php endif; ?>