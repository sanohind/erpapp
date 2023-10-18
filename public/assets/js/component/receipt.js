document.addEventListener("DOMContentLoaded", function() {

    //Date range picker
    //$('#receiptDate').daterangepicker()
    document.getElementById('displayElement').style.display = "none";
    document.getElementById('btnDisplay').addEventListener("click", displayData);

    function displayData() {
      const displayElement = document.getElementById('displayElement');

      const displayElementExist = displayElement.querySelectorAll('div.row');
      for (dee of displayElementExist) {
        dee.remove();
      }

      document.getElementById('overlay').style.display = "block";
      const dtFrom = document.getElementById('rcDateFrom').value;
      const dtTo = document.getElementById('rcDateTo').value;
      const po = document.getElementById('po_no').value;
      console.log(`from ${dtFrom} to ${dtTo} and po ${po}`);

      fetch(`${api_url}/receipt/?datefrom=${dtFrom}&dateto=${dtTo}&po=${po}`, {
          mode: "no-cors"
        })
        .then(response => {
          if (response.ok) {
            return Promise.resolve(response);
          } else {
            return Promise.reject(new Error('Failed to load'));
          }
        })
        .then(response => response.json()) // parse response as JSON
        .then(data => {
          const result = data.data;
          if (Object.keys(result).length > 0) {
            for (res of result) {
              renderData(res);
              makeBreak();
              document.getElementById('overlay').style.display = "none";
            }
          } else {
            document.getElementById('overlay').style.display = "none";
            //alert("No Data, please change filter");
            Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: 'No data display, please change filter..'
            })
          }
        })
        .catch(function(error) {
          console.log(`Error: ${error.message}`);
          //alert(`Error: ${error.message}`);
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: `${error.message}. Please contact administrator!!`
          })
          document.getElementById('overlay').style.display = "none";
        });
    }

    function renderData(data) {
      console.log(data);

      //table template
      const head = ['Item No', 'Description', 'Std. Old Part', 'PO Qty', 'Unit Price', 'Receipt Qty', 'Unit', 'Extended Cost', 'Inv. Doc. No', 'Approve Date.']


      fetch(`${api_url}/receipt-details/?receipt=${res.receipt_no}`, {
          mode: "no-cors"
        })
        .then((resp) => resp.json())
        .then(function(data) {
          const dtResult = data.data;
          const tbData = document.createElement('tbody');
          console.log(dtResult);
          for (res of dtResult) {
            const dtRow = document.createElement('tr');
            dtRow.append(
              makeRow(res.item),
              makeRow(res.item_desc),
              makeRow(res.old_partno),
              makeRow(res.po_qty),
              makeRow(amountFormat(res.po_price)),
              makeRow(res.receipt_qty),
              makeRow(res.receipt_unit),
              makeRow(amountFormat(res.extend_price)),
              makeRow(res.inv_doc),
              makeRow(res.inv_date)
            );
            tbData.append(dtRow);
          }
          console.log(tbData);
          //table.append(tbData);
          const table = generate_table(head);
          table.append(tbData);

          const divData = document.createElement('div');
          divData.className = "row invoice-info";
          divData.append(createColInv6('PO Information.', `PO Number : ${res.po_no}`, `PO Date : ${res.po_date}`, `Supplier : ${res.supplier}`),
            createColInv6(`Receipt Information.`, `Receipt Number : ${res.receipt_no}`, `Receipt Date : ${res.receipt_date}`, `Slip : ${res.packing_slip}`),
            table);

          //console.log(createColInv6('PO Information.', 'PO Number :', 'PO Date :', 'Supplier'))
          console.log(divData);

          displayElement.style.display = "block";
          displayElement.append(divData, makeLine(), makeBreak());
          //document.getElementById('rcDateFrom').value = "";
          //document.getElementById('rcDateTo').value = "";
          //document.getElementById('po_no').value = "";
        })
        .catch(function(error) {
          console.log(error);
        });

    }

    function createColInv6(title, text1, text2, text3) {
      const textR1 = document.createElement('span');
      textR1.innerText = text1;
      const textR2 = document.createElement('span');
      textR2.innerText = text2;
      const textR3 = document.createElement('span');
      textR3.innerText = text3;

      const address = document.createElement('address');
      address.append(textR1, makeBreak(), textR2, makeBreak(), textR3);

      const sTitle = document.createElement('span');
      sTitle.className = 'text-primary';
      sTitle.innerText = title;

      const colInv = document.createElement('div');
      colInv.className = "col-sm-4 invoice-col font-table";

      colInv.append(sTitle, address);
      return colInv;
    }

    function makeBreak() {
      const br = document.createElement('br');
      return br;
    }

    function makeLine() {
      const hr = document.createElement('hr');
      return hr;
    }

    function generate_table(head) {
      const tbl = document.createElement('table');
      tbl.className = "font-table";
      tbl.width = "100%"
      tbl.id = "tbDisplay";

      const tbHeader = document.createElement('thead');
      const rowHeader = document.createElement('tr');
      for (rowHead of head) {
        const cellHead = document.createElement('th');
        const cellHeadText = document.createTextNode(rowHead);
        cellHead.append(cellHeadText);
        rowHeader.append(cellHead);
      }
      tbHeader.append(rowHeader);

      tbl.append(tbHeader);

      return tbl;
    }

    function makeRow(data) {
      const row = document.createElement('td');
      const rowText = document.createTextNode(data);
      row.append(rowText);
      return row;
    }

    function amountFormat(value) {
      const val = new Intl.NumberFormat().format(value);
      return val;
    }



  });

  function printDiv(divName) {
    const displayElement = document.getElementById(divName);
    const countRow = displayElement.querySelectorAll('div.row');

    const nonPrint = document.getElementById('nonPrrint');
    const printContents = displayElement.innerHTML;

    console.log(countRow.length);
    if (countRow.length > 0) {
      //const originalContents = document.body.innerHTML;

      //document.body.innerHTML = printContents;
      nonPrint.style.display = "none";
      window.print();

      //document.body.innerHTML = originalContents;
      nonPrint.style.display = "block";
    } else {
      alert("No data printed");
    }
  }