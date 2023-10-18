document.addEventListener("DOMContentLoaded", function () {
  fetch(`http://10.1.10.101/api-display/public/stockbypart/?group=FG`, {
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
      const firstTop = result.slice(0, 10);
      const itemList = document.querySelector("#listPart");
      //itemList.setAttribute('data-autoscroll','')
      for (res of firstTop) {
        itemList.appendChild(
          renderContent(
            res.oldpartno,
            res.partno,
            res.partname,
            res.onhand,
            res.onorder,
            res.allocated,
            res.economicstock
          )
        );
      }
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

  function renderContent(
    oldpartno,
    partno,
    partname,
    qtyOhd,
    qtyOor,
    qtyAll,
    qtyEco
  ) {
    //on hand
    const spoh = makeSpan(
      qtyOhd <= 0
        ? "strong text-danger text-right"
        : "strong text-primary text-right",
      new Intl.NumberFormat().format(qtyOhd)
    );
    const poh = makeP("h6", "On Hand : ");
    poh.append(spoh);

    //on order
    const spor = makeSpan(
      qtyOor <= 0 ? "strong text-danger" : "strong text-primary",
      new Intl.NumberFormat().format(qtyOor)
    );
    const por = makeP("h6", "On Order : ");
    por.append(spor);

    //allocated
    const spal = makeSpan(
      "strong text-primary",
      new Intl.NumberFormat().format(qtyAll)
    );
    const pal = makeP("h6", "Allocated : ");
    pal.append(spal);

    //economic
    const spec = makeSpan(
      qtyEco <= 0 ? "strong text-danger" : "strong text-primary",
      new Intl.NumberFormat().format(qtyEco)
    );
    const pec = makeP("h6", "Economic : ");
    pec.append(spec);

    //qty1
    const divQ1 = makeDiv("col-md-3", "");
    divQ1.append(poh, pal);

    //qty2
    const divQ2 = makeDiv("col-md-3", "");
    divQ2.append(por, pec);

    //part data
    const h4 = document.createElement("h4");
    h4.className = "product-title text-success";
    h4.innerText = oldpartno;
    const spPart = makeSpan("product-description", `${partname} - ${partno}`);
    const divPart = makeDiv("col-md-5", "");
    divPart.append(h4, spPart);

    //alert
    const iconAlert = document.createElement("i");
    iconAlert.className = "fas fa-exclamation-circle";
    iconAlert.style = "font-size : 32px";
    const spanAlert = makeSpan("text-center text-warning blink", "");
    spanAlert.append(iconAlert);
    const divAlert = makeDiv("col-md-1", "");
    divAlert.append(spanAlert);

    //row
    const divRow = makeDiv("row", "");
    divRow.append(divPart, divQ1, divQ2, divAlert);

    //prod info
    const divProductInfo = makeDiv("product-info", "");
    divProductInfo.append(divRow);

    //item
    const divItem = makeDiv("item", "li");
    divItem.append(divProductInfo);

    return divItem;
  }

  function makeDiv(className, idName) {
    const div = document.createElement("div");
    div.className = className;
    div.id = idName;
    return div;
  }

  function makeP(className, text) {
    const p = document.createElement("p");
    p.className = className;
    p.innerText = text;
    return p;
  }

  function makeSpan(className, text) {
    const span = document.createElement("span");
    span.className = className;
    span.innerText = text;
    return span;
  }

  function checklength(i) {
    "use strict";
    if (i < 10) {
      i = "0" + i;
    }
    return i;
  }

  var minutes, seconds, count, counter, timer;
  count = 180; //seconds
  counter = setInterval(timer, 1000);

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
      "Next refresh in " + minutes + ":" + seconds + " ";
    if (count === 0) {
      location.reload();
    }
  }
});
