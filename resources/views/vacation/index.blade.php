<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>

</head>

<body>
    <div class="screen">
        <div class="row">
            <x-sidebar></x-sidebar>

            <div class="right">
                <div class="navbar">
                    <div>
                        <h3>長期休暇設定</h3>
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

                <div class="main">
                    <h3 class="time">期間</h3>
                    <form action="/vacation" method="POST">
                        @csrf
                        <input type="hidden" name="clinic_id" id="clinic_id">
                        <input name="start_date" type="date" id="date1">
                        @error('start_date')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input name="end_date" type="date" id="date2">
                        @error('end_date')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input name="reason" type="text" placeholder="理由を入力">
                        @error('reason')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="save">保存する</button>
                    </form>

                </div>

                <div id="vacationDetails">
                </div>
            </div>
        </div>
    </div>
    <x-modal></x-modal>
    <script>
        function confirmDelete(start_date, end_date, reason, id) {
            var confirmationText = 'test.jpの内容\n\n' +
                start_date + ' ~ ' + end_date + '\n' +
                reason + '\n\n' +
                'Are you sure you want to delete this vacation?';

            document.getElementById('confirmationText').innerText = confirmationText;
            document.getElementById('confirmationModal').style.display = 'block';


            document.getElementById('confirmButton').onclick = function() {

                document.getElementById('deleteForm' + id).submit();
            };

            document.getElementById('cancelButton').onclick = function() {
                document.getElementById('confirmationModal').style.display = 'none';
            };
        }

        document.addEventListener('DOMContentLoaded', function() {

            var clinicSelect = document.getElementById('clinic');
            var clinicIdInput = document.getElementById('clinic_id');

            clinicIdInput.value = clinicSelect.value;

            clinicSelect.addEventListener('change', function() {

                clinicIdInput.value = this.value;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {

            var clinicSelect = document.getElementById('clinic');
            var clinicIdInput = document.getElementById('clinic_id');

            var storedClinicId = localStorage.getItem('selectedClinicId');
            if (storedClinicId) {
                clinicIdInput.value = storedClinicId;
                clinicSelect.value = storedClinicId;
            } else {
                clinicIdInput.value = clinicSelect.value;
            }

            clinicSelect.addEventListener('change', function() {

                clinicIdInput.value = this.value;
                localStorage.setItem('selectedClinicId', this.value);
            });

            showVacations(clinicIdInput.value);
        });

        function showVacations(clinicId) {
            fetch(`/vacation/${clinicId}`)
                .then(response => response.json())
                .then(data => {
                    const vacationDetails = document.getElementById('vacationDetails');
                    vacationDetails.innerHTML = '';

                    data.forEach(vacation => {
                        const div = document.createElement('div');
                        div.classList.add('main');
                        div.innerHTML = `
                        <p>${vacation.start_date} ~ ${vacation.end_date}</p>
                        <p>${vacation.reason}</p>
                        <form id="deleteForm${vacation.id}" action="/vacation/${vacation.id}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="button" class="deleteBtn" onclick="confirmDelete('${vacation.start_date}', '${vacation.end_date}', '${vacation.reason}', '${vacation.id}')">削除</button>
                        </form>
                    `;
                        vacationDetails.appendChild(div);
                    });
                })
                .catch(error => {
                    console.error('Error fetching vacation details:', error);
                });
        }


        document.getElementById('clinic').addEventListener('change', function() {
            const clinicId = this.value;
            showVacations(clinicId);
        });


        const defaultClinicId = document.getElementById('clinic').value;
        showVacations(defaultClinicId);
    </script>
</body>

</html>
