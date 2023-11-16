    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('admin/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('admin/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Add event listener to radio buttons
        const roundtripOption = document.getElementById('roundtripOption');
        const roundtripContent = document.getElementById('roundtripContent');
        const onewayOption = document.getElementById('onewayOption');
        const onewayContent = document.getElementById('onewayContent');


        if(onewayOption.checked === true) {
            onewayContent.style.display = 'none';
        } else {
            onewayContent.style.display = 'block';
        }

        roundtripOption.addEventListener('change', () => {
            onewayContent.style.display = 'block';
        });

        onewayOption.addEventListener('change', () => {
            onewayContent.style.display = 'none';
        });
    });
    </script>
    