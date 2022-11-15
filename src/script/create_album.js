const judul = document.getElementById("judul");
const penyanyi = document.getElementById("penyanyi");
const tanggalTerbit = document.getElementById("tanggal-terbit");
const genre = document.getElementById("genre");
const cover = document.getElementById("cover");
const imgPreview = document.getElementById("img-preview");
const createBtn = document.getElementById("create-btn");
const errorText = document.getElementById("error-text");
const successText = document.getElementById("success-text");
const closeBtn = document.getElementsByClassName("close-btn");

const resetForm = () => {
  judul.value = "";
  penyanyi.value = "";
  tanggalTerbit.value = "";
  genre.value = "";
  cover.value = null;
  imgPreview.setAttribute("src", "assets/songdefault.jpeg");
};

const setErrorAlert = (text) => {
  errorText.innerHTML = text;
  errorText.parentElement.style.display = "block";
};

const setSuccessAlert = (text) => {
  successText.innerHTML = text;
  successText.parentElement.style.display = "block";
};

const postDataAlbum = (url, data) => {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", url);
    xhr.onload = () => {
      if (xhr.status === 200) {
        resolve(xhr.responseText);
      } else {
        reject(xhr.responseText);
      }
    };
    xhr.onerror = () => {
      reject(xhr.responseText);
    };
    xhr.send(data);
  });
};

cover.addEventListener("change", () => {
  const file = cover.files[0];
  if (file) {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
      imgPreview.setAttribute("src", reader.result);
    });
    reader.readAsDataURL(file);
  }
});

createBtn.addEventListener("click", () => {
  if (
    judul.value === "" ||
    penyanyi.value === "" ||
    tanggalTerbit.value === "" ||
    genre.value === "" ||
    cover.value === ""
  ) {
    setErrorAlert("Please fill all fields");
  } else {
    const dataAlbum = {
      judul: judul.value,
      penyanyi: penyanyi.value,
      tanggalTerbit: tanggalTerbit.value,
      genre: genre.value,
    };
    const formData = new FormData();
    formData.set("cover", cover.files[0]);
    formData.set("dataAlbum", JSON.stringify(dataAlbum));
    postDataAlbum("php/album/create.php", formData)
      .then((response) => JSON.parse(response))
      .then((obj) => {
        if (obj.status) {
          setSuccessAlert("Album berhasil dibuat");
          setTimeout(() => {
            window.location.href = "albumDetail.php?id=" + obj.id;
          }, 2000);
        } else {
          setErrorAlert("Please try again");
        }
      });
    resetForm();
  }
});

var i;
for (i = 0; i < closeBtn.length; i++) {
  closeBtn[i].onclick = function () {
    var div = this.parentElement;
    setTimeout(function () {
      div.style.display = "none";
    }, 500);
  };
}
