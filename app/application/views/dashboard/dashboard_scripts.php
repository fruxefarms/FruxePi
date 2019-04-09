<!-- Page Plugins -->
<script src="<?php echo asset_url(); ?>js/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>

<script src="<?php echo asset_url(); ?>js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.timepicker.min.js"></script> 
<script src="<?php echo asset_url(); ?>js/bootstrap-select.min.js"></script> 

<!-- Page Scripts -->
<script>

    // Timepicker Input
    $('#lightsON').timepicker({ show2400: true, timeFormat: 'G:i'});
    $('#lightsOFF').timepicker({ show2400: true, timeFormat: 'G:i'});
    $('#pumpON').timepicker({ show2400: true, timeFormat: 'G:i'});
    $('#pumpDurdation').timepicker({ show2400: true, timeFormat: 'G:i'});

    // Selectpicker dropdown
    $('.selectpicker').selectpicker();

    // Reveal edit functions on mouseover
    $(".activity_type").on("mouseenter", function (e) {
        $('.activity_edit').fadeIn('slow');
    });

    $(".activity_type").on("mouseleave", function (e) {
        $('.activity_edit').delay(3000).fadeOut(); 
    });

    // Hide show floating activity button on modal pop-up
    $("#activityButton").click(function () {
        $(this).css("visibility", "hidden");
    });

    $("#cancelActivityModal").click(function () {
        $("#activityButton").css("visibility", "visible").fadeIn('slow');
    });
    
    // Run functions on load
    $(document).ready(function() {
       
        $('.image-popup-vertical-fit').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            },
            callbacks: {
                open: function(){
                    $("#activityButton").css("visibility", "hidden");
                },
                close: function(){
                    $("#activityButton").css("visibility", "visible");
                }
            }
        });

    });

    // Chart Data
    var lineChartData = {
        labels: [<?php echo $chart_legend; ?>],
        datasets: [{
            label: 'Temperature (°<?php echo $temperature_format; ?>)',
            borderColor: window.chartColors.red,
            backgroundColor: window.chartColors.red,
            fill: false,
            data: [<?php echo $temperature_chart; ?>],
            yAxisID: 'y-axis-1',
        }, {
            label: 'Humidity (%)',
            borderColor: window.chartColors.blue,
            backgroundColor: window.chartColors.blue,
            fill: false,
            data: [<?php echo $humidity_chart; ?>],
            yAxisID: 'y-axis-2'
        }]
    };

</script>