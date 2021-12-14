<div class="container">
    <br>
    <?php if (empty($_SESSION['user_id'])) : ?>
        <h1>Welcome Guest</h1>
    <?php else : ?>
        <h1>Welcome <br>
            <?= $_SESSION['username']; ?></h1>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h4>Dashboard <?= date("F", strtotime('m')); ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-white h-100">
                        <h5 class="card-header">Penjualan</h5>
                        <div class="card-body py-5">
                            <h3>
                                Rp <br> <?= number_format($data['inv']['total'], 0); ?>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-danger text-white h-100">
                        <h5 class="card-header">Pembelian</h5>
                        <div class="card-body py-5">
                            <h3>
                                Rp <br><?= number_format($data['purch']['total'], 0); ?>

                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-success text-white h-100">
                        <h5 class="card-header">Profit</h5>
                        <div class="card-body py-5">
                            <h3>Rp <br>
                                <?= number_format($data['inv']['total'] - ($data['purch']['total'] + $data['petty']['total']), 0); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-warning text-dark h-100">
                        <h5 class="card-header">Petty Cash</h5>
                        <div class="card-body py-5">

                            <h3>
                                Rp <br><?= number_format($data['petty']['total'], 0); ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                            <h4>Chart Bulanan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="speedChart" width="600" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php endif; ?>
    <br>

    <div>
        <?php
        // total penjualan
        $jan_inv = $data['totinv']['january'];
        $feb_inv = $data['totinv']['february'];
        $mar_inv = $data['totinv']['maret'];
        $apr_inv = $data['totinv']['april'];
        $mei_inv = $data['totinv']['mei'];
        $jun_inv = $data['totinv']['juni'];
        $jul_inv = $data['totinv']['july'];
        $aug_inv = $data['totinv']['agustus'];
        $sep_inv = $data['totinv']['september'];
        $okt_inv = $data['totinv']['oktober'];
        $nov_inv = $data['totinv']['november'];
        $des_inv = $data['totinv']['desember'];

        // total pembelian
        $jan_purch = $data['totpurch']['january'];
        $feb_purch = $data['totpurch']['february'];
        $mar_purch = $data['totpurch']['maret'];
        $apr_purch = $data['totpurch']['april'];
        $mei_purch = $data['totpurch']['mei'];
        $jun_purch = $data['totpurch']['juni'];
        $jul_purch = $data['totpurch']['july'];
        $aug_purch = $data['totpurch']['agustus'];
        $sep_purch = $data['totpurch']['september'];
        $okt_purch = $data['totpurch']['oktober'];
        $nov_purch = $data['totpurch']['november'];
        $des_purch = $data['totpurch']['desember'];

        //total petty cash

        $jan_petty = $data['totpetty']['january'];
        $feb_petty = $data['totpetty']['february'];
        $mar_petty = $data['totpetty']['maret'];
        $apr_petty = $data['totpetty']['april'];
        $mei_petty = $data['totpetty']['mei'];
        $jun_petty = $data['totpetty']['juni'];
        $jul_petty = $data['totpetty']['july'];
        $aug_petty = $data['totpetty']['agustus'];
        $sep_petty = $data['totpetty']['september'];
        $okt_petty = $data['totpetty']['oktober'];
        $nov_petty = $data['totpetty']['november'];
        $des_petty = $data['totpetty']['desember'];

        ?>

    </div>

    <script>
        var speedCanvas = document.getElementById("speedChart");

        Chart.defaults.global.defaultFontFamily = "Helvetica";
        Chart.defaults.global.defaultFontSize = 16;

        var dataFirst = {
            label: "Penjualan",
            data: [
                <?= $jan_inv; ?>,
                <?= $feb_inv; ?>,
                <?= $mar_inv; ?>,
                <?= $apr_inv; ?>,
                <?= $mei_inv; ?>,
                <?= $jun_inv; ?>,
                <?= $jul_inv; ?>,
                <?= $aug_inv; ?>,
                <?= $sep_inv; ?>,
                <?= $okt_inv; ?>,
                <?= $nov_inv; ?>,
                <?= $des_inv; ?>,

            ],

            lineTension: 0,
            fill: false,
            borderColor: 'Blue'
        };

        var dataSecond = {
            label: "Pembelian",
            data: [
                <?= $jan_purch; ?>,
                <?= $feb_purch; ?>,
                <?= $mar_purch; ?>,
                <?= $apr_purch; ?>,
                <?= $mei_purch; ?>,
                <?= $jun_purch; ?>,
                <?= $jul_purch; ?>,
                <?= $aug_purch; ?>,
                <?= $sep_purch; ?>,
                <?= $okt_purch; ?>,
                <?= $nov_purch; ?>,
                <?= $des_purch; ?>,


            ],
            lineTension: 0,
            fill: false,
            borderColor: 'Red'
        };

        var dataThird = {
            label: "Profit",
            data: [
                <?= $jan_inv - ($jan_purch + $jan_petty); ?>,
                <?= $feb_inv - ($feb_purch + $feb_petty); ?>,
                <?= $mar_inv - ($mar_purch + $mar_petty); ?>,
                <?= $apr_inv - ($apr_purch + $apr_petty); ?>,
                <?= $mei_inv - ($mei_purch + $mei_petty); ?>,
                <?= $jun_inv - ($jun_purch + $jun_petty); ?>,
                <?= $jul_inv - ($jul_purch + $jul_petty); ?>,
                <?= $aug_inv - ($aug_purch + $aug_petty); ?>,
                <?= $sep_inv - ($sep_purch + $sep_petty); ?>,
                <?= $okt_inv - ($okt_purch + $okt_petty); ?>,
                <?= $nov_inv - ($nov_purch + $nov_petty); ?>,
                <?= $des_inv - ($des_purch + $des_petty); ?>,
            ],
            lineTension: 0,
            fill: false,
            borderColor: 'Green'
        };

        var dataFourth = {
            label: "Petty Cash",
            data: [
                <?= $jan_petty; ?>,
                <?= $feb_petty; ?>,
                <?= $mar_petty; ?>,
                <?= $apr_petty; ?>,
                <?= $mei_petty; ?>,
                <?= $jun_petty; ?>,
                <?= $jul_petty; ?>,
                <?= $aug_petty; ?>,
                <?= $sep_petty; ?>,
                <?= $okt_petty; ?>,
                <?= $nov_petty; ?>,
                <?= $des_petty; ?>
            ],
            lineTension: 0,
            fill: false,
            borderColor: 'Yellow'
        };



        var speedData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sept", "Okt", "Nov", "Des"],
            datasets: [dataFirst, dataSecond, dataThird, dataFourth]
        };

        var chartOptions = {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 80,
                    fontColor: 'black'
                }

            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            if (parseInt(value) >= 1000) { //positif format per 1000
                                return 'Rp.' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            } else {
                                return 'Rp.' + value; //negatif
                            }
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return 'Rp.' + tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            }

        };

        var lineChart = new Chart(speedCanvas, {
            type: 'line',
            data: speedData,
            options: chartOptions,

        })
    </script>

</div>