<div id="paypal-button-container"></div>
<script
    src="https://www.paypal.com/sdk/js?client-id=AcU44R-o3pZ2gQGfZt-UgpWCXE0O-HmlGirXcXtkxTbMXf6P6WAK45uhZ9lkHSNPSVKQ8TCbRI5lea7u&currency=GBP"
    data-sdk-integration-source="button-factory">
</script>
<script>
paypal.Buttons({
    style: {
        shape: 'rect',
        color: 'gold',
        layout: 'vertical',
        label: 'paypal',

    },
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '1'
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            window.location.replace("./success.php");
        });
    }
}).render('#paypal-button-container');
</script>