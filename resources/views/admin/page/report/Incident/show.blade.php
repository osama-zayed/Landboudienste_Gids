<!DOCTYPE html>
<html lang="ar">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تقرير البلاغات</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            direction: rtl;
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            text-align: center;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        .order-details thead tr th {
            background-color: #414ab1;
            color: #fff;
            text-align: right;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <h5 class="text-center">{{ $title }}</h5>

    <table class="order-details">
        <thead>
            <tr>
                <th>#</th>
                <th>رقم الجريمة</th>
                <th>نوع الجريمة</th>
                <th>تاريخ البلاغ</th>
                <th>مركز الشرطة</th>
                <th>زمن وقوعها</th>
                <th>تاريخ وقوعها</th>
                <th>مكان وقوعها</th>
                <th>الاسباب والدوافع</th>
                <th>الادوات المستحدمة</th>
                <th>عدد الجناه</th>
                <th>عدد الضحايا</th>
                <th>الحالة</th>
                <th>شرح البلاغ</th>
                <th>الملاحظات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $incident_statusData)
                <tr>
                    <td>{{ $incident_statusData->id }}</td>
                    <td>{{ $incident_statusData->incident_number }}</td>
                    <td>{{ $incident_statusData->crimeType->name }}</td>
                    <td>{{ $incident_statusData->incident_date }}</td>
                    <td>{{ $incident_statusData->department->name }}</td>
                    <td>{{ $incident_statusData->incident_time }}</td>
                    <td>{{ $incident_statusData->date_occurred }}</td>
                    <td>{{ $incident_statusData->incident_location }}</td>
                    <td>{{ $incident_statusData->reasons_and_motives }}</td>
                    <td>{{ $incident_statusData->tools_used }}</td>
                    <td>{{ $incident_statusData->number_of_victims }}</td>
                    <td>{{ $incident_statusData->number_of_perpetrators }}</td>
                    <td>{{ $incident_statusData->incident_status }}</td>
                    <td>{{ $incident_statusData['incident_description'] ?? '' }}</td>
                    <td>{{ $incident_statusData['notes'] ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" style="text-align: center">لا توجد بيانات متاحة.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
