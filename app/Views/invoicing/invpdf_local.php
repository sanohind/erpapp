<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice - <?= $invHeader[0]->trans . $invHeader[0]->inv_no ?> </title>

    <style type="text/css">
        body {
            font-size: 12px;
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

        /* table td {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
        } */

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
            margin-top: 10px;
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
            margin-top: 260px;
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
    //$data = json_decode($invDetail);
    foreach (array_chunk($invDetail, 24) as $dataInv) :
    ?>
        <header>
            <section class="header">
                <table width="100%" border="0">
                    <tr>
                        <td width="75%">
                            <h2 class="bold">PT. Sanoh Indonesia</h2>
                            Jl. Inti II Blok C-04 No. 10 Kawasan Industri Hyundai<br />
                            Cikarang - Bekai, 17550. Indonesia
                        </td>
                        <td colspan="2">
                            <br />
                            <p>
                                P.O Customer :
                                <br />
                                Surat Jalan No : SJ. Terlampir
                        </td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td width="15%">
                            Invoice No :
                            <p class="bold"><?= $invHeader[0]->trans . $invHeader[0]->inv_no ?></p>
                        </td>
                        <td width="70%" class="border">
                            <h4>CUSTOMER </h4>
                            <address>
                                <strong><?= $invHeader[0]->bp_name ?></strong><br />
                                <?= $invHeader[0]->inv_adr2 ?><br />
                                <?= $invHeader[0]->inv_adr3 ?><br />
                                <?= $invHeader[0]->inv_adr4 ?><br />
                                <?= $invHeader[0]->inv_adr5 ?><br />
                            </address>
                        </td>
                        <td width="15%">
                            <p class="bold">Currency : <?= $invHeader[0]->inv_currency ?></p>
                        </td>
                    </tr>
                </table>
            </section>
        </header>
        <?php
        $i = 0;
        ?>

        <footer>
            <hr />
            <section class="cost">
                <table width="100%" style="border-collapse: collapse;" border="0">
                    <tr>
                        <td width="50%">
                            <img src="<?= $qruri ?>" alt="QRCODE" width="115"><br/>
                            <span><?= $dekrip ?></span>
                        </td>
                        <td width="50%">
                            <table width="100%" style="border-collapse: collapse;" border="0">
                                <tr>
                                    <td class="text-right">AMOUNT</td>
                                    <td class="text-right">
                                        <?= number_format($invHeader[0]->inv_amount - $invHeader[0]->inv_tax_value, 2) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">PPN 11%</td>
                                    <td class="text-right">
                                        <?= number_format($invHeader[0]->inv_tax_value, 2) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">GRAND TOTAL</td>
                                    <td class="text-right">
                                        <?= number_format($invHeader[0]->inv_amount, 2) ?>
                                    </td>
                                </tr>
                            </table>
                        <td>
                    </tr>
                </table>
            </section>
            <section class="sign">
                <table width="100%">
                    <tr>
                        <td width="50%" class="text-center">
                            <p class="lead" style="margin-left: 5px;">Tanggal Penyerahan :<strong> <?= date_format(date_create($invHeader[0]->inv_date2), 'd/m/Y') ?></strong></p>
                            <p class="lead" style="margin-left: 5px;">PREPARED BY :</p>
                            <img src="<?= $ttdAgus ?>" height="75" width="75">
                            <p class="lead" style="margin-left: 5px;">Agus Wahyono</p>
                        </td>
                        <td class="text-center">
                            <p class="lead" style="margin-left: 5px;">Bekasi ,<strong> <?= date_format(date_create($invHeader[0]->inv_date2), 'd/m/Y') ?></strong></p>
                            <p class="lead" style="margin-left: 5px;">APPROVED BY :</p>
                            <!-- <img src="#" height="75" width="75" alt="Manager Approver"> -->
                            <p class="lead" style="margin-left: 5px;">Dian Rakhma Sari</p>
                        </td>
                    </tr>
                </table>
            </section>
        </footer>

        <main style="left: 0cm !important; right:0cm !important;">
            <table width="100%" style="border-collapse: collapse;" border="0">
                <thead>
                    <tr style="border-bottom: 1px solid black; border-top: 1px solid black;">
                        <th style="border-left: 1px solid #000; border-right: 1px solid #000;">QUANTITY</th>
                        <th style="border-left: 1px solid #000; border-right: 1px solid #000;">DESCRIPTION </th>
                        <th style="border-left: 1px solid #000; border-right: 1px solid #000;">PRICE / UNIT</th>
                        <th style="border-left: 1px solid #000; border-right: 1px solid #000;">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($dataInv as $row) {
                    ?>
                        <tr>
                            <!-- <tr style="border-bottom: 0.5px solid black;"> -->
                            <td class="text-right" style="border-left: 1px solid #000; border-right: 1px solid #000;"><?= number_format($row->qty, 2) ?></td>
                            <td style="border-left: 1px solid #000; border-right: 1px solid #000;"><?= $row->part . "&nbsp;&nbsp;&nbsp;&nbsp; " . $row->name ?></td>
                            <td class="text-right" style="border-left: 1px solid #000; border-right: 1px solid #000;"><?= number_format($row->price, 2)  ?></td>
                            <td class="text-right" style="border-left: 1px solid #000; border-right: 1px solid #000;"><?= number_format($row->amount, 2)  ?></td>
                        </tr>
                    <?php
                        $i++;
                    };
                    ?>
                    <br/>
                </tbody>
            </table>
        </main>
        <div class="page-break"></div>
    <?php
    endforeach;
    ?>

</body>

</html>