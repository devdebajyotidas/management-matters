<!-- jQuery -->
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Menu Plugin JavaScript -->
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src=" {{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('assets/js/waves.js') }}"></script>
<!--weather icon -->
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/skycons/skycons.js"></script>
<!--Morris JavaScript -->
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/raphael/raphael-min.js"></script>
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/morrisjs/morris.js"></script>
<!-- jQuery for carousel -->
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/owl.carousel/owl.carousel.min.js"></script>
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/owl.carousel/owl.custom.js"></script>
<!-- Sparkline chart JavaScript -->
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
<!--Counter js -->
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
{{--<script src="{{ asset('assets/js/widget.js') }}"></script>--}}
<!--Style Switcher -->
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/calendar/jquery-ui.min.js"></script>
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/moment/moment.js"></script>
<script src='https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/calendar/dist/fullcalendar.min.js'></script>

{{--<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/calendar/dist/jquery.fullcalendar.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/3.1.6/footable.min.js"></script>
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>

<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->

<!-- Include Froala JS file. -->
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.3/js/froala_editor.min.js'></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js"></script>

<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/tiny-editable/mindmup-editabletable.js"></script>
<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/tiny-editable/numeric-input-example.js"></script>

<script src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/offline-exporting.js"></script>

<script src="{{ asset('assets/js/cbpFWTabs.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
{{--<script src="{{ asset('assets/js/calendar.js') }}"></script>--}}

<script type="text/javascript">

    $(document).ready(function () {
        $('.timeline > li').mouseenter(function () {
            $(this).find('.timeline-badge').addClass('flip').addClass('animated');
        });

        $('.timeline > li').mouseleave(function () {
            var $this = $(this);
            setTimeout(function () {
                $this.find('.timeline-badge').removeClass('flip').removeClass('animated');
            }, 500);
        });

        (function() {

            [].slice.call(document.querySelectorAll('.learning-content .sttabs')).forEach(function(el) {
                new CBPFWTabs(el);
            });

        })();
    });
</script>

@if($page=='awards')
    <script>
        (function() {
            var COLORS, Confetti, NUM_CONFETTI, PI_2, canvas, confetti, context, drawCircle, i, range, resizeWindow, xpos;

            NUM_CONFETTI = 350;

            COLORS = [[85, 71, 106], [174, 61, 99], [219, 56, 83], [244, 92, 68], [248, 182, 70]];

            PI_2 = 2 * Math.PI;

            canvas = document.getElementById("world");

            context = canvas.getContext("2d");

            window.w = 0;

            window.h = 0;

            resizeWindow = function() {
                window.w = canvas.width = window.innerWidth;
                return window.h = canvas.height = window.innerHeight;
            };

            window.addEventListener('resize', resizeWindow, false);

            window.onload = function() {
                return setTimeout(resizeWindow, 0);
            };

            range = function(a, b) {
                return (b - a) * Math.random() + a;
            };

            drawCircle = function(x, y, r, style) {
                context.beginPath();
                context.arc(x, y, r, 0, PI_2, false);
                context.fillStyle = style;
                return context.fill();
            };

            xpos = 0.5;

            document.onmousemove = function(e) {
                return xpos = e.pageX / w;
            };

            window.requestAnimationFrame = (function() {
                return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
                    return window.setTimeout(callback, 1000 / 60);
                };
            })();

            Confetti = (function() {
                function Confetti() {
                    this.style = COLORS[~~range(0, 5)];
                    this.rgb = "rgba(" + this.style[0] + "," + this.style[1] + "," + this.style[2];
                    this.r = ~~range(2, 6);
                    this.r2 = 2 * this.r;
                    this.replace();
                }

                Confetti.prototype.replace = function() {
                    this.opacity = 0;
                    this.dop = 0.03 * range(1, 4);
                    this.x = range(-this.r2, w - this.r2);
                    this.y = range(-20, h - this.r2);
                    this.xmax = w - this.r;
                    this.ymax = h - this.r;
                    this.vx = range(0, 2) + 8 * xpos - 5;
                    return this.vy = 0.7 * this.r + range(-1, 1);
                };

                Confetti.prototype.draw = function() {
                    var ref;
                    this.x += this.vx;
                    this.y += this.vy;
                    this.opacity += this.dop;
                    if (this.opacity > 1) {
                        this.opacity = 1;
                        this.dop *= -1;
                    }
                    if (this.opacity < 0 || this.y > this.ymax) {
                        this.replace();
                    }
                    if (!((0 < (ref = this.x) && ref < this.xmax))) {
                        this.x = (this.x + this.xmax) % this.xmax;
                    }
                    return drawCircle(~~this.x, ~~this.y, this.r, this.rgb + "," + this.opacity + ")");
                };

                return Confetti;

            })();

            confetti = (function() {
                var j, ref, results;
                results = [];
                for (i = j = 1, ref = NUM_CONFETTI; 1 <= ref ? j <= ref : j >= ref; i = 1 <= ref ? ++j : --j) {
                    results.push(new Confetti);
                }
                return results;
            })();

            window.step = function() {
                var c, j, len, results;
                requestAnimationFrame(step);
                context.clearRect(0, 0, w, h);
                results = [];
                for (j = 0, len = confetti.length; j < len; j++) {
                    c = confetti[j];
                    results.push(c.draw());
                }
                return results;
            };

            step();

        }).call(this);
    </script>
    @if($role=='learner')
        <script type="text/javascript">
            (function() {
                window.onload = function() {
                   var flag=$('.award-flag').val();
                   if(flag==='0'){
                       swal('Information', "You haven't recieved any award yet", 'info');
                       return;
                   }
                };
            }).call(this)
        </script>
    @endif

@elseif($page=='cost')
    <script>
        // $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
        // $('#editable-datatable').editableTableWidget().numericInputExample().find('td:first').focus();
        var editor='';
        $(document).ready(function() {

            // editor = new $.fn.dataTable.Editor( {
            //     table: "#mainTable",
            //     fields: [ {
            //         label: "First name:",
            //         name: "first_name"
            //     }, {
            //         label: "Last name:",
            //         name: "last_name"
            //     }, {
            //         label: "Salary:",
            //         name: "salary"
            //     }
            //     ]
            // } );

            $('#mainTable').DataTable( {
                dom: 'Bfrtip',
                columns: [
                    {className: ''},
                    {className: 'editable' },
                    { className: 'editable' },
                    {className: 'editable' },
                    {className:'noteditable'}
                ],
                buttons:[]
            } );
            caltotal();

            $('#editable-datatable').DataTable();
            var table=$('#mainTable').DataTable();

            $('#new-datafield').on('click',function(){
                table.row.add( [
                   'Name',
                    '0',
                    '0',
                    '0',
                    '0'
                ] ).draw(false);
                $('#mainTable').editableTableWidget().numericInputExample();
            });
            $('#mainTable td:nth-child(2),#mainTable td:nth-child(3),#mainTable td:nth-child(4)').change(function(){
                caltotal();
            })
        });
        function caltotal(){
            $('#mainTable tbody tr').each(function(){
                var val1=$(this).find('td:nth-child(2)').html();
                var val2=$(this).find('td:nth-child(3)').html();
                var val3=$(this).find('td:nth-child(4)').html();
                var val4=parseFloat(val1) * parseFloat(val2) * parseFloat(val3);
                $(this).find('td:nth-child(5)').html(val4);
            });
            $('#mainTable').editableTableWidget().numericInputExample();
        }
    </script>
@endif
