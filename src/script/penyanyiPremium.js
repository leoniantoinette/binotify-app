const listPenyanyiPremium = document.getElementById("list-penyanyiPremium");

const getListPenyanyi = () => {
  // fetch data from database
  return new Promise((resolve, reject) => {
    const xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "php/penyanyi/detail.php");
    xmlHttp.onload = () => {
      if (xmlHttp.status === 200) {
        resolve(xmlHttp.responseText);
      } else {
        reject(xmlHttp.responseText);
      }
    };
    xmlHttp.onerror = () => {
      reject(xmlHttp.responseText);
    };
    xmlHttp.send();
  });
};

const ListPenyanyi = () => {
  // delete all rows
  listPenyanyiPremium.innerHTML = "";

  // get all penyanyi and append it to the table
  getListPenyanyi().then((penyanyi) => {
    penyanyi = JSON.parse(penyanyi);
    const penyanyiID = penyanyi.penyanyiID.map(object => parseInt(object.creator_id));
    penyanyi.listPenyanyi.forEach((data) => {
      listPenyanyiPremium.appendChild(createPenyanyiRow(data, penyanyiID));
    });
  });
};

const createPenyanyiRow = (listPenyanyi, penyanyiID) => {
  const tr = document.createElement("tr");
  tr.classList.add("penyanyi-row");
  if (penyanyiID.includes(listPenyanyi.user_id)) {
    const child = `
      <p class="penyanyi-name">${listPenyanyi.name}</p>
      <a href="songPremium.php?id=${listPenyanyi.user_id}&artist=${listPenyanyi.name}" class="seesongs-btn"><p>See Songs</p><i class="fa fa-chevron-right"></i></a>
    `;
    tr.innerHTML = child;
  } else {
    const child = `
      <p class="penyanyi-name">${listPenyanyi.name}</p>
      <button class="subscribe-btn" value="${listPenyanyi.user_id}">Subscribe</button>
    `;
    tr.innerHTML = child;
  }
  return tr;
}

ListPenyanyi();