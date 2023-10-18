document.addEventListener("DOMContentLoaded", function () {
  const gp = document.getElementById("gp").innerHTML;
  var year = "2023";
  var month = "4";
  console.log(gp);

  fetch(`${api_url}/stock-monitor/?year=${year}&month=${month}&wh=${gp}`, {
    mode: "no-cors",
  })
    .then((response) => {
      if (response.ok) {
        return Promise.resolve(response);
        //console.log(response);
      } else {
        return Promise.reject(new Error("Failed to load"));
      }
    })
    .then((response) => response.json()) // parse response as JSON
    .then((data) => {
      const result = data;
      console.log(result);
      $("#tableInventory").DataTable({
        dom: "Bfrtip",
        buttons: ["csv", "excel"],
        responsive: true,
        autoWidth: false,
        scrollY: "50vh",
        scrollCollapse: true,
        paging: false,
        data: result,
        columnDefs: [
          {
            targets: 0,
            render: function (data, type, row, meta) {
              if (type === "display") {
                data = `<a href="#" onclick="showDetail('${data}')" data-id="${data}">${data}</a>`;
              }
              return data;
            },
          },
          {
            targets: [3, 4, 5, 6, 7],
            className: "dt-body-right",
            render: function (data, type, row, meta) {
              if (type === "display") {
                data = new Intl.NumberFormat().format(data);
              }
              return data;
            },
          },
        ],
        columns: [
          {
            data: "partno",
          },
          {
            data: "oldpartno",
          },
          {
            data: "partname",
          },
          {
            data: "onhand",
          },
          {
            data: "safety_stock",
          },
          {
            data: "min_stock",
          },
          {
            data: "max_stock",
          },
          {
            data: "total_planned",
          },
        ],
        order: [
          [7, "asc"]
        ],
      });
      $("#olTable").remove();
    })
    .catch(function (error) {
      console.log(`Error: ${error.message}`);
      //alert(`Error: ${error.message}`);
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: `${error.message}. Please contact administrator!!`,
      });
      $("#olTable").remove();
    });

    var minutes, seconds, count, counter, timer;
    count = 1200; //seconds
    counter = setInterval(timer, 1000);

    function checklength(i) {
        "use strict";
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    function timer() {
        "use strict";
        count = count - 1;
        minutes = checklength(Math.floor(count / 60));
        seconds = checklength(count - minutes * 60);
        if (count < 0) {
            clearInterval(counter);
            return;
        }
        document.getElementById("timer").innerHTML =
            "Refresh in " + minutes + ":" + seconds + " ";
        if (count === 0) {
            location.reload();
        }
    }
  
});

function showDetail(partno) {
  const dtTitle = document.getElementById("detailTitle");
  dtTitle.innerText = partno;
  $("#tableInventoryDetail").DataTable().destroy();

  fetch(`${api_url}/stockpartwh/?partno=${partno}`, {
    mode: "no-cors",
  })
    .then((response) => {
      if (response.ok) {
        return Promise.resolve(response);
      } else {
        return Promise.reject(new Error("Failed to load"));
      }
    })
    .then((response) => response.json()) // parse response as JSON
    .then((data) => {
      const result = data.data;
      const dtTable = $("#tableInventoryDetail").DataTable({
        responsive: true,
        autoWidth: false,
        data: result,
        columnDefs: [
          {
            targets: [1, 2, 3, 4],
            render: function (data, type, row, meta) {
              if (type === "display") {
                data = new Intl.NumberFormat().format(data);
              }
              return data;
            },
          },
        ],
        columns: [
          {
            data: "warehouse",
          },
          {
            data: "onhand",
          },
          {
            data: "allocated",
          },
          {
            data: "onorder",
          },
          {
            data: "economicstock",
          },
        ],
        order: [[0, "asc"]],
      });
      $("#olTableDetail").remove();
    })
    .catch(function (error) {
      console.log(`Error: ${error.message}`);
      //alert(`Error: ${error.message}`);
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: `${error.message}. Please contact administrator!!`,
      });
    });

  $("#modal-detail").modal("show");
}
