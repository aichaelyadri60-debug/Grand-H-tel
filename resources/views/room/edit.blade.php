<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Room</title>
    <link rel="stylesheet" href="{{ asset('css/createRoom.css') }}">
</head>
<body>

<div class="container">
    <h2>Edit Room</h2>

    <form action="{{ route('updateRoom', $room->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="roomNumber">Room Number</label>
            <input type="text" 
                   name="roomNumber" 
                   id="roomNumber"
                   value="{{ old('roomNumber', $room->roomNumber) }}"
                   required>
        </div>

        <div class="form-group">
            <label for="type">Room Type</label>
            <select name="type" id="type" required>
                <option value="Single" {{ $room->type == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Double" {{ $room->type == 'Double' ? 'selected' : '' }}>Double</option>
                <option value="Suite" {{ $room->type == 'Suite' ? 'selected' : '' }}>Suite</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Price per Night ($)</label>
            <input type="number"
                   name="price"
                   id="price"
                   step="0.01"
                   value="{{ old('price', $room->price) }}"
                   required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="occupied" {{ $room->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
        </div>

        <button type="submit" class="btn">Update Room</button>

    </form>
</div>

</body>
</html>
