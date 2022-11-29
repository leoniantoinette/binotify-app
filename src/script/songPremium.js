const penyanyiID = document.getElementById("penyanyi-id");
const tbody = document.getElementById("tbody");

const getSongList = () => {
  params = {
    penyanyiID: penyanyiID.value
  }
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    const parameter = new URLSearchParams();
    Object.keys(params).forEach((key) => {
      if (params[key] !== "") {
        parameter.append(key, params[key]);
      }
    });
    xhr.open(
      "GET", "/binotify-app/src/php/songPremium/detail.php" +
        (parameter.toString().length > 0 ? "?" + parameter.toString() : "")
    );
    console.log("/binotify-app/src/php/songPremium/detail.php" + (parameter.toString().length > 0 ? "?" + parameter.toString() : ""));
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

const createSongRow = (song) => {
  const tr = document.createElement("tr");
  tr.classList.add("songrow");
  const child = `
  <td>
    <div class="audio">
      <audio id="music" controls>
        <source src="${song.Audio_path}" type="audio/mp3" />
      </audio>
    </div>
  </td>
  <td>
    <div class="songtitle">
      <div class="songtitle-desc">
        <p class="songtitle-title">${song.Judul}</p>
      </div>
    </div>
  </td>
  `;
  tr.innerHTML = child;
  return tr;
};

const songPremium = () => {
  // delete all rows
  tbody.innerHTML = "";

  // get all songs and append it to the table
  getSongList().then((songs) => {
    songs = JSON.parse(songs);

    songs.forEach((song) => {
      tbody.appendChild(createSongRow(song));
    });
  });
}

songPremium();