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

document.addEventListener('DOMContentLoaded', function() {
    const clinicSelect = document.getElementById('clinic');

    const storedClinicId = localStorage.getItem('selectedClinicId');
    if (storedClinicId) {
        clinicSelect.value = storedClinicId;
        filterElements(storedClinicId); // Filter elements based on the stored clinic_id
    }

    clinicSelect.addEventListener('change', function() {
        const clinicId = this.value;
        localStorage.setItem('selectedClinicId', clinicId);
        filterElements(clinicId); // Filter elements based on the newly selected clinic_id
    });

    function filterElements(clinicId) {
        var holidayDivs = document.querySelectorAll('.holiday');
        holidayDivs.forEach(function(div) {
            var divClinicId = div.dataset.clinicId;
            if (divClinicId === clinicId || clinicId === 'all') {
                div.style.display = 'flex';
            } else {
                div.style.display = 'none';
            }
        });

        var addedTimeDivs = document.querySelectorAll('.addedTime');
        addedTimeDivs.forEach(function(div) {
            var divClinicId = div.dataset.clinicId;
            if (divClinicId === clinicId || clinicId === 'all') {
                div.style.display = 'flex';
            } else {
                div.style.display = 'none';
            }
        });
    }
});

