const judul = document.getElementById("judul");
const tanggalTerbit = document.getElementById("tanggal-terbit");
const genre = document.getElementById("genre");
const cover = document.getElementById("cover");
const imgPreview = document.getElementById("img-preview");
const createBtn = document.getElementById("create-btn");
const deleteBtn = document.getElementById("delete-btn");
const deleteBtn2 = document.querySelectorAll(".delete2-btn");
const errorText = document.getElementById("error-text");
const successText = document.getElementById("success-text");
const closeBtn = document.getElementsByClassName("close-btn");
const albumId = document.getElementById("album-id");
const checkbox = document.getElementsByClassName("checkbox");
const save2Btn = document.getElementById("save2-btn");

const resetForm = () => {
    judul.value = "";
    tanggalTerbit.value = "";
    genre.value = "";
    cover.value = "";
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


    const coverfile = cover.files[0];
    if (coverfile) {
        const dataAlbum = {
            judul: judul.value,
            tanggalTerbit: tanggalTerbit.value,
            genre: genre.value,
            albumId: albumId.value,
        };
        const formData = new FormData();
        formData.set("cover", cover.files[0]);
        formData.set("dataAlbum", JSON.stringify(dataAlbum));
        postDataAlbum("php/album/detail.php", formData)
            .then((response) => JSON.parse(response))
            .then((obj) => {
                if (obj.status) {
                    setSuccessAlert("Album berhasil diedit");
                    setTimeout(() => {
                        location.replace(window.location.href);
                    }, 2000);
                } else {
                    setErrorAlert("Please try again");
                }
            });
    } else {
        const dataAlbum = {
            judul: judul.value,
            tanggalTerbit: tanggalTerbit.value,
            genre: genre.value,
            albumId: albumId.value,
        };
        console.log('dataAlbum2', dataAlbum);
        const formData = new FormData();
        formData.set("dataAlbum", JSON.stringify(dataAlbum));
        postDataAlbum("php/album/detail.php", formData)
            .then((response) => JSON.parse(response))
            .then((obj) => {
                if (obj.status) {
                    setSuccessAlert("Album berhasil diedit");
                    setTimeout(() => {
                        location.replace(window.location.href);
                    }, 2000);
                } else {
                    setErrorAlert("Please try again");
                }
            });
    }

    resetForm();
});

var i;
for (i = 0; i < closeBtn.length; i++) {
    closeBtn[i].onclick = function() {
        var div = this.parentElement;
        setTimeout(function() {
            div.style.display = "none";
        }, 500);
    };
}

deleteBtn.addEventListener("click", () => {
    const dataAlbum = {
        albumId: albumId.value,
    };

    const formData = new FormData();
    formData.set("dataAlbum", JSON.stringify(dataAlbum));
    postDataAlbum("php/album/delete.php", formData)
        .then((response) => JSON.parse(response))
        .then((obj) => {
            if (obj.status) {
                console.log("deleted");
                // move to home page
                location.replace("albumList.php");
            } else {
                console.log("failed");
            }
        });
});

save2Btn.addEventListener("click", () => {
    var songID = [];
    for (var i = 0; i < checkbox.length; i++) {
        if (checkbox[i].checked) {
            songID.push(checkbox[i].value);
        }
    }
    const dataSongAlbum = {
        songID: songID,
        albumID: albumId.value,
    };
    const formData = new FormData();
    formData.set("data", JSON.stringify(dataSongAlbum));
    postDataAlbum("php/album/addSong.php", formData)
        .then((response) => JSON.parse(response))
        .then((obj) => {
            if (obj.status) {
                setSuccessAlert("Lagu berhasil ditambahkan pada Album");
                setTimeout(() => {
                    location.replace(window.location.href);
                }, 2000);
            } else {
                setErrorAlert("Please try again");
            }
        });
});

deleteBtn2.forEach(element => {
    {
        element.addEventListener("click", () => {
            const dataSong = {
                songId: element.value,
            };
            console.log(dataSong);
    
            const formData = new FormData();
            formData.set("dataSong", JSON.stringify(dataSong));
            postDataAlbum("php/album/delete2.php", formData)
                .then((response) => JSON.parse(response))
                .then((obj) => {
                    if (obj.status) {
                        console.log("deleted");
                        setTimeout(() => {
                            location.replace(window.location.href);
                        }, 2000);
                    } else {
                        console.log("failed");
                    }
                });
        });
    }
}); 