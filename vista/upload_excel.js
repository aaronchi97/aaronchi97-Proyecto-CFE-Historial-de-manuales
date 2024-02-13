const dropArea = document.querySelector(".drop-area");
const dragText = dropArea.querySelector("h2");
const button = dropArea.querySelector("button");
const input = dropArea.querySelector("#input-file");
let files;

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
  dragText.textContent = "Suelta para subir los archivos";
});

dropArea.addEventListener("dragleave", (e) => {
  e.preventDefault();
  dropArea.classList.remove("active");
  dragText.textContent = "Arrastra y suelta el documento PDF";
});

dropArea.addEventListener("drop", (e) => {
  e.preventDefault();
  files = e.dataTransfer.files;
  showFiles(files);
  dropArea.classList.remove("active");
  dragText.textContent = "Arrastra y suelta el documento PDF";
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
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", // Para archivos de Excel en formato .xlsx (Excel 2007 y posteriores)
    "application/vnd.ms-excel", // Para archivos de Excel en formato .xls (Excel 97-2003)
  ];

  if (validExtensions.includes(docType)) {
    //archivo valido
    const fileReader = new FileReader();
    const id = `file-${Math.random().toString(32).substring(7)}`;

    fileReader.addEventListener("load", (e) => {
      const fileUrl = fileReader.result;
      const documentpdf = `
        <div id="${id}" class="file-container">
        <i class="fa-regular fa-file-pdf" style="font-size: 20px;"></i>
          <div class="status">
            <span> <a target="_blank" href="/uploads/${file.name}" >Excel${file.name}</a></span>
            <span class="status-text">
              Loading...
            </span>
            <span><a href="#" onclick="eliminarArchivo('${id}', '${file.name}')"><i class="fa-solid fa-circle-xmark"></i> Eliminar</a></span>
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

  try {
    const response = await fetch("upload_excel.php", {
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

function eliminarArchivo(id, fileName, id_documento) {
  if (confirm("¿Estás seguro de que quieres eliminar este archivo?")) {
    // Imprimir el JSON que se enviará en la solicitud
    console.log(
      JSON.stringify({
        id: id,
        fileName: fileName,
        idDocumento: id_documento,
      })
    );

    // Realizar la eliminación del archivo
    fetch("eliminar_archivo.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        id: id,
        fileName: fileName,
        idDocumento: id_documento,
      }),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error al eliminar el archivo");
        }
        return response.json();
      })
      .then((data) => {
        console.log(data);
        // Aquí puedes actualizar la interfaz de usuario para reflejar la eliminación del archivo
        document.getElementById(id).remove(); // Eliminar el contenedor del archivo del DOM
      })
      .catch((error) => {
        console.error("Error:", error);
        // Aquí puedes mostrar un mensaje de error al usuario
      });
  }
}

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
