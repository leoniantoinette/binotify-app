const judul = document.getElementById("song-title");
const tanggalTerbit = document.getElementById("song-release");
const genre = document.getElementById("song-genre");
const audio = document.getElementById("song-file");
const cover = document.getElementById("song-image");
// const imgPreview = document.getElementById("img-preview");
const createBtn = document.getElementById("create-btn");
const deleteBtn = document.getElementById("delete-btn");
const errorText = document.getElementById("error-text");
const successText = document.getElementById("success-text");
const closeBtn = document.getElementsByClassName("close-btn");
const songId = document.getElementById("song-id");

const resetForm = () => {
    judul.value = "";
    tanggalTerbit.value = "";
    genre.value = "";
    audio.value = null;
    cover.value = null;
    // imgPreview.setAttribute("src", "assets/songdefault.jpeg");
};

const setErrorAlert = (text) => {
    errorText.innerHTML = text;
    errorText.parentElement.style.display = "block";
};

const setSuccessAlert = (text) => {
    successText.innerHTML = text;
    successText.parentElement.style.display = "block";
};

const postDataSong = (url, data) => {
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

// cover.addEventListener("change", () => {
//   const file = cover.files[0];
//   if (file) {
//     const reader = new FileReader();
//     reader.addEventListener("load", () => {
//       imgPreview.setAttribute("src", reader.result);
//     });
//     reader.readAsDataURL(file);
//   }
// });

createBtn.addEventListener("click", () => {
    console.log("clikced");
    const audiofile = audio.files[0];
    const coverfile = cover.files[0];
    if (audiofile && coverfile) {
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            const audioComp = new Audio(reader.result);
            audioComp.addEventListener("loadedmetadata", () => {
                const dataSong = {
                    judul: judul.value,
                    tanggalTerbit: tanggalTerbit.value,
                    genre: genre.value,
                    duration: audioComp.duration,
                    songId: songId.value,
                };
                const formData = new FormData();
                formData.set("audio", audio.files[0]);
                formData.set("cover", cover.files[0]);
                formData.set("dataSong", JSON.stringify(dataSong));
                postDataSong("./php/song/edit.php", formData)
                    .then((response) => JSON.parse(response))
                    .then((obj) => {
                        if (obj.status) {
                            setSuccessAlert("Lagu berhasil diedit");
                            setTimeout(() => {
                                location.replace(window.location.href);
                            }, 2000);
                        } else {
                            setErrorAlert("Please try again");
                            console.log("errorr");
                        }
                    });
                resetForm();
            });
        });
        reader.readAsDataURL(audiofile);
    // }
    } 
    else if (audiofile){
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            const audioComp = new Audio(reader.result);
            audioComp.addEventListener("loadedmetadata", () => {
                const dataSong = {
                    judul: judul.value,
                    tanggalTerbit: tanggalTerbit.value,
                    genre: genre.value,
                    duration: audioComp.duration,
                    songId: songId.value,
                };
                const formData = new FormData();
                formData.set("audio", audio.files[0]);
                formData.set("dataSong", JSON.stringify(dataSong));
                postDataSong("./php/song/edit.php", formData)
                    .then((response) => JSON.parse(response))
                    .then((obj) => {
                        if (obj.status) {
                            setSuccessAlert("Lagu berhasil diedit");
                            setTimeout(() => {
                                location.replace(window.location.href);
                            }, 2000);
                        } else {
                            setErrorAlert("Please try again");
                            console.log("errorr");
                        }
                    });
                resetForm();
            });
        });
        reader.readAsDataURL(audiofile);
    // }
    }
    else if (coverfile){
        const dataSong = {
            judul: judul.value,
            tanggalTerbit: tanggalTerbit.value,
            genre: genre.value,
            songId: songId.value,
        };
        const formData = new FormData();
        formData.set("cover", cover.files[0]);
        formData.set("dataSong", JSON.stringify(dataSong));
        postDataSong("./php/song/edit.php", formData)
            .then((response) => JSON.parse(response))
            .then((obj) => {
                if (obj.status) {
                    setSuccessAlert("Lagu berhasil diedit");
                    setTimeout(() => {
                        location.replace(window.location.href);
                    }, 2000);
                } else {
                    setErrorAlert("Please try again");
                    console.log("errorr");
                }
            });
        resetForm();
    }

    else {
        const dataSong = {
            judul: judul.value,
            tanggalTerbit: tanggalTerbit.value,
            genre: genre.value,
            songId: songId.value,
        };
        const formData = new FormData();
        formData.set("dataSong", JSON.stringify(dataSong));
        postDataSong("./php/song/edit.php", formData)
            .then((response) => JSON.parse(response))
            .then((obj) => {
                if (obj.status) {
                    setSuccessAlert("Lagu berhasil diedit");
                    setTimeout(() => {
                        location.replace(window.location.href);
                    }, 2000);
                } else {
                    setErrorAlert("Please try again");
                    console.log("errorr");
                }
            });
        resetForm();
    }
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


const postDataDelete = (url, data) => {
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

deleteBtn.addEventListener("click", () => {
    const dataSong = {
        songId: songId.value,
    };

    const formData = new FormData();
    formData.set("dataSong", JSON.stringify(dataSong));
    postDataDelete("./php/song/delete.php", formData)
        .then((response) => JSON.parse(response))
        .then((obj) => {
            if (obj.status) {
                console.log("deleted");
                // move to home page
                location.replace("homepageUser.php");
            } else {
                console.log("failed");
            }
        });
});