<script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/app.min.js') }}"></script>


<!-- Datatables js -->
<script src="{{ asset('backend/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('backend/assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>

@stack('checkall')

<!-- demo app -->
<script src="{{ asset('backend/assets/js/pages/demo.dashboard-crm.js') }}"></script>

@stack('script')
