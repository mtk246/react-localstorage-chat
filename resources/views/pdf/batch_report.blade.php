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
@php
    $grandTotal = 0.00;
    $totalClaims = 0;
@endphp
<table class="table">
    <thead>
        <tr>
            <th>Claim number</th>
            <th>Patient number</th>
            <th>Patient</th>
            <th>Healthcare P</th>
            <th>Plan</th>
            <th>Facility</th>
            <th>DOS</th>
            <th>File amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($claimsByPlan ?? [] as $records)
            @php
                $total = 0.00;
                $totalClaims += count($records['claims']);
            @endphp
            <tr>
                <td colspan="8" style="text-align: left">
                    <strong> {{ $records['insuranceCompany'] }} </strong>
                </td>
            </tr>
            @foreach($records['claims'] as $claim)
                @php
                    $total += (float) Str::replace(',', '', $claim['amount']);
                    $grandTotal += (float) Str::replace(',', '', $claim['amount']);
                @endphp
                <tr>
                    <td> {{ $claim['code'] }} </td>
                    <td> {{ $claim['patientNumber'] }} </td>
                    <td> {{ $claim['patientName'] }} </td>
                    <td> {{ $claim['healthProfessional'] }} </td>
                    <td> {{ $claim['insurancePlan'] }} </td>
                    <td> {{ $claim['facility'] }} </td>
                    <td> {{ $claim['date_of_service'] }} </td>
                    <td style="text-align: right"> $ {{ $claim['amount'] }} </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: right">
                    <strong> Totals for: </strong> {{ $records['insuranceCompany'] }}
                </td>
                <td style="text-align: right; border-top: 1px solid #000000;">{{ count($records['claims']) }}</td>
                <td style="text-align: right; border-top: 1px solid #000000;">$ {{ number_format($total, 2) }}</td>
            </tr>
            <tr style="height: 20px;"><td colspan="10"></td></tr>
        @endforeach
        <tr>
            <td colspan="6" style="text-align: right">
                <strong> Grand total: </strong>
            </td>
            <td style="text-align: right; border-top: 1px solid #000000;">{{ $totalClaims }}</td>
            <td style="text-align: right; border-top: 1px solid #000000;">$ {{ number_format($grandTotal, 2) }}</td>
        </tr>
    </tbody>
</table>