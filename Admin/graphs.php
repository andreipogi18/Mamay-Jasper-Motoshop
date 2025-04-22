<?php include '../assets/php/graph_data.php'; ?>
<div class='row align-items-md-center'>
    <div class='col-12 card shadow mb-4'>
        <div class='card-header py-3'>
            <h6 class='m-0 font-weight-bold text-dark'>Total Purchases</h6>
        </div>
        <div class='chart-bar w-100' style="height:500px;">
            <canvas id='total-purchases'></canvas>
        </div>
    </div>
    <div class='row justify-content-around'>
        <div class='col-md-5 card shadow mb-4 m-2'>
            <div class='card-header py-3'>
                <h6 class='m-0 font-weight-bold text-dark'>Top 3 Products</h6>
            </div>
            <div class='chart-bar w-100' style="height:500px;">
                <canvas id='Top3product'></canvas>
            </div>
        </div>
        <div class='col-md-5 card shadow mb-4 '>
            <div class='card-header py-3'>
                <h6 class='m-0 font-weight-bold text-dark'>Daily Income</h6>
            </div>
            <div class='mx-auto' style="height:500px;">
                <h1 class="d-md-flex text-center mx-auto justify-content-md-center display-1">₱
                    <?php echo number_format($total_revenue, 2) ?>
                </h1>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        let productLabel = <?= json_encode($productName, JSON_UNESCAPED_UNICODE) ?>;
        let productPurchases = <?= json_encode($productPurchases, JSON_UNESCAPED_UNICODE) ?>;
        let productTotal = <?= json_encode($productTotal, JSON_UNESCAPED_UNICODE) ?>;
        let Top3 = <?= json_encode($label3, JSON_UNESCAPED_UNICODE) ?>;
        let Top3_data = <?= json_encode($Top3_data, JSON_UNESCAPED_UNICODE) ?>;
        let HighestData = <?= json_encode($Highest, JSON_UNESCAPED_UNICODE) ?>;
    </script>