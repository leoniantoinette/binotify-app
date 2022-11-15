const inputSearchTerm = document.getElementById("search-term");
const inputSearchBy = document.getElementById("search-by");
const inputSortJudul = document.getElementById("sort-judul");
const inputSortDate = document.getElementById("sort-date");
const inputFilterGenre = document.getElementById("filter-genre");
const searchBtn = document.getElementById("search-btn");
const resetBtn = document.getElementById("reset-btn");
const tbody = document.getElementById("tbody");
const nav = document.getElementById("nav");

var params;

const resetSearch = () => {
  inputSearchTerm.value = "";
  inputSearchBy.value = "all";
  inputSortJudul.selectedIndex = 0;
  inputSortDate.selectedIndex = 0;
  inputFilterGenre.selectedIndex = 0;
  params = {
    searchTerm: "",
    searchBy: "",
    sortJudul: "",
    sortDate: "",
    filterGenre: "",
    page: 1,
  };
  search();
};

const getSongList = (page) => {
  params.page = page;
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    const parameter = new URLSearchParams();
    Object.keys(params).forEach((key) => {
      if (params[key] !== "") {
        parameter.append(key, params[key]);
      }
    });
    xhr.open(
      "GET", "/tugas-besar-1/src/php/song/search.php" +
        (parameter.toString().length > 0 ? "?" + parameter.toString() : "")
    );
    xhr.onload = () => {
      if (xhr.status === 200) {
        resolve(xhr.responseText);
      } else {
        reject(xhr.responseText);
      }
    };
    xhr.onerror = () => reject(xhr.responseText);
    xhr.send();
  });
};

const search = () => {
  params = {
    searchTerm: inputSearchTerm.value,
    searchBy: inputSearchBy.value,
    sortJudul: inputSortJudul.value,
    sortDate: inputSortDate.value,
    filterGenre: inputFilterGenre.value,
  };
  tbody.innerHTML = "";
  // search song
  getSongList(1).then((songs) => {
    songs = JSON.parse(songs);
    var i = 0;
    songs.data.forEach((song) => {
      tbody.appendChild(createSongRow(song, songs.no + i++));
    });
    nav.innerHTML = "";
    if (songs.total_page > 1) {
      nav.appendChild(createNav(songs.total_page, 1));
    }
  });
};

const createSongRow = (song, no) => {
  const date = new Date(song.Tanggal_terbit);
  const year = date.getFullYear();
  const tr = document.createElement("tr");
  tr.classList.add("songrow");
  const child = `
  <td>${no++}</td>
  <td>
    <div class="songtitle">
      <img
        class="songtitle-img"
        src="${song.Image_path}"
        alt=""
      />
      <div class="songtitle-desc">
        <p class="songtitle-title">
          <a href="songDetail.php?id=${song.song_id}">${song.Judul}</a>
        </p>
        <p class="songtitle-artist">${song.Penyanyi}</p>
      </div>
    </div>
  </td>
  <td>${song.Genre}</td>
  <td>${year}</td>
  `;
  tr.innerHTML = child;
  return tr;
};

const createNav = (countPage, currPage) => {
  const nav = document.createElement("nav");
  const ul = document.createElement("ul");
  ul.classList.add("pagination");
  ul.classList.add("justify-content-center");
  for (let i = 1; i <= countPage; i++) {
    const li = document.createElement("li");
    li.classList.add("page-item");
    const a = document.createElement("a");
    a.classList.add("page-link");
    if (i == currPage) {
      a.classList.add("page-active");
    }
    a.innerText = i;
    a.addEventListener("click", () => {
      getSongList(i).then((songs) => {
        songs = JSON.parse(songs);
        var j = 0;
        tbody.innerHTML = "";
        songs.data.forEach((song) => {
          tbody.appendChild(createSongRow(song, songs.no + j++));
        });
        nav.innerHTML = "";
        if (songs.total_page > 1) {
          nav.appendChild(createNav(songs.total_page, i));
        }
      });
    });
    li.appendChild(a);
    ul.appendChild(li);
  }
  nav.appendChild(ul);
  return nav;
};

searchBtn.addEventListener("click", search);
resetBtn.addEventListener("click", resetSearch);

search();
