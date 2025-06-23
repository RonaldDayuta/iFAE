<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Visitor Label Print</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card p-4 shadow-lg">
          <h3>Visitor Label Print</h3>
          <form id="visitorForm">
            <div class="row">
              <div class="mb-3 col-12">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Juan Dela Cruz" required>
              </div>
              <div class="mb-3 col-12 col-md-6">
                <label for="room" class="form-label">Room Number</label>
                <input type="text" name="room" id="room" class="form-control" placeholder="e.g., 301" required>
              </div>
              <div class="mb-3 col-12 col-md-6">
                <label for="floor" class="form-label">Floor</label>
                <input type="text" name="floor" id="floor" class="form-control" placeholder="e.g., 3" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Print Label</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
