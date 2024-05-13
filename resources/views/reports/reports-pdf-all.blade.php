<!DOCTYPE html>
<html>
<head>
    <title>MONITORING REPORTS</title>
    <style>
        table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
        font-size: 12px;
        }

        th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        }

        .text-center{
            text-align: center;
        }

        .center-image {
            margin-top: -60px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <img src="{{ asset('style/dist/img/library header.png') }}" alt="" width="600" class="center-image">
    </div>
    @if($user_type == 'All' || $user_type == 'Students')
        <table>
            <thead>
                <tr><th class="text-center" colspan="5">STUDENTS</th></tr>
                <tr>
                    <th>FULL NAME</th>
                    <th class="text-center">COURSE YR & SEC</th>
                    <th class="text-center">TIME-IN</th>
                    <th class="text-center">TIME-OUT</th>
                    <th class="text-center">DATE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $d)
                    @if($d->user_type == 'Students')
                        <tr>
                           <td>{{ strtoupper($d->lname) }} {{ strtoupper($d->fname) }} {{ strtoupper($d->mname) }}</td>
                            <td class="text-center">{{ $d->course }} - {{ $d->year }}{{ $d->desc }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($d->time_in)->format('h:i A') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($d->time_out)->format('h:i A') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($d->date)->format('F d, Y') }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

    @if($user_type == 'All' || $user_type == 'Faculty')
        <table>
            <thead>
                <tr><th class="text-center" colspan="4">FACULTY</th></tr>
                <tr>
                    <th>FULL NAME</th>
                    <th class="text-center">TIME-IN</th>
                    <th class="text-center">TIME-OUT</th>
                    <th class="text-center">DATE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $d)
                    @if($d->user_type == 'Faculty')
                        <tr>
                            <td>{{ strtoupper($d->lname) }} {{ strtoupper($d->fname) }} {{ strtoupper($d->mname) }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($d->time_in)->format('h:i A') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($d->time_out)->format('h:i A') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($d->date)->format('F d, Y') }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

    @if($user_type == 'All' || $user_type == 'STAFF')
        <table>
            <thead>
                <tr><th class="text-center" colspan="5">STAFF</th></tr>
                <tr>
                    <th>FULL NAME</th>
                    <th class="text-center">OFFICE</th>
                    <th class="text-center">TIME-IN</th>
                    <th class="text-center">TIME-OUT</th>
                    <th class="text-center">DATE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $d)
                    @if($d->user_type == 'Staff')
                        <tr>
                           <td>{{ strtoupper($d->lname) }} {{ strtoupper($d->fname) }} {{ strtoupper($d->mname) }}</td>
                            <td class="text-center">{{ ucwords($d->office_name) }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($d->time_in)->format('h:i A') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($d->time_out)->format('h:i A') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($d->date)->format('F d, Y') }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

 @if($user_type == 'All' || $user_type == 'Visitor')
        <table>
            <thead>
                <tr><th class="text-center" colspan="5">VISITOR</th></tr>
                <tr>
                    <th>FULL NAME</th>
                    <th class="text-center">CAMPUS</th>
                    <th class="text-center">TIME-IN</th>
                    <th class="text-center">TIME-OUT</th>
                    <th class="text-center">DATE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $d)
                    @if($d->user_type == 'Visitor')
                        <tr>
                           <td>{{ strtoupper($d->lname) }} {{ strtoupper($d->fname) }} {{ strtoupper($d->mname) }}</td>
                            <td>{{ ucwords($d->campus_name) }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->time_in)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->time_out)->format('h:i A') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($d->date)->format('F d, Y') }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
