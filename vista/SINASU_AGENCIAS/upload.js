const dropArea = document.querySelector(".drop-area");
const dragText = dropArea.querySelector("h2");
const button = dropArea.querySelector("button");
const input = dropArea.querySelector("#input-file");
let files;
// Obtener el valor de mostrar_id_guia desde el elemento HTML
var mostrar_id_agencia = document.getElementById("mostrar_id_agencia").value;
console.log("mostrar_id_agencia:", mostrar_id_agencia);

button.addEventListener("click", (e) => {
  input.setAttribute("multiple", "multiple");
  input.click();
});

input.addEventListener("change", (e) => {
  files = input.files;
  dropArea.classList.add("active");
  showFiles(files);
  dropArea.classList.remove("active");
});

dropArea.addEventListener("dragover", (e) => {
  e.preventDefault();
  dropArea.classList.add("active");
  dragText.textContent = "Suelta para subir las evidencias";
});

dropArea.addEventListener("dragleave", (e) => {
  e.preventDefault();
  dropArea.classList.remove("active");
  dragText.textContent = "Arrastra y suelta las evidencias";
});

dropArea.addEventListener("drop", (e) => {
  e.preventDefault();
  files = e.dataTransfer.files;
  showFiles(files);
  dropArea.classList.remove("active");
  dragText.textContent = "Arrastra y suelta las evidencias";
});

function showFiles(files) {
  if (files && files.length !== undefined) {
    // Verifica si files no es undefined
    if (files.length === 0) {
      console.log("No hay archivos para mostrar");
    } else {
      for (const file of files) {
        processFile(file);
      }
    }
  } else {
    console.log("No se proporcionaron archivos");
  }
}

function processFile(file) {
  const docType = file.type;
  const validExtensions = [
    "application/pdf",
    "image/png",
    "image/jpg",
    "image/jpeg",
    "application/msword",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document", //Documentos WORD
    "application/vnd.ms-excel",
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", //Documentos excel
    "application/vnd.ms-powerpoint",
    "application/vnd.openxmlformats-officedocument.presentationml.presentation", //Documentos powerpoint
  ];

  if (validExtensions.includes(docType)) {
    //archivo valido
    const fileReader = new FileReader();
    const id = `file-${Math.random().toString(32).substring(7)}`;

    fileReader.addEventListener("load", (e) => {
      const fileUrl = fileReader.result;
      const documentpdf = `
        <div id="${id}" class="file-container">
        <i class="fa-regular fa-file-lines" style="font-size:20px"></i>
          <div class="status">
            <span> <a target="_blank" href="../SINASU/uploads/${mostrar_id_agencia}${file.name}" >${file.name}</a></span>
            <span class="status-text">
              Loading...
          </div>
        </div>
        `;

      const html = document.querySelector("#preview").innerHTML;
      document.querySelector("#preview").innerHTML = documentpdf + html;
    });

    fileReader.readAsDataURL(file);
    uploadFile(file, id);
  } else {
    //no es un archivo válido
    alert("No es un archivo válido");
  }
}

async function uploadFile(file, id) {
  const formData = new FormData();
  formData.append("file", file);
  formData.append("mostrar_id_agencia", mostrar_id_agencia);

  // Verifica que el FormData se ha llenado correctamente
  for (let pair of formData.entries()) {
    console.log(pair[0] + ": " + pair[1]);
  }

  try {
    const response = await fetch("upload.php", {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      throw new Error("Error al subir el archivo");
    }

    const responseText = await response.text();
    console.log(responseText); // Muestra la respuesta del servidor en la consola

    let responseData;
    try {
      responseData = JSON.parse(responseText); // Intenta analizar la respuesta como JSON
    } catch (error) {
      console.error("Error al analizar la respuesta JSON:", error);
    }

    if (responseData && responseData.error) {
      // Manejar el error de manera adecuada
      console.error("Error en la carga del archivo:", responseData.error);
      document.querySelector(
        `#${id} .status-text`
      ).innerHTML = `<span class="failure">${responseData.error}</span>`;
    } else {
      // Manejar la respuesta exitosa de manera adecuada
      console.log("Archivo subido correctamente");
      document.querySelector(
        `#${id} .status-text`
      ).innerHTML = `<span class="success">Archivo subido correctamente...</span>`;
    }
  } catch (error) {
    console.error("Error:", error);
    // Aquí puedes manejar el error, como mostrar un mensaje al usuario
    document.querySelector(
      `#${id} .status-text`
    ).innerHTML = `<span class="failure">El archivo no pudo subirse...</span>`;
  }
}

function eliminarArchivo(mostrar_id_guia) {
  if (confirm("¿Estás seguro de que quieres eliminar este archivo?")) {
    // Realizar la eliminación del archivo mediante una solicitud al controlador PHP
    fetch("../../controlador/controlador_eliminar_documentos.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        mostrar_id_guia: mostrar_id_guia,
      }),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error al eliminar el archivo");
        }
        return response.json();
      })
      .then((data) => {
        // Manejar la respuesta del servidor
        console.log(data); // Puedes realizar alguna acción adicional según la respuesta del servidor
        // Por ejemplo, actualizar la interfaz de usuario para reflejar la eliminación del archivo
        // Por ejemplo, remover el elemento de la interfaz que representa el archivo eliminado
      })
      .catch((error) => {
        console.error("Error:", error);
        // Puedes mostrar un mensaje de error al usuario si la eliminación del archivo falla
      });
  }
}

// Agregar un evento de clic al ícono de agregar comentario
// document.addEventListener("click", async function (event) {
//   if (event.target.matches(".fa-comment")) {
//     const fileContainer = event.target.closest(".file-container");
//     const fileName = fileContainer.querySelector("span").textContent.trim();

//     const result = await Swal.fire({
//       title: `Agregar Comentario a ${fileName}`,
//       input: "text",
//       inputPlaceholder: "Ingrese su comentario",
//       showCancelButton: true,
//       confirmButtonText: "Enviar",
//       cancelButtonText: "Cancelar",
//       allowOutsideClick: false,
//       inputValidator: (value) => {
//         if (!value) {
//           return "Debe ingresar un comentario";
//         }
//       },
//     });

//     if (result.isConfirmed && result.value) {
//       try {
//         const response = await fetch("agregar_comentario.php", {
//           method: "POST",
//           headers: {
//             "Content-Type": "application/json",
//           },
//           body: JSON.stringify({
//             comentario: result.value,
//             filename: fileName,
//           }),
//         });
//         console.log("Datos a enviar al servidor:", {
//           comentario: result.value,
//           fileName: fileName,
//         });

//         if (!response.ok) {
//           throw new Error("Error al enviar el comentario");
//         }

//         const data = await response.json();
//         console.log(data); // Mostrar la respuesta JSON en la consola

//         if (data.success) {
//           Swal.fire("Éxito", "Comentario agregado correctamente", "success");
//         } else {
//           Swal.fire("Error", "Hubo un error al agregar el comentario", "error");
//         }
//       } catch (error) {
//         console.error("Error:", error);
//         Swal.fire("Error", "Hubo un error al agregar el comentario", "error");
//       }
//     }
//   }
// });

// function uploadFile(file) {
//   const formData = new FormData();
//   formData.append("file", file);

// try {
//   const response = await fetch('http:localhost:3000/upload', {
//     method: "POST",
//     body: formData,
//   });

//   const responseText = await response.text();
//   console.log(responseText);

//   document.querySelector(`#${id} .status-text`).innerHTML = `<span class="success">Archivo subido correctamente...</span>`;
// } catch (error) {
//   document.querySelector(`#${id} .status-text`).innerHTML = `<span class="failure">El archivo no pudo subirse...</span>`;
// }
// }
