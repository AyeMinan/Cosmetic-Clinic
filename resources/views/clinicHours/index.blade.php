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
                        <select name="clinic" id="clinic" class="clinic" onchange="filterAddedTimes()">
                            @foreach ($clinics as $clinic)
                                <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @foreach ($days as $index => $day)
                    <div class="main">

                        @if ($day->is_holiday)
                            <div class="holiday" data-clinic-id="{{ $day->clinic_id }}">
                                <h5 id="day" class="day">{{ $day->name }}</h5>
                                <div>
                                    <p id="holiday">{{ $day->name }}</p>
                                </div>
                                <div>
                                    <form action="/cancelHoliday/{{ $day->id }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit">休日をキャンセルする</button>
                                    </form>
                                </div>
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


                            @foreach ($addedTimes[$index] as $addedTime)
                                @if ($addedTime)
                                    <div class="addedTime" data-clinic-id="{{ $addedTime->clinic_id }}">
                                        <select name="startHour" id="start-hour" class="start-hour">
                                            <option value="00">{{ $addedTime->start_hour }}</option>
                                        </select>
                                        <p>時</p>
                                        <select name="startMinute" id="start-minute" class="start-minute">
                                            <option value="00">{{ $addedTime->start_minute }}</option>
                                        </select>
                                        <p>分</p>
                                        <p>-</p>
                                        <select name="endHour" id="end-hour" class="end-hour">
                                            <option value="00">{{ $addedTime->end_hour }}</option>
                                        </select>
                                        <p>時</p>
                                        <select name="endMinute" id="end-minute" class="end-minute">
                                            <option value="00">{{ $addedTime->end_minute }}</option>
                                        </select>
                                        <p>分</p>
                                        <button class="deleteTime"
                                            onclick="deleteTime('{{ $day->name }}', {{ $addedTime->id }})"><ion-icon
                                                name="close-outline"></ion-icon></button>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

<script src="js/script.js"></script>

</html>
