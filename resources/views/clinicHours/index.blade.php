<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="screen">
        <div class="row">
            <x-sidebar></x-sidebar>
            <div class="right">
                <div class="navbar">
                    <div>
                        <h3>診察時間</h3>
                    </div>
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="items">
                        <select name="clinic" id="clinic" class="clinic">
                            @foreach ($clinics as $clinic)
                                <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="clinic_id" id="clinic_id">
                @foreach ($days as $index => $day)
                    <div class="main">
                        @if ($day->is_holiday)
                            <div id="holidayDetails" class="holiday">
                            </div>
                        @else
                            <p id="day" class="day">{{ $day->name }}</p>
                            <select name="startHour" id="start-hour" class="start-hour">
                                @for ($hour = 0; $hour < 24; $hour++)
                                    <option value="{{ sprintf('%02d', $hour) }}" {{ $hour == 10 ? 'selected' : '' }}>
                                        {{ sprintf('%02d', $hour) }}
                                    </option>
                                @endfor
                            </select>
                            <p>時</p>
                            <select name="startMinute" id="start-minute" class="start-minute">
                                @for ($minute = 0; $minute < 60; $minute++)
                                    <option value="{{ sprintf('%02d', $minute) }}"
                                        {{ $minute == 00 ? 'selected' : '' }}>
                                        {{ sprintf('%02d', $minute) }}
                                    </option>
                                @endfor
                            </select>
                            <p>分</p>
                            <p>-</p>
                            <select name="endHour" id="end-hour" class="end-hour">
                                @for ($hour = 0; $hour < 24; $hour++)
                                    <option value="{{ sprintf('%02d', $hour) }}" {{ $hour == 19 ? 'selected' : '' }}>
                                        {{ sprintf('%02d', $hour) }}
                                    </option>
                                @endfor
                            </select>
                            <p>時</p>
                            <select name="endMinute" id="end-minute" class="end-minute">
                                @for ($minute = 0; $minute < 60; $minute++)
                                    <option value="{{ sprintf('%02d', $minute) }}"
                                        {{ $minute == 00 ? 'selected' : '' }}>
                                        {{ sprintf('%02d', $minute) }}
                                    </option>
                                @endfor
                            </select>
                            <p>分</p>
                            <button class="addTimeButton" onclick="addTime(this, '{{ $day->name }}')">時間を追加</button>

                            <input type="hidden" name="day_id" value="{{ $day->id }}">
                            <form action="/setHoliday/{{ $day->id }}" method="POST"
                                id="set-holiday-form-{{ $day->id }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="clinic_id" id="clinic-id-{{ $day->id }}"
                                    value="">
                                <button class="setHoliday"
                                    onclick="setHoliday(this, '{{ $day->id }}')">定休日に設定</button>
                            </form>
                        @endif
                    </div>

                @endforeach
                <div id="timeDetails" class="timeDetails"></div>
            </div>
        </div>
    </div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clinicSelect = document.getElementById('clinic');

        const storedClinicId = localStorage.getItem('selectedClinicId');
        if (storedClinicId) {
            clinicSelect.value = storedClinicId;
        }

        clinicSelect.addEventListener('change', function() {
            const clinicId = this.value;


            localStorage.setItem('selectedClinicId', clinicId);

            showTime(clinicId);
            showHoliday(clinicId);
        });
        if (storedClinicId) {
            showTime(storedClinicId);
            showHoliday(storedClinicId);
        }
    });


    function showTime(clinicId) {
        fetch(`/time/${clinicId}`)
            .then(response => response.json())
            .then(data => {
                const timeDetails = document.getElementById('timeDetails');

                timeDetails.innerHTML = '';

                data.forEach(time => {
                    const timeContainer = document.createElement('div');
                    timeContainer.classList.add('timeContainer');

                    timeContainer.innerHTML = `
                        <div>
                            <h5 id="day" class="day">${time.day}</h5>
                        </div>
                        <div class="addedTime">
                            <p id="startHour" class="startHour">${time.start_hour}</p>
                            <p>時</p>
                            <p id="startMinute" class="startMinute">${time.start_minute}</p>
                            <p>分</p>
                            <p>-</p>
                            <p id="endHour" class="endHour">${time.end_hour}</p>
                            <p>時</p>
                            <p id="endMinute" class="endMinute">${time.end_minute}</p>
                            <p>分</p>
                            <button class="deleteTime" onclick="deleteTime('${time.day}', ${time.id})">
                                <ion-icon name="close-outline"></ion-icon>
                            </button>
                        </div>
                    `;
                    timeDetails.appendChild(timeContainer);
                });
            })
            .catch(error => {
                console.error('Error fetching time details:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const clinicSelect = document.getElementById('clinic');

        clinicSelect.addEventListener('change', function() {
            const clinicId = this.value;

            document.querySelectorAll('.day-container').forEach(dayContainer => {
                const dayId = dayContainer.id.split('-')[
                1];
                const selectedIndex = clinicSelect.selectedIndex;

                showTime(clinicId, selectedIndex);
            });
        });
    });

    function showHoliday(clinicId) {
        fetch(`/holiday/${clinicId}`)
            .then(response => response.json())
            .then(data => {
                const holidayDetails = document.getElementById('holidayDetails');


                holidayDetails.innerHTML = '';

                data.forEach(day => {
                    const holidayContainer = document.createElement('div');
                    holidayContainer.classList.add('holidayContainer');

                    holidayContainer.innerHTML = `
                <div>
                     <h5 id="day" class="day">${day.name}</h5>
                    </div>
                    <div>
                        <p id="holiday" class="holiday">${day.name}</p>
                    </div>
                    <div>
                        <form action="/cancelHoliday/${day.id}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">休日をキャンセルする</button>
                        </form>
                    </div>
                `;

                    holidayDetails.appendChild(holidayContainer);
                });
            })
            .catch(error => {
                console.error('Error fetching vacation details:', error);
            });
    }

    function setHoliday(button, dayId) {
        var clinicId = document.getElementById('clinic').value;
        document.getElementById('clinic-id-' + dayId).value = clinicId;
        document.getElementById('set-holiday-form-' + dayId).submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('addTimeButton')) {
                var selectedDay = event.target.dataset.day;
                addTime(selectedDay);
            }
        });
    });


    function addTime(button, selectedDay) {
        var parentDiv = button.closest('.main');

        var startHour = parentDiv.querySelector('.start-hour').value;
        var startMinute = parentDiv.querySelector('.start-minute').value;
        var endHour = parentDiv.querySelector('.end-hour').value;
        var endMinute = parentDiv.querySelector('.end-minute').value;

        if (startHour > endHour || (startHour == endHour && startMinute >= endMinute)) {
            alert("Start time must be before end time.");
            return;
        }
        var clinicId = document.getElementById('clinic').value;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/time', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log('Time added successfully');
                    location.reload();
                } else {
                    console.error('Failed to add time:', xhr.status);
                }
            }
        };

        var data = JSON.stringify({
            day: selectedDay,
            startHour: startHour,
            startMinute: startMinute,
            endHour: endHour,
            endMinute: endMinute,
            clinic_id: clinicId
        });
        xhr.send(data);
    }

    function deleteTime(selectedDay, timeId) {
        var xhr = new XMLHttpRequest();
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        xhr.open('DELETE', '/time/' + timeId, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log('Time deleted successfully');
                    location.reload();
                } else {
                    console.error('Failed to delete time:', xhr.status);
                }
            }
        };

        xhr.send();
    }
</script>

</html>
