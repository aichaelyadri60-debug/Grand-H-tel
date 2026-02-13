<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Room</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Add New Room</h2>

    <form action="/rooms" method="POST">

     <div class="form-group">
            <label for="roomNumber">Room Number</label>
            <input type="text" name="roomNumber" id="roomNumber" placeholder="e.g. 101" required>
        </div>


        <div class="form-group">
            <label for="type">Room Type</label>
            <select name="type" id="type" required>
                <option value="">Select type</option>
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="Suite">Suite</option>
            </select>
        </div>


        <div class="form-group">
            <label for="price">Price per Night ($)</label>
            <input type="number" name="price" id="price" step="0.01" placeholder="e.g. 99.00" required>
        </div>


        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>

        <button type="submit" class="btn">Add Room</button>

    </form>
</div>

</body>
</html>
