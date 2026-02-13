<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Room</title>
    <link rel="stylesheet" href="modal.css">
</head>
<body>

<div cglass="modal-overlay">
    <div class="modal">

        <div class="modal-header">
            <h2>Add New Room</h2>
            <span class="close-btn">&times;</span>
        </div>
        <form class="modal-body" action="{{ route('create_room') }}">

            <div class="form-row">
                <div class="form-group">
                    <label>Room Number</label>
                    <input type="text" name="roomNumber" placeholder="e.g., 101">
                </div>

                <div class="form-group">
                    <label>Room Type</label>
                    <select name="type">
                        <option>Single</option>
                        <option>Double</option>
                        <option>Suite</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Floor</label>
                    <input type="number" value="1">
                </div>

                <div class="form-group">
                    <label>Price per Night ($)</label>
                    <input type="text" name="price" placeholder="e.g., 99.00">
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option>Available</option>
                    <option>Occupied</option>
                    <option>Maintenance</option>
                </select>
            </div>

            <div class="form-group">
                <label>Description (Optional)</label>
                <input type="text" placeholder="Room description...">
            </div>

        </form>
        <div class="modal-footer">
            <button class="btn cancel">Cancel</button>
            <button class="btn primary">Add Room</button>
        </div>

    </div>
</div>

</body>
</html>
