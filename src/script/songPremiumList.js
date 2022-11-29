const tbody = document.getElementById("tbody");

const getSongList = () => {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open(
      "GET", "/binotify-app/src/php/songPremium/allSong.php");
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

const ListSong = () => {
  // delete all rows
  tbody.innerHTML = "";

  // get all penyanyi and append it to the table
  getSongList().then((data) => {
    data = JSON.parse(data);
    data.songList.forEach((song) => {
      tbody.appendChild(createSongRow(song, data.listPenyanyi));
    });
  });
};

const createSongRow = (song, listPenyanyi) => {
  var artist = listPenyanyi.find(obj => {
    return obj.user_id === song.penyanyi_id
  })
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
        <p class="songtitle-artist">${artist.name}</p>
      </div>
    </div>
  </td>
  `;
  tr.innerHTML = child;
  return tr;
}

ListSong();