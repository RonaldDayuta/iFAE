document.getElementById("visitorForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch("print.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      Swal.fire({
        icon: data.status === "success" ? "success" : "error",
        title: data.status === "success" ? "Printed!" : "Error",
        text: data.message,
      });
    })
    .catch(() => {
      Swal.fire(
        "Error",
        "Something went wrong while sending the request.",
        "error"
      );
    });
});
