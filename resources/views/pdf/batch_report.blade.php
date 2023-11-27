<style>
    .table {
        width: 100%;
    }
    .table td {
        font-size:7rem;
        text-align: center;
    }
    .table th {
        text-align: center;
        background-color: white;
        font-size:8rem;
        border-bottom: 1px solid #000000;
        vertical-align: bottom;
    }
</style>

<table class="table">
    <thead>
        <tr>
            <th>Claim number</th>
            <th>Patient number</th>
            <th>Patient name</th>
            <th>Doctor</th>
            <th>Insurance plan</th>
            <th>By report?</th>
            <th>Facility</th>
            <th>DOS</th>
            <th>File date</th>
            <th>File amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($claimsByPlan ?? [] as $records)
            @php
                $total = 0.00;
            @endphp
            <tr>
                <td colspan="10" style="text-align: left">
                    <strong> {{ $records['insurancePlan'] }} </strong>
                </td>
            </tr>
            @foreach($records['claims'] as $claim)
                @php
                    $total += (float) Str::replace(',', '', $claim['amount']);
                @endphp
                <tr>
                    <td> {{ $claim['code'] }} </td>
                    <td> {{ $claim['patientNumber'] }} </td>
                    <td> {{ $claim['patientName'] }} </td>
                    <td> {{ $claim['healthProfessional'] }} </td>
                    <td> {{ $records['insurancePlan'] }} </td>
                    <td></td>
                    <td> {{ $claim['facility'] }} </td>
                    <td> {{ $claim['date_of_service'] }} </td>
                    <td style="text-align: right"> {{ $shipping_date }} </td>
                    <td style="text-align: right"> $ {{ $claim['amount'] }} </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: right">
                    <strong> Totals for: </strong> {{ $records['insurancePlan'] }}
                </td>
                <td></td>
                <td></td>
                <td style="text-align: right; border-top: 1px solid #000000;">{{ count($records['claims']) }}</td>
                <td style="text-align: right; border-top: 1px solid #000000;">$ {{ number_format($total, 2) }}</td>
            </tr>
            <tr style="height: 20px;"><td colspan="10"></td></tr>
        @endforeach
    </tbody>
</table>