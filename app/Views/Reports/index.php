<?= $this->extend("Layouts/Main"); ?>

<?= $this->section("title") ?>
التقارير
<?= $this->endSection() ?>


<?= $this->section("content"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">التقارير</h1>
</div>

<div class="container-fluid">

    <div class="row align-items-start">


<section class="col p-3 mx-auto">
    <canvas id="myChart">

    </canvas>
</section>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url:"<?php echo base_url();?>/api/products/top?type=qty",
            dataType:'text',
            type:"GET",
            success: function(result){
                var obj = $.parseJSON(result);
                console.log(obj);

            }
        })
    });

    let myChart = document.getElementById('myChart').getContext('2d');

    //Global Options

        Chart.defaults.font.family='Cairo',
        Chart.defaults.font.size=18,
        Chart.defaults.font.color='#777'

    let topProductsChart = new Chart(myChart, {
        type:'bar', //bar , horizontalBar, pie, line, doughnut, radar, polarArea
        data: {
            labels: <?= getTop5MaterialinNamesQTY() ?>,
            datasets:[{
                label: 'الكمية',
                data: <?= getTop5MaterialinQTY() ?>,
                backgroundColor: <?= generateRGBColor(10) ?>,
                hoverBackgroundColor:'#777',
                borderWidth:'1',
                borderColor:'#777',
                hoverBorderWidth: '3',
                hoverBorderColor: '#000'

            }]

    },
        options:{
            // indexAxis: 'y',
            plugins: {
                title:{
                    display:true,
                    text:'اول 5 خامات من حيث الكمية بالمخازن',
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                },
                legend: {
                    position:'right',
                }

            }

        }
    });

</script>
<?= $this->endSection(); ?>
