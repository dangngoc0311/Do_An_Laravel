<div class="clearfix"></div>
<!-- Footer -->
<footer class="site-footer">
    <div class="footer-inner bg-white">
        <div class="row">
            <div class="col-sm-6">
                Copyright &copy; 2018 Ela Admin
            </div>
            <div class="col-sm-6 text-right">
                Designed by <a href="#">Colorlib</a>
            </div>
        </div>
    </div>
</footer>
<!-- /.site-footer -->
</div>
<!-- /#right-panel -->

<!-- Scripts -->
{{-- <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> --}}

<script src="{{ url('backend') }}/js/jquery.min.js"></script>
<script type="text/javascript" src="{{ url('ckeditor') }}/ckeditor.js"></script>

<script src="{{ url('backend') }}/js/popper.min.js"></script>
<script src="{{ url('backend') }}/js/bootstrap.min.js"></script>
<script src="{{ url('backend') }}/js/jquery.matchHeight.min.js"></script>
<script src="{{ url('backend') }}/js/main.js"></script>

<!--  Chart js -->
<script src="{{ url('backend') }}/js/Chart.bundle.min.js"></script>

<!--Chartist Chart-->
<script src="{{ url('backend') }}/js/chartist.min.js"></script>
<script src="{{ url('backend') }}/js/chartist-plugin-legend.min.js"></script>

<script src="{{ url('backend') }}/js/jquery.flot.min.js"></script>
<script src="{{ url('backend') }}/js/jquery.flot.pie.min.js"></script>
<script src="{{ url('backend') }}/js/jquery.flot.spline.min.js"></script>

{{-- <script src="{{ url('backend') }}/js/jquery.simpleWeather.min.js"></script> --}}


<script src="{{ url('backend') }}/js/moment.min.js"></script>
<script src="{{ url('backend') }}/js/fullcalendar.min.js"></script>
<script src="{{ url('backend') }}/js/fullcalendar-init.js"></script>
<script src="{{ url('backend') }}/js/toastr.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
{!! Toastr::message() !!}
@yield('js')
</body>


</html>
