<x-app-layout>
    <x-slot name="header">

    </x-slot>

    @push('stylesheets')

        <style>
            canvas {
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }

            .donut-inner {

            }
            .donut-inner .percent {
                font-size: 65px;
                margin-bottom: 3px;
                margin-top: 0;
                font-weight: bolder;
            }
            .donut-inner .percent small{
                font-size: 35px;
                font-weight: bolder;
                font-family: Arial;
            }
            .donut-inner .price {
                margin: 0;
                font-size: 30px;
            }
        </style>
    @endpush


    <div class="container form-builder">

        <div class="row mb-5">

            <div class="col-12 col-lg-11 align-self-center order-2 order-lg-1 my-2 my-lg-0">
                <div class="card shadow form-builder-card border-0 py-2 px-1 px-lg-3">

                    <div class="card-body text-center p-0">

                        <div class="text-center form-builder-header">
                            <img class="img-fluid md-icon mb-3" src="{{asset('img/form-builder/icons/grid.svg')}}"
                                 alt="">
                            <p class="text-primary-light fs-16">Personal Property
                                <a href="">
                                    <img class="img-fluid sm-small-icon"
                                         src="{{asset('img/form-builder/icons/pencil.svg')}}" alt="">
                                </a>
                            </p>
                        </div>

                        @include('form-builders.partials.closing-cost-calc')

                        <div class="form-builder-footer">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3 mb-lg-0 ">
                                    <form action="" class="">
                                        <div class="d-flex justify-content-start">
                                            <div class="form-group align-self-center">
                                                <label for="" class="fs-12">Select Input: </label>
                                                <select name="" id="" class="px-2 px-lg-5 mx-1 border-light ">
                                                    <option value="">Yes - No</option>
                                                    <option value="">Yes - No</option>
                                                    <option value="">Yes - No</option>
                                                </select>
                                            </div>

                                            <div class="align-self-center">
                                                <ul class="list-group list-group-horizontal list-group-flush text-center rounded-3">
                                                    <li class="list-group-item border-0 bg-transparent">
                                                        <a href="#">
                                                            <i class="fa fa-angle-double-down fa-2x text-muted fs-22"
                                                               aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item border-0 bg-transparent">
                                                        <a href="#">
                                                            <i class="fa fa-file-image-o fa-2x text-muted fs-22"
                                                               aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item border-0 bg-transparent">
                                                        <a href="#">
                                                            <i class="fa fa-files-o fa-2x text-muted fs-22"
                                                               aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item border-0 bg-transparent">
                                                        <a href="#">
                                                            <i class="fa fa-trash fa-2x text-muted fs-22"
                                                               aria-hidden="true"></i>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 col-lg-6 mb-3 mb-lg-0  align-self-center">
                                    <form action="" class="">
                                        <div class="d-flex justify-content-start">
                                            <div class="align-self-center mx-3">
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Required </label>
                                                    <input class="form-check-input" type="checkbox"
                                                           id="flexSwitchCheckDefault">
                                                </div>
                                            </div>
                                            <div class="form-group align-self-center">
                                                <select name="" id="" class="px-2 px-lg-5 mx-1 border-light">
                                                    <option value="">Not Categorized</option>
                                                    <option value="">Yes - No</option>
                                                    <option value="">Yes - No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-1 align-self-center pt-5 order-1 order-lg-2 my-2 my-lg-0">
                <div class="form-builder-sidebar-icons">
                    <ul class="list-group list-group-flush bg-white py-3 text-center shadow-lg rounded-3">
                        <li class="list-group-item border-0 px-2">
                            <a href="#">
                                <i class="fa fa-plus-circle text-muted fa-2x" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-group-item border-0 px-2">
                            <a href="#">
                                <i class="fa fa-comment text-muted fa-2x" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-group-item border-0 px-2">
                            <a href="#">
                                <i class="fa fa-file-image-o text-muted fa-2x" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-group-item border-0 px-2">
                            <a href="#">
                                <i class="fa fa-youtube-play text-muted fa-2x" aria-hidden="true"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </div>


    @push('scripts')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://www.chartjs.org/dist/2.7.3/Chart.bundle.js"></script>
        <script src="https://www.chartjs.org/samples/latest/utils.js"></script>


        <script type="text/javascript">

            $(document).ready(function () {

                $(".addMoreMultipleChoiceInput").click(function () {
                    var html = $(".copyRadioButton").html();
                    $(".multipleOptionListing").after(html);
                });

                // $("body").on("click",".remove",function(){
                //     $(this).parents(".control-group").remove();
                // });

                $(".addMoreMultipleCheckBoxInput").click(function () {
                    var html = $(".copyCheckbox").html();
                    $(".multipleCheckBoxListing").after(html);
                });

                $(".addLogicBtn").click(function () {
                    var html = $(".copyLogicList").html();
                    $(".multipleLogicListing").after(html);
                });

            });

        </script>

        {{--    chart js circle--}}
        <script>
            // round corners
            Chart.pluginService.register({
                afterUpdate: function (chart) {
                    for (let i = 1; i < chart.config.data.labels.length; i++) {
                        var arc = chart.getDatasetMeta(0).data[i];
                        arc.round = {
                            x: (chart.chartArea.left + chart.chartArea.right) / 2,
                            y: (chart.chartArea.top + chart.chartArea.bottom) / 2,
                            radius: (chart.outerRadius + chart.innerRadius) / 2,
                            thickness: (chart.outerRadius - chart.innerRadius) / 2 - 1,
                            backgroundColor: arc._model.backgroundColor
                        }
                    }
                    // Draw rounded corners for first item
                    var arc = chart.getDatasetMeta(0).data[0];
                    arc.round = {
                        x: (chart.chartArea.left + chart.chartArea.right) / 2,
                        y: (chart.chartArea.top + chart.chartArea.bottom) / 2,
                        radius: (chart.outerRadius + chart.innerRadius) / 2,
                        thickness: (chart.outerRadius - chart.innerRadius) / 2 - 1,
                        backgroundColor: arc._model.backgroundColor
                    }
                },

                afterDraw: function (chart) {
                    for (let i = 1; i < chart.config.data.labels.length; i++) {
                        var ctx = chart.chart.ctx;
                        arc = chart.getDatasetMeta(0).data[i];
                        var startAngle = Math.PI / 2 - arc._view.startAngle;
                        var endAngle = Math.PI / 2 - arc._view.endAngle;
                        ctx.save();
                        ctx.translate(arc.round.x, arc.round.y);
                        ctx.fillStyle = arc.round.backgroundColor;
                        ctx.beginPath();
                        ctx.arc(arc.round.radius * Math.sin(endAngle), arc.round.radius * Math.cos(endAngle), arc.round.thickness, 0, 2 * Math.PI);
                        ctx.closePath();
                        ctx.fill();
                        ctx.restore();
                    }
                    // Draw rounded corners for first item
                    var ctx = chart.chart.ctx;
                    arc = chart.getDatasetMeta(0).data[0];
                    var startAngle = Math.PI / 2 - arc._view.startAngle;
                    var endAngle = Math.PI / 2 - arc._view.endAngle;
                    ctx.save();
                    ctx.translate(arc.round.x, arc.round.y);
                    ctx.fillStyle = arc.round.backgroundColor;
                    ctx.beginPath();
                    // ctx.arc(arc.round.radius * Math.sin(startAngle), arc.round.radius * Math.cos(startAngle), arc.round.thickness, 0, 2 * Math.PI);
                    ctx.arc(arc.round.radius * Math.sin(endAngle), arc.round.radius * Math.cos(endAngle), arc.round.thickness, 0, 2 * Math.PI);
                    ctx.closePath();
                    ctx.fill();
                    ctx.restore();
                },
            });

            var config = {
                type: 'doughnut',
                data: {
                    labels: ['first title', 'second title', 'third title'],
                    datasets: [{
                        data: [55, 25, 28,],
                        backgroundColor: ["#7b2dbf", "#000000", "#C67EFF",],
                        // hoverBackgroundColor: ["#62C1C1", "#92C348", "#EC6362", "#B4B4B5", "#BFE5E5"],
                        borderWidth: 0,
                        borderColor: ["#000000", "#7b2dbf", "#000000"],
                        hoverBorderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                        reverse: true,
                        labels: {
                            padding: 25,
                            fontSize: 12,
                            fontColor: 'rgb(0, 0, 0)'
                        }
                    },
                    tooltips: {
                        enabled: true,
                    },
                    cutoutPercentage: 80,
                    rotation: -0.5 * Math.PI,
                    circumference: 2 * Math.PI,
                    title: {
                        display: true,
                        text: 'Mortgage Calculator'
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    elements: {
                        center: {
                            // the longest text that could appear in the center  7,500,000 /10,000,000
                            maxText: '100%',
                            text: '',
                            fontColor: '#000',
                            fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                            fontStyle: 'bold',
                            minFontSize: 1,
                            maxFontSize: 256,
                        }
                    }
                }
            };
            window.onload = function () {
                var ctx = document.getElementById('myChart').getContext('2d');
                window.myDoughnut = new Chart(ctx, config);
                // window.myDoughnut.generateLegend();
            };

        </script>

    @endpush

</x-app-layout>
