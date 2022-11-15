const tbody = document.getElementById("tbody");

const getAllUsers = () => {
  // fetch data from database
  return new Promise((resolve, reject) => {
    const xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "php/user.php");
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

const createUserRow = (user) => {
  const role = user.isAdmin == 1 ? "Admin" : "User";
  const tr = document.createElement("tr");
  const child = `
    <td>${user.username}</td>
    <td>${user.email}</td>
    <td>${role}</td>
  `;
  tr.innerHTML = child;
  return tr;
};

const UserList = () => {
  // delete all rows
  tbody.innerHTML = "";

  // get all users and append it to the table
  getAllUsers().then((users) => {
    users = JSON.parse(users);

    users.forEach((user) => {
      tbody.appendChild(createUserRow(user));
    });
  });
};

UserList();
