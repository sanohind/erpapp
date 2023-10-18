<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice - <?= $shipment['invNo'] ?></title>

    <style type="text/css">
        body {
            font-size: 11px;
            font-family: sans-serif;

            /* margin-top: 0.5cm; */
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2cm;
        }

        p {
            font-size: 11px;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .italic {
            font-style: italic;
        }

        .border {
            border-collapse: collapse;
            border: 1px solid #333333;
        }

        .border-bottom {
            border-bottom: 1px solid black;
        }

        th {
            font-size: 11px;
            text-align: center;
            padding: 4px 4px;
        }

        td {
            font-size: 11px;
            padding: 4px 4px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .valign-top {
            vertical-align: top;
        }

        header {
            position: fixed;
            top: 1cm;
            left: 1cm;
            right: 1cm;
            height: 2cm;
        }

        header .row {
            border: 4px solid #333333;
        }

        /* header table {
            border: 4x solid #333333;
        } */

        header h1 {
            font-size: 24px;
            font-weight: 700;
            vertical-align: top;
        }

        header h1 span {
            margin-top: 0px;
        }

        header h2 {
            font-size: 19px;
            font-weight: bold;
        }

        header h2 span {
            margin-top: 0px;
        }

        header h3 {
            font-size: 16px;
            font-weight: 900;
            text-align: right;
        }

        main .supplier {
            margin-top: 20px;
        }

        main .supplier .box span {
            font-size: 24px;
        }

        footer {
            position: fixed;
            bottom: 6.5cm;
            left: 1cm;
            right: 1cm;
            height: 2cm;
        }

        footer .sign h1 {
            font-size: 14px;
            font-weight: bold;
        }

        footer .sign td {
            font-size: 12px;
        }

        footer .vpadding-sign {
            padding-bottom: 18px;
            padding-top: 18px
        }

        footer .hpadding-logistic {
            padding-left: 29px;
            padding-right: 29px;
        }

        footer .hpadding-controller {
            padding-left: 19px;
            padding-right: 19px;
        }

        footer .hpadding-driver {
            padding-left: 39px;
            padding-right: 39px;
        }

        footer .hpadding-receiver {
            padding-left: 29px;
            padding-right: 29px;
        }

        @page {
            margin: 0cm 0cm;
        }

        main {
            margin-top: 480px;
        }

        .page-break {
            page-break-after: always;
        }

        address {
            margin-left: 25px;
        }

        .font14 {
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    $data = json_decode($invDetail);
    foreach (array_chunk($data, 14) as $dataInv) :
    ?>
        <header>
            <section class="header">
                <table width="100%" border="0">
                    <tr>
                        <td width="60%">
                            <h1 class="bold">INVOICE</h1>
                        </td>
                        <td colspan="2">
                            <h2 class="bold">PT. Sanoh Indonesia</h2>
                            Jl. Inti II Blok C-04 No. 10 Kawasan Industri Hyundai<br />
                            Cikarang - Bekai, 17550. Indonesia
                        </td>
                    </tr>
                </table>
                <table width="100%" class="border">
                    <tr class="border">
                        <td rowspan="5" width="60%" class="border">
                            <h4>Deliver to :</h4>
                            <address>
                                <strong><?= $invoice[0]->bp_name ?></strong><br />
                                <?= $invoice[0]->inv_adr2 ?><br />
                                <?= $invoice[0]->inv_adr3 ?><br />
                                <?= $invoice[0]->inv_adr4 ?><br />
                                <?= $invoice[0]->inv_adr5 ?><br />
                                Telp&nbsp;&nbsp;&nbsp;: <br />
                                Fax&nbsp;&nbsp;&nbsp;: <br />
                                <br />
                                Attn&nbsp;&nbsp;&nbsp;:
                            </address>
                        </td>
                        <td width="25%">
                            Invoice No :
                            <p class="bold"><?= $shipment['invNo'] ?></p>
                        </td>
                        <td width="15%">
                            Date :
                            <p class="bold"><?= $invoice[0]->inv_date2 ?></p>
                        </td>
                    </tr>
                    <tr class="border">
                        <td colspan="2"> L/C No :</td>
                    </tr>
                    <tr class="border">
                        <td colspan="2"> Issuing Bank :</td>
                    </tr>
                    <tr class="border">
                        <td colspan="2"> Term / Method of payment :</td>
                    </tr>
                    <tr class="border">
                        <td colspan="2"> L/C No :</td>
                    </tr>
                </table>
            </section>
            <section>
                <table width="100%" style="border-collapse: collapse;">
                    <tr style="border-bottom: 1px solid black;">
                        <td>
                            Vessel <br />
                            <i class="bold"><?= $shipment['vessel'] ?></i>
                        </td>
                        <td>
                            Port of Loading <br />
                            <i class="bold"><?= $shipment['portLoading'] ?></i>
                        </td>
                        <td>
                            Sailing on or about <br />
                            <i class="bold"><?= $shipment['sailDate'] ?></i>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid black;">
                        <td>
                            Port of Discharge <br />
                            <i class="bold"><?= $shipment['portDest'] ?></i>
                        </td>
                        <td>
                            Place of delivery <br />
                            <i class="bold"><?= $shipment['delvPlace'] ?></i>
                        </td>
                        <td>
                            Shipped by <br />
                            <i class="bold"><?= $shipment['shipby'] ?></i>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <br />
                            PART FOR AUTOMOTIVE COMPONENT
                        </td>
                        <td class="text-center">
                            <br />
                            <i class="bold"><?= strtoupper($shipment['incoterm'])  ?></i>
                        </td>
                    </tr>
                </table>
            </section>
        </header>
        <?php
        $i = 0;
        $packingTotal = 0;
        $amountTotal = 0;
        ?>

        <footer>
            <hr />
            <section class="cost">
                <table width="90%" style="border-collapse: collapse;">
                    <tr class="text-center">
                        <td width="55%" rowspan="4">
                            <br />
                            <i class="font14"><?= $packingTotal ?> Cartons</i><br />
                            <i class="font14"><?= $shipment['pallet'] ?> Pallets</i>
                        </td>
                        <td width="20%" class="text-right">
                            FOB TOTAL
                        </td>
                        <td width="15%" class="text-right">
                            <?= number_format($amountTotal, 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" class="text-right">
                            INSURANCE
                        </td>
                        <td width="15%" class="text-right">
                            <?= number_format($shipment['insurance'], 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" class="text-right">
                            FREIGHT COST
                        </td>
                        <td width="15%" class="text-right">
                            <?= number_format($shipment['frcost'], 2) ?>
                        </td>
                    </tr>
                </table>
                <hr />
                <table width="90%">
                    <tr>
                        <td width="55%"></td>
                        <td width="20%" class="text-right">
                            <br />
                            CIF TOTAL
                        </td>
                        <td width="15%" class="text-right">
                            <br />
                            <?= number_format($amountTotal + $shipment['insurance'] + $shipment['frcost'], 2) ?>
                        </td>
                    </tr>
                </table>
                <hr />
            </section>
            <section class="sign">
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <address style="font-size: 9px;">
                                * COMMERCIAL VALUE <br>
                                * NET WEIGHT <?= number_format($shipment['netweight'], 2) ?> KGS <br>
                                * GROSS WEIGHT <?= number_format($shipment['grossweight'], 2) ?> KGS <br>
                                * PACKING : 40 Cartons : 2 Pallet <br>
                                * COUNTRY OF ORIGIN : INDONESIA <br>
                                <u>* BANK OF PAYMENT :</u> <br>
                                ACCOUNT NAME : PT. SANOH INDONESIA <br>
                                ACCOUNT NUMBER (USD) : 5300-889012 <br>
                                BANK NAME : MUFG BANK, Ltd <br>
                                BANK BRANCH : JAKARTA <br>
                                SWIFT CODE : BOTKIDJX <br>
                            </address>
                        </td>
                        <td>
                            <p class="lead" style="margin-left: 25px;">PT. Sanoh Indonesia</p>
                            <br />
                            <br />
                            <br />
                            <hr style="width:40%;text-align:left;margin-left:30px">
                            <p style="margin-left: 25px;">ABDUL KADIR</p>
                            <p style="margin-left: 25px;">MANAGER</p>
                        </td>
                    </tr>
                </table>
            </section>
        </footer>

        <main style="left: 0cm !important; right:0cm !important;">
            <table width="100%" style="border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid black; border-top: 1px solid black;">
                        <th>C/No.</th>
                        <th>Description</th>
                        <th>Bundles</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Amount</th>
                        <th>PO Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $packingTotal = 0;
                    $amountTotal = 0;
                    foreach ($dataInv as $row) {
                        $amount = $row->amount;
                        $packing = $shipment['boxQty'][$i];
                    ?>
                        <tr style="border-bottom: 0.5px solid black;">
                            <td><?= $row->std_oldpart ?></td>
                            <td><?= $row->description ?></td>
                            <td class="text-right"><?= $shipment['boxQty'][$i] . " " . $shipment['box'][$i] ?></td>
                            <td class="text-right"><?= number_format($row->qty)  ?> Pcs</td>
                            <td class="text-right"><?= number_format($row->price, 4)  ?></td>
                            <td class="text-right"><?= number_format($row->amount, 2)  ?></td>
                            <td><?= $row->po_customer ?></td>
                        </tr>
                    <?php
                        $packingTotal = $packing + $packingTotal;
                        $amountTotal = $amount + $amountTotal;
                        $i++;
                    };
                    ?>
                </tbody>
            </table>
        </main>
        <div class="page-break"></div>

    <?php
    endforeach;
    ?>

</body>

</html>