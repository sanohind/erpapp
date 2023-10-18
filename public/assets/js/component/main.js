document.addEventListener("DOMContentLoaded", function () {
  const gp = document.getElementById('gp').innerHTML;
  console.log(gp);
  fetch(`${api_url}/stockbypart/?group=${gp}`, {
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
      //console.log(result);
      $("#tableInventory").DataTable({
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print"],
        responsive: true,
        autoWidth: false,
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
            targets: [3, 4, 5, 6],
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
            data: "allocated",
          },
          {
            data: "onorder",
          },
          {
            data: "economicstock",
          },
        ],
        order: [
          [4, "desc"],
          [3, "asc"],
        ],
      });
      $("#olTable").remove();
    })
    .catch(function (error) {
      console.log(`Error: ${error.message}`);
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: `${error.message}. Please contact administrator!!`,
      });
    });

 
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
